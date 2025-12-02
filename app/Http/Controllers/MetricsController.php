<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MetricsController extends Controller
{
    /**
     * Export metrics in Prometheus format
     */
    public function index()
    {
        $metrics = [];

        // Collect HTTP request metrics
        $metrics = array_merge($metrics, $this->getHttpMetrics());

        // Collect database metrics
        $metrics = array_merge($metrics, $this->getDatabaseMetrics());

        // Collect cache metrics
        $metrics = array_merge($metrics, $this->getCacheMetrics());

        // Collect application-specific metrics
        $metrics = array_merge($metrics, $this->getApplicationMetrics());

        // Format as Prometheus text format
        $output = $this->formatPrometheusMetrics($metrics);

        return response($output, 200)
            ->header('Content-Type', 'text/plain; version=0.0.4');
    }

    /**
     * Get HTTP request metrics from cache
     */
    private function getHttpMetrics(): array
    {
        $metrics = [];

        // Get all metric keys from cache
        $keys = Cache::get('metrics_keys', []);

        foreach ($keys as $key) {
            if (str_starts_with($key, 'metrics_http_')) {
                $value = Cache::get($key, 0);
                $metricName = str_replace('metrics_', '', explode('_', $key)[1] . '_' . explode('_', $key)[2] . '_' . explode('_', $key)[3]);
                $metrics[] = [
                    'name' => $metricName,
                    'type' => 'counter',
                    'value' => $value,
                    'labels' => [],
                ];
            }
        }

        return $metrics;
    }

    /**
     * Get database metrics
     */
    private function getDatabaseMetrics(): array
    {
        $metrics = [];

        try {
            // Get table row counts
            $tables = ['students', 'instructors', 'courses', 'chapters', 'lessons', 'student_course'];

            foreach ($tables as $table) {
                $count = DB::table($table)->count();
                $metrics[] = [
                    'name' => 'laravel_database_table_rows',
                    'type' => 'gauge',
                    'value' => $count,
                    'labels' => ['table' => $table],
                ];
            }

            // Get active student enrollments
            $activeEnrollments = DB::table('student_course')
                ->where('status', 'active')
                ->count();

            $metrics[] = [
                'name' => 'laravel_active_enrollments',
                'type' => 'gauge',
                'value' => $activeEnrollments,
                'labels' => [],
            ];

            // Get pending courses (awaiting approval)
            $pendingCourses = DB::table('courses')
                ->where('status', 'pending')
                ->count();

            $metrics[] = [
                'name' => 'laravel_pending_courses',
                'type' => 'gauge',
                'value' => $pendingCourses,
                'labels' => [],
            ];

        } catch (\Exception $e) {
            // Log error but continue
            \Log::error('Error collecting database metrics: ' . $e->getMessage());
        }

        return $metrics;
    }

    /**
     * Get cache metrics
     */
    private function getCacheMetrics(): array
    {
        $metrics = [];

        try {
            // Redis connection check
            $redisConnected = 1;
            try {
                Redis::ping();
            } catch (\Exception $e) {
                $redisConnected = 0;
            }

            $metrics[] = [
                'name' => 'laravel_redis_connected',
                'type' => 'gauge',
                'value' => $redisConnected,
                'labels' => [],
            ];

            // Get Redis memory info if connected
            if ($redisConnected) {
                $info = Redis::info('memory');
                if (isset($info['used_memory'])) {
                    $metrics[] = [
                        'name' => 'laravel_redis_memory_bytes',
                        'type' => 'gauge',
                        'value' => $info['used_memory'],
                        'labels' => [],
                    ];
                }
            }

        } catch (\Exception $e) {
            \Log::error('Error collecting cache metrics: ' . $e->getMessage());
        }

        return $metrics;
    }

    /**
     * Get application-specific metrics
     */
    private function getApplicationMetrics(): array
    {
        $metrics = [];

        try {
            // Queue metrics
            $failedJobs = DB::table('failed_jobs')->count();
            $metrics[] = [
                'name' => 'laravel_queue_failed_jobs_total',
                'type' => 'counter',
                'value' => $failedJobs,
                'labels' => [],
            ];

            // User metrics
            $totalStudents = DB::table('students')->count();
            $totalInstructors = DB::table('instructors')->count();
            $totalAdmins = DB::table('admin')->count();

            $metrics[] = [
                'name' => 'laravel_users_total',
                'type' => 'gauge',
                'value' => $totalStudents,
                'labels' => ['type' => 'students'],
            ];

            $metrics[] = [
                'name' => 'laravel_users_total',
                'type' => 'gauge',
                'value' => $totalInstructors,
                'labels' => ['type' => 'instructors'],
            ];

            $metrics[] = [
                'name' => 'laravel_users_total',
                'type' => 'gauge',
                'value' => $totalAdmins,
                'labels' => ['type' => 'admins'],
            ];

            // Course metrics
            $publishedCourses = DB::table('courses')
                ->where('status', 'approved')
                ->count();

            $metrics[] = [
                'name' => 'laravel_courses_total',
                'type' => 'gauge',
                'value' => $publishedCourses,
                'labels' => ['status' => 'published'],
            ];

            // Lesson completion rate
            $totalLessons = DB::table('lessons')->count();
            $completedLessons = DB::table('student_lesson_completion')->count();
            $completionRate = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;

            $metrics[] = [
                'name' => 'laravel_lesson_completion_rate',
                'type' => 'gauge',
                'value' => round($completionRate, 2),
                'labels' => [],
            ];

        } catch (\Exception $e) {
            \Log::error('Error collecting application metrics: ' . $e->getMessage());
        }

        return $metrics;
    }

    /**
     * Format metrics in Prometheus text format
     */
    private function formatPrometheusMetrics(array $metrics): string
    {
        $output = "# AllnGrow Application Metrics\n";
        $output .= "# Generated at: " . date('Y-m-d H:i:s') . "\n\n";

        $groupedMetrics = [];

        // Group metrics by name
        foreach ($metrics as $metric) {
            $name = $metric['name'];
            if (!isset($groupedMetrics[$name])) {
                $groupedMetrics[$name] = [
                    'type' => $metric['type'],
                    'values' => [],
                ];
            }
            $groupedMetrics[$name]['values'][] = [
                'value' => $metric['value'],
                'labels' => $metric['labels'] ?? [],
            ];
        }

        // Format each metric
        foreach ($groupedMetrics as $name => $data) {
            // Add TYPE comment
            $output .= "# TYPE {$name} {$data['type']}\n";

            // Add each value
            foreach ($data['values'] as $valueData) {
                $labelString = '';
                if (!empty($valueData['labels'])) {
                    $labelPairs = [];
                    foreach ($valueData['labels'] as $key => $value) {
                        $labelPairs[] = $key . '="' . addslashes($value) . '"';
                    }
                    $labelString = '{' . implode(',', $labelPairs) . '}';
                }

                $output .= "{$name}{$labelString} {$valueData['value']}\n";
            }

            $output .= "\n";
        }

        return $output;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class MetricsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);

        // Process the request
        $response = $next($request);

        // Calculate request duration
        $duration = microtime(true) - $startTime;

        // Collect metrics
        $this->collectMetrics($request, $response, $duration);

        return $response;
    }

    /**
     * Collect and store metrics
     */
    private function collectMetrics(Request $request, Response $response, float $duration): void
    {
        $method = $request->method();
        $route = $request->route() ? $request->route()->uri() : 'unknown';
        $statusCode = $response->getStatusCode();
        $statusClass = substr((string)$statusCode, 0, 1) . 'xx';

        // Increment request counter
        $this->incrementCounter("http_requests_total", [
            'method' => $method,
            'route' => $route,
            'status' => $statusCode,
            'status_class' => $statusClass,
        ]);

        // Store request duration
        $this->recordHistogram("http_request_duration_seconds", $duration, [
            'method' => $method,
            'route' => $route,
        ]);

        // Track error responses
        if ($statusCode >= 400) {
            $this->incrementCounter("http_errors_total", [
                'method' => $method,
                'route' => $route,
                'status' => $statusCode,
            ]);
        }

        // Track slow requests (> 1 second)
        if ($duration > 1.0) {
            $this->incrementCounter("http_slow_requests_total", [
                'method' => $method,
                'route' => $route,
                'duration' => $duration,
            ]);
        }
    }

    /**
     * Increment a counter metric
     */
    private function incrementCounter(string $metric, array $labels = []): void
    {
        $key = $this->buildMetricKey($metric, $labels);
        Cache::increment($key, 1);

        // Set expiration to 1 hour for metric retention
        if (!Cache::has($key . '_ttl')) {
            Cache::put($key . '_ttl', true, 3600);
        }
    }

    /**
     * Record a histogram metric
     */
    private function recordHistogram(string $metric, float $value, array $labels = []): void
    {
        $key = $this->buildMetricKey($metric, $labels);

        // Store histogram data as array
        $histogram = Cache::get($key, [
            'count' => 0,
            'sum' => 0,
            'buckets' => [0.005, 0.01, 0.025, 0.05, 0.1, 0.25, 0.5, 1.0, 2.5, 5.0, 10.0],
            'bucket_counts' => array_fill(0, 11, 0),
        ]);

        $histogram['count']++;
        $histogram['sum'] += $value;

        // Update bucket counts
        foreach ($histogram['buckets'] as $index => $bucket) {
            if ($value <= $bucket) {
                $histogram['bucket_counts'][$index]++;
            }
        }

        Cache::put($key, $histogram, 3600);
    }

    /**
     * Build a unique metric key with labels
     */
    private function buildMetricKey(string $metric, array $labels): string
    {
        $labelString = '';
        if (!empty($labels)) {
            ksort($labels);
            $labelString = '_' . md5(json_encode($labels));
        }
        return 'metrics_' . $metric . $labelString;
    }
}

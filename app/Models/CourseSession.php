<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'session_type',
        'meeting_link',
        'meeting_id',
        'meeting_password',
        'location_name',
        'location_address',
        'start_time',
        'end_time',
        'duration_minutes',
        'max_participants',
        'status',
        'recording_url'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'max_participants' => 'integer',
        'duration_minutes' => 'integer'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'courseID');
    }

    // Check if session is upcoming
    public function getIsUpcomingAttribute()
    {
        return $this->start_time > now() && $this->status === 'scheduled';
    }

    // Check if session is ongoing
    public function getIsOngoingAttribute()
    {
        return now()->between($this->start_time, $this->end_time) || $this->status === 'ongoing';
    }

    // Get formatted date
    public function getFormattedDateAttribute()
    {
        return $this->start_time->format('d M Y');
    }

    // Get formatted time
    public function getFormattedTimeAttribute()
    {
        return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
    }

    // Get duration in hours and minutes
    public function getFormattedDurationAttribute()
    {
        if ($this->duration_minutes) {
            $hours = floor($this->duration_minutes / 60);
            $minutes = $this->duration_minutes % 60;

            if ($hours > 0 && $minutes > 0) {
                return "{$hours}h {$minutes}m";
            } elseif ($hours > 0) {
                return "{$hours}h";
            } else {
                return "{$minutes}m";
            }
        }

        return '-';
    }
}

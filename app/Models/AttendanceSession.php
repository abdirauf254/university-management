<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttendanceSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'course_offering_id',
        'timetable_id',
        'session_date',
        'start_time',
        'end_time',
        'recorded_by',
        'status',
    ];

    /**
     * University this attendance session belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Course offering for this attendance session.
     */
    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }

    /**
     * Timetable entry associated with this session.
     */
    public function timetable(): BelongsTo
    {
        return $this->belongsTo(Timetable::class);
    }

    /**
     * Lecturer/user who recorded the attendance.
     */
    public function recorder(): BelongsTo
    {
        return $this->belongsTo(
            LecturerProfile::class,
            'recorded_by'
        );
    }

    /**
     * Individual student attendance records.
     */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(StudentAttendance::class);
    }

    /**
     * Cast date and time attributes.
     */
    protected function casts(): array
    {
        return [
            'session_date' => 'date',
        ];
    }
}
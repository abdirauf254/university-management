<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_session_id',
        'student_id',
        'status',
        'remarks',
    ];

    /**
     * Attendance session this record belongs to.
     */
    public function attendanceSession(): BelongsTo
    {
        return $this->belongsTo(AttendanceSession::class);
    }

    /**
     * Student whose attendance is recorded.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            StudentProfile::class,
            'student_id'
        );
    }
}
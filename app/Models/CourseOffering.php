<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseOffering extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'course_id',
        'academic_year_id',
        'semester_id',
        'section',
        'capacity',
        'status',
    ];

    /**
     * University this course offering belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Course being offered.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Academic year for this offering.
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Semester for this offering.
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    /**
     * Lecturers assigned to this course offering.
     */
    public function lecturerAssignments(): HasMany
    {
        return $this->hasMany(CourseOfferingLecturer::class);
    }

    /**
     * Student registrations for this offering.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

    /**
     * Timetable entries for this offering.
     */
    public function timetables(): HasMany
    {
        return $this->hasMany(Timetable::class);
    }

    /**
     * Attendance sessions for this offering.
     */
    public function attendanceSessions(): HasMany
    {
        return $this->hasMany(AttendanceSession::class);
    }

    /**
     * Exams associated with this offering.
     */
    public function examCourses(): HasMany
    {
        return $this->hasMany(ExamCourse::class);
    }

    /**
     * Assessments for this offering.
     */
    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    /**
     * Final course results for this offering.
     */
    public function courseResults(): HasMany
    {
        return $this->hasMany(CourseResult::class);
    }

    /**
     * Cast attributes to appropriate types.
     */
    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
        ];
    }
}
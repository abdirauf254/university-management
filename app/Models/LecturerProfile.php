<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LecturerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'user_id',
        'employee_number',
        'department_id',
        'phone',
        'qualification',
        'specialization',
        'joining_date',
        'status',
    ];

    /**
     * University this lecturer belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * User account associated with this lecturer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Department this lecturer belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Course offerings assigned to this lecturer.
     */
    public function courseOfferingAssignments(): HasMany
    {
        return $this->hasMany(CourseOfferingLecturer::class);
    }

    /**
     * Attendance sessions recorded by this lecturer.
     */
    public function attendanceSessions(): HasMany
    {
        return $this->hasMany(AttendanceSession::class, 'recorded_by');
    }
    
    /**
     * Assessment results recorded by this lecturer.
     */
    public function assessmentResults(): HasMany
    {
        return $this->hasMany(AssessmentResult::class, 'recorded_by');
    }

    /**
     * Course results recorded by this lecturer.
     */
    public function courseResults(): HasMany
    {
        return $this->hasMany(CourseResult::class, 'recorded_by');
    }

    /**
     * Cast date attributes.
     */
    protected function casts(): array
    {
        return [
            'joining_date' => 'date',
        ];
    }
}
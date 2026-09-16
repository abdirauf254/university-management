<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'department_id',
        'code',
        'name',
        'description',
        'credit_hours',
        'level',
        'status',
    ];

    /**
     * University this course belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Department responsible for this course.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Curricula containing this course.
     */
    public function curriculumCourses(): HasMany
    {
        return $this->hasMany(CurriculumCourse::class);
    }

    /**
     * Course prerequisites.
     */
    public function prerequisites(): HasMany
    {
        return $this->hasMany(
            CoursePrerequisite::class,
            'course_id'
        );
    }

    /**
     * Courses that require this course as a prerequisite.
     */
    public function prerequisiteFor(): HasMany
    {
        return $this->hasMany(
            CoursePrerequisite::class,
            'prerequisite_course_id'
        );
    }

    /**
     * Course offerings.
     */
    public function courseOfferings(): HasMany
    {
        return $this->hasMany(CourseOffering::class);
    }

    /**
     * Cast attributes to appropriate types.
     */
    protected function casts(): array
    {
        return [
            'credit_hours' => 'decimal:2',
        ];
    }
}
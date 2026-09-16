<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'program_id',
        'name',
        'version',
        'effective_from',
        'effective_to',
        'status',
    ];

    /**
     * University this curriculum belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Program this curriculum belongs to.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Courses included in this curriculum.
     */
    public function curriculumCourses(): HasMany
    {
        return $this->hasMany(CurriculumCourse::class);
    }

    /**
     * Student enrollments using this curriculum.
     */
    public function studentProgramEnrollments(): HasMany
    {
        return $this->hasMany(StudentProgramEnrollment::class);
    }

    /**
     * Cast date attributes.
     */
    protected function casts(): array
    {
        return [
            'effective_from' => 'date',
            'effective_to' => 'date',
        ];
    }
}
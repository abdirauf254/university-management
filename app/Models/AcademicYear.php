<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'name',
        'start_date',
        'end_date',
        'is_current',
        'status',
    ];

    /**
     * University this academic year belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Semesters belonging to this academic year.
     */
    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    /**
     * Student program enrollments using this academic year.
     */
    public function studentProgramEnrollments(): HasMany
    {
        return $this->hasMany(StudentProgramEnrollment::class);
    }

    /**
     * Applications for this academic year.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Course offerings for this academic year.
     */
    public function courseOfferings(): HasMany
    {
        return $this->hasMany(CourseOffering::class);
    }

    /**
     * Exams for this academic year.
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    /**
     * Fee structures for this academic year.
     */
    public function feeStructures(): HasMany
    {
        return $this->hasMany(FeeStructure::class);
    }

    /**
     * Invoices for this academic year.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Graduation batches for this academic year.
     */
    public function graduationBatches(): HasMany
    {
        return $this->hasMany(GraduationBatch::class);
    }

    /**
     * Cast attributes to their appropriate types.
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
        ];
    }
}
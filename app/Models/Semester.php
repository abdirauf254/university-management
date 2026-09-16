<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'academic_year_id',
        'name',
        'number',
        'start_date',
        'end_date',
        'is_current',
        'status',
    ];

    /**
     * University this semester belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Academic year this semester belongs to.
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Course offerings for this semester.
     */
    public function courseOfferings(): HasMany
    {
        return $this->hasMany(CourseOffering::class);
    }

    /**
     * Exams for this semester.
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    /**
     * Fee structures for this semester.
     */
    public function feeStructures(): HasMany
    {
        return $this->hasMany(FeeStructure::class);
    }

    /**
     * Invoices for this semester.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Cast attributes to their appropriate types.
     */
    protected function casts(): array
    {
        return [
            'number' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_current' => 'boolean',
        ];
    }
}
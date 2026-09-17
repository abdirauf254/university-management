<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GraduationCandidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'graduation_batch_id',
        'student_id',
        'student_program_enrollment_id',
        'final_cgpa',
        'classification',
        'eligibility_status',
        'graduation_status',
        'approved_by',
        'approved_at',
        'notes',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function graduationBatch(): BelongsTo
    {
        return $this->belongsTo(GraduationBatch::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            StudentProfile::class,
            'student_id'
        );
    }

    public function studentProgramEnrollment(): BelongsTo
    {
        return $this->belongsTo(
            StudentProgramEnrollment::class,
            'student_program_enrollment_id'
        );
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }

    public function clearances(): HasMany
    {
        return $this->hasMany(StudentClearance::class);
    }

    protected function casts(): array
    {
        return [
            'final_cgpa' => 'decimal:2',
            'approved_at' => 'datetime',
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProgramEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'student_id',
        'program_id',
        'curriculum_id',
        'academic_year_id',
        'admission_date',
        'expected_graduation_date',
        'completion_date',
        'status',
    ];

    /**
     * University this enrollment belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Student associated with this enrollment.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    /**
     * Program the student is enrolled in.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Curriculum being followed by the student.
     */
    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class);
    }

    /**
     * Academic year in which the enrollment began.
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Graduation candidates associated with this enrollment.
     */
    public function graduationCandidates(): HasMany
    {
        return $this->hasMany(
            GraduationCandidate::class,
            'student_program_enrollment_id'
        );
    }

    /**
     * Cast date attributes.
     */
    protected function casts(): array
    {
        return [
            'admission_date' => 'date',
            'expected_graduation_date' => 'date',
            'completion_date' => 'date',
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialClearance extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'student_id',
        'academic_year_id',
        'semester_id',
        'status',
        'cleared_by',
        'cleared_at',
        'remarks',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            StudentProfile::class,
            'student_id'
        );
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function clearedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'cleared_by'
        );
    }

    protected function casts(): array
    {
        return [
            'cleared_at' => 'datetime',
        ];
    }
}
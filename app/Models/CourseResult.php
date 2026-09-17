<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'student_id',
        'course_offering_id',
        'total_marks',
        'grade',
        'grade_point',
        'status',
        'remarks',
        'recorded_by',
        'approved_by',
        'approved_at',
        'published_at',
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

    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(
            LecturerProfile::class,
            'recorded_by'
        );
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }

    protected function casts(): array
    {
        return [
            'total_marks' => 'decimal:2',
            'grade_point' => 'decimal:2',
            'approved_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'student_id',
        'marks',
        'status',
        'remarks',
        'recorded_by',
        'recorded_at',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            StudentProfile::class,
            'student_id'
        );
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(
            LecturerProfile::class,
            'recorded_by'
        );
    }

    protected function casts(): array
    {
        return [
            'marks' => 'decimal:2',
            'recorded_at' => 'datetime',
        ];
    }
}
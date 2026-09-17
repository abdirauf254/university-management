<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentClearance extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'graduation_candidate_id',
        'clearance_type_id',
        'status',
        'cleared_by',
        'cleared_at',
        'remarks',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function graduationCandidate(): BelongsTo
    {
        return $this->belongsTo(
            GraduationCandidate::class
        );
    }

    public function clearanceType(): BelongsTo
    {
        return $this->belongsTo(
            ClearanceType::class
        );
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
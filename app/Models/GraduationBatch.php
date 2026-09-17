<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GraduationBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'academic_year_id',
        'name',
        'code',
        'graduation_date',
        'description',
        'status',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function candidates(): HasMany
    {
        return $this->hasMany(GraduationCandidate::class);
    }

    protected function casts(): array
    {
        return [
            'graduation_date' => 'date',
        ];
    }
}
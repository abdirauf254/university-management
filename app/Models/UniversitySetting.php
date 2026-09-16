<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UniversitySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'timezone',
        'currency',
        'academic_year_start_month',
        'grading_system',
        'transcript_format',
        'attendance_enabled',
        'finance_enabled',
        'examination_enabled',
    ];

    /**
     * University these settings belong to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'academic_year_start_month' => 'integer',
            'attendance_enabled' => 'boolean',
            'finance_enabled' => 'boolean',
            'examination_enabled' => 'boolean',
        ];
    }
}
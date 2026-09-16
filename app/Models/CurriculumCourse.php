<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurriculumCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum_id',
        'course_id',
        'year_of_study',
        'semester_number',
        'is_core',
        'credit_hours',
    ];

    /**
     * Curriculum this record belongs to.
     */
    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class);
    }

    /**
     * Course included in the curriculum.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Cast attributes to appropriate types.
     */
    protected function casts(): array
    {
        return [
            'year_of_study' => 'integer',
            'semester_number' => 'integer',
            'is_core' => 'boolean',
            'credit_hours' => 'decimal:2',
        ];
    }
}
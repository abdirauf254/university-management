<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoursePrerequisite extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'prerequisite_course_id',
    ];

    /**
     * Course that requires the prerequisite.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(
            Course::class,
            'course_id'
        );
    }

    /**
     * Course that must be completed first.
     */
    public function prerequisiteCourse(): BelongsTo
    {
        return $this->belongsTo(
            Course::class,
            'prerequisite_course_id'
        );
    }
}
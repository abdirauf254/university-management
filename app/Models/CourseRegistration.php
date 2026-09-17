<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'student_id',
        'course_offering_id',
        'registered_at',
        'status',
        'approved_by',
        'approved_at',
        'dropped_at',
    ];

    /**
     * University this registration belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Student who registered for the course.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            StudentProfile::class,
            'student_id'
        );
    }

    /**
     * Course offering being registered for.
     */
    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }

    /**
     * User who approved the registration.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }

    /**
     * Cast date and time fields.
     */
    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
            'approved_at' => 'datetime',
            'dropped_at' => 'datetime',
        ];
    }
}
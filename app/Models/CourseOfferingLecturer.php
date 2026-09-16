<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseOfferingLecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_offering_id',
        'lecturer_id',
        'role',
    ];

    /**
     * Course offering this lecturer is assigned to.
     */
    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }

    /**
     * Lecturer assigned to the course offering.
     */
    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(
            LecturerProfile::class,
            'lecturer_id'
        );
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'course_offering_id',
        'room_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    /**
     * University this timetable belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Course offering scheduled in this timetable.
     */
    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }

    /**
     * Room where the class takes place.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Cast timetable attributes.
     */
    protected function casts(): array
    {
        return [
            'day_of_week' => 'integer',
        ];
    }
}
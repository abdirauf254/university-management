<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'campus_id',
        'building',
        'name',
        'capacity',
        'status',
    ];

    /**
     * University this room belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Campus this room belongs to.
     */
    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class);
    }

    /**
     * Timetable entries using this room.
     */
    public function timetables(): HasMany
    {
        return $this->hasMany(Timetable::class);
    }

    /**
     * Exam courses using this room.
     */
    public function examCourses(): HasMany
    {
        return $this->hasMany(ExamCourse::class);
    }
}
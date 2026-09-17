<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'course_offering_id',
        'exam_date',
        'start_time',
        'end_time',
        'room_id',
        'total_marks',
        'pass_marks',
        'status',
    ];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function courseOffering(): BelongsTo
    {
        return $this->belongsTo(CourseOffering::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    protected function casts(): array
    {
        return [
            'exam_date' => 'date',
            'total_marks' => 'decimal:2',
            'pass_marks' => 'decimal:2',
        ];
    }
}
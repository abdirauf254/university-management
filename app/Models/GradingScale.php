<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradingScale extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'name',
        'min_mark',
        'max_mark',
        'grade',
        'grade_point',
        'description',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    protected function casts(): array
    {
        return [
            'min_mark' => 'decimal:2',
            'max_mark' => 'decimal:2',
            'grade_point' => 'decimal:2',
        ];
    }
}
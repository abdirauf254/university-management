<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClearanceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'name',
        'code',
        'description',
        'is_required',
        'status',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function studentClearances(): HasMany
    {
        return $this->hasMany(StudentClearance::class);
    }

    protected function casts(): array
    {
        return [
            'is_required' => 'boolean',
        ];
    }
}
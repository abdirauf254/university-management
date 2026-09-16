<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'name',
        'code',
        'description',
        'status',
    ];

    /**
     * University this faculty belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Departments belonging to this faculty.
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Users assigned to this faculty, including leadership history.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'faculty_user'
        )->withPivot([
            'position',
            'start_date',
            'end_date',
        ])->withTimestamps();
    }
}
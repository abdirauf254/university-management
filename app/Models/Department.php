<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'faculty_id',
        'name',
        'code',
        'description',
        'status',
    ];

    /**
     * University this department belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Faculty this department belongs to.
     */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Programs belonging to this department.
     */
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    /**
     * Courses belonging to this department.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Users assigned to this department, including HOD history.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'department_user'
        )->withPivot([
            'position',
            'start_date',
            'end_date',
        ])->withTimestamps();
    }
}
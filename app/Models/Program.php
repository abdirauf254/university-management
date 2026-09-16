<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'department_id',
        'name',
        'code',
        'level',
        'duration_years',
        'description',
        'status',
    ];

    /**
     * University this program belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Department responsible for this program.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Curricula belonging to this program.
     */
    public function curricula(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }

    /**
     * Student program enrollments.
     */
    public function studentProgramEnrollments(): HasMany
    {
        return $this->hasMany(StudentProgramEnrollment::class);
    }

    /**
     * Application choices for this program.
     */
    public function applicationProgramChoices(): HasMany
    {
        return $this->hasMany(ApplicationProgramChoice::class);
    }

    /**
     * Cast attributes to appropriate types.
     */
    protected function casts(): array
    {
        return [
            'duration_years' => 'decimal:2',
        ];
    }
}
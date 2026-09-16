<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationProgramChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'program_id',
        'choice_order',
        'status',
    ];

    /**
     * Application this choice belongs to.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Program selected by the applicant.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Cast attributes to appropriate types.
     */
    protected function casts(): array
    {
        return [
            'choice_order' => 'integer',
        ];
    }
}
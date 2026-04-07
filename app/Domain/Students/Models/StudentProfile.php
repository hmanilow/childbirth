<?php

namespace App\Domain\Students\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends DomainModel
{
    protected $fillable = [
        'user_id',
        'city',
        'birth_due_date',
        'notes',
        'preferences',
    ];

    protected function casts(): array
    {
        return [
            'birth_due_date' => 'date',
            'preferences' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Domain\Consultations\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Leads\Models\Lead;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends DomainModel
{
    protected $fillable = [
        'lead_id',
        'user_id',
        'scheduled_at',
        'status',
        'topic',
        'notes',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'payload' => 'array',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

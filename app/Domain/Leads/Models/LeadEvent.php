<?php

namespace App\Domain\Leads\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadEvent extends DomainModel
{
    protected $fillable = [
        'lead_id',
        'user_id',
        'type',
        'before',
        'after',
        'context',
    ];

    protected function casts(): array
    {
        return [
            'before' => 'array',
            'after' => 'array',
            'context' => 'array',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Domain\Leads\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Leads\Enums\LeadStatus;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends DomainModel
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'city',
        'message',
        'source',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'page_url',
        'referer',
        'status',
        'assigned_to',
        'notes',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'status' => LeadStatus::class,
            'payload' => 'array',
        ];
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(LeadNote::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(LeadEvent::class);
    }
}

<?php

namespace App\Domain\Leads\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadNote extends DomainModel
{
    protected $fillable = [
        'lead_id',
        'user_id',
        'body',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

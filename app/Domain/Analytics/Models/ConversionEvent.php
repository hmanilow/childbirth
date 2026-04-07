<?php

namespace App\Domain\Analytics\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Leads\Models\Lead;
use App\Domain\Orders\Models\Order;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversionEvent extends DomainModel
{
    protected $fillable = [
        'user_id',
        'lead_id',
        'order_id',
        'type',
        'source',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'page_url',
        'referer',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}

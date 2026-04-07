<?php

namespace App\Domain\Payments\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Enums\PaymentInternalStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends DomainModel
{
    protected $fillable = [
        'order_id',
        'provider',
        'provider_payment_id',
        'provider_status',
        'internal_status',
        'amount',
        'currency',
        'confirmation_url',
        'paid_at',
        'raw_payload',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'internal_status' => PaymentInternalStatus::class,
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'raw_payload' => 'array',
            'metadata' => 'array',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(PaymentEvent::class);
    }
}

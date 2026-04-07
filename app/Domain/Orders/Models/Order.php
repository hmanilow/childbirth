<?php

namespace App\Domain\Orders\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Orders\Enums\OrderStatus;
use App\Domain\Payments\Models\Payment;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends DomainModel
{
    protected $fillable = [
        'user_id',
        'lead_id',
        'number',
        'status',
        'amount',
        'currency',
        'customer_name',
        'customer_phone',
        'customer_email',
        'paid_at',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}

<?php

namespace App\Domain\Payments\Models;

use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refund extends DomainModel
{
    protected $fillable = [
        'payment_id',
        'provider_refund_id',
        'status',
        'amount',
        'currency',
        'reason',
        'raw_payload',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'raw_payload' => 'array',
        ];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}

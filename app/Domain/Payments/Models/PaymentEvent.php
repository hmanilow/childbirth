<?php

namespace App\Domain\Payments\Models;

use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentEvent extends DomainModel
{
    protected $fillable = [
        'payment_id',
        'provider',
        'provider_event_id',
        'event_type',
        'payload_hash',
        'payload',
        'processed_at',
        'processing_error',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'processed_at' => 'datetime',
        ];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}

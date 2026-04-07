<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Models\Payment;
use App\Domain\Payments\Models\PaymentEvent;
use Illuminate\Support\Facades\DB;

class HandleYooKassaWebhookAction
{
    public function __construct(
        private readonly ConfirmOrderPaidAction $confirmOrderPaid,
    ) {
    }

    public function execute(array $payload): PaymentEvent
    {
        return DB::transaction(function () use ($payload): PaymentEvent {
            $object = $payload['object'] ?? [];
            $providerPaymentId = $object['id'] ?? null;
            $payloadHash = hash('sha256', json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

            $payment = $providerPaymentId
                ? Payment::query()->where('provider', 'yookassa')->where('provider_payment_id', $providerPaymentId)->first()
                : null;

            $event = PaymentEvent::firstOrCreate(
                [
                    'provider' => 'yookassa',
                    'payload_hash' => $payloadHash,
                ],
                [
                    'payment_id' => $payment?->id,
                    'provider_event_id' => $payload['id'] ?? $payload['event'] ?? $providerPaymentId,
                    'event_type' => $payload['event'] ?? 'unknown',
                    'payload' => $payload,
                ],
            );

            if ($event->processed_at) {
                return $event;
            }

            if (! $payment) {
                $event->forceFill([
                    'processing_error' => 'Payment not found for provider payment id: '.$providerPaymentId,
                    'processed_at' => now(),
                ])->save();

                return $event;
            }

            $payment->forceFill([
                'provider_status' => $object['status'] ?? $payment->provider_status,
                'raw_payload' => $object,
            ])->save();

            if (($object['status'] ?? null) === 'succeeded' && ($object['paid'] ?? false) === true) {
                $this->confirmOrderPaid->execute($payment->order()->with('items.purchasable', 'user')->firstOrFail(), $payment);
            }

            $event->forceFill([
                'payment_id' => $payment->id,
                'processed_at' => now(),
            ])->save();

            return $event->refresh();
        });
    }
}

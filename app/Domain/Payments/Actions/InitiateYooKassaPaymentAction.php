<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Payments\Enums\PaymentInternalStatus;
use App\Domain\Payments\Models\Payment;
use Illuminate\Support\Str;
use YooKassa\Client;

class InitiateYooKassaPaymentAction
{
    public function execute(Payment $payment): Payment
    {
        $client = new Client;
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key'),
        );

        $response = $client->createPayment([
            'amount' => [
                'value' => number_format((float) $payment->amount, 2, '.', ''),
                'currency' => $payment->currency,
            ],
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => config('services.yookassa.return_url'),
            ],
            'capture' => true,
            'description' => 'Заказ '.$payment->order->number,
            'metadata' => [
                'order_id' => $payment->order_id,
                'payment_id' => $payment->id,
            ],
        ], 'payment-'.$payment->id.'-'.Str::uuid());

        $payment->forceFill([
            'provider_payment_id' => $response->getId(),
            'provider_status' => $response->getStatus(),
            'internal_status' => PaymentInternalStatus::AwaitingConfirmation,
            'confirmation_url' => $response->getConfirmation()?->getConfirmationUrl(),
            'raw_payload' => method_exists($response, 'jsonSerialize') ? $response->jsonSerialize() : null,
        ])->save();

        return $payment->refresh();
    }
}

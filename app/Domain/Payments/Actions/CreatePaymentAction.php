<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Orders\Enums\OrderStatus;
use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Enums\PaymentInternalStatus;
use App\Domain\Payments\Models\Payment;
use Illuminate\Support\Facades\DB;

class CreatePaymentAction
{
    public function execute(Order $order, string $provider = 'yookassa'): Payment
    {
        return DB::transaction(function () use ($order, $provider): Payment {
            $payment = Payment::create([
                'order_id' => $order->id,
                'provider' => $provider,
                'internal_status' => PaymentInternalStatus::Pending,
                'amount' => $order->amount,
                'currency' => $order->currency,
            ]);

            $order->forceFill([
                'status' => OrderStatus::AwaitingPayment,
            ])->save();

            return $payment;
        });
    }
}

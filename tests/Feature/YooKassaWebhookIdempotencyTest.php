<?php

namespace Tests\Feature;

use App\Domain\Orders\Enums\OrderStatus;
use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Enums\PaymentInternalStatus;
use App\Domain\Payments\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YooKassaWebhookIdempotencyTest extends TestCase
{
    use RefreshDatabase;

    public function test_duplicate_webhook_payload_is_logged_once(): void
    {
        $order = Order::create([
            'number' => 'TEST-1',
            'status' => OrderStatus::AwaitingPayment,
            'amount' => 1000,
            'currency' => 'RUB',
            'customer_name' => 'Анна',
            'customer_phone' => '+79990000000',
        ]);

        Payment::create([
            'order_id' => $order->id,
            'provider' => 'yookassa',
            'provider_payment_id' => '2ff4',
            'internal_status' => PaymentInternalStatus::AwaitingConfirmation,
            'amount' => 1000,
            'currency' => 'RUB',
        ]);

        $payload = ['event' => 'payment.succeeded', 'object' => ['id' => '2ff4', 'status' => 'succeeded', 'paid' => true]];

        $this->postJson('/webhooks/yookassa', $payload)->assertOk();
        $this->postJson('/webhooks/yookassa', $payload)->assertOk();

        $this->assertDatabaseCount('payment_events', 1);
    }
}

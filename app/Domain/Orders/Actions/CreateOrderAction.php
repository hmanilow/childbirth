<?php

namespace App\Domain\Orders\Actions;

use App\Domain\Orders\DTO\CreateOrderData;
use App\Domain\Orders\Enums\OrderStatus;
use App\Domain\Orders\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateOrderAction
{
    public function execute(CreateOrderData $data): Order
    {
        return DB::transaction(function () use ($data): Order {
            $amount = $data->course->price;

            $order = Order::create([
                'user_id' => $data->user?->id,
                'lead_id' => $data->leadId,
                'number' => now()->format('ymd').'-'.Str::upper(Str::random(8)),
                'status' => OrderStatus::Pending,
                'amount' => $amount,
                'currency' => 'RUB',
                'customer_name' => $data->customerName,
                'customer_phone' => $data->customerPhone,
                'customer_email' => $data->customerEmail,
                'metadata' => $data->metadata,
            ]);

            $order->items()->create([
                'purchasable_type' => $data->course->getMorphClass(),
                'purchasable_id' => $data->course->id,
                'title' => $data->course->title,
                'quantity' => 1,
                'unit_amount' => $amount,
                'total_amount' => $amount,
            ]);

            return $order->load('items');
        });
    }
}

<?php

namespace App\Domain\Payments\Actions;

use App\Domain\Courses\Models\Course;
use App\Domain\Orders\Enums\OrderStatus;
use App\Domain\Orders\Models\Order;
use App\Domain\Payments\Enums\PaymentInternalStatus;
use App\Domain\Payments\Models\Payment;
use App\Domain\Students\Actions\GrantCourseAccessAction;
use App\Domain\Students\Enums\AccessGrantSource;
use Illuminate\Support\Facades\DB;

class ConfirmOrderPaidAction
{
    public function __construct(
        private readonly GrantCourseAccessAction $grantCourseAccess,
    ) {
    }

    public function execute(Order $order, Payment $payment): Order
    {
        return DB::transaction(function () use ($order, $payment): Order {
            if ($order->status === OrderStatus::Paid) {
                return $order;
            }

            $payment->forceFill([
                'internal_status' => PaymentInternalStatus::Succeeded,
                'paid_at' => $payment->paid_at ?? now(),
            ])->save();

            $order->forceFill([
                'status' => OrderStatus::Paid,
                'paid_at' => $order->paid_at ?? now(),
            ])->save();

            if ($order->user) {
                foreach ($order->items as $item) {
                    if ($item->purchasable instanceof Course) {
                        $this->grantCourseAccess->execute(
                            user: $order->user,
                            course: $item->purchasable,
                            source: AccessGrantSource::Payment,
                            grantedBy: $payment,
                            notes: 'Автоматическая выдача доступа после оплаты заказа '.$order->number,
                            metadata: ['order_id' => $order->id, 'payment_id' => $payment->id],
                        );
                    }
                }
            }

            return $order->refresh();
        });
    }
}

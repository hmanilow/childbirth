<?php

namespace App\Domain\Orders\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case AwaitingPayment = 'awaiting_payment';
    case Paid = 'paid';
    case Canceled = 'canceled';
    case Refunded = 'refunded';
}

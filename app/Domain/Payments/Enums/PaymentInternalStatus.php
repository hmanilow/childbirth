<?php

namespace App\Domain\Payments\Enums;

enum PaymentInternalStatus: string
{
    case Pending = 'pending';
    case AwaitingConfirmation = 'awaiting_confirmation';
    case Succeeded = 'succeeded';
    case Canceled = 'canceled';
    case Refunded = 'refunded';
    case Failed = 'failed';
}

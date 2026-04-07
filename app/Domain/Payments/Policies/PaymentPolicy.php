<?php

namespace App\Domain\Payments\Policies;

use App\Domain\Payments\Models\Payment;
use App\Domain\Users\Models\User;

class PaymentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('payments.view');
    }

    public function view(User $user, Payment $payment): bool
    {
        return $user->can('payments.view');
    }
}

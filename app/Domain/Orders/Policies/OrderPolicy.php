<?php

namespace App\Domain\Orders\Policies;

use App\Domain\Orders\Models\Order;
use App\Domain\Users\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('orders.manage');
    }

    public function view(User $user, Order $order): bool
    {
        return $user->can('orders.manage') || $order->user_id === $user->id;
    }

    public function manage(User $user): bool
    {
        return $user->can('orders.manage');
    }

    public function update(User $user, Order $order): bool
    {
        return $this->manage($user);
    }
}

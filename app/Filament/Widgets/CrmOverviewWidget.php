<?php

namespace App\Filament\Widgets;

use App\Domain\Leads\Models\Lead;
use App\Domain\Orders\Enums\OrderStatus;
use App\Domain\Orders\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CrmOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Новые лиды', Lead::query()->where('status', 'new')->count()),
            Stat::make('Оплаченные заказы', Order::query()->where('status', OrderStatus::Paid)->count()),
            Stat::make('Выручка', number_format((float) Order::query()->where('status', OrderStatus::Paid)->sum('amount'), 0, ',', ' ').' ₽'),
        ];
    }
}

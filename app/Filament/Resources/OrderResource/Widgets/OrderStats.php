<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [
            Stat::make('New Order', Order::query()->where('status', 'new')->count()),
            Stat::make('Order Shipped', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Order Delivered', Order::query()->where('status', 'delivered')->count()),
        ];

        $averagePrice = Order::query()->avg('grand_total');
        if ($averagePrice !== null) {
            $stats[] = Stat::make('Average Price', Number::currency($averagePrice, 'MYR'));
        } else {
            $stats[] = Stat::make('Average Price', 'No orders yet');
        }

        return $stats;
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\User;    
use App\Models\Order;   
use Filament\Widgets\StatsOverviewWidget\Stat; //digunakan untuk membuat kartu statistik dalam widget
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OrderOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::query()->count()),    // jumlah total pesanan
            Stat::make('Total Customer', User::query()->count()),   // jumlah total pelanggan 
            Stat::make('Average Price', 'Rp ' . Order::query()->avg('grand_total')),    //  rata-rata harga transaksi
        ];
    }
}


// Stat::make('New', Order::query()->where('status', 'new')->count()),
// Stat::make('Processing', Order::query()->where('status', 'processing')->count()),
// Stat::make('Shipped', Order::query()->where('status', 'shipped')->count()),
// Stat::make('Success', Order::query()->where('status', 'delivered')->count()),
// Stat::make('Canceled', Order::query()->where('status', 'canceled')->count()),
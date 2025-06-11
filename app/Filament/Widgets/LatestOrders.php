<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Order; 
use App\Filament\Resources\OrderResource; 

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full'; // menentukan ukuran kolom

    protected static ?int $sort = 3; // menentukan urutan tampilan widget 

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery()) // mengambil query utama dari OrderResource untuk mendapatkan data pesanan
            ->defaultSort('created_at', 'desc') // mengurutkan data berdasarkan kolom created_at secara descending (terbaru duluan) 
            ->columns([
                // id
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') 
                    ->getStateUsing(fn ($record) => Order::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                // user
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->getStateUsing(fn ($record) => $record->user?->name) 
                    ->searchable(),

                // grand total
                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Grand Total')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state)) 
                    ->searchable(),

                // payment method
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn ($state) => [ 
                        'cod' => 'Cash on Delivery',
                        'stripe' => 'Stripe',
                    ][$state] ?? $state)
                    ->searchable(),

                // payment status
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->formatStateUsing(fn ($state) => [
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ][$state] ?? $state)
                    ->searchable(),

                // status
                Tables\Columns\TextColumn::make('status')
                    ->badge() // mengubah tampilan teks menjadi badge 
                    ->color(fn (string $state): string => match ($state) { // warna badge ditentukan menggunakan fungsi match()
                        'new' => 'info',
                        'processing' => 'primary',
                        'shipped' => 'info',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) { // icon badge ditentukan menggunakan fungsi match()
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'cancelled' => 'heroicon-m-x-circle',
                    }),

                // shipping method
                Tables\Columns\TextColumn::make('shipping_method')
                    ->label('Shipping Method')
                    ->formatStateUsing(fn ($state) => [
                        'pickupAtDealer' => 'Pickup at Dealer',
                        'homeDelivery' => 'Home Delivery',
                        'carCarrier' => 'Car Carrier',
                        'roRoShipping' => 'Ro-Ro Shipping',
                        'driverDelivery' => 'Driver Delivery',
                    ][$state] ?? $state)
                    ->searchable(),
            ])
            ->actions([ 
                Tables\Actions\Action::make('View Order') // membuat aksi bernama "View Order" yang bisa diklik 
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                        // menentukan URL tujuan saat aksi diklik
                        // menerima parameter $record (Order) 
                        // mengembalikan URL untuk melihat detail order menggunakan OrderResource::getUrl('view', [...]).
                    ->icon('heroicon-m-eye'), // menambahka icon mata
            ]);
    }
}

<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Order; // tambahkan ini
use App\Filament\Resources\OrderResource; // tambahkan ini
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                // id
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') 
                    ->getStateUsing(fn ($record) => Order::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

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
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('View Order') 
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
            ])
            ->bulkActions([
                //
            ]);
    }
}

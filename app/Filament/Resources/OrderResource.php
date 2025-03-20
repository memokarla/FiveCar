<?php

namespace App\Filament\Resources;

use App\Models\Order;
use App\Models\OrderItem;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                ->schema([

                    // oder information
                    Forms\Components\Section::make('Order Information') // membuat section order information yang berisi beberapa input 
                    ->schema([

                        // daftar user
                        Forms\Components\Select::make('user_id') // menampilkan daftar user
                            ->label('Customer') 
                            ->relationship('user', 'name') 
                            ->native(false) 
                            ->required(),

                        // grid
                        Forms\Components\Grid::make(2) 
                        ->schema([
                            // payment method
                            Forms\Components\Select::make('payment_method')
                                ->label('Payment Method') 
                                ->options([
                                    'cod' => 'Cash on Delivery',
                                    'stripe' => 'Stripe',
                                ])
                                ->native(false)
                                ->required(),

                            // payment status
                            Forms\Components\Select::make('payment_status')
                                ->label('Payment Status')
                                ->options([
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                    'failed' => 'Failed',
                                ])
                                ->native(false)
                                ->required(),
                        ]),

                        // status
                        Forms\Components\ToggleButtons::make('status')
                        ->label('Status')
                        ->options([
                            'new' => 'New',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'canceled' => 'Cancelled',
                        ])
                        ->colors([
                            'new' => 'info', // Biru
                            'processing' => 'primary', // Kuning
                            'shipped' => 'info', // Biru
                            'delivered' => 'success', // Hijau
                            'canceled' => 'danger', // Merah
                        ])
                        ->icons([
                            'new' => 'heroicon-m-sparkles',
                            'processing' => 'heroicon-m-arrow-path',
                            'shipped' => 'heroicon-m-truck',
                            'delivered' => 'heroicon-m-check-badge',
                            'canceled' => 'heroicon-m-x-circle',
                        ])
                        ->inline() // Menampilkan tombol dalam satu baris
                        ->live()
                        ->required(),

                        // grid
                        Forms\Components\Grid::make(12) 
                        ->schema([
                            // shipping method
                            Forms\Components\Select::make('shipping_method')
                                ->label('Shipping Method')
                                ->options([
                                    'pickupAtDealer' => 'Pickup at Dealer',
                                    'homeDelivery' => 'Home Delivery',
                                    'carCarrier' => 'Car Carrier',
                                    'roRoShipping' => 'Ro-Ro Shipping',
                                    'driverDelivery' => 'Driver Delivery',
                                ])
                                ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                                    $taxRates = [
                                        'pickupAtDealer' => 0,
                                        'homeDelivery' => 5,
                                        'carCarrier' => 7,
                                        'roRoShipping' => 8,
                                        'driverDelivery' => 6,
                                    ];
                                    
                                    // Set nilai tax berdasarkan metode pengiriman yang dipilih
                                    $set('tax', $taxRates[$state] ?? 0);
                                })
                                ->live() // Agar perubahan langsung diproses
                                ->native(false)
                                ->columnSpan(6)
                                ->required(),

                            // tax
                            Forms\Components\TextInput::make('tax')
                                ->label('Tax')
                                ->numeric()
                                ->disabled()
                                ->suffix('%')
                                ->columnSpan(2),

                            Forms\Components\Hidden::make('tax')
                                ->default(0),
                        ]),

                    ]), // tutup group Order Information

                ]), // tutup Order Information

                Forms\Components\Card::make()
                ->schema([

                    // order item
                    Forms\Components\Section::make('Order Item') // membuat section order information yang berisi beberapa input 
                    ->schema([
                        Forms\Components\Repeater::make('orderItems')
                            ->label('')
                            ->relationship('orderItems') // Sesuai dengan relasi di model Order
                            ->schema([
                                Forms\Components\Grid::make(12) // Grid dengan 4 kolom
                                    ->schema([
                                        // product
                                        Forms\Components\Select::make('product_id')
                                            ->label('Product')
                                            ->options(
                                                \App\Models\Product::with(['merk', 'jenis']) // Pastikan relasi dimuat
                                                    ->get()
                                                    ->mapWithKeys(fn ($product) => [
                                                        $product->id => "{$product->merk->name} {$product->jenis->name} {$product->name}"
                                                    ])
                                            )
                                            ->live()
                                            ->afterStateUpdated(fn ($state, callable $set) => 
                                                $set('unit_amount', \App\Models\Product::find($state)?->price ?? 0)
                                            )
                                            ->afterStateUpdated(fn ($state, callable $set) => 
                                                $set('total_amount', \App\Models\Product::find($state)?->price ?? 0)
                                            )
                                            ->native(false)
                                            ->columnSpan(4)
                                            ->required(),

                                        // qty
                                        Forms\Components\TextInput::make('quantity')
                                            ->label('Qty')
                                            ->numeric() 
                                            ->default(1)
                                            ->minValue(1)
                                            ->columnSpan(2)
                                            ->reactive()
                                            ->afterStateUpdated(fn ($state, callable $set, callable $get) => 
                                                $set('total_amount', $state * $get('unit_amount'))
                                            )
                                            ->required(),

                                        // unit amount
                                        Forms\Components\TextInput::make('unit_amount')
                                            ->label('Unit Price')
                                            ->numeric()
                                            ->disabled()
                                            ->prefix('Rp')
                                            ->columnSpan(3),
                                        
                                        Forms\Components\Hidden::make('unit_amount')
                                            ->default(0),

                                        // total amount
                                        Forms\Components\TextInput::make('total_amount')
                                            ->label('Total Price')
                                            ->numeric()
                                            ->disabled()
                                            ->prefix('Rp')
                                            ->columnSpan(3),
                                        
                                        Forms\Components\Hidden::make('total_amount')
                                            ->default(0),
                                    ]),
                            ]) // tutup repeater oder item
                            ->columns(1) // Agar setiap item dalam satu baris
                            ->defaultItems(1) // Minimal 1 item
                            ->addActionLabel('Add Product') // Label tombol tambah
                            ->inlineLabel(false), // Agar tidak bertumpuk

                            // grand total
                            Forms\Components\Placeholder::make('grand_total')
                            ->label('Grand Total')
                            ->content(function (\Filament\Forms\Get $get, \Filament\Forms\Set $set) {
                                $subtotal = 0;

                                // Menghitung subtotal dari orderItems
                                if ($orderItems = $get('orderItems')) {
                                    foreach ($orderItems as $key => $item) {
                                        $subtotal += $get("orderItems.{$key}.total_amount") ?? 0;
                                    }
                                }

                                // Mendapatkan tax dari input 'tax'
                                $tax = $get('tax') ?? 0;
                                $taxAmount = ($subtotal * $tax) / 100;

                                // Menghitung Grand Total
                                $grandTotal = $subtotal + $taxAmount;

                                // Menyimpan hasil ke state 'grand_total'
                                $set('grand_total', $grandTotal);

                                return 'Rp ' . number_format($grandTotal, 2);
                            }),

                            Forms\Components\Hidden::make('grand_total')
                            ->default(0),

                    ]) // tutup group Order Item

                ]), // tutup Order Item

                Forms\Components\Card::make()
                ->schema([
                
                    // address
                    Forms\Components\Section::make('Address') // membuat section address yang berisi beberapa input 
                    ->relationship('address')
                    ->schema([

                        // grid
                        Forms\Components\Grid::make(2) 
                        ->schema([
                            // name
                            Forms\Components\TextInput::make('name')
                                ->label('Name') 
                                ->placeholder('Name') 
                                ->required(),

                            // phone
                            Forms\Components\TextInput::make('phone')
                                ->label('Phone')
                                ->prefix('+62 ')
                                ->numeric() 
                                ->required(),
                                
                            // street address
                            Forms\Components\TextInput::make('street_address')
                                ->label('Street Address') 
                                ->placeholder('Street Address') 
                                ->required(),

                            // city
                            Forms\Components\TextInput::make('city')
                                ->label('City')
                                ->placeholder('City')
                                ->required(),
                                
                            // state
                            Forms\Components\TextInput::make('state')
                                ->label('State') 
                                ->placeholder('State') 
                                ->required(),

                            // zip code
                            Forms\Components\TextInput::make('zip_code')
                                ->label('Zip Code')
                                ->placeholder('Zip Code')
                                ->numeric()
                                ->required(),
                        ]),

                    ]), // tutup group Address

                ]), // tutup Address
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // id
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') // Ini kayak fieldnya, untuk memudahkan pengguna mengidentifikasi data
                    ->getStateUsing(fn ($record) => Order::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                // user
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->getStateUsing(fn ($record) => $record->user?->name) // Mengambil nama dari relasi user
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
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => [
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Cancelled',
                    ][$state] ?? $state)
                    ->searchable(),

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
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                // 
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string {
        return static::getModel()::count();
    }
    
    public static function getNavigationBadgeColor(): string|array|null {
        return static::getModel()::count() > 10 ? 'danger' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

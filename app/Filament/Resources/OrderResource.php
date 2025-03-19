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

                        // grid
                        Forms\Components\Grid::make(2) 
                        ->schema([
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
                                ->inline() // Menampilkan tombol dalam satu baris
                                ->live()
                                ->required(),

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
                                ->native(false)
                                ->required(),
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
                            Forms\Components\Grid::make(10) // Grid dengan 4 kolom
                                ->schema([
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

                                    Forms\Components\TextInput::make('unit_amount')
                                        ->label('Unit Price')
                                        ->numeric()
                                        ->disabled()
                                        ->columnSpan(2),

                                    Forms\Components\TextInput::make('total_amount')
                                        ->label('Total Price')
                                        ->numeric()
                                        ->disabled()
                                        ->columnSpan(2),
                                ]),
                        ])
                        ->columns(1) // Agar setiap item dalam satu baris
                        ->defaultItems(1) // Minimal 1 item
                        ->addActionLabel('Add Product') // Label tombol tambah
                        ->inlineLabel(false), // Agar tidak bertumpuk
                    ]) // tutup group Order Item

                ]), // tutup Order Item

                Forms\Components\Card::make()
                ->schema([

                    // address
                    Forms\Components\Section::make('Address') // membuat section address yang berisi beberapa input 
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
                        ]),

                        // grid
                        Forms\Components\Grid::make(2) 
                        ->schema([
                            // name
                            Forms\Components\TextInput::make('street_address')
                                ->label('Street Address') 
                                ->placeholder('Street Address') 
                                ->required(),

                            // phone
                            Forms\Components\TextInput::make('city')
                                ->label('City')
                                ->placeholder('City')
                                ->required(),
                        ]),

                        // grid
                        Forms\Components\Grid::make(2) 
                        ->schema([
                            // name
                            Forms\Components\TextInput::make('state')
                                ->label('State') 
                                ->placeholder('State') 
                                ->required(),

                            // phone
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
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

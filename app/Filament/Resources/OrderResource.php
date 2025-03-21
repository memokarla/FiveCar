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

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    // mengatur urutannya
    public static function getNavigationSort(): ?int
    {
        return 5; 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make() // membuat kartu untuk Order Information
                ->schema([

                    // oder information
                    Forms\Components\Section::make('Order Information') // membuat section order information yang berisi beberapa input 
                    ->schema([

                        // daftar user
                        Forms\Components\Select::make('user_id') // menampilkan daftar user dalam bentuk dropdown
                            ->label('Customer') 
                            ->relationship('user', 'name') // menghubungkan dengan model user dan mengambil nilai kolom name sebagai opsi dalam dropdown
                            ->native(false) 
                            ->required(),

                        // grid
                        Forms\Components\Grid::make(2) 
                        ->schema([
                            // payment method
                            Forms\Components\Select::make('payment_method') // dropdown
                                ->label('Payment Method') 
                                ->options([ // opsi yang akan ditampilkan di dropdown
                                    'cod' => 'Cash on Delivery',
                                    'stripe' => 'Stripe',
                                ])
                                ->native(false)
                                ->required(),

                            // payment status
                            Forms\Components\Select::make('payment_status') // dropdown
                                ->label('Payment Status')
                                ->options([ // opsi yang akan ditampilkan di dropdown
                                    'pending' => 'Pending',
                                    'paid' => 'Paid',
                                    'failed' => 'Failed',
                                ])
                                ->native(false)
                                ->required(),
                        ]),

                        // status
                        Forms\Components\ToggleButtons::make('status') // toggle button
                        ->label('Status')
                        ->options([ // opsi button nya
                        //  Sebagai kunci (key) dalam array => Sebagai nilai (value) yang ditampilkan di dropdown
                            'new' => 'New',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'canceled' => 'Cancelled',
                        ])
                        ->colors([ // warna pada tiap opsi button nya (sekadar UI, tidak masuk database)
                        //  'database' => 'status's colors'
                            'new' => 'info', // Biru
                            'processing' => 'primary', // Kuning
                            'shipped' => 'info', // Biru
                            'delivered' => 'success', // Hijau
                            'canceled' => 'danger', // Merah
                        ])
                        ->icons([
                        //  'database' => 'tampilan icon status'
                            'new' => 'heroicon-m-sparkles',
                            'processing' => 'heroicon-m-arrow-path',
                            'shipped' => 'heroicon-m-truck',
                            'delivered' => 'heroicon-m-check-badge',
                            'canceled' => 'heroicon-m-x-circle',
                        ])
                        ->inline() // tombol dalam satu baris
                        ->live() // perubahan langsung diproses
                        ->required(),

                        // grid
                        Forms\Components\Grid::make(12) 
                        ->schema([
                            // shipping method
                            Forms\Components\Select::make('shipping_method') // dropdown
                                ->label('Shipping Method')
                                ->options([ // pilihanya
                                    'pickupAtDealer' => 'Pickup at Dealer',
                                    'homeDelivery' => 'Home Delivery',
                                    'carCarrier' => 'Car Carrier',
                                    'roRoShipping' => 'Ro-Ro Shipping',
                                    'driverDelivery' => 'Driver Delivery',
                                ])
                                ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                                // afterStateUpdated -> setiap kali nilai shipping_method berubah, fungsi ini akan dijalankan
                                    $taxRates = [ // array yang dibuat sendiri 
                                        'pickupAtDealer' => 0,  // pajak 0%
                                        'homeDelivery' => 5,    // pajak 5%
                                        'carCarrier' => 7,      // pajak 7%
                                        'roRoShipping' => 8,    // pajak 8%
                                        'driverDelivery' => 6,  // pajak 6%
                                    ];
                                    
                                    // set nilai tax berdasarkan metode pengiriman yang dipilih
                                    $set('tax', $taxRates[$state] ?? 0);
                                })
                                ->live() // perubahan langsung diproses
                                ->native(false)
                                ->columnSpan(6)
                                ->required(),

                            // tax
                            Forms\Components\TextInput::make('tax')
                                ->label('Tax')
                                ->numeric()
                                ->disabled()
                                ->suffix('%') // menambahkan simbol  di ahir
                                ->columnSpan(2),

                            // field tersembunyi (hidden) sering digunakan untuk menyimpan data yang tidak perlu dilihat atau diedit langsung 
                            // dalam konteks ini, digunakan untuk menyimpan nilai tax secara internal tanpa menampilkan atau mengeditnya langsung di antarmuka pengguna
                            Forms\Components\Hidden::make('tax')
                                ->default(0),
                        ]),

                    ]), // tutup group Order Information

                ]), // tutup Order Information

                Forms\Components\Card::make() // membuat kartu untuk Order Item
                ->schema([

                    // order item
                    Forms\Components\Section::make('Order Item') // membuat section order item yang berisi beberapa input 
                    ->schema([
                        Forms\Components\Repeater::make('orderItems')
                        ->relationship('orderItems') // Sesuai dengan nama relasi di model Order
                        ->label('') // secara default akan membei sub judul Order Items, ini diambil dari relationship
                            ->schema([
                                Forms\Components\Grid::make(12)
                                    ->schema([
                                        // product
                                        Forms\Components\Select::make('product_id') // sambungkan ke fk product_id, seperti yang dibuat dalam order_items
                                            ->label('Product')
                                            ->options(
                                                // Pastikan relasi dimuat di model OrderItems 
                                                \App\Models\Product::with(['merk', 'jenis']) // mengambil field fk merk_id dan jenis_id di tabel products
                                                    ->get()
                                                    ->mapWithKeys(fn ($product) => [ // membuat key-value untuk dropdown, dengan product sebagai key 
                                                        // gabungan informasi merk, jenis, dan nama produk sebagai value
                                                        $product->id => "{$product->merk->name} {$product->jenis->name} {$product->name}" 
                                                    ])
                                            )
                                            // mengapa ditaruh di Product? 
                                            // karena $set (setelan) yang diatur menyesuaikan $state (nilai) di Product
                                            // kan kita milih Product, nah unit_amount dan total_amount menyesuaikan tergantung Product yang kita pilih
                                            ->afterStateUpdated(fn ($state, callable $set) => 
                                                $set('unit_amount', \App\Models\Product::find($state)?->price ?? 0) // mencari harga produk yang dipilih
                                                // Product::find($state) -> cari produk berdasarkan id yang dipilih
                                                // ?->price -> ambil harga produk (jika ada)
                                                // ?? 0 -> jika produk tidak ditemukan, pakai nilai default 0
                                            )
                                            ->afterStateUpdated(fn ($state, callable $set) => 
                                                $set('total_amount', \App\Models\Product::find($state)?->price ?? 0)
                                            )
                                            ->live() // mengaktifkan pembaruan ulang
                                            ->native(false)
                                            ->columnSpan(4)
                                            ->required(),

                                        // qty
                                        Forms\Components\TextInput::make('quantity')
                                            ->label('Qty')
                                            ->numeric() 
                                            ->default(1)
                                            ->minValue(1) // agar tidak bisa minus
                                            ->reactive()
                                            // mengapa ini di quantity?
                                            // yap, karena hendak menyesuaikan dengan nilai yang ada di qantity
                                            ->afterStateUpdated(fn ($state, callable $set, callable $get) => 
                                            //  kali ini ada tamban $get, ini untuk mengambil nilai dari field lain (dalam konteks ini, field lainnya adalah 'unit_amount')
                                                $set('total_amount', $state * $get('unit_amount'))
                                                // set('total_amount', value)
                                                // menyimpan nilai di total_amount, berdasarkan nilai di $state (di field ini, yaitu quantity) yang dikali dengan nilai yang diambil dari unit_amount
                                                    // $state → Berisi nilai terbaru dari quantity (jumlah produk).
                                                    // $get('unit_amount') → Mengambil nilai dari harga satuan produk (unit_amount).
                                                    // $set('total_amount', $state * $get('unit_amount')) → Menghitung total harga dan menyimpannya di total_amount.
                                            )
                                            ->columnSpan(2)
                                            ->required(),

                                        // unit amount
                                        Forms\Components\TextInput::make('unit_amount')
                                            ->label('Unit Price')
                                            ->numeric()
                                            ->disabled()
                                            ->prefix('Rp')
                                            ->columnSpan(3),
                                        
                                        Forms\Components\Hidden::make('unit_amount')
                                        // field tersembunyi (hidden) sering digunakan untuk menyimpan data yang tidak perlu dilihat atau diedit langsung 
                                            ->default(0),

                                        // total amount
                                        Forms\Components\TextInput::make('total_amount')
                                            ->label('Total Price')
                                            ->numeric()
                                            ->disabled()
                                            ->prefix('Rp')
                                            ->columnSpan(3),
                                        
                                        Forms\Components\Hidden::make('total_amount')
                                        // field tersembunyi (hidden) sering digunakan untuk menyimpan data yang tidak perlu dilihat atau diedit langsung 
                                            ->default(0),
                                    ]),
                            ]) // tutup repeater oder item
                        ->columns(1) // Agar setiap item dalam satu baris
                        ->defaultItems(1) // Minimal menampilkan 1 item
                        ->addActionLabel('Add Product') // Label tombol tambah
                        ->inlineLabel(false), // Agar tidak bertumpuk

                            // grand total
                            Forms\Components\Placeholder::make('grand_total') // menampilkan teks atau nilai yang dihitung secara dinamis, tetapi tidak menyediakan input 
                            ->label('Grand Total')
                            ->content(function (callable $get, callable $set) {
                                $subtotal = 0; // nilai awalnya

                                // Menghitung subtotal dari orderItems
                                if ($orderItems = $get('orderItems')) { // ambil semua orderItems (nama variabelnya) dengan $get('orderItems') 
                                    foreach ($orderItems as $key => $item) { // foreach digunakan untuk mengulang setiap item di dalam array $orderItems
                                        $subtotal += $get("orderItems.{$key}.total_amount") ?? 0; 
                                        // $get("orderItems.{$key}.total_amount") -> mengambil nilai total_amount dari setiap index (key) di dalam orderItems
                                        // {key} adalah index dari setiap item, jadi ini akan mengambil nilai total_amount yang sesuai
                                        // jika nilai total_amount tidak ada, maka akan menampilkan 0
                                        // nilai total_amount setiap item ditambahkan ke dalam $subtotal
                                    }
                                }

                                // Mendapatkan tax dari input 'tax'
                                $tax = $get('tax') ?? 0; // mengambil nilai field tax (jika ada), jika tida maka 0. nantinya akan disimpan ke dalam $tax
                                $taxAmount = ($subtotal * $tax) / 100; // operasi $subtotal yang dikali dengan $tax dan dibagi 100. nantinya akan disimpan ke dalam $taxAmount

                                // Menghitung Grand Total
                                $grandTotal = $subtotal + $taxAmount; // hasil akhirnya, setelah menghitung pertambahan $subtotal dan $taxAmount. nantinya akan disimpan ke dalam $grandTotal

                                // Menyimpan hasil ke state 'grand_total'
                                $set('grand_total', $grandTotal); // $set('nama_field', $nilai);. nilai pada $grandTotalakan disimpan di field 'grand_total'

                                // menambahkan "Rp " di depan angka hasil format
                                return 'Rp ' . number_format($grandTotal, 2);
                            }),

                            Forms\Components\Hidden::make('grand_total')
                            // field tersembunyi (hidden) sering digunakan untuk menyimpan data yang tidak perlu dilihat atau diedit langsung 
                            ->default(0),

                    ]) // tutup group Order Item

                ]), // tutup Order Item

                Forms\Components\Card::make() // membuat kartu untuk Address
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
                                ->prefix('+62 ') // menambahkan teks atau simbol di depan
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
                    ->label('ID') 
                    ->getStateUsing(fn ($record) => Order::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                // user
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->getStateUsing(fn ($record) => $record->user?->name) // mengambil nama dari relasi user
                    ->searchable(),

                // grand total
                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Grand Total')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state)) // mengatur formatnya agar ada Rp 
                    ->searchable(),

                // payment method
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn ($state) => [ 
                    // secara default, tabelnya akan menampilkan cod/stripe, bukan Cash on Delivery/Stripe
                    // ini sekadar merapikan, jadi jika tabelnya memiliki data cod (misalnya), maka di tabel ini akan menampilkan Cash on Delivery
                        'cod' => 'Cash on Delivery',
                        'stripe' => 'Stripe',
                    ][$state] ?? $state)
                    // [$state] mencoba mengambil nilai dari array mapping (Cash on Delivery/Stripe)
                    // ?? $state digunakan sebagai fallback (jika $state tidak ada dalam array, gunakan nilai aslinya (cod/stripe))
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

    // mengembalikan jumlah total data
    public static function getNavigationBadge(): ?string {
        return static::getModel()::count(); // menghitung jumlah data dalam model yang digunakan oleh resource Order
    }
    
    // mengatur warnanya
    public static function getNavigationBadgeColor(): string|array|null {
                                                    // string -> jika warna yang dikembalikan adalah sebuah string (misalnya return 'danger')
                                                    // array -> jika warna bisa berupa array (misalnya return ['success', 'dark'])
                                                    // null -> jika fungsi tidak mengembalikan nilai apa pun
        return static::getModel()::count() > 10 ? 'danger' : 'success'; // secara default berwarna hijau, jika orderan lebih dari 10, maka akan berwarna merah
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

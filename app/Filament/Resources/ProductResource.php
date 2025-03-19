<?php

namespace App\Filament\Resources;

use App\Models\Merk;
use App\Models\Jenis;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
 

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                ->schema([
                    
                    //image
                    Forms\Components\FileUpload::make('image')
                        ->label('Car Image')
                        ->image() 
                        ->directory('car_image') // Folder penyimpanan di storage/app/public/[car_image]
                        ->required(), // Wajib

                    // grid
                    Forms\Components\Grid::make(2) // membuat grid layout dalam form, dalam konteks ini berarti membuat 2 kolom dalam satu baris
                    ->schema([
                        // milih merk
                        Forms\Components\Select::make('merks_id') // menghasilkan dorpdown untuk memilih data berdasarkan FK merks_id
                            ->label('Car Brand') 
                            ->relationship('merk', 'name') // mengambil field name dari tabel merk (jadi dropdownnya akan menampilkan field name)
                                                           // dengan ini, model utama (product) harus memiliki relasi belongsTo ke model Merk
                            ->native(false) // menonaktifkan tampilan dropdown bawaan browser, menggantinya dengan dropdown yang lebih interaktif dari Filament
                            ->required(),

                        // milih jenis
                        Forms\Components\Select::make('jenis_id')
                            ->label('Car Categories')
                            ->relationship('jenis', 'name')
                            ->native(false)
                            ->required(),
                    ]),

                    // grid
                    Forms\Components\Grid::make(2) 
                    ->schema([
                        // name
                        Forms\Components\TextInput::make('name')
                            ->label('Car Variant / Series') 
                            ->placeholder('Varian or Series') 
                            ->afterStateUpdated(function (callable $set, $state) {  
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            })
                            ->required(),
  
                        // slug
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->disabled() // Nonaktifkan jika ingin slug hanya untuk tampil dan tidak diubah manual
                            ->required(),
                    ]),
                    
                    // price
                    Forms\Components\TextInput::make('price')
                        ->label('Price (Million)')
                        ->numeric() // Hanya menerima angka
                        ->prefix('Rp ') // Menambahkan "Rp " di depan input
                        ->extraInputAttributes(['style' => 'text-align: left']) // Teks rata kiri
                        ->suffix('.00') // Menambahkan ".00" di akhir input
                        ->required(),

                    // location
                    Forms\Components\TextInput::make('location')
                        ->label('Location') 
                        ->placeholder('City') 
                        ->required(),

                    // condition
                    Forms\Components\Select::make('condition') // menghasilkan dorpdown untuk memilih data berdasarkan field condition
                        ->label('Condition')
                        ->options([                 // membuat pilihan untuk dropdownnya
                            'baru' => 'New',
                            'bekas' => 'Second',
                        ])
                        ->native(false) // menonaktifkan tampilan dropdown bawaan browser
                        ->required(),

                    // description
                    Forms\Components\Section::make('description') // membuat section description yang berisi beberapa input 
                    ->schema([
                        Forms\Components\Grid::make(2) // membuat 2 kolom dalam satu baris
                            ->schema([
                                Forms\Components\TextInput::make('description.engine')
                                    ->label('Engine')
                                    ->required(),
                                Forms\Components\TextInput::make('description.transmission')
                                    ->label('Transmission') 
                                    ->required(),
                                Forms\Components\TextInput::make('description.power')
                                    ->label('Power')
                                    ->required(),
                                Forms\Components\Select::make('description.fuel_type') // dropdown untuk memilih jenis bahan bakar
                                    ->label('Fuel Type')
                                    ->options([
                                        'bensin' => 'Bensin',
                                        'solar' => 'Solar',
                                        'listrik' => 'Listrik',
                                        'hybrid' => 'Hybrid',
                                    ])
                                    ->native(false)
                                    ->required(),
                                Forms\Components\TextInput::make('description.fuel_consumption')
                                    ->label('Fuel Consumption')
                                    ->required(),
                                Forms\Components\TextInput::make('description.seat_capacity')
                                    ->label('Seat Capacity')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('description.width')
                                    ->label('Width')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('description.length')
                                    ->label('Length')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('description.height')
                                    ->label('Height')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('description.ground_clearance')
                                    ->label('Ground Clearance')
                                    ->required(),
                            ]),
                        ])
                        ->collapsible() // Agar section bisa diklik untuk dibuka/tutup  
                        ->collapsed() // Default dalam keadaan tertutup saat halaman dimuat  
                        ->columnSpanFull(), // Memastikan section ini mengambil lebar penuh dalam grid form           
                                    
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // id menjadi nomor urut berdasarkan id terkecil hingga terbesar
                // ini sekadar di table filamentnya, pada database tetap sesuai dengan id yang tersimpan dan terhapus
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') // Ini kayak fieldnya, untuk memudahkan pengguna mengidentifikasi data
                    ->getStateUsing(fn ($record) => Product::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 
                
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('car_info') // membuat kolom baru dalam tabel Filament dengan nama "car_info"
                    ->label('Car')
                    ->getStateUsing(fn ($record) => "{$record->merk->name} - {$record->jenis->name}") 
                                    // untuk menampilkan data yang tidak ada di database secara langsung, tetapi berasal dari relasi
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Car Price')
                    ->searchable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Location')
                    ->searchable(),

                Tables\Columns\TextColumn::make('condition')
                    ->label('Condition')
                    ->searchable(),
                    
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

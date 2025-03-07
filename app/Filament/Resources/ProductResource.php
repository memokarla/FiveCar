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
                        ->required(),

                    // grid
                    Forms\Components\Grid::make(2)
                    ->schema([

                        // milih merk
                        Forms\Components\Select::make('merks_id')
                            ->label('Car Brand') 
                            ->relationship('merk', 'name')
                            ->required(),

                        // milih jenis
                        Forms\Components\Select::make('jenis_id')
                            ->label('Car Categories')
                            ->relationship('jenis', 'name')
                            ->required(),
                    ]),

                    // name
                    Forms\Components\TextInput::make('name')
                        ->label('Car Name') 
                        ->placeholder('Categories') 
                        ->required(),
                    
                    // price
                    Forms\Components\TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->prefix('Rp ')
                        ->extraInputAttributes(['style' => 'text-align: right']) // Rata kanan agar lebih rapi
                        ->suffix('.00') // Menampilkan default desimal
                        ->required(),

                    // location
                    Forms\Components\TextInput::make('location')
                        ->label('Location') 
                        ->placeholder('City') 
                        ->required(),

                    // description
                    Forms\Components\Section::make('Description') // Card dengan judul "Description"
                    ->schema([
                        Forms\Components\Grid::make(2) // Grid 2 kolom
                            ->schema([
                                Forms\Components\TextInput::make('Mesin')
                                    ->required(),
                                Forms\Components\TextInput::make('Transmisi')
                                    ->required(),
                                Forms\Components\TextInput::make('Tenaga')
                                    ->required(),
                                Forms\Components\Select::make('Jenis Bahan Bakar')
                                    ->options([
                                        'bensin' => 'Bensin',
                                        'solar' => 'Solar',
                                        'listrik' => 'Listrik',
                                        'hybrid' => 'Hybrid',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('Konsumsi BBM')
                                    ->label('Konsumsi BBM')
                                    ->required(),
                                Forms\Components\TextInput::make('Kapasitas Tempat Duduk')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('Lebar')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('Panjang')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('Tinggi')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('Ground Clearance')
                                    ->required(),
                            ]),
                    ])
                    ->collapsible() // Menjadikan section bisa di-expand/collapse
                    ->collapsed() // Defaultnya tertutup
                    ->columnSpanFull(), // Memastikan card ini melebar penuh di form
                    
                    // condition
                    Forms\Components\Select::make('condition')
                        ->label('Kondisi')
                        ->options([
                            'baru' => 'Baru',
                            'bekas' => 'Bekas',
                        ])
                        ->required()
                        ->native(false), // Agar pakai dropdown custom Filament
                ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

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
                        ->directory('car_image')
                        ->required(), // Wajib

                    // grid
                    Forms\Components\Grid::make(2)
                    ->schema([

                        // milih merk
                        Forms\Components\Select::make('merks_id')
                            ->label('Car Brand') 
                            ->relationship('merk', 'name')
                            ->native(false)
                            ->required(),

                        // milih jenis
                        Forms\Components\Select::make('jenis_id')
                            ->label('Car Categories')
                            ->relationship('jenis', 'name')
                            ->native(false)
                            ->required(),
                    ]),

                    // name
                    Forms\Components\TextInput::make('name')
                        ->label('Car Variant / Series') 
                        ->placeholder('Varian or Series') 
                        ->required(),
                    
                    // price
                    Forms\Components\TextInput::make('price')
                        ->label('Price (Million)')
                        ->numeric()
                        ->prefix('Rp ')
                        ->extraInputAttributes(['style' => 'text-align: left']) // Rata kiri agar lebih rapi
                        ->suffix('.00') // Menampilkan default desimal
                        ->required(),

                    // location
                    Forms\Components\TextInput::make('location')
                        ->label('Location') 
                        ->placeholder('City') 
                        ->required(),

                    // condition
                    Forms\Components\Select::make('condition')
                        ->label('Condition')
                        ->options([
                            'baru' => 'New',
                            'bekas' => 'Second',
                        ])
                        ->required()
                        ->native(false), // Agar pakai dropdown custom Filament

                    // description
                    Forms\Components\Section::make('description')
                    ->schema([
                        Forms\Components\Grid::make(2)
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
                                Forms\Components\Select::make('description.fuel_type')
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
                        ->collapsible()
                        ->collapsed()
                        ->columnSpanFull(),                
                                    
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') 
                    ->getStateUsing(fn ($record) => Product::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 
                
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->searchable(),
                
                // Brand - Categories - Variant
                Tables\Columns\TextColumn::make('car_info')
                    ->label('Car')
                    ->getStateUsing(fn ($record) => "{$record->merk->name} - {$record->jenis->name}")
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

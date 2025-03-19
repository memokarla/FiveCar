<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MerkResource\Pages;
use App\Filament\Resources\MerkResource\RelationManagers;
use App\Models\Merk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MerkResource extends Resource
{
    protected static ?string $model = Merk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //card
                Forms\Components\Card::make()
                    ->schema([
                        
                        //image
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image() 
                            ->directory('merk_image') // Folder penyimpanan di storage/app/public/[merk_image]
                            ->required(), // Wajib

                        // name
                        Forms\Components\TextInput::make('name')
                            ->label('Car Brand') // Tulisan ini ada di atas form
                            ->placeholder('Brand') // Tulisan ini ada di dalam form
                            ->afterStateUpdated(function (callable $set, $state) {  
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            })
                            ->required(),
  
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->disabled() // Nonaktifkan jika ingin slug hanya untuk tampil dan tidak diubah manual
                            ->required(),
                        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') 
                    ->getStateUsing(fn ($record) => Merk::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Car Brand')
                    ->searchable(), // bisa di search oleh filamentnya

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
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
            'index' => Pages\ListMerks::route('/'),
            'create' => Pages\CreateMerk::route('/create'),
            'edit' => Pages\EditMerk::route('/{record}/edit'),
        ];
    }
}

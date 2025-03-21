<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisResource\Pages;
use App\Filament\Resources\JenisResource\RelationManagers;
use App\Models\Jenis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisResource extends Resource
{
    protected static ?string $model = Jenis::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

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
                            ->directory('jenis_image') // Folder penyimpanan di storage/app/public/[jenis_image]
                            ->required(), // Wajib

                        // name
                        Forms\Components\TextInput::make('name')
                            ->label('Car Categories') // Tulisan ini ada di atas form
                            ->placeholder('Categories') // Tulisan ini ada di dalam form
                            ->afterStateUpdated(function (callable $set, $state) {  
                              // afterStateUpdated -> callback yang dijalankan setelah nilai state pada field diperbarui oleh pengguna
                              // function (callable $set, $state) 
                              // -> $set (setter): mengubah atau mengisi field lain (dala konteks ini adalah 'slug') dalam form berdasarkan input name (ini tegantung $set yang diatur) 
                              // -> $state: nilai terkini dari input field (misal aku isi field name dengan "Sedan", maka maka $state akan berisi "Sedan")
                                $set('slug', \Illuminate\Support\Str::slug($state));
                                // set inilah yang menjadi acuan nilai pada $state hendak diapakan
                                // \Illuminate\Support\Str::slug($state) -> Mengubah nilai name menjadi slug
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
                    ->getStateUsing(fn ($record) => Jenis::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Car Category')
                    ->searchable(), // bisa di search oleh filamentnya

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJenis::route('/'),
            'create' => Pages\CreateJenis::route('/create'),
            'edit' => Pages\EditJenis::route('/{record}/edit'),
        ];
    }
}

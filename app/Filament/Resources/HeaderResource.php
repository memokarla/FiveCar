<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeaderResource\Pages;
use App\Filament\Resources\HeaderResource\RelationManagers;
use App\Models\Header;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeaderResource extends Resource
{
    protected static ?string $model = Header::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //card
                Forms\Components\Card::make()
                    ->schema([

                        Forms\Components\FileUpload::make('image')
                        ->label('Image Header')
                        ->image() // Menjadikan file yang di-upload sebagai gambar
                        ->directory('headers') // Folder penyimpanan di storage/app/public/[headers]
                        ->required(), // Wajib

                        Forms\Components\TextInput::make('text')
                        ->label('Text Header')
                        ->placeholder('Text'),

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('button.text')
                                ->label('Button Text'),
                        
                            Forms\Components\Select::make('button.color')
                                ->label('Button Color (Bootstrap)')
                                ->options([
                                    'primary' => 'Primary (Blue)',
                                    'secondary' => 'Secondary (Gray)',
                                    'success' => 'Success (Green)',
                                    'danger' => 'Danger (Red)',
                                    'warning' => 'Warning (Yellow)',
                                    'info' => 'Info (Cyan)',
                                    'light' => 'Light (White)',
                                    'dark' => 'Dark (Black)',
                                ]),
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            Tables\Columns\ImageColumn::make('image')
                 ->label('Header Image'),

            Tables\Columns\TextColumn::make('text')
                ->label('Text Header')
                ->searchable(),

            Tables\Columns\TextColumn::make('button.text')
                ->label('Button Text')
                ->sortable(),

            Tables\Columns\BadgeColumn::make('button.color')
                ->label('Button Color')
                ->colors([
                    'primary' => 'blue',
                    'secondary' => 'gray',
                    'success' => 'green',
                    'danger' => 'red',
                    'warning' => 'yellow',
                    'info' => 'cyan',
                    'light' => 'white',
                    'dark' => 'black',
                ])
                ->sortable(),
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
            'index' => Pages\ListHeaders::route('/'),
            'create' => Pages\CreateHeader::route('/create'),
            'edit' => Pages\EditHeader::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    // mengatur urutannya
    public static function getNavigationSort(): ?int
    {
        return 6; 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                ->schema([
                    // grid
                    Forms\Components\Grid::make(2) 
                    ->schema([
                        // email
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->placeholder('Email')
                            ->email()
                            ->required(),

                        // phone
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone')
                            ->prefix('+62 ') // menambahkan teks atau simbol di depan
                            ->numeric() 
                            ->required(),
                    ]),

                    // name
                    Forms\Components\TextInput::make('name')
                        ->label('Name') 
                        ->placeholder('Name') 
                        ->required(),

                    // message
                    Forms\Components\RichEditor::make('message') // ini untuk text berformat, kayak bold, italic, underlin, dsb
                        ->label('Message')
                        ->placeholder('Message')
                        ->disableAttachments() // matikan upload gambar
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') // Ini kayak fieldnya, untuk memudahkan pengguna mengidentifikasi data
                    ->getStateUsing(fn ($record) => Contact::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
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
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    // mengatur urutannya
    public static function getNavigationSort(): ?int
    {
        return 6; 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //card
                Forms\Components\Card::make()
                    ->schema([

                        // grid
                        Forms\Components\Grid::make(2) 
                        ->schema([

                            // name
                            Forms\Components\TextInput::make('name')
                                ->label('Name')
                                ->placeholder('Name')
                                ->required(),

                            // email
                            Forms\Components\TextInput::make('email')
                                ->label('Email Address')
                                ->placeholder('Email')
                                ->email()
                                ->required(),

                            // email created
                            Forms\Components\DateTimePicker::make('created_at')
                                ->label('Email Created At')
                                ->placeholder('Email Created At')
                                ->default(now())
                                ->disabled(), // Membuat input tidak bisa diedit

                            // password
                            Forms\Components\TextInput::make('password')
                                ->label('Password')
                                ->placeholder('Password')
                                ->password()
                                ->required(),

                            // roles
                            Forms\Components\Select::make('roles')
                                ->relationship('roles', 'name') // Relasi dengan roles dari spatie/permission
                                ->multiple()
                                ->columnSpan(2)
                                ->required(),

                        ]),
                        
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') // Ini kayak fieldnya, untuk memudahkan pengguna mengidentifikasi data
                    ->getStateUsing(fn ($record) => User::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

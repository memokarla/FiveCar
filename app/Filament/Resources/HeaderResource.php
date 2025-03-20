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
                        ->label('Text Header') // Tulisan ini ada di atas form
                        ->placeholder('Text'), // Tulisan ini ada di dalam form

                        // keduanya dianggap sebagai array JSON dalam satu kolom database, bukan sebagai field individual
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('button.text') // Mengakses properti text dalam JSON
                                ->label('Button Text'),
                        
                            Forms\Components\Select::make('button.color') // Mengakses properti color dalam JSON
                                ->label('Button Color (Bootstrap)')
                                ->options([
                                    // Sebagai kunci (key) dalam array => Sebagai nilai (value) yang ditampilkan di dropdown
                                    'primary' => 'Primary (Blue)',
                                    'secondary' => 'Secondary (Gray)',
                                    'success' => 'Success (Green)',
                                    'danger' => 'Danger (Red)',
                                    'warning' => 'Warning (Yellow)',
                                    'info' => 'Info (Cyan)',
                                    'light' => 'Light (White)',
                                    'dark' => 'Dark (Black)',
                                ])
                                ->required(fn ($get) => !empty($get('button.text'))), // Wajib jika button text diisi
                        ]),
                        
                        Forms\Components\TextInput::make('button_link')
                            ->label('Link') 
                            ->placeholder('Link for Button')
                            ->url() // memastikan input berupa URL 
                            ->required(fn ($get) => !empty($get('button.text'))),
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
                    ->getStateUsing(fn ($record) => Header::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 
                    
                Tables\Columns\ImageColumn::make('image')
                    ->label('Header Image'),

                Tables\Columns\TextColumn::make('text')
                    ->label('Text Header')
                    ->searchable(), // bisa di search oleh filamentnya

                Tables\Columns\TextColumn::make('button.text')
                    ->label('Button Text')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('button.color')
                    ->label('Button Color')
                    ->colors([
                        // nilai yang disimpan di database => teks yang ditampilkan di dropdown pada form (saat memilih warna)
                        'primary' => 'primary',
                        'secondary' => 'gray',
                        'success' => 'success',
                        'danger' => 'danger',
                        'warning' => 'warning',
                        'info' => 'info',
                        'light' => 'gray',
                        'dark' => 'dark',
                    ])                    
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('is_active') // Menampilkan toggle switch di tabel
                    ->label('Is Active'), 
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active') // Menyaring carousel berdasarkan status:
                    ->trueLabel('Aktif') // Menampilkan hanya yang aktif
                    ->falseLabel('Nonaktif'), // Menampilkan hanya yang tidak aktif
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
            'index' => Pages\ListHeaders::route('/'),
            'create' => Pages\CreateHeader::route('/create'),
            'edit' => Pages\EditHeader::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\MerkResource\Pages;

use App\Filament\Resources\MerkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMerk extends EditRecord
{
    protected static string $resource = MerkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

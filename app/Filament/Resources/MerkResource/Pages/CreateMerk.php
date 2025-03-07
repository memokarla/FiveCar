<?php

namespace App\Filament\Resources\MerkResource\Pages;

use App\Filament\Resources\MerkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMerk extends CreateRecord
{
    protected static string $resource = MerkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

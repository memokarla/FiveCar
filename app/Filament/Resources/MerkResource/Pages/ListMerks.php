<?php

namespace App\Filament\Resources\MerkResource\Pages;

use App\Filament\Resources\MerkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMerks extends ListRecords
{
    protected static string $resource = MerkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

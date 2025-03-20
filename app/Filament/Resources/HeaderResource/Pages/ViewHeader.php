<?php

namespace App\Filament\Resources\ViewResource\Pages;

use App\Filament\Resources\ViewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewView extends ViewRecord
{
    protected static string $resource = ViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

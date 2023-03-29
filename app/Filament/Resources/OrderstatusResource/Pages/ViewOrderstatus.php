<?php

namespace App\Filament\Resources\OrderstatusResource\Pages;

use App\Filament\Resources\OrderstatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrderstatus extends ViewRecord
{
    protected static string $resource = OrderstatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

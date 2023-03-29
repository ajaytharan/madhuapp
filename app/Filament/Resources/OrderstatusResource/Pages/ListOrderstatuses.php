<?php

namespace App\Filament\Resources\OrderstatusResource\Pages;

use App\Filament\Resources\OrderstatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderstatuses extends ListRecords
{
    protected static string $resource = OrderstatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

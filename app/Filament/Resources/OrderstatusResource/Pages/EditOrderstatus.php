<?php

namespace App\Filament\Resources\OrderstatusResource\Pages;

use App\Filament\Resources\OrderstatusResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderstatus extends EditRecord
{
    protected static string $resource = OrderstatusResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ItemChestResource\Pages;

use App\Filament\Resources\ItemChestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemChest extends EditRecord
{
    protected static string $resource = ItemChestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

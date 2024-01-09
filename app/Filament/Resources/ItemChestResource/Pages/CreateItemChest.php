<?php

namespace App\Filament\Resources\ItemChestResource\Pages;

use App\Filament\Resources\ItemChestResource;
use App\Models\ItemChest;
use App\Models\ItemStudent;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateItemChest extends CreateRecord
{
    protected static string $resource = ItemChestResource::class;

    protected function beforeCreate()
    {
        $itemId = $this->data['item_id'];
        $chestId = $this->data['chest_id'];
        $item = ItemChest::where('chest_id', $chestId)->where('item_id', $itemId)->exists();
        if ($item) {
            Notification::make()
                ->title('Item zit al in de kist')
                ->danger()
                ->send();
            $this->halt();
        }
    }
}

<?php

namespace App\Filament\Resources\ItemStudentResource\Pages;

use App\Filament\Resources\ItemStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemStudent extends EditRecord
{
    protected static string $resource = ItemStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ChestStudentResource\Pages;

use App\Filament\Resources\ChestStudentResource;
use App\Models\ChestStudent;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditChestStudent extends EditRecord
{
    protected static string $resource = ChestStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ItemStudentResource\Pages;

use App\Filament\Resources\ItemStudentResource;
use App\Models\ItemStudent;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

use function Laravel\Prompts\error;

class EditItemStudent extends EditRecord
{
    protected static string $resource = ItemStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function beforeSave()
    {
        $originalItemId = $this->getRecord()->getOriginal()['item_id'];
        $newItemId = $this->getRecord()->item_id;
        $studentId = $this->getRecord()->student_id;
        $item = ItemStudent::where('student_id', $studentId)->where('item_id', $newItemId)->exists();
        if ($item && $newItemId != $originalItemId) {
            Notification::make()
                ->title('Student heeft item al in bezit')
                ->danger()
                ->send();
            $this->halt();
        }
    }
}

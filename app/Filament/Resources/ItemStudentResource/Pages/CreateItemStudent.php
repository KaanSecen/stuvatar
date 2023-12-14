<?php

namespace App\Filament\Resources\ItemStudentResource\Pages;

use App\Filament\Resources\ItemStudentResource;
use App\Models\ItemStudent;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateItemStudent extends CreateRecord
{
    protected static string $resource = ItemStudentResource::class;

    protected function beforeCreate()
    {
        $itemId = $this->data['item_id'];
        $studentId = $this->data['student_id'];
        $item = ItemStudent::where('student_id', $studentId)->where('item_id', $itemId)->exists();
        if ($item) {
            Notification::make()
                ->title('Student heeft item al in bezit')
                ->danger()
                ->send();
            $this->halt();
        }
    }
}

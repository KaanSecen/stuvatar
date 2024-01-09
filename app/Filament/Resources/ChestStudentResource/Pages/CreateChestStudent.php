<?php

namespace App\Filament\Resources\ChestStudentResource\Pages;

use App\Filament\Resources\ChestStudentResource;
use App\Models\ChestStudent;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateChestStudent extends CreateRecord
{
    protected static string $resource = ChestStudentResource::class;

    protected function beforeCreate()
    {
        $studentId = $this->data['student_id'];
        $chestId = $this->data['chest_id'];
        $item = ChestStudent::where('chest_id', $chestId)->where('student_id', $studentId)->exists();
        if ($item) {
            Notification::make()
                ->title('Student heeft deze kist al')
                ->danger()
                ->send();
            $this->halt();
        }
    }
}

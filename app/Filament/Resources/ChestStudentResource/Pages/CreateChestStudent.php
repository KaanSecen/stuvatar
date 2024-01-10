<?php

namespace App\Filament\Resources\ChestStudentResource\Pages;

use App\Filament\Resources\ChestStudentResource;
use App\Models\ChestStudent;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateChestStudent extends CreateRecord
{
    protected static string $resource = ChestStudentResource::class;
}

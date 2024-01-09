<?php

namespace App\Filament\Resources\ChestStudentResource\Pages;

use App\Filament\Resources\ChestStudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChestStudents extends ListRecords
{
    protected static string $resource = ChestStudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

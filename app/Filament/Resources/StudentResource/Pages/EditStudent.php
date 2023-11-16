<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(35),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(35),
                Select::make('grade_id')
                    ->required()
                    ->relationship('grade', 'title'),
                TextInput::make('card')
                    ->disabled(),
                TextInput::make('points')
                    ->numeric()
                    ->minValue(0)
                    ->default(150)
            ]);
    }
}

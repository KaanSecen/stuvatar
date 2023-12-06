<?php

namespace App\Filament\Resources\GradeResource\RelationManagers;

use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    public function form(Form $form): Form
    {
//        dd($form);
        $randomCardValue = Str::random(9);
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(35),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(35),
                Forms\Components\Select::make('grade_id')
                    ->required()
                    ->relationship('grade', 'title')
                    ->default('5'),
                Forms\Components\TextInput::make('card')
                    ->required()
                    ->default($randomCardValue)
                    ->readonly(),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->minValue(0)
                    ->default(150)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('first_name')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('card')
                    ->color('info')
                    ->icon('heroicon-o-identification')
                    ->copyable()
                    ->copyMessage('Kaart gekopieerd')
                    ->label('Kaart'),
                Tables\Columns\TextColumn::make('points')
                    ->color('warning')
                    ->icon('heroicon-o-circle-stack'),
                Tables\Columns\SelectColumn::make('grade_id')
                    ->options(Grade::all()->pluck('title', 'id'))
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    public static ?string $navigationLabel = 'Klassen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Titel')
                    ->maxLength(255),
                Forms\Components\ColorPicker::make('color')
                    ->label('Kleur'),
                Forms\Components\Textarea::make('description')
                    ->label('Beschrijving'),
                Forms\Components\TextInput::make('grade_number')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(8)
                    ->label('Groep'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Titel'),
                Tables\Columns\ColorColumn::make('color')
                    ->copyable()
                    ->copyMessage('Kleur gekopieerd')
                    ->label('Kleur')
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('grade_number')
                    ->label('Groep'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}

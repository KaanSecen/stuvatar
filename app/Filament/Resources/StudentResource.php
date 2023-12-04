<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Grade;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

use Filament\Tables\Filters\SelectFilter;


class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static ?string $navigationGroup = 'School';

    public static function form(Form $form): Form
    {
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
                    ->relationship('grade', 'title'),
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


    public static function table(Table $table): Table
    {
        return $table
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
                SelectFilter::make('grade_id')
                    ->label('Groep')
                    ->searchable()
                    ->options(Grade::all()->pluck('title', 'id'))
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}

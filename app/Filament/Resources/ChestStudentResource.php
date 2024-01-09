<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChestStudentResource\Pages;
use App\Filament\Resources\ChestStudentResource\RelationManagers;
use App\Models\ChestStudent;
use App\Models\Item;
use App\Models\ItemStudent;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChestStudentResource extends Resource
{
    protected static ?string $model = ChestStudent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->required()
                            ->searchable()
                            ->suffixIcon('heroicon-o-user-circle')
                            ->relationship('student', 'full_name'),
                        Forms\Components\Select::make('chest_id')
                            ->required()
                            ->searchable()
                            ->suffixIcon('heroicon-o-cube')
                            ->relationship('chest', 'title'),
                    ])->columnSpan(['lg' => 2]),
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('used')
                            ->label('Actief')
                            ->disabled()
                            ->offIcon('heroicon-o-x-mark')
                            ->onIcon('heroicon-o-check')
                    ])->columnSpan(['lg' => 1])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('student.id'),
                Tables\Columns\TextColumn::make('student.full_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('chest.id'),
                Tables\Columns\TextColumn::make('chest.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('used')
                    ->boolean(),
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
            'index' => Pages\ListChestStudents::route('/'),
            'create' => Pages\CreateChestStudent::route('/create'),
            'edit' => Pages\EditChestStudent::route('/{record}/edit'),
        ];
    }
}

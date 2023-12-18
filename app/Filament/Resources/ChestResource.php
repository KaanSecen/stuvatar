<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChestResource\Pages;
use App\Filament\Resources\ChestResource\RelationManagers;
use App\Models\Chest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ChestResource extends Resource
{
    protected static ?string $model = Chest::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    public static ?string $navigationGroup = 'Stuvatar';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Titel')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                    ->rules( 'file', 'mimetypes:image/png,image/jpeg,image/webp')
                    ->maxSize(1024)
                    ->directory('chests')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Beschrijving'),
                Forms\Components\Toggle::make('is_available_for_sale')
                    ->label('Beschikbaar voor verkoop')
                    ->live()
                    ->offIcon('heroicon-o-x-mark')
                    ->onIcon('heroicon-o-check'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->hidden(fn (Get $get): bool => ! $get('is_available_for_sale'))
                    ->minValue(0)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\ImageColumn::make('image')
                    ->square()
                    ->label('Afbeelding'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\IconColumn::make('is_available_for_sale')
                    ->boolean(),
                Tables\Columns\TextColumn::make('price')
                    ->color('warning')
                    ->icon('heroicon-o-circle-stack'),
                Tables\Columns\TextColumn::make('price')
                    ->color('warning')
                    ->icon('heroicon-o-circle-stack')
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
            'index' => Pages\ListChests::route('/'),
            'create' => Pages\CreateChest::route('/create'),
            'edit' => Pages\EditChest::route('/{record}/edit'),
        ];
    }
}

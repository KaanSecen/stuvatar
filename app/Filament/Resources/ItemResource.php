<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static ?string $navigationGroup = 'Stuvatar';

    protected static ?string $navigationLabel = 'Items';


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
                    ->directory('items')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Beschrijving'),
                Forms\Components\ColorPicker::make('background_color')
                    ->label('Achtergrondkleur'),
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
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship('category', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ColorColumn::make('background_color')
                    ->copyable()
                    ->copyMessage('Kleur gekopieerd')
                    ->label('Kleur'),
                Tables\Columns\ImageColumn::make('image')
                    ->square()
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}

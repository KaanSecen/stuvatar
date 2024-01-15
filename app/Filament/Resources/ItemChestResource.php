<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemChestResource\Pages;
use App\Filament\Resources\ItemChestResource\RelationManagers;
use App\Models\ItemChest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemChestResource extends Resource
{
    protected static ?string $model = ItemChest::class;

    protected static ?string $slug = 'chests/items';
    protected static ?string $modelLabel = 'Chest Items';
    protected static ?string $navigationParentItem = 'Chests';
    public static ?string $navigationGroup = 'Stuvatar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('chest_id')
                            ->required()
                            ->searchable()
                            ->suffixIcon('heroicon-o-gift')
                            ->relationship('chest', 'title'),
                        Forms\Components\Select::make('item_id')
                            ->required()
                            ->searchable()
                            ->suffixIcon('heroicon-o-cube')
                            ->relationship('item', 'title'),
                        Forms\Components\Radio::make('rarity')
                            ->required()
                            ->options([
                                'common' => 'Common',
                                'uncommon' => 'Uncommon',
                                'rare' => 'Rare',
                                'legendary' => 'Legendary'
                            ])
                    ])->columnSpan(['lg' => 2]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('chest.id'),
                Tables\Columns\TextColumn::make('chest.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item.category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('rarity')
                    ->icon('heroicon-o-square-3-stack-3d')
                    ->color(fn (string $state): string => match ($state) {
                        'common' => 'info',
                        'uncommon' => 'success',
                        'rare' => 'danger',
                        'legendary' => 'warning',
                        default => 'gray',
                    }),
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
            'index' => Pages\ListItemChests::route('/'),
            'create' => Pages\CreateItemChest::route('/create'),
            'edit' => Pages\EditItemChest::route('/{record}/edit'),
        ];
    }
}

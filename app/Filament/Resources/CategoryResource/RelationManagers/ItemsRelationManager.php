<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Models\Category;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
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
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship('category', 'name')
                    ->default(function (RelationManager $livewire) {
                        return $livewire->ownerRecord->id;
                    }),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ColorColumn::make('background_color')
                    ->copyable()
                    ->copyMessage('Kleur gekopieerd')
                    ->label('Kleur'),
                Tables\Columns\ImageColumn::make('image')
                    ->square(),
                Tables\Columns\SelectColumn::make('category_id')
                    ->options(Category::all()->pluck('name', 'id'))
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

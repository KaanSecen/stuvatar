<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemStudentResource\Pages;
use App\Models\ItemStudent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Closure;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemStudentResource extends Resource
{
    protected static ?string $model = ItemStudent::class;

    protected static ?string $slug = 'items/inventory';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $modelLabel = 'Inventory';
    protected static ?string $navigationParentItem = 'Items';
    public static ?string $navigationGroup = 'Stuvatar';


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
                Forms\Components\Select::make('item_id')
                    ->required()
                    ->searchable()
                    ->suffixIcon('heroicon-o-cube')

                    ->rules([
                        fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            $item = ItemStudent::where('student_id', $get('student_id'))->where('item_id', $get('item_id'))->exists();
                            if ($item) {
                                $fail('Dit item is al in het bezit van deze student.');
                            }
                        },
                    ])
                    ->relationship('item', 'title'),
                    ])->columnSpan(['lg' => 2]),
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actief')
                            ->offIcon('heroicon-o-x-mark')
                            ->onIcon('heroicon-o-check')
                    ])->columnSpan(['lg' => 1])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.id'),
                Tables\Columns\TextColumn::make('student.full_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item.category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
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
            'index' => Pages\ListItemStudents::route('/'),
            'create' => Pages\CreateItemStudent::route('/create'),
            'edit' => Pages\EditItemStudent::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources\Levels;

use App\Filament\Resources\Levels\Pages\CreateLevel;
use App\Filament\Resources\Levels\Pages\EditLevel;
use App\Filament\Resources\Levels\Pages\ListLevels;
use App\Models\Level;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput; 
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; 
use Filament\Support\Icons\Heroicon;

class LevelResource extends Resource
{
    protected static ?string $model = Level::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'level_nama';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('level_kode')
                ->required()
                ->unique(ignoreRecord: true),
            TextInput::make('level_nama')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('level_kode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('level_nama')
                    ->searchable()
                    ->sortable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLevels::route('/'),
            'create' => CreateLevel::route('/create'),
            'edit' => EditLevel::route('/{record}/edit'),
        ];
    }
}
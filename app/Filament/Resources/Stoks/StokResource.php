<?php

namespace App\Filament\Resources\Stoks;

use App\Filament\Resources\Stoks\Pages\CreateStok;
use App\Filament\Resources\Stoks\Pages\EditStok;
use App\Filament\Resources\Stoks\Pages\ListStoks;
use App\Models\Stok;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Icons\Heroicon;

class StokResource extends Resource
{
    protected static ?string $model = Stok::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // Karena stok tidak punya judul spesifik, kita pakai ID saja atau kosongkan
    protected static ?string $recordTitleAttribute = 'stok_id';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('supplier_id')
                ->relationship('supplier', 'supplier_nama')
                ->required()
                ->searchable(),
            
            Select::make('barang_id')
                ->relationship('barang', 'barang_nama')
                ->required()
                ->searchable(),
            
            Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->searchable(),
            
            DateTimePicker::make('stok_tanggal')
                ->required()
                ->default(now()),
            
            TextInput::make('stok_jumlah')
                ->numeric()
                ->required()
                ->minValue(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier.supplier_nama')
                    ->label('Supplier')
                    ->sortable(),
                TextColumn::make('barang.barang_nama')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('stok_jumlah')
                    ->label('Jumlah Stok')
                    ->alignCenter(),
                TextColumn::make('stok_tanggal')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Petugas'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStoks::route('/'),
            'create' => CreateStok::route('/create'),
            'edit' => EditStok::route('/{record}/edit'),
        ];
    }
}
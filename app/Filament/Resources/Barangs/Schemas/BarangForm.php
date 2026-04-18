<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori_id')
                    ->relationship('kategori', 'kategori_nama')
                    ->required()
                    ->searchable(),

                TextInput::make('barang_kode')
                    ->required()
                    ->maxLength(10)
                    ->unique(ignoreRecord: true),

                TextInput::make('barang_nama')
                    ->required()
                    ->maxLength(100),

                TextInput::make('harga_beli')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('harga_jual')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $label = 'Data Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->label('Kode Barang'),
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Barang'),
                Forms\Components\TextInput::make('stok')
                    ->label('Stok Awal')
                    ->disabledOn('edit'),
                Forms\Components\Select::make('satuan')
                    ->label('Satuan')
                    ->options([
                        'psc' => 'Pcs',
                        'lusin' => 'Lusin',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode Barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok Awal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan')
                    ->label('Satuan'),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\RelationManagers;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $label = 'Data Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([TextInput::make('kode')
                    ->label('Kode Barang'),
            TextInput::make('nama')
                    ->label('Nama Barang'),
            TextInput::make('harga')
                ->label('Harga Barang'),
            TextInput::make('stok')
                    ->label('Stok Awal')
                    ->disabledOn('edit'),
            Select::make('satuan')
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
            ->columns([TextColumn::make('kode')
                    ->label('Kode Barang')
                    ->searchable(),
            TextColumn::make('nama')
                    ->label('Nama Barang')
                    ->searchable(),
            TextColumn::make('harga')
                ->label('Harga Barang')
                ->searchable(),
            TextColumn::make('stok')
                    ->label('Stok Awal')
                    ->searchable(),
            TextColumn::make('satuan')
                    ->label('Satuan'),
            ])
            ->filters([
                //
            ])
            ->actions([EditAction::make(),
            ])
            ->bulkActions([BulkActionGroup::make([
                DeleteBulkAction::make(),
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
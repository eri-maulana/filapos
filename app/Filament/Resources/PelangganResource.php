<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pelanggan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PelangganResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PelangganResource\RelationManagers;

class PelangganResource extends Resource
{
    protected static ?string $model = Pelanggan::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';
    protected static ?string $label = 'Data Pelanggan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([TextInput::make('nama')->required()->minLength(3),
            TextInput::make('no_hp')->label('Nomor Handphone')->unique(ignoreRecord: true),
            TextInput::make('alamat'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            // menambah kolom pencarian otomatis menggunakan "searchable"
            TextColumn::make('nama')->searchable(),
            TextColumn::make('no_hp')->label('Nomor Handphone')->searchable(),
            TextColumn::make('alamat')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([EditAction::make(),
            DeleteAction::make(),
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
            'index' => Pages\ListPelanggans::route('/'),
            'create' => Pages\CreatePelanggan::route('/create'),
            'edit' => Pages\EditPelanggan::route('/{record}/edit'),
        ];
    }
}

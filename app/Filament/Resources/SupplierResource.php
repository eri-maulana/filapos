<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Supplier;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\SupplierResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SupplierResource\RelationManagers;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $label = 'Data Supplier';

    public static function getForm()
    {
        return [
            TextInput::make('nama_perusahaan'),
            TextInput::make('nama'),
            TextInput::make('no_hp')
                ->label('Nomor Handphone')
                ->type('number'),
            TextInput::make('email')
                ->type('email')
                ->label('Email'),
            Textarea::make('alamat')
                ->columnSpanFull(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                self::getForm()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('nama_perusahaan')
                    ->label('Nomor Supplier')->searchable(),
            TextColumn::make('no_hp')
                    ->label('Nomor Handphone')->searchable(),
            TextColumn::make('email')
                    ->searchable(),
            TextColumn::make('alamat')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
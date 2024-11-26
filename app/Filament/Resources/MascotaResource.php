<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MascotaResource\Pages;
use App\Filament\Resources\MascotaResource\RelationManagers;
use App\Models\Mascota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MascotaResource extends Resource
{
    protected static ?string $model = Mascota::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('clientes_id')
                ->relationship('clientes', 'cedula')
                ->required()
                ->searchable()
                ->preload(),
                Forms\Components\TextInput::make('documento')
                ->required(),
                Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('razas_id')
                ->relationship('razas', 'nombre')
                ->required()
                ->searchable()
                ->preload(),
                Forms\Components\Select::make('tipo')
    ->options([
        'Perro' => 'Perro',
        'Gato' => 'Gato',
    ])
    ->required()
    ->label('Tipo de Mascota'),
                Forms\Components\TextInput::make('sexo')
                ->required(),
                Forms\Components\TextInput::make('edad')
                ->required()
                ->numeric(),
                Forms\Components\FileUpload::make('image_path')
    ->image()
    ->imageEditor()
    ->directory('mascotas'), // Especifica la carpeta donde se guardarán las imágenes

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make( 'clientes.cedula')
                    ->sortable(),
                Tables\Columns\TextColumn::make('documento')
                    ->sortable(),
                Tables\Columns\TextColumn::make( 'nombre')
                    ->sortable(),
                Tables\Columns\TextColumn::make('razas.nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('edad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image_path') // Cambiar 'image_url' a 'image_path'
                    ->label('Imagen')
                    ->sortable()
                    ->size(40),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                //]),
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
            'index' => Pages\ListMascotas::route('/'),
            'create' => Pages\CreateMascota::route('/create'),
            'edit' => Pages\EditMascota::route('/{record}/edit'),
        ];
    }
}

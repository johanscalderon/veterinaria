<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VacunaResource\Pages;
use App\Filament\Resources\VacunaResource\RelationManagers;
use App\Models\Vacuna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VacunaResource extends Resource
{
    protected static ?string $model = Vacuna::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye-dropper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mascotas_id')
                ->relationship('mascotas', 'documento')
                ->required()
                ->searchable()
                ->preload(),
                Forms\Components\TextInput::make('nombre_vacuna')
                ->required(),
                Forms\Components\TextInput::make('lote')
                ->required(),
                Forms\Components\DatePicker::make('fecha_aplicacion')
                ->required()
                ->label('Fecha_aplicacion'),
                Forms\Components\DatePicker::make('fecha_proxima_dosis')
                ->required()
                ->label('fecha_proxima_dosis'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mascotas.documento')
                ->label('Documento de Mascota')
                ->sortable(),
            Tables\Columns\TextColumn::make('nombre_vacuna')
                ->label('Nombre de la Vacuna')
                ->sortable(),
            Tables\Columns\TextColumn::make('lote')
                ->label('Lote')
                ->sortable(),
            Tables\Columns\TextColumn::make('fecha_aplicacion')
                ->label('Fecha de Aplicación')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('fecha_proxima_dosis')
                ->label('Fecha de Próxima Dosis')
                ->date()
                ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListVacunas::route('/'),
            'create' => Pages\CreateVacuna::route('/create'),
            'edit' => Pages\EditVacuna::route('/{record}/edit'),
        ];
    }
}

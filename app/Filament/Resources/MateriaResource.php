<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriaResource\Pages;
use App\Models\Materia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class MateriaResource extends Resource {
    protected static ?string $model = Materia::class;

    // 1. ICONO Y GRUPO (Para que aparezca junto a Microcurrículos)
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Académico';

    // 2. ETIQUETAS EN ESPAÑOL
    protected static ?string $modelLabel = 'Asignatura';
    protected static ?string $pluralModelLabel = 'Asignaturas';

    public static function form(Form $form): Form {
        return $form->schema([
            // 3. DISEÑO DE SECCIÓN (Para que se vea más completo como la demo)
            Section::make('Detalles de la Asignatura')
                ->description('Configure la información básica de la materia o asignatura.')
                ->icon('heroicon-m-academic-cap')
                ->schema([
                    Grid::make(3)->schema([
                        Forms\Components\TextInput::make('codigo')
                            ->label('Código')
                            ->placeholder('Ej: SIS-101')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('nombre')
                            ->label('Nombre de la Materia')
                            ->placeholder('Ej: Estructura de Datos')
                            ->required()
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('creditos')
                            ->label('Créditos')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10)
                            ->default(3)
                            ->required(),
                    ]),
                ])
        ]);
    }

    public static function table(Table $table): Table {
        return $table->columns([
            Tables\Columns\TextColumn::make('codigo')
                ->label('Código')
                ->searchable()
                ->sortable()
                ->copyable(), // Permite copiar el código con un clic

            Tables\Columns\TextColumn::make('nombre')
                ->label('Nombre')
                ->searchable()
                ->sortable()
                ->weight('bold'),

            Tables\Columns\TextColumn::make('creditos')
                ->label('Créditos')
                ->badge()
                ->color('info')
                ->alignCenter(),
        ])
        ->filters([
            // Aquí podrías añadir un filtro por créditos si quieres
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListMaterias::route('/'),
            'create' => Pages\CreateMateria::route('/create'),
            'edit' => Pages\EditMateria::route('/{record}/edit'),
        ];
    }
}
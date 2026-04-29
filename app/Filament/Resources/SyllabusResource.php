<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SyllabusResource\Pages;
use App\Models\Syllabus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Closure;

class SyllabusResource extends Resource
{
    protected static ?string $model = Syllabus::class;

    // ICONO Y GRUPO PARA LA BARRA LATERAL
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Académico';
    
    protected static ?string $modelLabel = 'Microcurrículo';
    protected static ?string $pluralModelLabel = 'Microcurrículos';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        if (!auth()->user()->isDirector()) {
            return $query->where('docente_id', auth()->user()->id);
        }
        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Syllabus')
                    ->tabs([
                        // PESTAÑA 1: INFORMACIÓN GENERAL
                        Tabs\Tab::make('Información General')
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('codigo')->label('Código')->required(),
                                    Select::make('materia_id')->relationship('materia', 'nombre')->label('Asignatura')->required()->searchable()->preload(),
                                    TextInput::make('semestre')->label('Semestre')->required(),
                                ]),
                                Grid::make(2)->schema([
                                    TextInput::make('programa_academico')->label('Programa Académico'),
                                    TextInput::make('area_formacion')->label('Área de Formación'),
                                ]),
                                Grid::make(3)->schema([
                                    TextInput::make('creditos')->numeric()->label('Créditos'),
                                    TextInput::make('tipo_asignatura')->label('Tipo de Asignatura'),
                                    Select::make('modalidad')
                                        ->options(['Presencial' => 'Presencial', 'Virtual' => 'Virtual', 'Distancia' => 'A Distancia']),
                                ]),
                            ]),

                        // PESTAÑA 2: UNIDADES DE APRENDIZAJE
                        Tabs\Tab::make('Unidades de Aprendizaje')
                            ->icon('heroicon-m-list-bullet')
                            ->schema([
                                Repeater::make('unidades')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('nombre_unidad')
                                            ->label('Nombre de la Unidad')
                                            ->placeholder('Ej: Unidad 1: Fundamentos de Ingeniería...')
                                            ->required()
                                            ->columnSpanFull(),
                                        
                                        Grid::make(2)->schema([
                                            RichEditor::make('temas')
                                                ->label('Contenidos / Temas')
                                                ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                                                ->required(),

                                            RichEditor::make('resultados_aprendizaje')
                                                ->label('Resultados de Aprendizaje')
                                                ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList'])
                                                ->required(),
                                        ]),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['nombre_unidad'] ?? 'Nueva Unidad')
                                    ->collapsible()
                                    ->collapsed() // Esto fuerza el diseño compacto de lista
                                    ->cloneable()
                                    ->reorderableWithButtons()
                                    ->addActionLabel('Agregar Nueva Unidad')
                                    ->columnSpanFull()
                                    ->inset(),
                            ]),

                        // PESTAÑA 3: EVALUACIÓN
                        Tabs\Tab::make('Evaluación')
                            ->icon('heroicon-m-check-circle')
                            ->schema([
                                Repeater::make('evaluaciones')
                                    ->relationship()
                                    ->schema([
                                        Grid::make(4)->schema([
                                            TextInput::make('actividad')
                                                ->label('Actividad de Evaluación')
                                                ->required()
                                                ->columnSpan(2),
                                            TextInput::make('porcentaje')
                                                ->label('Porcentaje')
                                                ->numeric()
                                                ->minValue(1)
                                                ->maxValue(100)
                                                ->suffix('%')
                                                ->required(),
                                            TextInput::make('semana')
                                                ->label('Semana Sugerida'),
                                        ]),
                                    ])
                                    ->itemLabel(fn (array $state): ?string => $state['actividad'] ?? 'Nueva Actividad')
                                    ->collapsed() // También compacto para evaluaciones
                                    ->rules([
                                        fn (): Closure => function (string $attribute, $value, Closure $fail) {
                                            $total = collect($value)->sum('porcentaje');
                                            if ($total !== 100) {
                                                $fail("La suma de los porcentajes debe ser exactamente 100%. Actualmente suma: {$total}%");
                                            }
                                        },
                                    ])
                                    ->addActionLabel('Agregar Actividad de Evaluación')
                                    ->reorderableWithButtons()
                                    ->columnSpanFull()
                                    ->inset(),
                            ]),

                        // PESTAÑA 4: METODOLOGÍA Y BIBLIOGRAFÍA
                        Tabs\Tab::make('Metodología y Bibliografía')
                            ->icon('heroicon-m-book-open')
                            ->schema([
                                RichEditor::make('justificacion')->label('Justificación'),
                                RichEditor::make('metodologia')->label('Metodología'),
                                Section::make('Fuentes de Información')
                                    ->schema([
                                        RichEditor::make('bibliografia_basica')->label('Bibliografía Básica'),
                                        RichEditor::make('bibliografia_digital')->label('Bibliografía Digital'),
                                    ])
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')->label('Código')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('materia.nombre')->label('Asignatura')->searchable()->sortable()->weight('bold'),
                Tables\Columns\TextColumn::make('docente.nombre')->label('Docente')->searchable(),
                Tables\Columns\TextColumn::make('modalidad')->label('Modalidad')->badge(),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aprobado' => 'success',
                        'pendiente' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('semestre')->label('Periodo'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('modalidad')
                    ->options(['Presencial' => 'Presencial', 'Virtual' => 'Virtual', 'Distancia' => 'A Distancia']),
            ])
            ->actions([
                Tables\Actions\Action::make('imprimir')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('danger')
                    ->url(fn (Syllabus $record): string => route('syllabus.print', $record))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('aprobar')
                    ->label('Aprobar')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Syllabus $record) => auth()->user()->isDirector() && $record->estado !== 'aprobado')
                    ->action(fn (Syllabus $record) => $record->update(['estado' => 'aprobado'])),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSyllabi::route('/'),
            'create' => Pages\CreateSyllabus::route('/create'),
            'edit' => Pages\EditSyllabus::route('/{record}/edit'),
        ];
    }
}
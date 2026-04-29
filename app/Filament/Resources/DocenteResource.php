<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocenteResource\Pages;
use App\Models\Docente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

class DocenteResource extends Resource
{
    protected static ?string $model = Docente::class;

    // ICONO Y GRUPOS PARA LA BARRA LATERAL
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Administración';
    
    protected static ?string $navigationLabel = 'Docentes';
    protected static ?string $modelLabel = 'Docente';
    protected static ?string $pluralModelLabel = 'Docentes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información del Docente')
                    ->description('Ingrese los datos personales del docente')
                    ->icon('heroicon-m-user-circle') // Un icono pequeño para la sección
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre Completo')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('documento')
                            ->label('Cédula/Documento')
                            ->required()
                            ->unique(ignoreRecord: true),
                            
                        TextInput::make('correo')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                            
                        TextInput::make('telefono')
                            ->tel()
                            ->label('Teléfono de contacto'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('documento')
                    ->label('Cédula')
                    ->searchable()
                    ->copyable(), // Permite copiar la cédula con un click
                
                Tables\Columns\TextColumn::make('correo')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope'),
                
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDocentes::route('/'),
            'create' => Pages\CreateDocente::route('/create'),
            'edit' => Pages\EditDocente::route('/{record}/edit'),
        ];
    }
}
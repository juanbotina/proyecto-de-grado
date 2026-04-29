<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $title = 'Configuración del Sistema';
    protected static ?string $navigationLabel = 'Configuración';
    protected static ?string $navigationGroup = 'Administración';

    // Esta es la línea clave que faltaba para evitar el error 500
    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        // Carga los datos existentes de la DB al formulario
        $this->form->fill(
            Setting::pluck('value', 'key')->toArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ficha configuración')
                    ->description('Datos generales de la institución')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nombre_sistema')->label('Nombre')->default('Syllabus'),
                            TextInput::make('direccion')->label('Dirección'),
                            TextInput::make('telefono')->label('Teléfono'),
                            TextInput::make('celular')->label('Celular'),
                            TextInput::make('nombre_institucional')->label('Nombre institucional'),
                            TextInput::make('correo_institucional')->label('Correo institucional'),
                            TextInput::make('correo_soporte')->label('Correo soporte'),
                        ]),
                        
                        Section::make('Configuración de Correo (SMTP)')->schema([
                            Grid::make(2)->schema([
                                TextInput::make('correo_envio')->label('Correo envío'),
                                TextInput::make('clave_correo')->label('Contraseña correo envío')->password(),
                                TextInput::make('puerto_correo')->label('Puerto')->numeric(),
                                TextInput::make('servidor_correo')->label('Servidor'),
                            ]),
                        ])->compact(),

                        Section::make('Tiempos y Plazos (Días)')->schema([
                            Grid::make(3)->schema([
                                TextInput::make('dias_entrega')->label('Días para entrega')->numeric(),
                                TextInput::make('dias_revision')->label('Días para revisión')->numeric(),
                                TextInput::make('dias_moodle')->label('Días para Moodle')->numeric(),
                            ]),
                        ])->compact(),
                    ])
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar Cambios')
                ->color('success')
                ->submit('save'), // Cambiado de action('save') a submit('save') para mejor compatibilidad
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            Notification::make()
                ->title('Configuración actualizada correctamente')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error al guardar')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
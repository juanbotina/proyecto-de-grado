<?php

namespace App\Filament\Resources\SyllabusResource\Pages;

use App\Filament\Resources\SyllabusResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

class ApproveSyllabus extends EditRecord
{
    protected static string $resource = SyllabusResource::class;

    protected static ?string $title = 'Revisión de Microcurrículo';

    // Esta ruta debe ser idéntica a las carpetas en views
    protected static string $view = 'filament.resources.syllabus-resource.pages.approve-syllabus';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('observaciones_revision')
                    ->label('Agregar observación...')
                    ->placeholder('Escriba aquí los detalles para el docente...')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }

    protected function getHeaderActions(): array { return []; }
    protected function getFormActions(): array { return []; }

    public function approve()
    {
        $this->record->update(['estado' => 'Aprobado']);

        Notification::make()->title('Microcurrículo Aprobado')->success()->send();

        return redirect($this->getResource()::getUrl('index'));
    }

    public function reject()
    {
        $this->record->update(['estado' => 'Con Observaciones']);

        Notification::make()->title('Enviado con observaciones')->warning()->send();

        return redirect($this->getResource()::getUrl('index'));
    }
}
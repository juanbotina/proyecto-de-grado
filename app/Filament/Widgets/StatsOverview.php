<?php

namespace App\Filament\Widgets;

use App\Models\Syllabus;
use App\Models\Docente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Microcurrículos', Syllabus::count())
                ->description('Total en el sistema')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Esta es la línea de diseño
                
            Stat::make('Pendientes', Syllabus::where('estado', 'pendiente')->count())
                ->description('Por revisar')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Docentes', Docente::count())
                ->description('Registrados')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
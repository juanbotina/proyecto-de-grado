<?php

namespace App\Filament\Widgets;

use App\Models\Syllabus;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SyllabusChart extends ChartWidget
{
    protected static ?string $heading = 'Microcurrículos por Programa';
    
    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Esta versión es segura: cuenta por el texto del campo 'programa_academico'
        // Así no dependemos de tablas externas por ahora.
        $data = Syllabus::query()
            ->select('programa_academico', DB::raw('count(*) as total'))
            ->whereNotNull('programa_academico')
            ->where('programa_academico', '!=', '')
            ->groupBy('programa_academico')
            ->pluck('total', 'programa_academico');

        return [
            'datasets' => [
                [
                    'label' => 'Syllabus',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        '#BA1B1B', // Rojo FUP
                        '#1A1A1A', // Negro
                        '#505050', // Gris
                    ],
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => ['stepSize' => 1],
                ],
            ],
        ];
    }
}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Microcurrículo - {{ $record->codigo }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; text-transform: uppercase; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 18px; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; table-layout: fixed; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; word-wrap: break-word; }
        
        .bg-gray { background-color: #f2f2f2; font-weight: bold; width: 25%; }
        .section-title { background-color: #000; color: #fff; font-weight: bold; padding: 5px; margin-top: 15px; text-transform: uppercase; }
        .content-box { border: 1px solid #000; padding: 10px; min-height: 30px; border-top: none; }
        
        /* Estilos para las tablas de repetidores */
        .table-repeater thead { background-color: #e8e8e8; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <strong>FUNDACIÓN UNIVERSITARIA DE POPAYÁN</strong>
        <h1>MICROCURRÍCULO DE ASIGNATURA</h1>
    </div>

    <table>
        <tr>
            <td class="bg-gray">Código del Curso:</td>
            <td>{{ $record->codigo }}</td>
            <td class="bg-gray">Semestre / Periodo:</td>
            <td>{{ $record->semestre }}</td>
        </tr>
        <tr>
            <td class="bg-gray">Asignatura:</td>
            <td colspan="3"><strong>{{ $record->materia->nombre }}</strong></td>
        </tr>
        <tr>
            <td class="bg-gray">Programa Académico:</td>
            <td colspan="3">{{ $record->programa_academico }}</td>
        </tr>
        <tr>
            <td class="bg-gray">Área de Formación:</td>
            <td>{{ $record->area_formacion }}</td>
            <td class="bg-gray">Créditos:</td>
            <td>{{ $record->creditos }}</td>
        </tr>
        <tr>
            <td class="bg-gray">Docente Responsable:</td>
            <td colspan="3">{{ $record->docente->nombre }}</td>
        </tr>
        <tr>
            <td class="bg-gray">Modalidad:</td>
            <td>{{ $record->modalidad }}</td>
            <td class="bg-gray">Tipo Asignatura:</td>
            <td>{{ $record->tipo_asignatura }}</td>
        </tr>
    </table>

    <div class="section-title">JUSTIFICACIÓN</div>
    <div class="content-box">{!! $record->justificacion !!}</div>

    <div class="section-title">UNIDADES DE APRENDIZAJE</div>
    <table class="table-repeater">
        <thead>
            <tr>
                <th style="width: 30%;">Unidad</th>
                <th style="width: 35%;">Temas</th>
                <th style="width: 35%;">Resultados de Aprendizaje</th>
            </tr>
        </thead>
        <tbody>
            @forelse($record->unidades as $unidad)
                <tr>
                    <td><strong>{{ $unidad->nombre_unidad }}</strong></td>
                    <td>{!! $unidad->temas !!}</td>
                    <td>{!! $unidad->resultados_aprendizaje !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay unidades registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">SISTEMA DE EVALUACIÓN</div>
    <table class="table-repeater">
        <thead>
            <tr>
                <th>Actividad / Estrategia</th>
                <th style="width: 20%;" class="text-center">Semana</th>
                <th style="width: 20%;" class="text-center">Porcentaje (%)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($record->evaluaciones as $eval)
                <tr>
                    <td>{{ $eval->actividad }}</td>
                    <td class="text-center">{{ $eval->semana }}</td>
                    <td class="text-center">{{ $eval->porcentaje }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay actividades de evaluación registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">METODOLOGÍA</div>
    <div class="content-box">{!! $record->metodologia !!}</div>

    <div class="section-title">BIBLIOGRAFÍA BÁSICA</div>
    <div class="content-box">{!! $record->bibliografia_basica !!}</div>

    <div class="section-title">BIBLIOGRAFÍA DIGITAL / COMPLEMENTARIA</div>
    <div class="content-box">{!! $record->bibliografia_digital !!}</div>

</body>
</html>
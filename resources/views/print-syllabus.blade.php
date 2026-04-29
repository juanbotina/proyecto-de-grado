<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Syllabus - {{ $syllabus->materia->nombre }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 40px; color: #333; }
        .header { text-align: center; border-bottom: 3px solid #004a99; margin-bottom: 30px; padding-bottom: 10px; }
        .header h1 { color: #004a99; margin: 0; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 10px; border: 1px solid #ddd; }
        .section-title { background: #004a99; color: white; padding: 10px; font-weight: bold; margin-top: 20px; }
        .content { padding: 15px; border: 1px solid #ddd; border-top: none; background: #fafafa; }
        .no-print { background: #22c55e; color: white; padding: 12px; border: none; border-radius: 5px; cursor: pointer; margin-bottom: 20px; font-weight: bold; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>
    <button class="no-print" onclick="window.print()">Confirmar Impresión / Guardar PDF</button>

    <div class="header">
        <h1>FUNDACIÓN UNIVERSITARIA DE POPAYÁN</h1>
        <h2>SISTEMA DE MICROCURRÍCULOS (SYLLABUS)</h2>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Asignatura:</strong> {{ $syllabus->materia->nombre }}</td>
            <td><strong>Semestre:</strong> {{ $syllabus->semestre }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Docente:</strong> {{ $syllabus->docente->nombre }}</td>
        </tr>
    </table>

    <div class="section-title">JUSTIFICACIÓN</div>
    <div class="content">{!! $syllabus->justificacion !!}</div>

    <div class="section-title">COMPETENCIAS</div>
    <div class="content">{!! $syllabus->competencias !!}</div>

    <div class="section-title">METODOLOGÍA</div>
    <div class="content">{!! $syllabus->metodologia !!}</div>

    <div class="section-title">BIBLIOGRAFÍA BÁSICA</div>
    <div class="content">{!! $syllabus->bibliografia_basica !!}</div>

    <div class="section-title">RECURSOS DIGITALES</div>
    <div class="content">{!! $syllabus->bibliografia_digital !!}</div>
</body>
</html>
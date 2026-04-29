<?php

use Illuminate\Support\Facades\Route;
use App\Models\Syllabus;
use Barryvdh\DomPDF\Facade\Pdf; // Importante para que funcione el PDF

Route::get('/', function () {
    return view('welcome');
});

// RUTA PARA LA IMPRESIÓN DEL MICROCURRÍCULO (MODIFICADA PARA PDF)
Route::get('/syllabus/{record}/print', function (Syllabus $record) {
    // Cargamos la vista que creaste en resources/views/pdf/syllabus.blade.php
    $pdf = Pdf::loadView('pdf.syllabus', compact('record'));
    
    // Retornamos el PDF para que se abra en el navegador
    return $pdf->stream('Syllabus-'.$record->codigo.'.pdf');
})->name('syllabus.print')->middleware(['auth']);
<?php

use Illuminate\Support\Facades\Route;
use App\Models\Syllabus;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Auth\LoginController;

// Redirige la raíz al login
Route::get('/', fn() => redirect('/login'));

// Login único para todos los roles
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para impresión del microcurrículo en PDF
Route::get('/syllabus/{record}/print', function (Syllabus $record) {
    $pdf = Pdf::loadView('pdf.syllabus', compact('record'));
    return $pdf->stream('Syllabus-'.$record->codigo.'.pdf');
})->name('syllabus.print')->middleware(['auth']);
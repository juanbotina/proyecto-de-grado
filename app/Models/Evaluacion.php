<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluacion extends Model
{
    // Nombre de la tabla
    protected $table = 'evaluaciones';

    // Campos permitidos
    protected $fillable = [
        'syllabus_id',
        'actividad',
        'porcentaje',
        'semana'
    ];

    // Relación inversa
    public function syllabus(): BelongsTo
    {
        return $this->belongsTo(Syllabus::class);
    }
}
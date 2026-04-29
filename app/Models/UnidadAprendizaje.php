<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnidadAprendizaje extends Model
{
    // Nombre de la tabla que creamos
    protected $table = 'unidades_aprendizaje';

    // Campos que permitimos guardar
    protected $fillable = [
        'syllabus_id',
        'nombre_unidad',
        'temas',
        'resultados_aprendizaje'
    ];

    // Relación inversa: Una unidad pertenece a un Syllabus
    public function syllabus(): BelongsTo
    {
        return $this->belongsTo(Syllabus::class);
    }
}
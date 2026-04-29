<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Syllabus extends Model
{
    use HasFactory;

    protected $table = 'syllabi';

    protected $fillable = [
        'docente_id', 
        'materia_id', 
        'codigo', 
        'duracion', 
        'horas_acompanamiento_directo', 
        'horas_trabajo_independiente', 
        'modalidad', 
        'disenador_instruccional', 
        'verificador_moodle', 
        'verificador_contenido', 
        'semestre',
        'estado',
        // Nuevos campos del diagrama que podrían ir en la tabla principal
        'programa_academico',
        'area_formacion',
        'tipo_asignatura',
        'creditos',
        'justificacion',
        'metodologia',
        'bibliografia_basica',
        'bibliografia_digital'
    ];

    // --- RELACIONES EXISTENTES ---

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class);
    }

    // --- NUEVAS RELACIONES (SEGÚN TU DIAGRAMA) ---

    /**
     * Relación con las Unidades de Aprendizaje (Uno a Muchos)
     */
    public function unidades(): HasMany
    {
        return $this->hasMany(UnidadAprendizaje::class);
    }

    /**
     * Relación con las Evaluaciones (Uno a Muchos)
     */
    public function evaluaciones(): HasMany
    {
        return $this->hasMany(Evaluacion::class);
    }
}
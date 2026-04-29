<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    use HasFactory;

    // Con esto le damos permiso a Laravel para guardar los datos de la materia
    protected $fillable = [
        'nombre',
        'codigo',
        'creditos',
    ];

    /**
     * Relación: Una Materia puede estar en muchos Microcurrículos
     */
    public function syllabi(): HasMany
    {
        return $this->hasMany(Syllabus::class);
    }
}
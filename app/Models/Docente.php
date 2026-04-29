<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Docente extends Model
{
    use HasFactory;

    // Ajustado para que coincida con el nombre de la columna en la base de datos
    protected $fillable = [
        'nombre',
        'documento', 
        'correo', 
        'telefono',
    ];

    /**
     * Relación: Un Docente puede tener muchos Microcurrículos (Syllabi)
     */
    public function syllabi(): HasMany
    {
        return $this->hasMany(Syllabus::class);
    }
}
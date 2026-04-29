<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     * Esto permite que la página ManageSettings guarde los datos.
     */
    protected $fillable = [
        'key',
        'value',
    ];
}
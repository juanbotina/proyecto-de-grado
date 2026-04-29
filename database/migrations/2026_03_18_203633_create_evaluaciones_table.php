<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            
            // Llave foránea para conectar con la tabla 'syllabi'
            $table->foreignId('syllabus_id')->constrained('syllabi')->onDelete('cascade');
            
            // Campos según tu diagrama de base de datos
            $table->string('actividad'); // Ejemplo: Parcial 1, Taller, Examen Final
            $table->integer('porcentaje'); // El valor de la nota (ej: 20, 30)
            $table->string('semana')->nullable(); // En qué semana se realizará
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
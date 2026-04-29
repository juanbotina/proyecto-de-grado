<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // CAMBIADO A 'syllabi'
        Schema::create('syllabi', function (Blueprint $table) {
            $table->id();
            // Conexiones (Llaves foráneas)
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
            $table->foreignId('docente_id')->constrained('docentes')->onDelete('cascade');
            
            // Información del Syllabus
            $table->string('semestre'); 
            $table->text('justificacion');
            $table->text('competencias');
            $table->text('metodologia');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('syllabi');
    }
};

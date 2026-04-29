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
        // Solo intentará crear la tabla si NO existe previamente
        if (!Schema::hasTable('unidades_aprendizaje')) {
            Schema::create('unidades_aprendizaje', function (Blueprint $table) {
                $table->id();
                // Asegúrate de que la tabla de referencia sea 'syllabi'
                $table->foreignId('syllabus_id')->constrained('syllabi')->onDelete('cascade');
                $table->string('nombre_unidad');
                $table->text('temas');
                $table->text('resultados_aprendizaje');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_aprendizaje');
    }
};
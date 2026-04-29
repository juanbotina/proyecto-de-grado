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
        Schema::create('unidades_aprendizaje', function (Blueprint $table) {
            $table->id();
            // Esta línea es VITAL: conecta la unidad con el Microcurrículo (Syllabus)
            $table->foreignId('syllabus_id')->constrained('syllabi')->onDelete('cascade');
            
            // Campos según tu diagrama
            $table->string('nombre_unidad');
            $table->text('temas')->nullable();
            $table->text('resultados_aprendizaje')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_aprendizaje');
    }
};
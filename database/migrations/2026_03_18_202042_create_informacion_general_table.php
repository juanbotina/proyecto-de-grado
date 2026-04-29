<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('informacion_general', function (Blueprint $table) {
        $table->id();
        $table->foreignId('syllabus_id')->constrained()->onDelete('cascade');
        $table->string('programa_academico');
        $table->string('area_formacion');
        $table->string('tipo_asignatura'); // Teórico, Práctico, etc.
        $table->integer('creditos');
        $table->string('trabajo_dirigido');
        $table->string('trabajo_independiente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_general');
    }
};

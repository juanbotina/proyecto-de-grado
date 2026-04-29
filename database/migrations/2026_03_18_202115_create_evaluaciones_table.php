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
    Schema::create('evaluaciones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('syllabus_id')->constrained()->onDelete('cascade');
        $table->string('actividad'); // Ej: Parcial 1
        $table->integer('porcentaje'); // Ej: 30
        $table->string('semana'); // Ej: Semana 5
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

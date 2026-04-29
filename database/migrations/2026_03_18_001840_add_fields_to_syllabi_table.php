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
        Schema::table('syllabi', function (Blueprint $table) {
            // Campos que pide el formulario de la imagen
            $table->string('codigo')->nullable();
            $table->integer('horas_acompanamiento_directo')->default(0);
            $table->integer('horas_trabajo_independiente')->default(0);
            $table->string('duracion')->nullable(); // Ej: 16 semanas
            $table->string('modalidad')->nullable(); // Virtual, Presencial, etc.
            
            // Campos de verificación y responsables
            $table->string('disenador_instruccional')->nullable();
            $table->string('verificador_moodle')->nullable();
            $table->string('verificador_contenido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('syllabi', function (Blueprint $table) {
            $table->dropColumn([
                'codigo',
                'horas_acompanamiento_directo',
                'horas_trabajo_independiente',
                'duracion',
                'modalidad',
                'disenador_instruccional',
                'verificador_moodle',
                'verificador_contenido'
            ]);
        });
    }
};
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void {
        Schema::table('syllabi', function (Blueprint $table) {
            // Usamos un condicional para cada columna por seguridad
            if (!Schema::hasColumn('syllabi', 'programa_academico')) {
                $table->string('programa_academico')->nullable();
            }
            if (!Schema::hasColumn('syllabi', 'area_formacion')) {
                $table->string('area_formacion')->nullable();
            }
            if (!Schema::hasColumn('syllabi', 'tipo_asignatura')) {
                $table->string('tipo_asignatura')->nullable();
            }
            if (!Schema::hasColumn('syllabi', 'creditos')) {
                $table->integer('creditos')->nullable();
            }
            if (!Schema::hasColumn('syllabi', 'justificacion')) {
                $table->text('justificacion')->nullable();
            }
            if (!Schema::hasColumn('syllabi', 'metodologia')) {
                $table->text('metodologia')->nullable();
            }
            if (!Schema::hasColumn('syllabi', 'bibliografia_basica')) {
                $table->text('bibliografia_basica')->nullable();
            }
            if (!Schema::hasColumn('syllabi', 'bibliografia_digital')) {
                $table->text('bibliografia_digital')->nullable();
            }
        });
    }

    public function down(): void {
        Schema::table('syllabi', function (Blueprint $table) {
            $table->dropColumn([
                'programa_academico', 'area_formacion', 'tipo_asignatura', 
                'creditos', 'justificacion', 'metodologia', 
                'bibliografia_basica', 'bibliografia_digital'
            ]);
        });
    }
};
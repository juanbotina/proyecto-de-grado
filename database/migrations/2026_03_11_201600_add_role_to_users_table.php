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
        Schema::table('users', function (Blueprint $table) {
            // Agregamos el rol: por defecto todos serán docentes
            // Se coloca después del email para que sea ordenado
            $table->string('role')->default('docente')->after('email');
            
            // Opcional: Para saber a qué programa pertenece el Director o Docente
            $table->string('programa')->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Si echamos para atrás la migración, borramos las columnas
            $table->dropColumn(['role', 'programa']);
        });
    }
};
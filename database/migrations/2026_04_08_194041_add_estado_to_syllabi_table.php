<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('syllabi', function (Blueprint $table) {
        // Agregamos la columna estado, por defecto será 'borrador'
        $table->string('estado')->default('borrador')->after('id'); 
    });
}

public function down(): void
{
    Schema::table('syllabi', function (Blueprint $table) {
        $table->dropColumn('estado');
    });
}
};

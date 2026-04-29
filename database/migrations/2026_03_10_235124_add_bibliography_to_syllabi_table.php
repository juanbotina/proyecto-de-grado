<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('syllabi', function (Blueprint $table) {
            // Agregamos los campos de texto largo para las bibliografías
            $table->text('bibliografia_basica')->nullable();
            $table->text('bibliografia_digital')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('syllabi', function (Blueprint $table) {
            $table->dropColumn(['bibliografia_basica', 'bibliografia_digital']);
        });
    }
};

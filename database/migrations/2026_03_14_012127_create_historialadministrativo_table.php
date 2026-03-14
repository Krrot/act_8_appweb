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
        Schema::create('historialadministrativo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuarioId')->constrained('usuarios');
            $table->string('accion',255)->nullable();
            $table->dateTime('fechaAccion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historialadministrativo');
    }
};

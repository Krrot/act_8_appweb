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
        Schema::create('historialfacturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clienteFacturaId')->constrained('clientefacturas');
            $table->foreignId('usuarioId')->constrained('usuarios');
            $table->integer('estadoId')->nullable();
            $table->dateTime('fechaCambio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historialfacturas');
    }
};

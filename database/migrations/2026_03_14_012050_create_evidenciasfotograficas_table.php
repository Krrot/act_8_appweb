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
        Schema::create('evidenciasfotograficas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedidoId')->constrained('pedidos');
            $table->foreignId('usuarioId')->constrained('usuarios');
            $table->enum('tipo',['ENTREGA','DAÑO','INSTALACION']);
            $table->string('urlFoto',255)->nullable();
            $table->dateTime('fechaSubida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidenciasfotograficas');
    }
};

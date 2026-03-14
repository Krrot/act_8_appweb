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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('numeroFactura',50)->nullable();
            $table->foreignId('clienteId')->constrained('clientes');
            $table->dateTime('fechaPedido')->nullable();
            $table->text('notas')->nullable();
            $table->integer('estadoId')->nullable();
            $table->foreignId('usuarioId')->constrained('usuarios');
            $table->boolean('activo')->nullable();
            $table->dateTime('creacionEn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

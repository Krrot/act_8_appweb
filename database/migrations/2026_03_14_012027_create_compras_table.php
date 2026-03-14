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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materialesId')->constrained('materiales');
            $table->integer('cantidadComprada')->nullable();
            $table->decimal('precioCompra',10,2)->nullable();
            $table->foreignId('proveedoresId')->constrained('proveedores');
            $table->foreignId('usuarioId')->constrained('usuarios');
            $table->dateTime('fechaCompra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};

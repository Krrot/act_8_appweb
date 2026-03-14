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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('numeroCliente',50)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('correoElectronico',100)->nullable();
            $table->boolean('activo')->nullable();
            $table->dateTime('registroFecha')->nullable();
            $table->foreignId('direccionesId')->nullable()->constrained('direcciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

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
        Schema::create('stockalmacenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materialesId')->unique()->constrained('materiales');
            $table->foreignId('almacenId')->unique()->constrained('almacenes');
            $table->integer('cantidadStock')->nullable();
            $table->integer('stockMinimo')->nullable();
            $table->integer('stockMaximo')->nullable();
            $table->dateTime('fechaActualizacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockalmacenes');
    }
};

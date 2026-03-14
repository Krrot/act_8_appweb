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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('calle',150)->nullable();
            $table->string('numeroExterior',20)->nullable();
            $table->string('numeroInterior',20)->nullable();
            $table->string('colonia',150)->nullable();
            $table->string('ciudad',150)->nullable();
            $table->string('municipio',150)->nullable();
            $table->string('estado',150)->nullable();
            $table->string('pais',100)->nullable();
            $table->string('codigoPostal',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};

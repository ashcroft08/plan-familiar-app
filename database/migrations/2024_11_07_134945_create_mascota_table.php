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
        Schema::create('mascota', function (Blueprint $table) {
            $table->id('cod_mascota');
            $table->unsignedBigInteger('cod_familia'); // Llave foránea
            $table->string('nombre');
            $table->string('especie');
            $table->string('raza');
            $table->boolean('esterilizado');
            $table->timestamps();

            // Definimos la clave foránea
            $table->foreign('cod_familia')
                ->references('cod_familia')
                ->on('informacion_general')
                ->onDelete('cascade'); // Elimina los registros relacionados en cascada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascota');
    }
};
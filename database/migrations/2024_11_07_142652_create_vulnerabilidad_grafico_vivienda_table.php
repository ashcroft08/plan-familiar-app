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
        Schema::create('grafico_vivienda', function (Blueprint $table) {
            $table->id('cod_grafico_vivienda');
            $table->unsignedBigInteger('cod_familia'); // Llave foránea
            $table->text('interior_vivienda');
            $table->text('brc');
            $table->string('coordenada_x');
            $table->string('coordenada_y');
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
        Schema::dropIfExists('grafico_vivienda');
    }
};

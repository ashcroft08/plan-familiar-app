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
        Schema::create('vulnerabilidad_vivienda', function (Blueprint $table) {
            $table->id('cod_vulnerabilidad_vivienda');
            $table->unsignedBigInteger('cod_familia'); // Llave foránea
            $table->string('detalle');
            $table->boolean('toda_vivienda');
            $table->boolean('comedor');
            $table->boolean('sala');
            $table->boolean('dormitorio');
            $table->boolean('banio');
            $table->boolean('cocina');
            $table->text('acciones');
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
        Schema::dropIfExists('vulnerabilidad_vivienda');
    }
};

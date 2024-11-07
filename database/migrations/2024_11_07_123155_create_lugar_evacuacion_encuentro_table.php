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
        Schema::create('lugar_evacuacion_encuentro', function (Blueprint $table) {
            $table->id('cod_evacuacion');
            $table->unsignedBigInteger('cod_familia'); // Llave foránea
            $table->text('punto_reunion');
            $table->text('ruta_evacuacion');
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
        Schema::dropIfExists('lugar_evacuacion_encuentro');
    }
};

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
        Schema::create('reduccion', function (Blueprint $table) {
            $table->id('cod_reduccion');
            $table->unsignedBigInteger('cod_familia'); // Llave foránea
            $table->text('preparacion');
            $table->string('responsable');
            $table->text('comentario');
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
        Schema::dropIfExists('reduccion');
    }
};

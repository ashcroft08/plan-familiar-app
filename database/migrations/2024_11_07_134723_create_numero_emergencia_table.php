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
        Schema::create('numero_emergencia', function (Blueprint $table) {
            $table->id('cod_numero_emergencia');
            $table->unsignedBigInteger('cod_familia'); // Llave foránea
            $table->string('hospital');
            $table->string('medico_barrio');
            $table->string('familiar1');
            $table->string('familiar2');
            $table->string('familiar3');
            $table->string('upc');
            $table->string('bomberos');
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
        Schema::dropIfExists('numero_emergencia');
    }
};

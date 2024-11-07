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
        Schema::create('informacion_general', function (Blueprint $table) {
            $table->id('cod_familia'); // Llave primaria
            $table->string('familiaAcogiente');
            $table->string('direccionDomicilio');
            $table->string('telfamiliaAcogiente');
            $table->string('provincia');
            $table->string('canton');
            $table->string('opcionBCR');
            $table->string('nombreBCR');
            $table->string('numeroCasa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion_general');
    }
};

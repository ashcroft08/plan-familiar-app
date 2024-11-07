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
            $table->string('familia_acogiente');
            $table->string('direccion_domicilio');
            $table->string('telf_familia_acogiente');
            $table->string('provincia');
            $table->string('canton');
            $table->string('opcion_bcr');
            $table->string('nombre_bcr');
            $table->string('numero_casa');
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

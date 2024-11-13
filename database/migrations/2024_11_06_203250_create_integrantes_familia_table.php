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
        Schema::create('integrantes_familia', function (Blueprint $table) {
            $table->id('cod_integrante');
            $table->unsignedBigInteger('cod_familia'); // Llave foránea
            $table->string('nombres');
            $table->string('pcd');
            $table->integer('edad');
            $table->string('sexo');
            $table->string('parentesco');
            $table->string('cuidador')->nullable();
            $table->string('frecuencia_necesidades')->nullable();
            $table->string('carnet', 2)->nullable();
            $table->string('proyecto', 2)->nullable();
            $table->string('acciones_responsabilidades')->nullable();
            $table->string('medicamentos')->nullable();
            $table->string('dosis')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('integrantes_familia');
    }
};

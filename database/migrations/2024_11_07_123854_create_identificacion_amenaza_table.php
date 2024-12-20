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
        Schema::create('identificacion_amenaza', function (Blueprint $table) {
            $table->id('cod_identificacion');
            $table->unsignedBigInteger('cod_familia'); // Primera clave foránea
            $table->unsignedBigInteger('cod_amenaza'); // Segunda clave foránea
            $table->text('efecto');
            $table->text('consecuencia');
            $table->text('acciones');
            $table->timestamps();

            // Definimos las claves foráneas
            $table->foreign('cod_familia')
                ->references('cod_familia')
                ->on('informacion_general')
                ->onDelete('cascade'); // Elimina los registros relacionados en cascada

            $table->foreign('cod_amenaza')
                ->references('cod_amenaza')
                ->on('amenaza')
                ->onDelete('cascade'); // Elimina los registros relacionados en cascada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identificacion_amenaza');
    }
};

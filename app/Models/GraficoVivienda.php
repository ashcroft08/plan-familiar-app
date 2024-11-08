<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionGeneral extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'grafico_vivienda';

    // Define la llave primaria
    protected $primaryKey = 'cod_grafico_vivienda';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = true;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia', // Llave foránea
        'interior_vivienda',
        'brc',
        'coordenada_x',
        'coordenada_y',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Un gráfico de vivienda pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }
}
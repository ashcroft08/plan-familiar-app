<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionGeneral extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'comedor';

    // Define la llave primaria
    protected $primaryKey = 'cod_comedor';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = false;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia', // Llave foránea
        'detalle',
        'respuesta',
        'acciones',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Un comedor pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }
}
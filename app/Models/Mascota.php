<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'mascota';

    // Define la llave primaria
    protected $primaryKey = 'cod_mascota';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = true;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia', // Llave foránea
        'nombre',
        'especie',
        'raza',
        'esterilizado',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Una mascota pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }
}
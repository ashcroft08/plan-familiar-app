<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegranteFamilia extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'integrantes_familia';

    // Define la llave primaria
    protected $primaryKey = 'cod_integrante';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = true;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia',  // Llave foránea
        'nombres',
        'pcd',
        'edad',
        'parentesco',
        'cuidador',
        'frecuencia_necesidades',
        'carnet',
        'proyecto',
        'acciones_responsabilidades',
        'medicamentos',
        'dosis',
        'observaciones',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Un integrante de familia pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }
}
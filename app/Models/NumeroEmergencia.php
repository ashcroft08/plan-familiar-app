<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionGeneral extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'numero_emergencia';

    // Define la llave primaria
    protected $primaryKey = 'cod_numero_emergencia';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = false;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia', // Llave foránea
        'hospital',
        'medico_barrio',
        'familiar1',
        'familiar2',
        'familiar3',
        'upc',
        'bomberos',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Un número de emergencia pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }
}
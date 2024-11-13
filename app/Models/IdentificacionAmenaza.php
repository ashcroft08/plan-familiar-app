<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificacionAmenaza extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'identificacion_amenaza';

    // Define la llave primaria
    protected $primaryKey = 'cod_identificacion';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = true;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia', // Llave foránea
        'cod_amenaza', //llave foranea
        'efecto',
        'consecuencia',
        'acciones',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Una identificación de amenaza pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }

    /**
     * Relación con el modelo de amenaza
     * Una identificación de amenaza pertenece a una amenaza.
     */
    public function amenaza()
    {
        return $this->belongsTo(Amenaza::class, 'cod_amenaza', 'cod_amenaza');
    }
}

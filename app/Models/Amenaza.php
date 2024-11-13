<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenaza extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'amenaza';

    // Define la llave primaria
    protected $primaryKey = 'cod_amenaza';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = true;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia', // Llave foránea
        'amenaza',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Una amenaza pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }

    // Relación con IdentificacionAmenaza (una amenaza puede estar asociada con múltiples identificaciones de amenazas)
    public function identificacionesAmenaza()
    {
        return $this->hasMany(IdentificacionAmenaza::class, 'cod_amenaza', 'cod_amenaza');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionGeneral extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'reduccion';

    // Define la llave primaria
    protected $primaryKey = 'cod_reduccion';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = true;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'cod_familia', // Llave foránea
        'preparacion',
        'responsable',
        'comentario',
    ];

    /**
     * Relación con el modelo de familia (informacion_general)
     * Una reducción pertenece a una familia.
     */
    public function familia()
    {
        return $this->belongsTo(InformacionGeneral::class, 'cod_familia', 'cod_familia');
    }
}
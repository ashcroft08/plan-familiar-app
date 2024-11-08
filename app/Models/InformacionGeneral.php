<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionGeneral extends Model
{
    use HasFactory;
    // Define el nombre de la tabla
    protected $table = 'informacion_general';

    // Define la llave primaria, ya que 'cod_familia' no es el nombre estándar 'id'
    protected $primaryKey = 'cod_familia';

    // Si no deseas que Eloquent maneje automáticamente las columnas created_at y updated_at, puedes deshabilitarlo.
    public $timestamps = true;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'familia_acogiente',
        'direccion_domicilio',
        'telf_familia_acogiente',
        'provincia',
        'canton',
        'opcion_bcr',
        'nombre_bcr',
        'numero_casa',
    ];
}
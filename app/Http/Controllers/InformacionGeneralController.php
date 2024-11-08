<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionGeneral;
use Illuminate\Support\Facades\Validator;

class InformacionGeneralController extends Controller
{
    public function mostrar()
    {
        return view('informacion_general');
    }

    public function guardar(Request $request)
    {
        // Verificar si ya existe un registro con el mismo número de teléfono o el mismo nombre de familia
        $existe = InformacionGeneral::where('telf_familia_acogiente', $request->input('telFam'))
            ->orWhere('familia_acogiente', $request->input('nombreFam'))
            ->exists();

        if ($existe) {
            // Si el teléfono o el nombre de la familia ya están registrados, no proceder con el guardado
            return response()->json(['success' => false, 'message' => 'El número de teléfono o el nombre de la familia ya están registrados']);
        }

        // Si no hay duplicados, proceder a guardar
        $informacionGeneral = new InformacionGeneral();
        $informacionGeneral->familia_acogiente = $request->input('nombreFam');
        $informacionGeneral->direccion_domicilio = $request->input('direccionFam');
        $informacionGeneral->telf_familia_acogiente = $request->input('telFam');
        $informacionGeneral->provincia = $request->input('provincia');
        $informacionGeneral->canton = $request->input('canton');
        $informacionGeneral->opcion_bcr = $request->input('opcionBcr');
        $informacionGeneral->nombre_bcr = $request->input('nombreBcr');
        $informacionGeneral->numero_casa = $request->input('numCasa');

        if ($informacionGeneral->save()) {
            return response()->json(['success' => true, 'message' => 'Datos guardados correctamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Hubo un error al guardar los datos']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NumeroEmergencia;
use App\Models\Recuperacion;
use Illuminate\Http\Request;

class NumeroEmergenciaController extends Controller
{
    public function mostrar($cod_familia)
    {
        // Verificar si ya existe un registro con el mismo código de familia
        $existe = NumeroEmergencia::where('cod_familia', $cod_familia)->exists();

        // Retornar la vista correspondiente
        if ($existe) {
            $numeroEmergencia = NumeroEmergencia::findOrFail($cod_familia);
            return view('numeros-emergencia.regresar_numeros_emergencia', ["numeroEmergencia" => $numeroEmergencia]);
        } else {
            return view('numeros-emergencia.numeros_emergencia');
        }
    }

    public function guardar(Request $request)
    {
        //Verificar que 'cod_familia' no esté vacío o no sea válido
        $codFamilia = $request->input('cod_familia');

        if (empty($codFamilia) || !is_numeric($codFamilia)) {
            return response()->json([
                'success' => false,
                'message' => 'El código de familia es inválido.',
            ], 400);
        }

        // Si no hay duplicados, proceder a guardar
        $numeroEmergencia = new NumeroEmergencia();
        $numeroEmergencia->cod_familia = $codFamilia;
        $numeroEmergencia->hospital = $request->input('hospitalCercano');
        $numeroEmergencia->medico_barrio = $request->input('medicoBarrio');
        $numeroEmergencia->familiar1 = $request->input('fam1');
        $numeroEmergencia->familiar2 = $request->input('fam2');
        $numeroEmergencia->familiar3 = $request->input('fam3');
        $numeroEmergencia->upc = $request->input('upc');
        $numeroEmergencia->bomberos = $request->input('bomberos');

        if ($numeroEmergencia->save()) {
            // Retornar `cod_familia` en la respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Datos guardados correctamente',
                'cod_familia' => $numeroEmergencia->cod_familia
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Hubo un error al guardar los datos']);
        }
    }

    public function editar($cod_familia)
    {
        $numeroEmergencia = NumeroEmergencia::findOrFail($cod_familia);
        return view('numeros-emergencia.editar_numeros_emergencia', ["numeroEmergencia" => $numeroEmergencia]);
    }

    public function actualizar(Request $request, $cod_numero_emergencia)
    {
        // Buscar el registro por cod_familia
        $numeroEmergencia = NumeroEmergencia::find($cod_numero_emergencia);

        // Verificar si el registro existe
        if (!$numeroEmergencia) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        $numeroEmergencia->hospital = $request->input('hospitalCercano');
        $numeroEmergencia->medico_barrio = $request->input('medicoBarrio');
        $numeroEmergencia->familiar1 = $request->input('fam1');
        $numeroEmergencia->familiar2 = $request->input('fam2');
        $numeroEmergencia->familiar3 = $request->input('fam3');
        $numeroEmergencia->upc = $request->input('upc');
        $numeroEmergencia->bomberos = $request->input('bomberos');

        if ($numeroEmergencia->update()) {
            // Retornar `cod_familia` en la respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Datos actualizados correctamente',
                'cod_familia' => $numeroEmergencia->cod_cod_numero_emergencia
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Hubo un error al actualizar los datos']);
        }
    }
}

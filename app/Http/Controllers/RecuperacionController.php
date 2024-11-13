<?php

namespace App\Http\Controllers;

use App\Models\Recuperacion;
use Illuminate\Http\Request;

class RecuperacionController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
            $actividad = Recuperacion::all();
            return view('plan-accion.plan_accion_recuperacion', ['actividad' => $actividad]);
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

        // Crear y guardar la nueva amenaza
        $nuevaActividad = new Recuperacion();
        $nuevaActividad->cod_familia = $codFamilia;
        $nuevaActividad->emergencia = $request->input('actividad');
        $nuevaActividad->responsable = $request->input('responsable');
        $nuevaActividad->comentario = $request->input('comentario');

        if ($nuevaActividad->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Actividad guardada correctamente.',
                'data' => $nuevaActividad
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar la actividad.'
            ], 500);
        }
    }
}
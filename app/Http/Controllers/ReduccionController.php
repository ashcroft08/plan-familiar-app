<?php

namespace App\Http\Controllers;

use App\Models\Reduccion;
use Illuminate\Http\Request;

class ReduccionController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
            $actividad = Reduccion::all();
            return view('plan-accion.plan_accion_reduccion', ['actividad' => $actividad]);
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
        $nuevaActividad = new Reduccion();
        $nuevaActividad->cod_familia = $codFamilia;
        $nuevaActividad->preparacion = $request->input('actividad');
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

    public function eliminar($cod_reduccion)
    {
        $actividad = Reduccion::find($cod_reduccion);

        if (!$actividad) {
            return response()->json([
                'success' => false,
                'message' => 'La actividad no existe.',
            ], 404);
        }

        if ($actividad->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Actividad eliminada correctamente.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al eliminar la actividad.'
            ], 500);
        }
    }

    public function editar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $actividad = Reduccion::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($actividad->isEmpty()) {
            abort(404, "No se encontraron actividades para este 'cod_familia'.");
        }

        return view('plan-accion.editar_plan_accion_reduccion', ['actividad' => $actividad]);
    }

    public function actualizar(Request $request, $cod_reduccion)
    {
        $actividad = Reduccion::find($cod_reduccion);

        // Verificar si el registro existe
        if (!$actividad) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        $actividad->preparacion = $request->input('actividad');
        $actividad->responsable = $request->input('responsable');
        $actividad->comentario = $request->input('comentario');


        if ($actividad->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos del plan de acción (reducción) actualizados correctamente.',
                'data' => $actividad
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar los datos del plan de acción (reducción) '
            ], 500);
        }
    }

    public function regresar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $actividad = Reduccion::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($actividad->isEmpty()) {
            abort(404, "No se encontraron actividades para este 'cod_familia'.");
        }

        return view('plan-accion.regresar_plan_accion_reduccion', ['actividad' => $actividad]);
    }
}

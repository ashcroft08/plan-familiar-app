<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use Illuminate\Http\Request;

class RespuestaController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
            $actividad = Respuesta::all();
            return view('plan-accion.plan_accion_respuesta', ['actividad' => $actividad]);
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
        $nuevaActividad = new Respuesta();
        $nuevaActividad->cod_familia = $codFamilia;
        $nuevaActividad->acciones = $request->input('actividad');
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

    public function eliminar($cod_respuesta)
    {
        $actividad = Respuesta::find($cod_respuesta);

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
        $actividad = Respuesta::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($actividad->isEmpty()) {
            abort(404, "No se encontraron actividades para este 'cod_familia'.");
        }

        return view('plan-accion.editar_plan_accion_respuesta', ['actividad' => $actividad]);
    }

    public function actualizar(Request $request, $cod_respuesta)
    {
        $actividad = Respuesta::find($cod_respuesta);

        // Verificar si el registro existe
        if (!$actividad) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        $actividad->acciones = $request->input('actividad');
        $actividad->responsable = $request->input('responsable');
        $actividad->comentario = $request->input('comentario');


        if ($actividad->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos del plan de acción (respuesta) actualizados correctamente.',
                'data' => $actividad
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar los datos del plan de acción (respuesta) '
            ], 500);
        }
    }

    public function regresar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $actividad = Respuesta::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($actividad->isEmpty()) {
            abort(404, "No se encontraron actividades para este 'cod_familia'.");
        }

        return view('plan-accion.regresar_plan_accion_respuesta', ['actividad' => $actividad]);
    }
}

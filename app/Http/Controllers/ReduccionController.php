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
        $actividad = Reduccion::find($cod_recurso);

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
        $actividads = RecursoPcd::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($actividads->isEmpty()) {
            abort(404, "No se encontraron amenazas para este 'cod_familia'.");
        }

        return view('recursos-pcd.editar_recursos_familiares_disponibles', ['recursos' => $actividads]);
    }

    public function actualizar(Request $request, $cod_recurso)
    {
        $actividad = RecursoPcd::find($cod_recurso);

        // Verificar si el registro existe
        if (!$actividad) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        // Crear y guardar el recurso
        $actividad->descripcion = $request->input('descripcion');
        $actividad->cantidad = $request->input('cantidad');
        $actividad->ubicacion = $request->input('ubicacion');
        $actividad->uso_recurso = $request->input('usoRecurso');

        if ($actividad->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos del recurso actualizados correctamente.',
                'data' => $actividad
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar los datos del recurso.'
            ], 500);
        }
    }
}

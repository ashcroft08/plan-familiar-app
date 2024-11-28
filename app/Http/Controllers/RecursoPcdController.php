<?php

namespace App\Http\Controllers;

use App\Models\Amenaza;
use App\Models\RecursoPcd;
use Illuminate\Http\Request;

class RecursoPcdController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
            $recursos = RecursoPcd::all();
            return view('recursos-pcd.recursos_familiares_disponibles', ['recursos' => $recursos]);
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
        $nuevoRecurso = new RecursoPcd();
        $nuevoRecurso->cod_familia = $codFamilia;
        $nuevoRecurso->descripcion = $request->input('descripcion');
        $nuevoRecurso->cantidad = $request->input('cantidad');
        $nuevoRecurso->ubicacion = $request->input('ubicacion');
        $nuevoRecurso->uso_recurso = $request->input('usoRecurso');

        if ($nuevoRecurso->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Recurso guardada correctamente.',
                'data' => $nuevoRecurso
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar el recurso.'
            ], 500);
        }
    }

    public function eliminar($cod_recurso)
    {
        $recurso = RecursoPcd::find($cod_recurso);

        if (!$recurso) {
            return response()->json([
                'success' => false,
                'message' => 'El recurso no existe.',
            ], 404);
        }

        if ($recurso->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Recurso eliminado correctamente.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al eliminar el recurso.'
            ], 500);
        }
    }

    public function editar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $recursos = RecursoPcd::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($recursos->isEmpty()) {
            abort(404, "No se encontraron amenazas para este 'cod_familia'.");
        }

        return view('recursos-pcd.editar_recursos_familiares_disponibles', ['recursos' => $recursos]);
    }

    public function actualizar(Request $request, $cod_recurso)
    {
        $recurso = RecursoPcd::find($cod_recurso);

        // Verificar si el registro existe
        if (!$recurso) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        // Crear y guardar el recurso
        $recurso->descripcion = $request->input('descripcion');
        $recurso->cantidad = $request->input('cantidad');
        $recurso->ubicacion = $request->input('ubicacion');
        $recurso->uso_recurso = $request->input('usoRecurso');

        if ($recurso->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos del recurso actualizados correctamente.',
                'data' => $recurso
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar los datos del recurso.'
            ], 500);
        }
    }
}

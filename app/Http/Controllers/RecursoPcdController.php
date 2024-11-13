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
}

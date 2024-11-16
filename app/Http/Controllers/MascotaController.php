<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
            $mascota = Mascota::all();
            return view('mascota.mi_mascota', ['mascota' => $mascota]);
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
        $nuevoRecurso = new Mascota();
        $nuevoRecurso->cod_familia = $codFamilia;
        $nuevoRecurso->nombre = $request->input('nombreAnimal');
        $nuevoRecurso->especie = $request->input('especie');
        $nuevoRecurso->raza = $request->input('raza');
        $nuevoRecurso->esterilizado = $request->input('esterilizado');

        if ($nuevoRecurso->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Mascota guardada correctamente.',
                'data' => $nuevoRecurso
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar la mascota.'
            ], 500);
        }
    }
}

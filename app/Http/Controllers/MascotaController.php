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
        $nuevaMascota = new Mascota();
        $nuevaMascota->cod_familia = $codFamilia;
        $nuevaMascota->nombre = $request->input('nombreAnimal');
        $nuevaMascota->especie = $request->input('especie');
        $nuevaMascota->raza = $request->input('raza');
        $nuevaMascota->esterilizado = $request->input('esterilizado');

        if ($nuevaMascota->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Mascota guardada correctamente.',
                'data' => $nuevaMascota
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar la mascota.'
            ], 500);
        }
    }

    public function eliminar($cod_mascota)
    {
        $mascota = Mascota::find($cod_mascota);

        if (!$mascota) {
            return response()->json([
                'success' => false,
                'message' => 'La mascota no existe.',
            ], 404);
        }

        if ($mascota->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'La mascota eliminado correctamente.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al eliminar la mascota.'
            ], 500);
        }
    }

    public function actualizar(Request $request, $cod_mascota)
    {
        $mascota = Mascota::find($cod_mascota);

        // Verificar si el registro existe
        if (!$mascota) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        // Crear y guardar el nueva mascota
        $mascota->nombre = $request->input('nombreAnimal');
        $mascota->especie = $request->input('especie');
        $mascota->raza = $request->input('raza');
        $mascota->esterilizado = $request->input('esterilizado');

        if ($mascota->update()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos de la mascota actualizados correctamente.',
                'data' => $mascota
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar los datos de la mascota.'
            ], 500);
        }
    }

    public function editar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $mascota = Mascota::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($mascota->isEmpty()) {
            abort(404, "No se encontraron mascota para este 'cod_familia'.");
        }

        return view('mascota.editar_mi_mascota', ['mascota' => $mascota]);
    }
}

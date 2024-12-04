<?php

namespace App\Http\Controllers;

use App\Models\Amenaza;
use Illuminate\Http\Request;

class AmenazaController extends Controller
{
    /**@foreach ($amenazasNom as $item)
                                @endforeach */
    public function mostrar(Request $request)
    {
        if ($request) {
            $amenazasNom = Amenaza::all();
            return view('amenazas.amenazas', ['amenazasNom' => $amenazasNom]);
        }
    }

    public function guardar(Request $request)
    {
        // Verificar que 'cod_familia' no esté vacío o no sea válido
        $codFamilia = $request->input('cod_familia');
        $amenaza = $request->input('amenazaEspecifica');

        if (empty($codFamilia) || !is_numeric($codFamilia)) {
            return response()->json([
                'success' => false,
                'message' => 'El código de familia es inválido.',
            ], 400);
        }

        // Verificar si ya existe una amenaza para el cod_familia y el valor de amenaza
        $existeAmenaza = Amenaza::where('amenaza', $amenaza)
            ->where('cod_familia', $codFamilia)  // Agregar la condición adicional
            ->exists();

        if ($existeAmenaza) {
            return response()->json([
                'success' => false,
                'message' => 'Ya existe esta amenaza en el registro.',
            ], 400);
        }

        // Crear y guardar la nueva amenaza
        $nuevaAmenaza = new Amenaza();
        $nuevaAmenaza->cod_familia = $codFamilia;
        $nuevaAmenaza->amenaza = $amenaza;

        if ($nuevaAmenaza->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Amenaza agregada correctamente.',
                'data' => $nuevaAmenaza
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al agregar la amenaza.'
            ], 500);
        }
    }

    public function editar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $amenazasNom = Amenaza::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($amenazasNom->isEmpty()) {
            abort(404, "No se encontraron amenazas para este 'cod_familia'.");
        }

        return view('amenazas.editar_amenaza', ["amenazasNom" => $amenazasNom]);
    }

    // Método para eliminar el registro
    public function eliminar($cod_amenaza)
    {
        $amenaza = Amenaza::find($cod_amenaza);

        if (!$amenaza) {
            return response()->json([
                'success' => false,
                'message' => 'La amenaza no existe.',
            ], 404);
        }

        if ($amenaza->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Amenaza eliminada correctamente.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al eliminar la amenaza.'
            ], 500);
        }
    }
}

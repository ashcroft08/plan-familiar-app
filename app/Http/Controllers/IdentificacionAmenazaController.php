<?php

namespace App\Http\Controllers;

use App\Models\Amenaza;
use App\Models\IdentificacionAmenaza;
use Illuminate\Http\Request;

class IdentificacionAmenazaController extends Controller
{
    /**@foreach ($amenazasNom as $item)
                                @endforeach */
    public function mostrar(Request $request)
    {
        if ($request) {
            $amenazasNom = Amenaza::all();
            return view('identificacion-amenaza.identificacion_de_amenazas', ['amenazasNom' => $amenazasNom]);
        }
    }

    public function guardar(Request $request)
    {
        // Verificar que 'cod_familia' no esté vacío o no sea válido
        $codFamilia = $request->input('cod_familia');

        if (empty($codFamilia) || !is_numeric($codFamilia)) {
            return response()->json([
                'success' => false,
                'message' => 'El código de familia es inválido.',
            ], 400);
        }

        // Crear y guardar la nueva amenaza
        $codFamilia = $request->input('cod_familia');
        $amenazas = $request->input('amenazas');

        try {
            foreach ($amenazas as $amenazaData) {
                // Crear una nueva instancia del modelo IdentificacionAmenaza
                IdentificacionAmenaza::create([
                    'cod_familia' => $codFamilia,
                    'cod_amenaza' => $amenazaData['cod_amenaza'],
                    'efecto' => $amenazaData['efecto'],
                    'consecuencia' => $amenazaData['consecuencia'],
                    'acciones' => $amenazaData['acciones'],
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Identificación de amenaza guardada correctamente.'
            ]);
        } catch (\Exception $e) {
            // Manejo de errores en caso de que ocurra un problema al guardar
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al guardar las amenazas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

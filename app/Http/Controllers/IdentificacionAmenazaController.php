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

    public function editar($cod_familia)
    {
        $identificacionAmenaza = Amenaza::join('identificacion_amenaza as i', 'amenaza.cod_amenaza', '=', 'i.cod_amenaza')
            ->select('i.cod_familia', 'i.cod_identificacion', 'amenaza.amenaza', 'i.efecto', 'i.consecuencia', 'i.acciones')
            ->where('i.cod_familia', '=', $cod_familia)
            ->get();


        return view('identificacion-amenaza.editar_identificacion_de_amenazas', [
            'identificacionAmenaza' => $identificacionAmenaza
        ]);
    }

    public function actualizar(Request $request)
    {
        $amenazas = $request->input('amenazas');

        if (!$amenazas || !is_array($amenazas)) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos proporcionados.'
            ], 400);
        }

        try {
            foreach ($amenazas as $amenazaData) {
                // Validación básica
                if (!isset($amenazaData['cod_identificacion'], $amenazaData['efecto'], $amenazaData['consecuencia'], $amenazaData['acciones'])) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Faltan datos obligatorios en algunas amenazas.'
                    ], 400);
                }

                // Buscar la amenaza por su código
                $identificacionAmenaza = IdentificacionAmenaza::find($amenazaData['cod_identificacion']);

                if ($identificacionAmenaza) {
                    // Actualizar el registro existente
                    $identificacionAmenaza->update([
                        'efecto' => $amenazaData['efecto'],
                        'consecuencia' => $amenazaData['consecuencia'],
                        'acciones' => $amenazaData['acciones'],
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "La amenaza con código {$amenazaData['cod_identificacion']} no existe."
                    ], 404);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Identificación de amenaza actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar las amenazas.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function regresar($cod_familia)
    {
        $identificacionAmenaza = Amenaza::join('identificacion_amenaza as i', 'amenaza.cod_amenaza', '=', 'i.cod_amenaza')
            ->select('i.cod_familia', 'i.cod_identificacion', 'amenaza.amenaza', 'i.efecto', 'i.consecuencia', 'i.acciones')
            ->where('i.cod_familia', '=', $cod_familia)
            ->get();


        return view('identificacion-amenaza.regresar_identificacion_de_amenazas', [
            'identificacionAmenaza' => $identificacionAmenaza
        ]);
    }
}

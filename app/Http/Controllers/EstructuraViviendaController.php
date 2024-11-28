<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstructuraVivienda;

class EstructuraViviendaController extends Controller
{
    public function mostrar($cod_familia)
    {
        // Verificar si ya existe un registro con el mismo código de familia
        $existe = EstructuraVivienda::where('cod_familia', $cod_familia)->exists();

        // Retornar la vista correspondiente
        if ($existe) {
            $estructuraVivienda = EstructuraVivienda::where('cod_familia', $cod_familia)
                ->orderBy('cod_estructura_vivienda', 'asc') // Ordena por la clave primaria o un campo específico
                ->get();
            return view('vivienda.regresar_matriz_de_estructura_general_vivienda', ['estructuraVivienda' => $estructuraVivienda]);
        } else {
            return view('vivienda.matriz_de_estructura_general_vivienda');
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

        // Guardar los datos en la tabla estructura_vivienda
        try {
            foreach ($request->matriz as $item) {
                EstructuraVivienda::create([
                    'cod_familia' => $request->cod_familia,
                    'detalle' => $item['detalle'],
                    'respuesta' => $item['respuesta'],
                    'acciones' => $item['acciones'],
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Datos guardados correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar los datos: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function editar($cod_familia)
    {
        $estructuraVivienda = EstructuraVivienda::where('cod_familia', $cod_familia)
            ->orderBy('cod_estructura_vivienda', 'asc') // Ordena por la clave primaria o un campo específico
            ->get();
        return view('vivienda.editar_matriz_de_estructura_general_vivienda', ['estructuraVivienda' => $estructuraVivienda]);
    }

    public function actualizar(Request $request)
    {
        $estructuraVivienda = $request->input('estructuraVivienda');

        try {
            foreach ($estructuraVivienda as $cod_estructura_vivienda => $datos) {
                $registro = EstructuraVivienda::find($cod_estructura_vivienda); // Usa el cod_estructura_vivienda como ID
                if ($registro) {
                    $registro->respuesta = $datos['respuesta'];
                    $registro->acciones = $datos['acciones'] ?? null;
                    $registro->update();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Estructura de vivienda actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar la estructura de vivienda.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

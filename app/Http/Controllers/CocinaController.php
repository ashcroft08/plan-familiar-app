<?php

namespace App\Http\Controllers;

use App\Models\Cocina;
use Illuminate\Http\Request;

class CocinaController extends Controller
{
    public function mostrar()
    {
        return view('vivienda.cocina');
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
                Cocina::create([
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
        $cocina = Cocina::where('cod_familia', $cod_familia)
            ->orderBy('cod_cocina', 'asc') // Ordena por la clave primaria o un campo específico
            ->get();
        return view('vivienda.editar_cocina', ['cocina' => $cocina]);
    }

    public function actualizar(Request $request)
    {
        $cocina = $request->input('estructuraVivienda');

        try {
            foreach ($cocina as $cod_cocina => $datos) {
                $registro = Cocina::find($cod_cocina); // Usa el cod_cocina como ID
                if ($registro) {
                    $registro->respuesta = $datos['respuesta'];
                    $registro->acciones = $datos['acciones'] ?? null;
                    $registro->update();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'La información de la cocina actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar la información de la cocina.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

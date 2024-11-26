<?php

namespace App\Http\Controllers;

use App\Models\Dormitorio;
use Illuminate\Http\Request;

class DormitorioController extends Controller
{
    public function mostrar()
    {
        return view('vivienda.dormitorio');
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
                Dormitorio::create([
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
        $dormitorio = Dormitorio::where('cod_familia', $cod_familia)
            ->orderBy('cod_dormitorio', 'asc') // Ordena por la clave primaria o un campo específico
            ->get();
        return view('vivienda.editar_dormitorio', ['dormitorio' => $dormitorio]);
    }

    public function actualizar(Request $request)
    {
        $dormitorio = $request->input('estructuraVivienda');

        try {
            foreach ($dormitorio as $cod_dormitorio => $datos) {
                $registro = Dormitorio::find($cod_dormitorio); // Usa el cod_dormitorio como ID
                if ($registro) {
                    $registro->respuesta = $datos['respuesta'];
                    $registro->acciones = $datos['acciones'] ?? null;
                    $registro->update();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'La información del dormitorio actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar la información del dormitorio.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
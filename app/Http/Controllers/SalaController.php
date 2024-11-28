<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function mostrar($cod_familia)
    {
        // Verificar si ya existe un registro con el mismo código de familia
        $existe = Sala::where('cod_familia', $cod_familia)->exists();

        // Retornar la vista correspondiente
        if ($existe) {
            $sala = Sala::where('cod_familia', $cod_familia)
                ->orderBy('cod_sala', 'asc') // Ordena por la clave primaria o un campo específico
                ->get();
            return view('vivienda.editar_sala', ['sala' => $sala]);
        } else {
            return view('vivienda.sala');
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
                Sala::create([
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
        $sala = Sala::where('cod_familia', $cod_familia)
            ->orderBy('cod_sala', 'asc') // Ordena por la clave primaria o un campo específico
            ->get();
        return view('vivienda.editar_sala', ['sala' => $sala]);
    }

    public function actualizar(Request $request)
    {
        $sala = $request->input('estructuraVivienda');

        try {
            foreach ($sala as $cod_sala => $datos) {
                $registro = Sala::find($cod_sala); // Usa el cod_sala como ID
                if ($registro) {
                    $registro->respuesta = $datos['respuesta'];
                    $registro->acciones = $datos['acciones'] ?? null;
                    $registro->update();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'La información de la sala actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar la información de la sala.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

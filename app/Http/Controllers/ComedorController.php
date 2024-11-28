<?php

namespace App\Http\Controllers;

use App\Models\Comedor;
use Illuminate\Http\Request;

class ComedorController extends Controller
{
    public function mostrar($cod_familia)
    {
        // Verificar si ya existe un registro con el mismo código de familia
        $existe = Comedor::where('cod_familia', $cod_familia)->exists();

        // Retornar la vista correspondiente
        if ($existe) {
            $comedor = Comedor::where('cod_familia', $cod_familia)
                ->orderBy('cod_comedor', 'asc') // Ordena por la clave primaria o un campo específico
                ->get();
            return view('vivienda.regresar_comedor', ['comedor' => $comedor]);
        } else {
            return view('vivienda.comedor');
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
                Comedor::create([
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
        $comedor = Comedor::where('cod_familia', $cod_familia)
            ->orderBy('cod_comedor', 'asc') // Ordena por la clave primaria o un campo específico
            ->get();
        return view('vivienda.editar_comedor', ['comedor' => $comedor]);
    }

    public function actualizar(Request $request)
    {
        $comedor = $request->input('estructuraVivienda');

        try {
            foreach ($comedor as $cod_comedor => $datos) {
                $registro = Comedor::find($cod_comedor); // Usa el cod_comedor como ID
                if ($registro) {
                    $registro->respuesta = $datos['respuesta'];
                    $registro->acciones = $datos['acciones'] ?? null;
                    $registro->update();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'La información del comedor actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar la información del comedor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

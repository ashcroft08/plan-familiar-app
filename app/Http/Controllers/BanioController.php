<?php

namespace App\Http\Controllers;

use App\Models\Banio;
use Illuminate\Http\Request;

class BanioController extends Controller
{
    public function mostrar($cod_familia)
    {
        // Verificar si ya existe un registro con el mismo código de familia
        $existe = Banio::where('cod_familia', $cod_familia)->exists();

        // Retornar la vista correspondiente
        if ($existe) {
            $banio = Banio::where('cod_familia', $cod_familia)
                ->orderBy('cod_banio', 'asc') // Ordena por la clave primaria o un campo específico
                ->get();
            return view('vivienda.regresar_bano', ['banio' => $banio]);
        } else {
            return view('vivienda.bano');
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
                Banio::create([
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
        $banio = Banio::where('cod_familia', $cod_familia)
            ->orderBy('cod_banio', 'asc') // Ordena por la clave primaria o un campo específico
            ->get();
        return view('vivienda.editar_bano', ['banio' => $banio]);
    }

    public function actualizar(Request $request)
    {
        $banio = $request->input('estructuraVivienda');

        try {
            foreach ($banio as $cod_banio => $datos) {
                $registro = Banio::find($cod_banio); // Usa el cod_banio como ID
                if ($registro) {
                    $registro->respuesta = $datos['respuesta'];
                    $registro->acciones = $datos['acciones'] ?? null;
                    $registro->update();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'La información del baño actualizada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar la información del baño.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VulnerabilidadVivienda;

class VulnerabilidadViviendaController extends Controller
{
    public function mostrar()
    {
        return view('vivienda.resumen_vulnerabilidad_vivienda');
    }

    public function guardar(Request $request)
    {
        // Extraer los datos del cuerpo de la solicitud
        $codFamilia = $request->input('codFamilia'); // 'codFamilia' en lugar de 'cod_familia'
        $data = $request->input('data'); // Asegurarse de que los datos estén bajo 'data'

        // Verificar que 'codFamilia' no esté vacío o no sea válido
        if (empty($codFamilia) || !is_numeric($codFamilia)) {
            return response()->json([
                'success' => false,
                'message' => 'El código de familia es inválido.',
            ], 400);
        }

        // Validar que 'data' no esté vacío
        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Los datos de vulnerabilidad son inválidos.',
            ], 400);
        }

        // Guardar los datos en la tabla vulnerabilidad_vivienda
        try {
            foreach ($data as $fila) {
                VulnerabilidadVivienda::create([
                    'cod_familia' => $codFamilia,  // Usar la variable extraída del request
                    'detalle' => $fila['detalle'],
                    'toda_vivienda' => in_array('a', $fila['espacios_fisicos']),
                    'comedor' => in_array('b', $fila['espacios_fisicos']),
                    'sala' => in_array('c', $fila['espacios_fisicos']),
                    'dormitorio' => in_array('d', $fila['espacios_fisicos']),
                    'banio' => in_array('e', $fila['espacios_fisicos']),
                    'cocina' => in_array('f', $fila['espacios_fisicos']),
                    'acciones' => $fila['acciones'],
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
}

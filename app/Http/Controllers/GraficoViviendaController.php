<?php

namespace App\Http\Controllers;

use App\Models\GraficoVivienda;
use Illuminate\Http\Request;

class GraficoViviendaController extends Controller
{
    public function mostrar()
    {
        return view('grafico-vivienda.grafico_vivienda');
    }

    public function guardar(Request $request)
    {
        // Obtener el código de la familia desde el formulario
        $codFamilia = $request->input('cod_familia');

        if (empty($codFamilia) || !is_numeric($codFamilia)) {
            return response()->json([
                'success' => false,
                'message' => 'El código de familia es inválido.',
            ], 400);
        }

        try {
            // Guardar los archivos
            if ($request->hasFile('inputGroupFile01') && $request->file('inputGroupFile01')->isValid()) {
                $file1 = $request->file('inputGroupFile01');
                $path1 = 'grafico_vivienda_interior/interior_vivienda_' . time() . '.' . $file1->getClientOriginalExtension();
                $file1->move(storage_path('images/grafico_vivienda_interior'), $path1); // Usar move() para mover el archivo a la carpeta deseada
            }

            if ($request->hasFile('inputGroupFile02') && $request->file('inputGroupFile02')->isValid()) {
                $file2 = $request->file('inputGroupFile02');
                $path2 = 'grafico_vivienda_exterior/exterior_vivienda_' . time() . '.' . $file2->getClientOriginalExtension();
                $file2->move(storage_path('images/grafico_vivienda_exterior'), $path2); // Mover el archivo a la carpeta
            }

            // Verificar si los archivos se subieron correctamente
            if (!isset($path1) || !isset($path2)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Uno o ambos archivos no se cargaron correctamente.',
                ]);
            }

            // Obtener las coordenadas
            $coordenadaX = $request->input('coordenada_x');
            $coordenadaY = $request->input('coordenada_y');

            // Guardar los datos en la base de datos
            $graficoVivienda = new GraficoVivienda();
            $graficoVivienda->cod_familia = $codFamilia;
            $graficoVivienda->coordenada_x = $coordenadaX;
            $graficoVivienda->coordenada_y = $coordenadaY;
            $graficoVivienda->interior_vivienda = $path1;
            $graficoVivienda->brc = $path2;
            $graficoVivienda->save();

            return response()->json([
                'success' => true,
                'message' => 'Datos guardados correctamente.',
                'grafico_vivienda' => $graficoVivienda,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar los datos.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
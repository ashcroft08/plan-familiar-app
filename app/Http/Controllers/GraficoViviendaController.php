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
            // Definir la ruta pública
            $publicPath = base_path('public');

            // Guardar los archivos
            if ($request->hasFile('inputGroupFile01') && $request->file('inputGroupFile01')->isValid()) {
                $file1 = $request->file('inputGroupFile01');
                // Generar el nombre y la ruta del archivo en el directorio público
                $path1 = 'interior_vivienda_' . time() . '.' . $file1->getClientOriginalExtension();
                // Mover el archivo al directorio público
                $file1->move($publicPath . '/images/grafico_vivienda_interior', $path1);
            }

            if ($request->hasFile('inputGroupFile02') && $request->file('inputGroupFile02')->isValid()) {
                $file2 = $request->file('inputGroupFile02');
                // Generar el nombre y la ruta del archivo en el directorio público
                $path2 = 'exterior_vivienda_' . time() . '.' . $file2->getClientOriginalExtension();
                // Mover el archivo al directorio público
                $file2->move($publicPath . '/images/grafico_vivienda_exterior', $path2);
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


    // Método para mostrar el formulario de edición
    public function editar($cod_familia)
    {
        // Buscar el gráfico de vivienda por el código de familia
        $graficoVivienda = GraficoVivienda::where('cod_familia', $cod_familia)->first();

        if (!$graficoVivienda) {
            return redirect()->route('grafico_vivienda.index')->with('error', 'Gráfico de vivienda no encontrado.');
        }

        return view('grafico-vivienda.editar_grafico_vivienda', compact('graficoVivienda'));
    }

    // Método para actualizar los datos
    public function actualizar(Request $request, $cod_grafico_vivienda)
    {
        //dd($request);
        try {
            // Buscar el registro existente por ID
            $graficoVivienda = GraficoVivienda::find($cod_grafico_vivienda);

            if (!$graficoVivienda) {
                return response()->json([
                    'success' => false,
                    'message' => 'El registro no existe.',
                ], 404);
            }

            // Definir la ruta pública
            $publicPath = base_path('public');

            // Procesar archivos si se suben nuevos
            if ($request->hasFile('inputGroupFile01') && $request->file('inputGroupFile01')->isValid()) {
                $file1 = $request->file('inputGroupFile01');
                $path1 = 'interior_vivienda_' . time() . '.' . $file1->getClientOriginalExtension();
                $file1->move($publicPath . '/images/grafico_vivienda_interior', $path1);

                // Eliminar el archivo anterior si existe
                if (!empty($graficoVivienda->interior_vivienda) && file_exists($publicPath . '/images/grafico_vivienda_interior/' . $graficoVivienda->interior_vivienda)) {
                    try {
                        unlink($publicPath . '/images/grafico_vivienda_interior/' . $graficoVivienda->interior_vivienda);
                    } catch (\Exception $e) {
                        // Registrar el error si es necesario
                    }
                }

                $graficoVivienda->interior_vivienda = $path1;
            }

            if ($request->hasFile('inputGroupFile02') && $request->file('inputGroupFile02')->isValid()) {
                $file2 = $request->file('inputGroupFile02');
                $path2 = 'exterior_vivienda_' . time() . '.' . $file2->getClientOriginalExtension();
                $file2->move($publicPath . '/images/grafico_vivienda_exterior', $path2);

                // Eliminar el archivo anterior si existe
                if (!empty($graficoVivienda->brc) && file_exists($publicPath . '/images/grafico_vivienda_exterior/' . $graficoVivienda->brc)) {
                    try {
                        unlink($publicPath . '/images/grafico_vivienda_exterior/' . $graficoVivienda->brc);
                    } catch (\Exception $e) {
                        // Registrar el error si es necesario
                    }
                }

                $graficoVivienda->brc = $path2;
            }

            // Actualizar las coordenadas y otros datos
            $graficoVivienda->fill([
                'coordenada_x' => $request->input('coordenada_x', $graficoVivienda->coordenada_x),
                'coordenada_y' => $request->input('coordenada_y', $graficoVivienda->coordenada_y),
            ]);

            $graficoVivienda->save();

            return response()->json([
                'success' => true,
                'message' => 'Datos actualizados correctamente.',
                'grafico_vivienda' => $graficoVivienda,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar los datos.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

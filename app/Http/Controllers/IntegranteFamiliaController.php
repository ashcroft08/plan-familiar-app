<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntegranteFamilia;

class IntegranteFamiliaController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
            $integrantes = IntegranteFamilia::all();
            return view('integrantes-familia.integrantes_de_la_familia', ['integrantes' => $integrantes]);
        }
    }
    //
    public function guardar(Request $request)
    {
        // Verificar que 'cod_familia' no esté vacío o no sea válido
        $codFamilia = $request->input('cod_familia');
        $nombresApellidos = $request->input('nombresApellidos');

        if (empty($codFamilia) || !is_numeric($codFamilia)) {
            return response()->json([
                'success' => false,
                'message' => 'El código de familia es inválido.',
            ], 400);
        }

        // Verificar si ya existe un integrante con el mismo nombre en la misma familia
        $existeIntegrante = IntegranteFamilia::where('nombres', $nombresApellidos)
            ->where('cod_familia', $codFamilia)  // Agregar la condición adicional
            ->exists();

        if ($existeIntegrante) {
            return response()->json([
                'success' => false,
                'message' => 'Este integrante ya está registrado en la familia.',
            ], 400);
        }

        // Crear y guardar el nuevo integrante
        $nuevoIntegrante = new IntegranteFamilia();
        $nuevoIntegrante->cod_familia = $codFamilia;
        $nuevoIntegrante->nombres = $nombresApellidos;
        $nuevoIntegrante->pcd = $request->input('pcd');
        $nuevoIntegrante->edad = $request->input('edad');
        $nuevoIntegrante->sexo = $request->input('sexo');  // Asegúrate de que el campo se reciba correctamente
        $nuevoIntegrante->parentesco = $request->input('parentesco');
        $nuevoIntegrante->cuidador = $request->input('cuidador');
        $nuevoIntegrante->frecuencia_necesidades = $request->input('frecuencia_necesidades');
        $nuevoIntegrante->carnet = $request->input('carnet');
        $nuevoIntegrante->proyecto = $request->input('proyecto');
        $nuevoIntegrante->acciones_responsabilidades = $request->input('acciones_responsabilidades');
        $nuevoIntegrante->medicamentos = $request->input('medicamentos_prescritos');
        $nuevoIntegrante->dosis = $request->input('dosis');
        $nuevoIntegrante->observaciones = $request->input('observaciones');

        if ($nuevoIntegrante->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Integrante guardado correctamente.',
                'data' => $nuevoIntegrante
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar el integrante.'
            ], 500);
        }
    }

    public function eliminar($cod_integrante)
    {
        $integrante = IntegranteFamilia::find($cod_integrante);

        if (!$integrante) {
            return response()->json([
                'success' => false,
                'message' => 'El integrante de la familia no existe.',
            ], 404);
        }

        if ($integrante->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Integrante de la familia eliminado correctamente.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al eliminar al integrante de la familia.'
            ], 500);
        }
    }

    public function editar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $integrantes = IntegranteFamilia::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($integrantes->isEmpty()) {
            abort(404, "No se encontraron integrantes de la familia para este 'cod_familia'.");
        }

        return view('integrantes-familia.editar_integrantes_de_la_familia', ['integrantes' => $integrantes]);
    }

    public function actualizar(Request $request, $cod_integrante)
    {
        $integrantes = IntegranteFamilia::find($cod_integrante);

        // Verificar si el registro existe
        if (!$integrantes) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        // Crear y guardar el nuevo integrante
        $integrantes->nombres = $request->input('nombres');
        $integrantes->pcd = $request->input('pcd');
        $integrantes->edad = $request->input('edad');
        $integrantes->sexo = $request->input('sexo');  // Asegúrate de que el campo se reciba correctamente
        $integrantes->parentesco = $request->input('parentesco');
        $integrantes->cuidador = $request->input('cuidador');
        $integrantes->frecuencia_necesidades = $request->input('frecuencia_necesidades');
        $integrantes->carnet = $request->input('carnet');
        $integrantes->proyecto = $request->input('proyecto');
        $integrantes->acciones_responsabilidades = $request->input('acciones_responsabilidades');
        $integrantes->medicamentos = $request->input('medicamentos_prescritos');
        $integrantes->dosis = $request->input('dosis');
        $integrantes->observaciones = $request->input('observaciones');

        if ($integrantes->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos del integrante actualizados correctamente.',
                'data' => $integrantes
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizar los datos del integrante.'
            ], 500);
        }
    }

    public function regresar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $integrantes = IntegranteFamilia::where('cod_familia', $cod_familia)->get();

        // Si no se encuentran amenazas para ese 'cod_familia', lanzar error 404
        if ($integrantes->isEmpty()) {
            abort(404, "No se encontraron integrantes de la familia para este 'cod_familia'.");
        }

        return view('integrantes-familia.regresar_integrantes_de_la_familia', ['integrantes' => $integrantes]);
    }
}

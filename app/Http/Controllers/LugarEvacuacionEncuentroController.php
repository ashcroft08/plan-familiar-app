<?php

namespace App\Http\Controllers;

use App\Models\Amenaza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LugarEvacuacionEncuentro;

class LugarEvacuacionEncuentroController extends Controller
{
    public function mostrar($cod_familia)
    {
        // Verificar si ya existe un registro con el mismo código de familia
        $existe = LugarEvacuacionEncuentro::where('cod_familia', $cod_familia)->exists();

        // Retornar la vista correspondiente
        if ($existe) {
            // Buscar todas las amenazas asociadas a 'cod_familia'
            $amenazasNom = Amenaza::where('cod_familia', $cod_familia)->get();
            $lugarEvacuacionEncuentro = LugarEvacuacionEncuentro::where('cod_familia', $cod_familia)->firstOrFail();
            return view('evacuacion-encuentro.regresar_lugares_de_evacuacion_y_de_encuentro', ['amenazasNom' => $amenazasNom, 'lugarEvacuacionEncuentro' => $lugarEvacuacionEncuentro]);
        } else {
            // Obtener todas las amenazas asociadas (una sola vez)
            $amenazasNom = Amenaza::all();
            return view('evacuacion-encuentro.lugares_de_evacuacion_y_de_encuentro', ['amenazasNom' => $amenazasNom]);
        }
    }

    public function guardar(Request $request)
    {
        // Ver los datos enviados en la solicitud
        //dd($request->all());
        // Verificar si el cod_familia ya existe
        $existeCodFamilia = LugarEvacuacionEncuentro::where('cod_familia', $request->input('cod_familia'))->exists();

        if ($existeCodFamilia) {
            return response()->json([
                'success' => false,
                'message' => 'El código de familia ya existe en los registros.',
            ]);
        }

        // Si no hay duplicados, proceder a guardar
        $lugarEvacuacionEncuentro = new LugarEvacuacionEncuentro();
        $lugarEvacuacionEncuentro->punto_reunion = $request->input('puntoReunion');
        $lugarEvacuacionEncuentro->ruta_evacuacion = $request->input('rutaEvac');
        $lugarEvacuacionEncuentro->cod_familia = $request->input('cod_familia');

        if ($lugarEvacuacionEncuentro->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos guardados correctamente',
                'cod_familia' => $lugarEvacuacionEncuentro->cod_familia,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al guardar los datos',
            ]);
        }
    }

    public function editar($cod_familia)
    {
        // Buscar todas las amenazas asociadas a 'cod_familia'
        $amenazasNom = Amenaza::where('cod_familia', $cod_familia)->get();

        $lugarEvacuacionEncuentro = LugarEvacuacionEncuentro::where('cod_familia', $cod_familia)->firstOrFail();

        // Pasar los resultados a la vista
        return view('evacuacion-encuentro.editar_lugares_de_evacuacion_y_de_encuentro', ['amenazasNom' => $amenazasNom, 'lugarEvacuacionEncuentro' => $lugarEvacuacionEncuentro]);
    }

    public function actualizar(Request $request, $cod_familia)
    {
        $lugarEvacuacionEncuentro = LugarEvacuacionEncuentro::where('cod_familia', $cod_familia)->firstOrFail();

        // Verificar si el registro existe
        if (!$lugarEvacuacionEncuentro) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        // Si no hay duplicados, proceder a ctualizar
        $lugarEvacuacionEncuentro->punto_reunion = $request->input('puntoReunion');
        $lugarEvacuacionEncuentro->ruta_evacuacion = $request->input('rutaEvac');

        if ($lugarEvacuacionEncuentro->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Datos actualizados correctamente'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al actualizados los datos',
            ]);
        }
    }
}

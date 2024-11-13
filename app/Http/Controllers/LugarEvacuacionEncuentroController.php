<?php

namespace App\Http\Controllers;

use App\Models\Amenaza;
use Illuminate\Http\Request;
use App\Models\LugarEvacuacionEncuentro;

class LugarEvacuacionEncuentroController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
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
}

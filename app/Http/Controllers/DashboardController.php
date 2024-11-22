<?php

namespace App\Http\Controllers;

use App\Models\Amenaza;
use Illuminate\Http\Request;
use App\Models\InformacionGeneral;
use Illuminate\Support\Facades\DB;
use App\Models\LugarEvacuacionEncuentro;


class DashboardController extends Controller
{
    public function mostrar(Request $request)
    {
        if ($request) {
            // Obtener todos los registros de la tabla 'informacion_general'
            $informacion = InformacionGeneral::all();
            //dd($informacion); // Esto imprimirá los datos que se obtienen de la base de datos

            // Pasar los datos a la vista
            return view('dashboard', ['informacion' => $informacion]);
        }
    }

    // Método para eliminar el registro
    public function eliminar($cod_familia)
    {
        // Buscar y eliminar el registro en la tabla 'informacion_general'
        $plan = InformacionGeneral::where('cod_familia', $cod_familia)->first();

        if ($plan) {
            $familia = InformacionGeneral::findOrFail($cod_familia);
            $familia->delete();
            return response()->json(['message' => 'Registros eliminados correctamente en todas las tablas.'], 200);
        } else {
            return response()->json(['message' => 'Plan no encontrado.'], 404);
        }
    }
}

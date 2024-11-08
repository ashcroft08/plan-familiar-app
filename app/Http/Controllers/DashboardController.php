<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionGeneral;
use Illuminate\Support\Facades\DB;

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
        // Buscar el plan por el código de la familia
        $plan = InformacionGeneral::where('cod_familia', $cod_familia)->first();

        if ($plan) {
            $plan->delete(); // Eliminar el plan
            return response()->json(['message' => 'Plan eliminado correctamente.'], 200);
        } else {
            return response()->json(['message' => 'Plan no encontrado.'], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacionGeneral;
use Illuminate\Support\Facades\Valcod_familiaator;

class InformacionGeneralController extends Controller
{
    public function mostrar()
    {
        return view('informacion-general.informacion_general');
    }

    public function guardar(Request $request)
    {
        // Verificar si ya existe un registro con el mismo número de teléfono o el mismo nombre de familia
        $existe = InformacionGeneral::where('telf_familia_acogiente', $request->input('telFam'))
            ->orWhere('familia_acogiente', $request->input('nombreFam'))
            ->exists();

        if ($existe) {
            // Si el teléfono o el nombre de la familia ya están registrados, no proceder con el guardado
            return response()->json(['success' => false, 'message' => 'El número de teléfono o el nombre de la familia ya están registrados']);
        }

        // Si no hay duplicados, proceder a guardar
        $informacionGeneral = new InformacionGeneral();
        $informacionGeneral->familia_acogiente = $request->input('nombreFam');
        $informacionGeneral->direccion_domicilio = $request->input('direccionFam');
        $informacionGeneral->telf_familia_acogiente = $request->input('telFam');
        $informacionGeneral->provincia = $request->input('provincia');
        $informacionGeneral->canton = $request->input('canton');
        $informacionGeneral->opcion_bcr = $request->input('opcionBcr');
        $informacionGeneral->nombre_bcr = $request->input('nombreBcr');
        $informacionGeneral->numero_casa = $request->input('numCasa');

        if ($informacionGeneral->save()) {
            // Retornar `cod_familia` en la respuesta JSON
            return response()->json([
                'success' => true,
                'message' => 'Datos guardados correctamente',
                'cod_familia' => $informacionGeneral->cod_familia
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Hubo un error al guardar los datos']);
        }
    }

    public function editar($cod_familia)
    {
        $informacionGeneral = InformacionGeneral::findOrFail($cod_familia);
        return view('informacion-general.editar_informacion_general', ["informacion_general" => $informacionGeneral]);
    }

    public function actualizar(Request $request, $cod_familia)
    {
        // Buscar el registro por cod_familia
        $informacionGeneral = InformacionGeneral::find($cod_familia);

        // Verificar si el registro existe
        if (!$informacionGeneral) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado']);
        }

        // Verificar si ya existe un registro con el mismo número de teléfono o el mismo nombre de familia, excluyendo el registro actual
        $existe = InformacionGeneral::where(function ($query) use ($request) {
            $query->where('telf_familia_acogiente', $request->input('telFam'))
                ->orWhere('familia_acogiente', $request->input('nombreFam'));
        })
            ->where('cod_familia', '<>', $cod_familia) // Excluir el registro actual en la verificación
            ->exists();

        if ($existe) {
            // Si el teléfono o el nombre de la familia ya están registrados en otro registro, no proceder con la actualización
            return response()->json(['success' => false, 'message' => 'El número de teléfono o el nombre de la familia ya están registrados en otro registro']);
        }

        // Si no hay duplicados, proceder a actualizar
        $informacionGeneral->familia_acogiente = $request->input('nombreFam');
        $informacionGeneral->direccion_domicilio = $request->input('direccionFam');
        $informacionGeneral->telf_familia_acogiente = $request->input('telFam');
        $informacionGeneral->provincia = $request->input('provincia');
        $informacionGeneral->canton = $request->input('canton');
        $informacionGeneral->opcion_bcr = $request->input('opcionBcr');
        $informacionGeneral->nombre_bcr = $request->input('nombreBcr');
        $informacionGeneral->numero_casa = $request->input('numCasa');

        if ($informacionGeneral->update()) {
            return response()->json(['success' => true, 'message' => 'Datos actualizados actualizados']);
        } else {
            return response()->json(['success' => false, 'message' => 'Hubo un error al actualizar los datos']);
        }
    }

    public function regresar($cod_familia)
    {
        $informacionGeneral = InformacionGeneral::findOrFail($cod_familia);
        return view('informacion-general.regresar_informacion_general', ["informacion_general" => $informacionGeneral]);
    }

    public function regresarM($cod_familia)
    {
        $informacionGeneral = InformacionGeneral::findOrFail($cod_familia);
        return view('informacion-general.regresarM_informacion_general', ["informacion_general" => $informacionGeneral]);
    }

    public function regresarC($cod_familia)
    {
        $informacionGeneral = InformacionGeneral::findOrFail($cod_familia);
        return view('informacion-general.regresarC_informacion_general', ["informacion_general" => $informacionGeneral]);
    }
}

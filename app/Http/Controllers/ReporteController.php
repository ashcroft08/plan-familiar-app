<?php

namespace App\Http\Controllers;

use App\Models\InformacionGeneral;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\LugarEvacuacionEncuentro;
use App\Models\Amenaza;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function generarDocumento($cod_familia)
    {
        // 🏠 Obtener datos de la base de datos
        $informacionGeneral = InformacionGeneral::where('cod_familia', $cod_familia)->first();
        if (!$informacionGeneral) {
            return response()->json(['error' => 'Información general no encontrada'], 404);
        }

        $amenazasNom = Amenaza::where('cod_familia', $cod_familia)->get();
        $amenazasList = '';
        foreach ($amenazasNom as $item) {
            $amenazasList .= $item->amenaza . "\n"; // Agrega un salto de línea entre cada amenaza
        }

        $lugarEvacuacionEncuentro = LugarEvacuacionEncuentro::where('cod_familia', $cod_familia)->firstOrFail();

        // 📄 Cargar la plantilla de Word desde `storage/app/plantillas/`
        $templatePath = storage_path('app/plantillas/plan-familiar.docx');
        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'La plantilla no existe en la ruta especificada'], 404);
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        // ✅ Insertar datos en la plantilla

        // Información General
        $templateProcessor->setValue('familia_acogiente', $informacionGeneral->familia_acogiente);
        $templateProcessor->setValue('direccion_domicilio', $informacionGeneral->direccion_domicilio);
        $templateProcessor->setValue('telf_familia_acogiente', $informacionGeneral->telf_familia_acogiente);
        $templateProcessor->setValue('provincia', $informacionGeneral->provincia);
        $templateProcessor->setValue('canton', $informacionGeneral->canton);
        $templateProcessor->setValue('opcion_bcr', $informacionGeneral->opcion_bcr);
        $templateProcessor->setValue('nombre_bcr', $informacionGeneral->nombre_bcr);
        $templateProcessor->setValue('numero_casa', $informacionGeneral->numero_casa);

        // Lugar de evacuación y encuentro
        $templateProcessor->setValue('punto_reunion', $lugarEvacuacionEncuentro->punto_reunion);
        $templateProcessor->setValue('ruta_evacuacion', $lugarEvacuacionEncuentro->ruta_evacuacion);
        $templateProcessor->setValue('amenazas', $amenazasList);

        // 📂 Guardar documento generado
        $outputPath = storage_path("app/documentos_generados/plan-familiar-{$cod_familia}.docx");
        $templateProcessor->saveAs($outputPath);

        // 📥 Descargar el archivo
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}

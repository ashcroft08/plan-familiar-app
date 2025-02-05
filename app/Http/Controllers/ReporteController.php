<?php

namespace App\Http\Controllers;

use App\Models\InformacionGeneral;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\LugarEvacuacionEncuentro;
use App\Models\Amenaza;
use App\Models\IntegranteFamilia;
use App\Models\RecursoPcd;
use App\Models\Reduccion;
use App\Models\Respuesta;
use App\Models\Recuperacion;
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

        $integrantes = IntegranteFamilia::where('cod_familia', $cod_familia)->get();

        $identificacionAmenaza = Amenaza::join('identificacion_amenaza as i', 'amenaza.cod_amenaza', '=', 'i.cod_amenaza')
            ->select('i.cod_familia', 'i.cod_identificacion', 'amenaza.amenaza', 'i.efecto', 'i.consecuencia', 'i.acciones')
            ->where('i.cod_familia', '=', $cod_familia)
            ->get();

        $recursos = RecursoPcd::where('cod_familia', $cod_familia)->get();

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

        // Integrantes de la familia
        $templateProcessor->cloneRow('nombres', count($integrantes)); // Use 'nombres' as the placeholder

        $row_index = 1;
        foreach ($integrantes as $integrante) {
            $templateProcessor->setValue('nombres#' . $row_index, $integrante->nombres);
            $templateProcessor->setValue('pcd#' . $row_index, $integrante->pcd);
            $templateProcessor->setValue('edad#' . $row_index, $integrante->edad);
            $templateProcessor->setValue('sexo#' . $row_index, $integrante->sexo);
            $templateProcessor->setValue('parentesco#' . $row_index, $integrante->parentesco);
            $templateProcessor->setValue('cuidador#' . $row_index, $integrante->cuidador);
            $templateProcessor->setValue('frecuencia_necesidades#' . $row_index, $integrante->frecuencia_necesidades);
            $templateProcessor->setValue('carnet#' . $row_index, $integrante->carnet);
            $templateProcessor->setValue('proyecto#' . $row_index, $integrante->proyecto);
            $templateProcessor->setValue('acciones_responsabilidades#' . $row_index, $integrante->acciones_responsabilidades);
            $templateProcessor->setValue('medicamentos#' . $row_index, $integrante->medicamentos);
            $templateProcessor->setValue('dosis#' . $row_index, $integrante->dosis);
            $templateProcessor->setValue('observaciones#' . $row_index, $integrante->observaciones);

            $row_index++;
        }

        // Identificación de Amenazas
        $templateProcessor->cloneRow('Amenaza', count($identificacionAmenaza));

        $row_index = 1; // Índice para el número de fila
        foreach ($identificacionAmenaza as $amenaza) {
            $templateProcessor->setValue('Amenaza#' . $row_index, $amenaza->amenaza);
            $templateProcessor->setValue('Efectos#' . $row_index, $amenaza->efecto);
            $templateProcessor->setValue('¿Por qué puede ocurrir?#' . $row_index, $amenaza->consecuencia); // Usa el campo correcto
            $templateProcessor->setValue('¿Qué podemos hacer?#' . $row_index, $amenaza->acciones);

            $row_index++;
        }

        // Recursos personales disponibles para la persona con discapacidad (PCD)
        $recursos = RecursoPcd::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Descripcion', count($recursos)); // Clona filas para la tabla

        $row_index = 1; // Índice para el número de fila
        foreach ($recursos as $recurso) {
            $templateProcessor->setValue('Descripcion#' . $row_index, $recurso->descripcion);
            $templateProcessor->setValue('Cantidad#' . $row_index, $recurso->cantidad);
            $templateProcessor->setValue('Ubicacion#' . $row_index, $recurso->ubicacion);
            $templateProcessor->setValue('Uso_Recurso#' . $row_index, $recurso->uso_recurso); // Usa el campo correcto

            $row_index++;
        }

        // Plan de acción
        $reducciones = Reduccion::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Preparacion', count($reducciones)); // Clona filas para la tabla

        $row_index = 1; // Índice para el número de fila
        foreach ($reducciones as $reduccion) {
            $templateProcessor->setValue('Preparacion#' . $row_index, $reduccion->preparacion);
            $templateProcessor->setValue('Responsable#' . $row_index, $reduccion->responsable);
            $templateProcessor->setValue('Comentarios#' . $row_index, $reduccion->comentario);

            $row_index++;
        }

        // ¿Cómo actuamos durante la emergencia?
        $respuestas = Respuesta::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Acciones', count($respuestas)); // Clona filas para la tabla

        $row_index = 1; // Índice para el número de fila
        foreach ($respuestas as $respuesta) {
            $templateProcessor->setValue('Acciones#' . $row_index, $respuesta->acciones);
            $templateProcessor->setValue('Responsable_Respuesta#' . $row_index, $respuesta->responsable); // Nombre modificado para evitar duplicados
            $templateProcessor->setValue('Comentarios_Respuesta#' . $row_index, $respuesta->comentario); // Nombre modificado para evitar duplicados

            $row_index++;
        }

        // Actividad Después (Recuperación)
        $recuperaciones = Recuperacion::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Emergencia', count($recuperaciones)); // Clona filas para la tabla

        $row_index = 1; // Índice para el número de fila
        foreach ($recuperaciones as $recuperacion) {
            $templateProcessor->setValue('Emergencia#' . $row_index, $recuperacion->emergencia);
            $templateProcessor->setValue('Responsable_Recuperacion#' . $row_index, $recuperacion->responsable); // Etiqueta única
            $templateProcessor->setValue('Comentarios_Recuperacion#' . $row_index, $recuperacion->comentario); // Etiqueta única

            $row_index++;
        }

        // 📂 Generar el documento en memoria
        $temp_file = tempnam(sys_get_temp_dir(), 'plan-familiar-') . '.docx';
        $templateProcessor->saveAs($temp_file);

        // 📥 Descargar el archivo
        return response()->download($temp_file, "plan-familiar-{$cod_familia}.docx")->deleteFileAfterSend(true);
    }
}

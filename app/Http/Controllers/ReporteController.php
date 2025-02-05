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
use App\Models\NumeroEmergencia;
use App\Models\Mascota;
use App\Models\EstructuraVivienda;
use App\Models\Comedor;
use App\Models\Sala;
use App\Models\Dormitorio;
use App\Models\Banio;
use App\Models\Cocina;
use App\Models\VulnerabilidadVivienda;
use App\Models\GraficoVivienda;
use Illuminate\Support\Facades\Log;
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

        // Números de Emergencia
        $numeroEmergencia = NumeroEmergencia::where('cod_familia', $cod_familia)->firstOrFail();
        $templateProcessor->setValue('hospital', $numeroEmergencia->hospital);
        $templateProcessor->setValue('medico_barrio', $numeroEmergencia->medico_barrio);
        $templateProcessor->setValue('familiar1', $numeroEmergencia->familiar1);
        $templateProcessor->setValue('familiar2', $numeroEmergencia->familiar2);
        $templateProcessor->setValue('familiar3', $numeroEmergencia->familiar3);
        $templateProcessor->setValue('upc', $numeroEmergencia->upc);
        $templateProcessor->setValue('bomberos', $numeroEmergencia->bomberos);

        // Mi mascota
        $mascotas = Mascota::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Nombre_Animal', count($mascotas)); // Clona filas para la tabla

        $row_index = 1;
        foreach ($mascotas as $mascota) {
            $templateProcessor->setValue('Nombre_Animal#' . $row_index, $mascota->nombre);
            $templateProcessor->setValue('Especie#' . $row_index, $mascota->especie);
            $templateProcessor->setValue('Raza#' . $row_index, $mascota->raza);
            $templateProcessor->setValue('Esterilizado#' . $row_index, $mascota->esterilizado ? 'Sí' : 'No'); // Condición para mostrar "Sí" o "No"

            $row_index++;
        }

        // Matriz de estructura general de la vivienda
        $estructuras_vivienda = EstructuraVivienda::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Detalle', count($estructuras_vivienda)); // Clona filas para la tabla

        $row_index = 1;
        foreach ($estructuras_vivienda as $estructura_vivienda) {
            $templateProcessor->setValue('Detalle#' . $row_index, $estructura_vivienda->detalle);
            $templateProcessor->setValue('Respuesta#' . $row_index, $estructura_vivienda->respuesta);
            $templateProcessor->setValue('Acciones_Vulnerabilidad#' . $row_index, $estructura_vivienda->acciones); // Etiqueta única para Acciones

            $row_index++;
        }

        // Comedor
        $comedores = Comedor::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Detalle_Comedor', count($comedores)); // Clona filas para la tabla del comedor

        $row_index = 1;
        foreach ($comedores as $comedor) {
            $templateProcessor->setValue('Detalle_Comedor#' . $row_index, $comedor->detalle);
            $templateProcessor->setValue('Respuesta_Comedor#' . $row_index, $comedor->respuesta);
            $templateProcessor->setValue('Acciones_Comedor#' . $row_index, $comedor->acciones); // Etiqueta única para Acciones del comedor

            $row_index++;
        }

        // Sala
        $salas = Sala::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Detalle_Sala', count($salas)); // Clona filas para la tabla de la sala

        $row_index = 1;
        foreach ($salas as $sala) {
            $templateProcessor->setValue('Detalle_Sala#' . $row_index, $sala->detalle);
            $templateProcessor->setValue('Respuesta_Sala#' . $row_index, $sala->respuesta);
            $templateProcessor->setValue('Acciones_Sala#' . $row_index, $sala->acciones); // Etiqueta única para Acciones de la sala

            $row_index++;
        }

        // Dormitorio
        $dormitorios = Dormitorio::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Detalle_Dormitorio', count($dormitorios)); // Clona filas para la tabla del dormitorio

        $row_index = 1;
        foreach ($dormitorios as $dormitorio) {
            $templateProcessor->setValue('Detalle_Dormitorio#' . $row_index, $dormitorio->detalle);
            $templateProcessor->setValue('Respuesta_Dormitorio#' . $row_index, $dormitorio->respuesta);
            $templateProcessor->setValue('Acciones_Dormitorio#' . $row_index, $dormitorio->acciones); // Etiqueta única para Acciones del dormitorio

            $row_index++;
        }

        // Baño
        $banios = Banio::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Detalle_Banio', count($banios)); // Clona filas para la tabla del baño

        $row_index = 1;
        foreach ($banios as $banio) {
            $templateProcessor->setValue('Detalle_Banio#' . $row_index, $banio->detalle);
            $templateProcessor->setValue('Respuesta_Banio#' . $row_index, $banio->respuesta);
            $templateProcessor->setValue('Acciones_Banio#' . $row_index, $banio->acciones); // Etiqueta única para Acciones del baño

            $row_index++;
        }

        // Cocina
        $cocinas = Cocina::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Detalle_Cocina', count($cocinas)); // Clona filas para la tabla de la cocina

        $row_index = 1;
        foreach ($cocinas as $cocina) {
            $templateProcessor->setValue('Detalle_Cocina#' . $row_index, $cocina->detalle);
            $templateProcessor->setValue('Respuesta_Cocina#' . $row_index, $cocina->respuesta);
            $templateProcessor->setValue('Acciones_Cocina#' . $row_index, $cocina->acciones); // Etiqueta única para Acciones de la cocina

            $row_index++;
        }

        // Resumen de la vulnerabilidad de la vivienda
        $vulnerabilidades = VulnerabilidadVivienda::where('cod_familia', $cod_familia)->get();

        $templateProcessor->cloneRow('Detalle', count($vulnerabilidades)); // Clona filas para la tabla

        $row_index = 1;
        foreach ($vulnerabilidades as $vulnerabilidad) {
            $templateProcessor->setValue('Detalle#' . $row_index, $vulnerabilidad->detalle);

            // Asigna valores a las celdas de "Espacio Físico"
            $templateProcessor->setValue('Toda_Vivienda#' . $row_index, $vulnerabilidad->toda_vivienda ? 'x' : ''); // Marca con 'x' si es vulnerable
            $templateProcessor->setValue('Comedor#' . $row_index, $vulnerabilidad->comedor ? 'x' : '');
            $templateProcessor->setValue('Sala#' . $row_index, $vulnerabilidad->sala ? 'x' : '');
            $templateProcessor->setValue('Dormitorio#' . $row_index, $vulnerabilidad->dormitorio ? 'x' : '');
            $templateProcessor->setValue('Banio#' . $row_index, $vulnerabilidad->banio ? 'x' : '');
            $templateProcessor->setValue('Cocina#' . $row_index, $vulnerabilidad->cocina ? 'x' : '');

            $templateProcessor->setValue('Acciones_Vulnerabilidad#' . $row_index, $vulnerabilidad->acciones); // Etiqueta única

            $row_index++;
        }

        // Gráfico de la Vivienda
        $graficoVivienda = GraficoVivienda::where('cod_familia', $cod_familia)->first();

        if ($graficoVivienda) {
            // Interior de la vivienda
            $interiorPath = storage_path('app/public/images/grafico_vivienda_interior/' . $graficoVivienda->interior_vivienda);

            if (file_exists($interiorPath)) {
                try {
                    $templateProcessor->setImageValue('Interior_Vivienda', $interiorPath);
                } catch (\Exception $e) {
                    Log::error('Error al insertar imagen Interior_Vivienda: ' . $e->getMessage());
                    $templateProcessor->setValue('Interior_Vivienda', 'Error al cargar imagen');
                }
            } else {
                Log::warning('Imagen Interior_Vivienda no encontrada: ' . $interiorPath);
                $templateProcessor->setValue('Interior_Vivienda', 'Imagen no encontrada');
            }

            // Barrio/Recinto/Comunidad (BRC) - Repetir el mismo patrón
            $brcPath = storage_path('app/public/images/grafico_vivienda_exterior/' . $graficoVivienda->brc);

            if (file_exists($brcPath)) {
                try {
                    $templateProcessor->setImageValue('Barrio_Recinto_Comunidad', $brcPath);
                } catch (\Exception $e) {
                    Log::error('Error al insertar imagen Barrio_Recinto_Comunidad: ' . $e->getMessage());
                    $templateProcessor->setValue('Barrio_Recinto_Comunidad', 'Error al cargar imagen');
                }
            } else {
                Log::warning('Imagen Barrio_Recinto_Comunidad no encontrada: ' . $brcPath);
                $templateProcessor->setValue('Barrio_Recinto_Comunidad', 'Imagen no encontrada');
            }

            // Coordenadas
            $templateProcessor->setValue('Coordenada_X', $graficoVivienda->coordenada_x);
            $templateProcessor->setValue('Coordenada_Y', $graficoVivienda->coordenada_y);
        }

        // 📂 Generar el documento en memoria
        $temp_file = tempnam(sys_get_temp_dir(), 'plan-familiar-') . '.docx';
        $templateProcessor->saveAs($temp_file);

        // 📥 Descargar el archivo
        return response()->download($temp_file, "plan-familiar-{$cod_familia}.docx")->deleteFileAfterSend(true);
    }
}

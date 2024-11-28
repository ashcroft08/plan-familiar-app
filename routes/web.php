<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});*/

/*$router->get('/', function () use ($router) {
    return file_get_contents(resource_path('views/dashboard.html'));
});*/

//Rutas Dashboard
$router->get('/', 'DashboardController@mostrar'); // Página principal (root) que muestra el dashboard
$router->delete('/{cod_familia}', 'DashboardController@eliminar');

//Rutas de Información General
$router->get('informacion_general', 'InformacionGeneralController@mostrar');
$router->post('informacion_general', 'InformacionGeneralController@guardar');
$router->get('informacion_general/visualizar/{cod_familia}', 'InformacionGeneralController@editar');
$router->put('informacion_general/{cod_familia}', 'InformacionGeneralController@actualizar');
$router->get('informacion_general/{cod_familia}', 'InformacionGeneralController@regresar');

//Rutas para Amenazas
$router->get('amenazas', 'AmenazaController@mostrar');
$router->post('amenazas', 'AmenazaController@guardar');
$router->get('amenazas/visualizar/{cod_familia}', 'AmenazaController@editar');
$router->delete('amenazas/{cod_amenaza}', 'AmenazaController@eliminar');

//Rutas de Lugaress de evacuacion y de encuentro
$router->get('lugares_de_evacuacion_y_de_encuentro/{cod_familia}', 'LugarEvacuacionEncuentroController@mostrar');
$router->post('lugares_de_evacuacion_y_de_encuentro', 'LugarEvacuacionEncuentroController@guardar');
$router->get('lugares_de_evacuacion_y_de_encuentro/visualizar/{cod_familia}', 'LugarEvacuacionEncuentroController@editar');
$router->put('lugares_de_evacuacion_y_de_encuentro/{cod_familia}', 'LugarEvacuacionEncuentroController@actualizar');

//Rutas para Integrantes de la familia
$router->get('integrantes_de_la_familia', 'IntegranteFamiliaController@mostrar');
$router->post('integrantes_de_la_familia', 'IntegranteFamiliaController@guardar');
$router->get('integrantes_de_la_familia/visualizar/{cod_familia}', 'IntegranteFamiliaController@editar');
$router->delete('integrantes_de_la_familia/{cod_integrante}', 'IntegranteFamiliaController@eliminar');
$router->put('integrantes_de_la_familia/{cod_integrante}', 'IntegranteFamiliaController@actualizar');

//Rutas para Identificacion de amenazas
$router->get('identificacion_de_amenazas/{cod_familia}', 'IdentificacionAmenazaController@mostrar');
$router->post('identificacion_de_amenazas', 'IdentificacionAmenazaController@guardar');
$router->get('identificacion_de_amenazas/visualizar/{cod_familia}', 'IdentificacionAmenazaController@editar');
$router->put('identificacion_de_amenazas', 'IdentificacionAmenazaController@actualizar');

//Rutas para Recursos
$router->get('recursos_familiares_disponibles', 'RecursoPcdController@mostrar');
$router->post('recursos_familiares_disponibles', 'RecursoPcdController@guardar');
$router->get('recursos_familiares_disponibles/visualizar/{cod_familia}', 'RecursoPcdController@editar');
$router->delete('recursos_familiares_disponibles/{cod_recurso}', 'RecursoPcdController@eliminar');
$router->put('recursos_familiares_disponibles/{cod_recurso}', 'RecursoPcdController@actualizar');

//Rutas para Plan accion Reducción
$router->get('plan_accion_reduccion', 'ReduccionController@mostrar');
$router->post('plan_accion_reduccion', 'ReduccionController@guardar');
$router->get('plan_accion_reduccion/visualizar/{cod_familia}', 'ReduccionController@editar');
$router->delete('plan_accion_reduccion/{cod_reduccion}', 'ReduccionController@eliminar');
$router->put('plan_accion_reduccion/{cod_reduccion}', 'ReduccionController@actualizar');

//Rutas para Plan accion Respuesta
$router->get('plan_accion_respuesta', 'RespuestaController@mostrar');
$router->post('plan_accion_respuesta', 'RespuestaController@guardar');
$router->get('plan_accion_respuesta/visualizar/{cod_familia}', 'RespuestaController@editar');
$router->delete('plan_accion_respuesta/{cod_respuesta}', 'RespuestaController@eliminar');
$router->put('plan_accion_respuesta/{cod_respuesta}', 'RespuestaController@actualizar');

//Rutas para Plan accion Recuperación
$router->get('plan_accion_recuperacion', 'RecuperacionController@mostrar');
$router->post('plan_accion_recuperacion', 'RecuperacionController@guardar');
$router->get('plan_accion_recuperacion/visualizar/{cod_familia}', 'RecuperacionController@editar');
$router->delete('plan_accion_recuperacion/{cod_recuperacion}', 'RecuperacionController@eliminar');
$router->put('plan_accion_recuperacion/{cod_recuperacion}', 'RecuperacionController@actualizar');

//Rutas para Plan accion Reducción
$router->get('numeros_emergencia/{cod_familia}', 'NumeroEmergenciaController@mostrar');
$router->post('numeros_emergencia', 'NumeroEmergenciaController@guardar');
$router->get('numeros_emergencia/visualizar/{cod_familia}', 'NumeroEmergenciaController@editar');
$router->put('numeros_emergencia/{cod_numero_emergencia}', 'NumeroEmergenciaController@actualizar');

//Rutas para Mi Mascota
$router->get('mi_mascota', 'MascotaController@mostrar');
$router->post('mi_mascota', 'MascotaController@guardar');
$router->get('mi_mascota/visualizar/{cod_familia}', 'MascotaController@editar');
$router->put('mi_mascota/{cod_mascota}', 'MascotaController@actualizar');
$router->delete('mi_mascota/{cod_mascota}', 'MascotaController@eliminar');

//Rutas para Matriz de estructura general vivienda
$router->get('matriz_de_estructura_general_vivienda/{cod_familia}', 'EstructuraViviendaController@mostrar');
$router->post('matriz_de_estructura_general_vivienda', 'EstructuraViviendaController@guardar');
$router->get('matriz_de_estructura_general_vivienda/visualizar/{cod_familia}', 'EstructuraViviendaController@editar');
$router->put('matriz_de_estructura_general_vivienda/actualizar', 'EstructuraViviendaController@actualizar');

//Rutas para Comedor
$router->get('comedor/{cod_familia}', 'ComedorController@mostrar');
$router->post('comedor', 'ComedorController@guardar');
$router->get('comedor/visualizar/{cod_familia}', 'ComedorController@editar');
$router->put('comedor/actualizar', 'ComedorController@actualizar');

//Rutas para Sala
$router->get('sala/{cod_familia}', 'SalaController@mostrar');
$router->post('sala', 'SalaController@guardar');
$router->get('sala/visualizar/{cod_familia}', 'SalaController@editar');
$router->put('sala/actualizar', 'SalaController@actualizar');

//Rutas para Dormitorio
$router->get('dormitorio/{cod_familia}', 'DormitorioController@mostrar');
$router->post('dormitorio', 'DormitorioController@guardar');
$router->get('dormitorio/visualizar/{cod_familia}', 'DormitorioController@editar');
$router->put('dormitorio/actualizar', 'DormitorioController@actualizar');

//Rutas para Baño
$router->get('bano/{cod_familia}', 'BanioController@mostrar');
$router->post('bano', 'BanioController@guardar');
$router->get('bano/visualizar/{cod_familia}', 'BanioController@editar');
$router->put('bano/actualizar', 'BanioController@actualizar');

//Rutas para Cocina
$router->get('cocina/{cod_familia}', 'CocinaController@mostrar');
$router->post('cocina', 'CocinaController@guardar');
$router->get('cocina/visualizar/{cod_familia}', 'CocinaController@editar');
$router->put('cocina/actualizar', 'CocinaController@actualizar');

//Rutas para Resumen de vulnerabilidad
$router->get('resumen_vulnerabilidad_vivienda/{cod_familia}', 'VulnerabilidadViviendaController@mostrar');
$router->post('resumen_vulnerabilidad_vivienda', 'VulnerabilidadViviendaController@guardar');
$router->get('resumen_vulnerabilidad_vivienda/visualizar/{cod_familia}', 'VulnerabilidadViviendaController@editar');
$router->put('resumen_vulnerabilidad_vivienda/actualizar', 'VulnerabilidadViviendaController@actualizar');

//Rutas para Grafico de Vivienda
$router->get('grafico_vivienda/{cod_familia}', 'GraficoViviendaController@mostrar');
$router->post('grafico_vivienda', 'GraficoViviendaController@guardar');
$router->get('grafico_vivienda/visualizar/{cod_familia}', 'GraficoViviendaController@editar');
$router->put('grafico_vivienda/actualizar', 'GraficoViviendaController@actualizar');
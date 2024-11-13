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
$router->get('informacion_general/{cod_familia}', 'InformacionGeneralController@editar');
$router->put('informacion_general/{cod_familia}', 'InformacionGeneralController@actualizar');

//Rutas para Amenazas
$router->get('amenazas', 'AmenazaController@mostrar');
$router->post('amenazas', 'AmenazaController@guardar');
$router->delete('amenaza/{cod_amenaza}', 'AmenazaController@eliminar');

//Rutas de Lugaress de evacuacion y de encuentro
$router->get('lugares_de_evacuacion_y_de_encuentro', 'LugarEvacuacionEncuentroController@mostrar');
$router->post('lugares_de_evacuacion_y_de_encuentro', 'LugarEvacuacionEncuentroController@guardar');
$router->get('lugares_de_evacuacion_y_de_encuentro/{cod_familia}', 'LugarEvacuacionEncuentroController@editar');
$router->put('lugares_de_evacuacion_y_de_encuentro/{cod_familia}', 'LugarEvacuacionEncuentroController@actualizar');

//Rutas para Amenazas
$router->get('integrantes_de_la_familia', 'IntegranteFamiliaController@mostrar');
$router->post('integrantes_de_la_familia', 'IntegranteFamiliaController@guardar');
//$router->delete('integrantes_de_la_familia/{cod_familia}', 'IntegranteFamiliaController@eliminar');

//Rutas para Identificacion de amenazas
$router->get('identificacion_de_amenazas', 'IdentificacionAmenazaController@mostrar');
$router->post('identificacion_de_amenazas', 'IdentificacionAmenazaController@guardar');

//Rutas para Recursos
$router->get('recursos_familiares_disponibles', 'RecursoPcdController@mostrar');
$router->post('recursos_familiares_disponibles', 'RecursoPcdController@guardar');

//Rutas para Plan accion Reducción
$router->get('plan_accion_reduccion', 'ReduccionController@mostrar');
$router->post('plan_accion_reduccion', 'ReduccionController@guardar');

//Rutas para Plan accion Respuesta
$router->get('plan_accion_respuesta', 'RespuestaController@mostrar');
$router->post('plan_accion_respuesta', 'RespuestaController@guardar');

//Rutas para Plan accion Recuperación
$router->get('plan_accion_recuperacion', 'RecuperacionController@mostrar');
$router->post('plan_accion_recuperacion', 'RecuperacionController@guardar');

//Rutas para Plan accion Reducción
$router->get('numeros_emergencia', 'NumeroEmergenciaController@mostrar');
$router->post('numeros_emergencia', 'NumeroEmergenciaController@guardar');

$router->get('/mi_mascota', function () {
    return view('/mi_mascota');
});

$router->get('/matriz_de_estructura_general_vivienda', function () {
    return view('matriz_de_estructura_general_vivienda');
});

$router->get('/comedor', function () {
    return view('comedor');
});

$router->get('/sala', function () {
    return view('sala');
});

$router->get('/dormitorio', function () {
    return view('dormitorio');
});

$router->get('/bano', function () {
    return view('bano');
});

$router->get('/cocina', function () {
    return view('cocina');
});

$router->get('/resumen_vulnerabilidad_vivienda', function () {
    return view('resumen_vulnerabilidad_vivienda');
});

$router->get('/grafico_vivienda', function () {
    return view('grafico_vivienda');
});

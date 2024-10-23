<?php

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

$router->get('/', function () use ($router) {
    return file_get_contents(resource_path('views/dashboard.html'));
});

$router->get('/informacion_general', function () {
    return view('informacion_general'); 
});

$router->get('/lugares_de_evacuacion_y_de_encuentro', function () {
    return view('lugares_de_evacuacion_y_de_encuentro'); 
});

$router->get('/integrantes_de_la_familia', function () {
    return view('integrantes_de_la_familia'); 
});

$router->get('/identificacion_de_amenazas', function () {
    return view('identificacion_de_amenazas'); 
});

$router->get('/recursos_familiares_disponibles', function () {
    return view('recursos_familiares_disponibles'); 
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
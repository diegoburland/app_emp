<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('empresa/{id}', 'Empresa_controller@show');
//Route::post('crear_empresa', 'Empresa_controller@store')->name('empresa.store');
Route::post('crear_empresa', 'Empresa_controller@store');

Route::post('filtrar_empresa', 'Empresa_controller@filtrar');

Route::post('crear_evaluacion', 'Evaluacion_controller@store');

Route::get('gracias', 'Evaluacion_controller@gracias');

Route::get('empresa_evaluar', 'Evaluacion_controller@continuar_evaluacion');


Route::get('empresa_new', function () {
    return view('empresa_new');
});

Route::get('buscar_empresa', function () {
    return view('filtro_empresa');
});

Route::get('login', function () {
    return view('login');
});

Route::get('empresa_list', 'Empresa_controller@list');

Route::get('/api/v1/encontrar_empresa', 'Empresa_controller@get_empresa');
Route::get('/api/v1/encontrar_ubicacion', 'Ciudad_controller@get_ciudad');

Route::post('/api/v1/crear_empresa', 'Empresa_controller@save_empresa');

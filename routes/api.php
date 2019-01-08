<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 *
 * Rutas de le Auth del sistema
 *
 */

Route::get('datos/{id}', 'datosController@datos')->name('datos');

Route::group([

    // 'middleware' => 'api',
    'prefix' => 'auth',
    'namespace'=> 'Api\\'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
/**
 *
 * Rutas de Usuarios del sistema
 *
 */

Route::group(['prefix'=>'user', 'namespace'=>'user\\'], function () {
    // Ruta libre para registro de usuarios
    Route::post('store', 'UserController@store')->name('user.store');
    // rutas con proteccion de token
    Route::group(['middleware' => 'auth:api'], function ($router) {
        Route::post('reactivar', 'UserController@reactivar')->name('user.reactivar');
        Route::get('/userRegister', 'UserController@userRegister')->name('user.register');
        Route::get('/{parametro}/{palabra?}', 'UserController@userList')->name('user.list');
        Route::put('/{id}', 'UserController@update')->name('user.update');
        Route::delete('/{id}', 'UserController@delete')->name('user.delete');
        Route::get('/{id}', 'UserController@show')->name('user.show');
    });
});
/**
 *
 * Rutas de las busquedas del sistema
 *
 */
Route::group(['prefix' => 'buscar', 'namespace'=>'busqueda\\', 'middleware'=>'auth:api'], function () {
    Route::get('{collection}/{id?}', 'BusquedaController@por_coleccion')->name('busqueda.por_colleccion');
});
/**
 *
 * Rutas de Empresas en el sistema
 *
 */
Route::group(['prefix' => 'empresa', 'namespace'=>'empresa\\', 'middleware'=>'auth:api'], function () {
    Route::post('store', 'EmpresaController@store')->name('empresa.store');
    Route::get('', 'EmpresaController@empresasList')->name('empresa.list');
    Route::put('/{id}', 'EmpresaController@update')->name('empresa.update');
    Route::delete('/{id}', 'EmpresaController@delete')->name('empresa.delete');
});
/**
 *
 * Rutas de Servicios en el sistema
 *
 */
Route::group(['prefix' => 'servicio', 'namespace'=>'servicios\\', 'middleware'=>'auth:api'], function () {
    Route::post('store', 'ServiciosController@store')->name('servicio.store');
    Route::get('{option?}', 'ServiciosController@correoList')->name('servicio.list');
    // Route::put('/{id}', 'CorreosEnviadosController@update')->name('correo.update');
    // Route::delete('/{id}', 'CorreosEnviadosController@delete')->name('correo.delete');
});
/**
 *
 * Rutas de Facturas en el sistema
 *
 */
Route::group(['prefix' => 'factura', 'namespace'=>'factura\\', 'middleware'=>'auth:api'], function () {
    Route::post('store', 'FacturaController@store')->name('factura.store');
    Route::get('', 'FacturaController@facturaList')->name('factura.list');
    Route::put('/{id}', 'FacturaController@update')->name('factura.update');
    Route::delete('/{id}', 'FacturaController@delete')->name('factura.delete');
});
/**
 *
 * Rutas de Tabulador de traslado
 *
 */
Route::group(['prefix' => 'tabulador', 'namespace'=>'tabulador\\','middleware'=>'auth:api'], function () {
    Route::post('', 'tabuladorController@store')->name('tabulador.store');
    Route::get('', 'tabuladorController@index')->name('tabulador.index');
});
/**
 *
 * Rutas de Validaciones ASINCRONAS
 *
 */
Route::group(['prefix' => 'validators', 'namespace'=>'async\\', 'middleware'=>'auth:api'], function() {
    Route::get('emailtaken/{email}', 'validatorsController@emailTaken')->name('validators.emailtaken');
    Route::get('empresaexiste/{campo}/{valor}', 'validatorsController@existe')->name('validators.empresaexiste');
});
/**
 *
 * Rutas para practicar cosas nuevas
 *
 */
Route::group(['prefix' => 'practica', 'namespace'=>'Practica\\'], function() {
    Route::get('', 'PracticaController@index')->name('practica.index');
});

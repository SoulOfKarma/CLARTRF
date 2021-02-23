<?php

use Illuminate\Http\Request;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/Login/Salir', ['middleware' => 'cors', 'uses' => 'LoginController@salir']);
Route::post('/Login/GetUsers', ['middleware' => 'cors', 'uses' => 'LoginController@getUsuarios']);
Route::post('/Login/getpr', ['middleware' => 'cors', 'uses' => 'LoginController@adminPr']);
Route::post('/auth/login','LoginController@login');

Route::group(['middleware' => ['jwt.verify']], function() {
    //Gets
    Route::get('/ART/GetCDP', ['middleware' => 'cors', 'uses' => 'CdpsController@index']);
    Route::get('/ART/GetEjecutores', ['middleware' => 'cors', 'uses' => 'EjecutoresController@index']);
    Route::get('/ART/GetItemPresupuestario', ['middleware' => 'cors', 'uses' => 'ItemPresupuestariosController@index']);
    Route::get('/ART/GetLicitaciones', ['middleware' => 'cors', 'uses' => 'LicitacionesController@index']);
    Route::get('/ART/GetMemos', ['middleware' => 'cors', 'uses' => 'MemosController@index']);
    Route::get('/ART/GetOrdenCompras', ['middleware' => 'cors', 'uses' => 'OrdenComprasController@index']);
    Route::get('/ART/GetProveedores', ['middleware' => 'cors', 'uses' => 'ProveedoresController@index']);
    Route::get('/ART/GetRecursos', ['middleware' => 'cors', 'uses' => 'RecursosController@index']);
    Route::get('/ART/GetResolucionAdjudicaciones', ['middleware' => 'cors', 'uses' => 'ResolucionAdjudicacionesController@index']);
    Route::get('/ART/GetResolucionContratos', ['middleware' => 'cors', 'uses' => 'ResolucionContratosController@index']);
    Route::get('/ART/GetResolucionInternas', ['middleware' => 'cors', 'uses' => 'ResolucionInternasController@index']);
    Route::get('/ART/GetResolucionLlamados', ['middleware' => 'cors', 'uses' => 'ResolucionLlamadosController@index']);
    Route::get('/ART/GetSolicitantes', ['middleware' => 'cors', 'uses' => 'SolicitantesController@index']);
    Route::get('/ART/GetTipoCompras', ['middleware' => 'cors', 'uses' => 'TipoComprasController@index']);
    Route::get('/ART/GetTipoMantenciones', ['middleware' => 'cors', 'uses' => 'TipoMantencionesController@index']);
    Route::get('/ART/GetDataByOC/{id}', ['middleware' => 'cors', 'uses' => 'RegistroARTSController@DataByOC']);
    
    //Posts 
    Route::post('/ART/PostNSolicitante', ['middleware' => 'cors', 'uses' => 'SolicitantesController@CreateSolicitante']);
    Route::post('/ART/PostNEjecutor', ['middleware' => 'cors', 'uses' => 'EjecutoresController@CreateEjecutor']);
    Route::post('/ART/PostNItemPresupuestario', ['middleware' => 'cors', 'uses' => 'ItemPresupuestariosController@CreateIP']);
    Route::post('/ART/PostNTipoMantencion', ['middleware' => 'cors', 'uses' => 'TipoMantencionesController@CreateTM']);
    Route::post('/ART/PostNRecursos', ['middleware' => 'cors', 'uses' => 'RecursosController@CreateR']);
    Route::post('/ART/PostNTipoCompras', ['middleware' => 'cors', 'uses' => 'TipoComprasController@CreateTC']);
    Route::post('/ART/PostNLicitacion', ['middleware' => 'cors', 'uses' => 'LicitacionesController@CreateLic']);
    Route::post('/ART/PostNResolucionLlamado', ['middleware' => 'cors', 'uses' => 'ResolucionLlamadosController@CreateRL']);
    Route::post('/ART/PostNResolucionAdjudicaciones', ['middleware' => 'cors', 'uses' => 'ResolucionAdjudicacionesController@CreateRA']);
    Route::post('/ART/PostNResolucionContrato', ['middleware' => 'cors', 'uses' => 'ResolucionContratosController@CreateRC']);
    Route::post('/ART/PostNCDP', ['middleware' => 'cors', 'uses' => 'CdpsController@CreateCDP']);
    Route::post('/ART/PostNOC', ['middleware' => 'cors', 'uses' => 'OrdenComprasController@CreateOC']);
    Route::post('/ART/PostNRI', ['middleware' => 'cors', 'uses' => 'ResolucionInternasController@CreateRI']);
    Route::post('/ART/PostNMemo', ['middleware' => 'cors', 'uses' => 'MemosController@CreateMemo']);
    Route::post('/ART/PostNProveedor', ['middleware' => 'cors', 'uses' => 'ProveedoresController@CreateProveedor']);
});

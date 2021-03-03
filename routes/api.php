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
    Route::get('/CLART/GetProveedores', ['middleware' => 'cors', 'uses' => 'ProveedoresController@index']);
    Route::get('/CLART/GetEstados', ['middleware' => 'cors', 'uses' => 'EstadosController@index']);
    Route::get('/CLART/GetRegistroCLARTS', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@showRegistroEspecifico']);
    Route::get('/CLART/GetRegistroCLARTSCatEQ', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatEQ']);
    Route::get('/CLART/GetRegistroCLARTSCatI', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatI']);
    Route::get('/CLART/GetRegistroCLARTSCatAP', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatAP']);
    Route::get('/CLART/GetRegistroCLARTSCatMI', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatMI']);
    Route::get('/CLART/GetCLARTByART/{id}', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@GetCLARTByART']);
    
    //Posts 
    Route::post('/CLART/PostDocumentoF', ['middleware' => 'cors', 'uses' => 'RepositorioDocumentacionesController@store']);
    Route::post('/CLART/PostRegistroCLART', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@store']);
    Route::post('/CLART/PostProveedor', ['middleware' => 'cors', 'uses' => 'ProveedoresController@create']);

    //PUT Como Post
    Route::post('/CLART/PUTCambiarEstado', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@PUTEstado']);
    Route::post('/CLART/PUTCambiarEstadoContabilidad', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@PUTEstadoContabilidad']);
    Route::post('/CLART/PUTRegistroCLART', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@PUTRegistroCLART']);

    //Post Como Get
    Route::post('/CLART/GetRegistroDocumentosF', ['middleware' => 'cors', 'uses' => 'RepositorioDocumentacionesController@showRegistroEspecifico']);

});

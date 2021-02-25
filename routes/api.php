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
    Route::get('/CLART/GetRegistroCLARTS', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@showRegistroEspecifico']);
    Route::get('/CLART/GetRegistroDocumentosF/{id}', ['middleware' => 'cors', 'uses' => 'RepositorioDocumentacionesController@showRegistroEspecifico']);
    Route::get('/CLART/GetRegistroCLARTSCatEQ', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatEQ']);
    Route::get('/CLART/GetRegistroCLARTSCatI', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatI']);
    Route::get('/CLART/GetRegistroCLARTSCatAP', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatAP']);
    Route::get('/CLART/GetRegistroCLARTSCatMI', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@indexCatMI']);
    
    //Posts 
    Route::post('/CLART/PostDocumentoF', ['middleware' => 'cors', 'uses' => 'RepositorioDocumentacionesController@store']);
    Route::post('/CLART/PostRegistroCLART', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@store']);

});

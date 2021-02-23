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

    
    //Posts 
    Route::post('/CLART/PostDocumentoF', ['middleware' => 'cors', 'uses' => 'RepositorioDocumentacionesController@store']);
    Route::post('/CLART/PostRegistroCLART', ['middleware' => 'cors', 'uses' => 'RegistroCLARTSController@store']);

});
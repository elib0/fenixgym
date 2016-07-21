<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');//raiz de la ruta


//Rutas para clientes
Route::group(['prefix' => 'customer'], function() {
    Route::get('all', 'CustomerController@index'); //ruta  de la raiz
    Route::get('profile/{user_id?}', 'CustomerController@profile');//ruta para  el formulario del usuario editando o nuevo cliente
    Route::get('envoice', 'CustomerController@envoice');
    Route::get('nutritional_control', 'CustomerController@nutritional_control');
    // Route::get('/nutritional_control', 'CustomerController@profileSave');
    Route::post('profile/save', 'CustomerController@profileSave'); //ruta para el boton guardar
});

Route::auth();

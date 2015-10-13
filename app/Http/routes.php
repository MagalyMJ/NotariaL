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

Route::get('/',[ 
	'uses' =>'HomeController@index',
	'as' => 'home' ]);
// Vista de login
Route::get('login',[

	'uses' => 'AuthController@index',

	'as' =>'auth_show_path',
 	]);
//Autenticacion de Login
Route::post('login',[

	'uses' => 'AuthController@store',

	'as' =>'auth_store_path',
 	]);


Route::get('servicio/{id_service}',[
	'uses' => 'ServiceController@index',
	'as' => 'service_show_path',
	]);

Route::post('servicio',[
	'uses' => 'ServiceController@addCustumer',
	'as' => 'service_post_path',
	]);




// se deberia de poner el id del caso ? y del cliente a asignar ? 
Route::get('nuevo/{id_service}','ServiceController@service');


Route::get('cliente/nuevo','CustomerController@index');

Route::post('nuevo/crearcaso/{id_service}',[

	'uses' =>'ServiceController@create',
	'as' => 'crearcaso',
	]);

Route::post('cliente/nuevo',[
	'uses' => 'CustomerController@addCustumer',
	'as' => 'customer_new_path',
	]);

Route::post('cliente/caso/nuevo',[
	'uses' => 'CustomerController@addCustumerCase',
	'as' => 'customer_service_path',
	]);







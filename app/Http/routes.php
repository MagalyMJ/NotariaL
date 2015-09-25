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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[

	'uses' => 'AuthController@index',

	'as' =>'auth_show_path',
 	]);
Route::post('login',[

	'uses' => 'AuthController@store',

	'as' =>'auth_store_path',
 	]);

Route::get('servicio',[
	'uses' => 'ServiceController@index',
	'as' => 'service_show_path',
	]);

Route::post('servicio',[
	'uses' => 'ServiceController@addCustumer',
	'as' => 'service_post_path',
	]);

Route::get('otros/{servicio}','ServiceController@service');
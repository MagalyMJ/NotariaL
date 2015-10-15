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



// Para mostrar todos los casos en base al servicio
Route::get('servicio/{id_service}',[
	'uses' => 'ServiceController@index',
	'as' => 'service_show_path',
	]);

Route::post('servicio',[
	'uses' => 'ServiceController@addCustumer',
	'as' => 'service_post_path',
	]);


//Para generar un nuevo caso del servicio seleccionado
Route::get('nuevo/{id_service}','ServiceController@service');


//Para ver los detalles de un caso 
Route::get('caso/{id_caseService}',[
	'uses' =>'ServiceController@show',
	'as' => 'Show_Case_path',
	]);

//Una ves asinado un cliente se puede crear un caso completo.
Route::post('nuevo/{id_service}/caso/',[
	'uses' =>'ServiceController@create',
	'as' => 'crearCaso',
	]);
//Mostrar el formulario para registrar un cliente 
Route::get('cliente/nuevo','CustomerController@index');

//Registra al cliente
Route::post('cliente/nuevo',[
	'uses' => 'CustomerController@addCustumer',
	'as' => 'customer_new_path',
	]);

Route::get('presupuesto/{id_presupuesto}',[
	'uses' =>'BudgetController@edit',
	'as' => 'EditBudget',
	]);
Route::post('presupuesto/{id_presupuesto}',[
	'uses' =>'BudgetController@update',
	'as' => 'UpdateBudget',
	]);

// Route::post('nuevo/{id_service}/caso/{id_caseService}',[

// 	'uses' =>'ServiceController@create',
// 	'as' => 'crearcaso',
// 	]);


// Route::post('cliente/caso/nuevo',[
// 	'uses' => 'CustomerController@addCustumerCase',
// 	'as' => 'customer_service_path',
// 	]);







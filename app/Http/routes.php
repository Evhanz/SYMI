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

//Route::get('/', 'WelcomeController@index');
Route::get('/', 'WelcomeController@main');

Route::get('home', 'HomeController@index');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('marca', ['as' => 'marca', 'uses' => 'MarcaController@index']);


//para RRHH - Personal

//Route::get('personal/all',['as'=>'personal','uses'=>'PersonaController@index']);

Route::get('personal',['as'=>'personalMod']);
Route::get('personal/all',['as'=>'personal','uses'=>'PersonaController@viewGetAllPersonas']);//esto es para el all
Route::get('personal/new',['as'=>'viewNewPersonal','uses'=>'PersonaController@viewNewPeronal']);
Route::get('personal/getBy/{criterio?}-{dni}',
    ['as'=>'getPersonaByCriterios','uses'=>'PersonaController@getPersonaByCriterios']);
Route::post('personal/regPersonal',['as'=>'regPersonal','uses'=>'PersonaController@regPersonal']);


//-------- profesiones --->
Route::get('personal/profesiones',['as'=>'modProfesion']);
Route::get('personal/profesiones/{criterio}',['as'=>'viewProfesiones','uses'=>'ProfesioneController@getProfesiones']);
Route::post('personal/profesiones/new',['as'=>'regProfesion','uses'=>'ProfesioneController@regProfesion']);



//-------- Proformas ----->
Route::get('proformas',['as'=>'modProformas']);
Route::get('proformas/get/{numero}',['as'=>'viewProformes','uses'=>'ProformaController@getProformasByNumero']);
Route::get('proformas/new',['as'=>'viewNewProforma','uses'=>'ProformaController@viewNewProforma']);
Route::post('proformas/regProforma',['as'=>'regProforma','uses'=>'ProformaController@regProforma']);


//-------- Areas --------->
Route::get('areas',['as'=>'modAreas']);
Route::get('areas/get/{criterio}',['as'=>'viewAreas','uses'=>'AreaController@viewArea']);
Route::post('areas/regArea',['as'=>'regArea','uses'=>'AreaController@regArea']);


//------- Aea Trabajador ---->
Route::get('areas/gestionArea/{id}',['as'=>'viewAreaTrabajador','uses'=>'AreaController@viewAsignarArea']);
Route::post('areas/gestionArea/regEncargadoArea',['as'=>'regEncargadoArea','uses'=>'AreaController@regEncargadoArea']);


//------- Helper ------------>
Route::post('helper/personalByDNI',['as'=>'hGetPersonalByDNI','uses'=>'HelperController@getPersonalByDNI']);
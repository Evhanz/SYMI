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
Route::get('personal/UpdateById/{id}',['as'=>'updatePersonal','uses'=>'PersonaController@updatePersonal']);
Route::post('personal/getById/',['as'=>'getPersonalByID','uses'=>'PersonaController@getPersonalByID']); 
Route::post('personal/updatePersonal',['as'=>'editPersonal','uses'=>'PersonaController@editPersonal']);


//-------- profesiones --->
Route::get('personal/profesiones',['as'=>'modProfesion']);
Route::get('personal/profesiones/{criterio}',['as'=>'viewProfesiones','uses'=>'ProfesioneController@getProfesiones']);
Route::post('personal/profesiones/new',['as'=>'regProfesion','uses'=>'ProfesioneController@regProfesion']);
Route::post('personal/getProfesionById',['as'=>'getProfesionById','uses'=>'ProfesioneController@getProfesionById']);
Route::post('personal/updateProfesion',['as'=>'updateProfesion','uses'=>'ProfesioneController@updateProfesion']);


//-------- Proformas ----->
Route::get('proformas',['as'=>'modProformas']);
Route::get('proformas/get/{numero}',['as'=>'viewProformas','uses'=>'ProformaController@getProformasByNumero']);
Route::get('proformas/new',['as'=>'viewNewProforma','uses'=>'ProformaController@viewNewProforma']);
Route::post('proformas/regProforma',['as'=>'regProforma','uses'=>'ProformaController@regProforma']);
Route::get('proformas/ViewUpdateProforma/{id}',['as'=>'ViewUpdateProforma','uses'=>'ProformaController@ViewUpdateProforma']);
Route::post('proformas/updateProforma',['as'=>'updateProforma','uses'=>'ProformaController@updateProforma']);




//-------- Tareos  -------->
Route::get('tareos',['as'=>'modTareos']);
Route::get('tareos/viewTareo',['as'=>'viewTareo','uses'=>'TareoController@viewTareo']);
Route::get('tareos/newTareo',['as'=>'newTareo','uses'=>'TareoController@newTareo']);
Route::get('tareos/updateTareo/{id}',['as'=>'viewUpdateTareo','uses'=>'TareoController@viewUpdateTareo']);
Route::post('tareos/regTareo',['as'=>'regTareo','uses'=>'TareoController@regTareo']);
Route::post('tareos/getDetallePersonal/ById',['as'=>'getDetallePersonal','uses'=>'TareoController@getDetallePersonal']);
Route::post('tareos/getDetalleAvance',['as'=>'getDetalleAvance','uses'=>'TareoController@getDetalleAvance']);
Route::post('tareos/updateTareo',['as'=>'updateTareo','uses'=>'TareoController@updateTareo']);




//-------- Areas --------->
Route::get('areas',['as'=>'modAreas']);
Route::get('areas/get/{criterio}',['as'=>'viewAreas','uses'=>'AreaController@viewArea']);
Route::get('areas/get/servicios/all',['as'=>'getAreasJSON','uses'=>'AreaController@getAreasJSON']);
Route::post('areas/regArea',['as'=>'regArea','uses'=>'AreaController@regArea']);
Route::post('areas/getById',['as'=>'getAreaById','uses'=>'AreaController@getAreaById']);
Route::post('areas/editArea',['as'=>'editArea','uses'=>'AreaController@editArea']);



//------- Aea Trabajador ---->
Route::get('areas/gestionArea/{id}',['as'=>'viewAreaTrabajador','uses'=>'AreaController@viewAsignarArea']);
Route::post('areas/gestionArea/regEncargadoArea',['as'=>'regEncargadoArea','uses'=>'AreaController@regEncargadoArea']);
Route::post('areas/gestionArea/regEmpleadoArea',['as'=>'regEmpleadoArea','uses'=>'AreaController@regEmpleadoArea']);
Route::post('areas/getPersonalByAreaId/',['as'=>'getPersonalByAreaId','uses'=>'AreaController@getPersonalByAreaId']);



//------- Helper ------------>
Route::post('helper/personalByDNI',['as'=>'hGetPersonalByDNI','uses'=>'HelperController@getPersonalByDNI']);
Route::post('helper/proformaByID',['as'=>'hGetProformaById','uses'=>'HelperController@hGetProformaById']);
Route::post('helper/getNumberProforma',['as'=>'getNumberProforma','uses'=>'HelperController@getNumberProforma']);



//-------solo para pruebas unitarias --->
Route::get('helper/getPersonalOrderAll',['as'=>'prueba','uses'=>'HelperController@prueba']);
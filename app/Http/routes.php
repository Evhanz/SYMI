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
Route::get('/',['as'=>'inicio','uses'=>'WelcomeController@main']);

Route::get('home', 'HomeController@index');

Route::get('createUaser',['as'=>'createUaser','uses'=>'UserController@create_user']);



// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);




Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function () {


	Route::group([
		'middleware' => 'supadmin'
	], function () {
		Route::get('marca', ['as' => 'marca', 'uses' => 'MarcaController@index']);

	});

});





///Route::get('marca', ['as' => 'marca', 'uses' => 'MarcaController@index']);


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
Route::get('personal/changeState/{id}',['as'=>'changeState','uses'=>'PersonaController@changeState']);
Route::get('personal/get/{id}',['as'=>'getPeronaById','uses'=>'PersonaController@getPeronaById']);





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
Route::post('proformas/get/getProformasByAreaOrNumero',['as'=>'getProformasByAreaOrNumero','uses'=>'ProformaController@getProformasByAreaOrNumero']);
Route::get('proformas/getEstadoOfProforma/{id}',['as'=>'getEstadoOfProforma','uses'=>'ProformaController@getEstadoOfProforma']);
Route::post('proformas/regEstadoNew',['as'=>'regEstadoNew','uses'=>'ProformaController@regEstadoNew']);
Route::get('proformas/getEstadoByID/{id}',['as'=>'getEstadoByID','uses'=>'ProformaController@getEstadoByID']);
Route::post('proformas/updateEstado',['as'=>'updateEstado','uses'=>'ProformaController@updateEstado']);
Route::get('proformas/getCostoOfAreaByFechas/{f_i}/{f_f}',
	['as'=>'getCostoOfAreaByFechas','uses'=>'ProformaController@getCostoOfAreaByFechas']);


/*----reporte de prforma*/
Route::get('proformas/getReporteDetalleProformaById/{id}',
			['as'=>'getReporteDetalleProformaById',
			'uses'=>'ProformaController@getReporteDetalleProformaById']);
Route::post('proformas/getInitAllDataProformas',['as'=>'getInitAlldata','uses'=>'ProformaController@getInitAlldata']);

//-------- Tareos  -------->
Route::get('tareos',['as'=>'modTareos']);
Route::get('tareos/viewTareo',['as'=>'viewTareo','uses'=>'TareoController@viewTareo']);
Route::get('tareos/newTareo',['as'=>'newTareo','uses'=>'TareoController@newTareo']);
Route::get('tareos/updateTareo/{id}',['as'=>'viewUpdateTareo','uses'=>'TareoController@viewUpdateTareo']);
Route::post('tareos/regTareo',['as'=>'regTareo','uses'=>'TareoController@regTareo']);
Route::post('tareos/getDetallePersonal/ById',['as'=>'getDetallePersonal','uses'=>'TareoController@getDetallePersonal']);
Route::post('tareos/getDetalleAvance',['as'=>'getDetalleAvance','uses'=>'TareoController@getDetalleAvance']);
Route::post('tareos/updateTareo',['as'=>'updateTareo','uses'=>'TareoController@updateTareo']);
Route::post('tareos/getTareosByAreaAndFecha',['as'=>'getTareosByAreaAndFecha','uses'=>'TareoController@getTareosByAreaAndFecha']);
Route::post('tareos/getInitTareoAll',['as'=>'getInitTareoAll','uses'=>'TareoController@getInitTareoAll']);




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
Route::get('helper/updateCostosPersonal',['as'=>'updateCostosPersonal','uses'=>'HelperController@updateCostosPersonal']);



//-------Reportes
Route::get('reportes',['as'=>'modReportes']);
Route::get('reportes/personal/viewAllPersonal',['as'=>'getViewPersonalByHoras',
	'uses'=>'ReportesController@getViewPersonalByHoras']);
/*Controller Reportes*/
Route::get('reportes/getReporteByPersonal',['as'=>'getReporteByPersonal','uses'=>'ReportesController@getViewByHorasPersonalForDates']);

/*Proformas no cerradas*/
Route::get('reportes/getProformaNoClosed',['as'=>'getProformaNoClosed','uses'=>'ProformaController@getProformaNoClosed']);
Route::get('reportes/viewGetProformaNoClosed',['as'=>'viewGetProformaNoClosed','uses'=>'ProformaController@viewGetProformaNoClosed']);
Route::post('reportes/getReportAdminByProforms',['as'=>'getReportAdminByProforms','uses'=>'ProformaController@getReportAdminByProforms']);
Route::get('reportes/viewGetReportByProforms',['as'=>'viewGetReportByProforms','uses'=>'ProformaController@viewGetReportByProforms']);
	/*----es apra mandar a excel el reporte de ^ */
Route::get('reportes/excelReportProformAbstract/{f_i}/{f_f}/{area}',['as'=>'excelReportProformAbstract','uses'=>'ProformaController@excelReportProformAbstract']);


/*Servicios*/

/*--------------Personal------------------------*/

Route::post('service/getPersonalByDNI',['as'=>'ServicegetPersonalByDNI',
	'uses'=>'HelperController@getPersonalByDNI']);

/*Horas por personal de fecha a fecha*/

Route::post('service/getHorasByFechas',['as'=>'ServiceGetHorasByFechas','uses'=>'PersonaController@ServiceGetHorasByFechas']);



/*-------------Contrato ----------------------*/
Route::get('contratos',['as'=>'modContratos']);
Route::get('contratos/getAllContratos',['as'=>'getAllContratos','uses'=>'ContratoController@index']);
Route::post('contratos/regContrato',['as'=>'regContrato','uses'=>'ContratoController@regContrato']);
Route::post('contratos/editContrato',['as'=>'editContrato','uses'=>'ContratoController@editContrato']);
Route::post('contratos/renovContrato',['as'=>'renovContrato','uses'=>'ContratoController@renovContrato']);
Route::get('contratos/getById/{id}',['as'=>'getContratoById','uses'=>'ContratoController@getById']);




//-------solo para pruebas unitarias --->
Route::get('helper/getPersonalOrderAll',['as'=>'prueba','uses'=>'HelperController@prueba']);
Route::get('helper/sendMail',['as'=>'sendMail','uses'=>'HelperController@sendMail']);
Route::get('helper/fecha',['as'=>'fecha','uses'=>'HelperController@fecha']);

//importo las rutas de logistica
require __DIR__ . '/Routes/logistica.php';

//importa las rutas para administracion
require __DIR__ . '/Routes/administracion.php';
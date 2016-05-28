<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 23/05/2016
 * Time: 15:47
 */

/*empieza el modulo de orden de servicio*/

Route::get('os',['as'=>'modOS']);
Route::post('os/regNewOS',['as'=>'regOS','uses'=>'OrdenServicioController@regOS']);
Route::get('os/getOsByIdProforma/{id}',['as'=>'getOsByIdProforma','uses'=>'OrdenServicioController@getOsByIdProforma']);
Route::get('os/viewAllOS',['as'=>'viewAllOS','uses'=>'OrdenServicioController@viewAllOS']);


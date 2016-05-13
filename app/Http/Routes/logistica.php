<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 18/03/2016
 * Time: 05:44 PM
 */


Route::get('productos',['as'=>'modProductos']);
Route::get('productos/index',['as'=>'productoIndex','uses'=>'ProductoController@index']);
Route::post('productos/importarDatos',['as'=>'importarDatos','uses'=>'ProductoController@importarDatos']);
Route::post('productos/getByCategoriaAndCriterio',['as'=>'getByCategoriaAndCriterio',
    'uses'=>'ProductoController@getByCategoriaAndCriterio']);


Route::get('categoria',['as'=>'modCategorias']);
Route::get('categoria/all',['as'=>'categoriaAll','uses'=>'ProductoController@getAllCategoria']);


//----------------
Route::get('compras',['as'=>'modCompras']);
Route::get('compras/index',['as'=>'comprasIndex','uses'=>'ComprasController@index']);
Route::get('compras/new',['as'=>'newCompra','uses'=>'ComprasController@newCompra']);
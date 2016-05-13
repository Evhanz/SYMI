<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 22/03/2016
 * Time: 10:14 AM
 */

namespace symi\Http\Controllers;


class ComprasController extends Controller
{

    public function index(){

        return view('Logistica/compras/comprasAll');

    }

    public function newCompra(){
        return view('Logistica/compras/comprasNew');
    }

}
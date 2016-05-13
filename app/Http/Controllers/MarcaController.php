<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 24/06/2015
 * Time: 04:32 PM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\MarcaRep;

class MarcaController extends Controller{

    protected $marcaRep;

    public function __construct(MarcaRep $marcaRep){

        $this->marcaRep = $marcaRep;

    }

    public function index(){


        //$marca = $this->marcaRep->find(1)->toJson();

        dd("hola");


    }


}
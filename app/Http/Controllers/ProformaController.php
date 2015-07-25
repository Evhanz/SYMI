<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 15/07/2015
 * Time: 09:41 AM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\ProformaRep;

class ProformaController extends Controller{

    public $proformaRep;

    public function __construct(ProformaRep $proformaRep){

        $this->proformaRep = $proformaRep;

    }


    public function getProformasByNumero($numero){

        $proformas = $this->proformaRep->all();

        return view('RH/proforma/viewProformas',compact('proformas'));


    }


    public function viewNewProforma(){

         return view('RH/proforma/viewNewProforma');
    }


    public function regProforma(){

        $data = \Input::all();

        dd($data);
    }


    public function index($numero){

    }

}
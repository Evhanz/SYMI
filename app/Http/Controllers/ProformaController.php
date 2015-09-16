<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 15/07/2015
 * Time: 09:41 AM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\ProformaRep;
use Symi\Repositories\AreaRep;


class ProformaController extends Controller{

    public $proformaRep;
    public $areaRep;

    public function __construct(ProformaRep $proformaRep,AreaRep $areaRep){

        $this->proformaRep = $proformaRep;
        $this->areaRep = $areaRep;

    }


    public function getProformasByNumero($numero){

        $proformas = $this->proformaRep->all();

        return view('RH/proforma/viewProformas',compact('proformas'));


    }


    public function viewNewProforma(){

        $areas = $this->areaRep->all();

         return view('RH/proforma/viewNewProforma',compact('areas'));
    }


    public function regProforma(){
        $areas = $this->areaRep->all();
        $data = \Input::all();
        $bandera = $this->proformaRep->regProforma($data);

        if ($bandera === 1) {
           return \Redirect::route('viewProformas',['&'])->with(array('confirm' => 'Proforma Registrada con exito'));
        }else
            return view('RH/proforma/viewNewProforma',compact('data','areas'))->withErrors($bandera);

       
    }
    public function ViewUpdateProforma($id)
    {
        
        $proforma = $this->proformaRep->find($id);
        $areas = $this->areaRep->all();
        return view('RH/proforma/viewUpdateProforma',compact('proforma','areas'));


    }

    public function updateProforma()
    {
        $data = \Input::all();

        $bandera = $this->proformaRep->updateProforma($data);

        if($bandera === 1){
            return \Redirect::route('viewProformas',['&'])->with(array('confirm' => 'Proforma Actualizada'));
        }
        else{

            return  redirect()->back()->withInput()->withErrors($bandera);
        }
    }


    public function index($numero){

    }

}
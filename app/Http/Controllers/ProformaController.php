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
use Symi\Repositories\ProformaTareoRep;
use Symi\Repositories\PersonalTareoRep;

class ProformaController extends Controller{

    public $proformaRep;
    public $areaRep;
    public $proformaTareoRep;
    public $personalTareoRep;

    public function __construct(ProformaRep $proformaRep,AreaRep $areaRep,
        ProformaTareoRep $proformaTareoRep,PersonalTareoRep $personalTareoRep){

        $this->proformaRep = $proformaRep;
        $this->areaRep = $areaRep;
        $this->proformaTareoRep = $proformaTareoRep;
        $this->personalTareoRep = $personalTareoRep;

    }


    public function getProformasByNumero($numero){

        $proformas = $this->proformaRep->all();
        $areas = $this->areaRep->all();

        return view('RH/proforma/viewProformas',compact('proformas','areas'));
    }


    public function getProformasByAreaOrNumero()
    {
        # code...

        $data = \Input::all();
        

        if ($data['numero']!="-" && strlen($data['numero'])>=1 ) {

            /*llamar a la funcion de getProformas by area y fechas*/
            $proforma = $this->proformaRep->GetProformaByNumero($data['numero']);

            if (count($proforma)) {
                foreach ($proforma as $prof) {
                    $prof->areaDesc = $prof->area->descripcion;
                }
                
            }
            //$proforma->areaDesc = $proforma->area->descripcion;
            return \Response::json($proforma);
        } else {

            /*llamar a la funcion de traer proformas por area*/
            
            $proformas = $this->proformaRep->getProformaByArea($data['area']);

            return \Response::json($proformas);
            
        }

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



    /*Reportes -------------*/



    public function getReporteDetalleProformaById($id)
    {

        /*primero llamamos toda la proforma*/

        $proforma = $this->proformaRep->find($id);

        /*luego llamamos a el detalle personal de tareo para sacar todo el costo segun la
          proforma*/

        $personalTareos = $this->personalTareoRep->getTareoPersonalByProforma($id);

        /*luego llamaos el detalle de avance  para su visualizacion - puede ser opcional*/

        $proformaTareos = $this->proformaTareoRep->getProformaTareoByProforma($id);



        return view('RH/Reportes/viewReporteProforma',compact('proforma','personalTareos'
            ,'proformaTareos'));
    }



    

}
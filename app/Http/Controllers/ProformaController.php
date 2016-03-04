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


    public function getInitAlldata()
    {

        $proformas = $this->proformaRep->getInitAlldata();

        return \Response::json($proformas);
       
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


    public function getProformaNoClosed(){


        $proformas = $this->proformaRep->getProformaNoClosed();

        //return \Response::json($proformas);

        return $proformas;

    }

    public function viewGetProformaNoClosed(){

        return view('RH/Reportes/viewReporteGetProformasNoClosed');

    }


    public function getEstadoOfProforma($id){

        $estados = $this->proformaRep->getEstadoOfProforma($id);

        return  \Response::json($estados);

    }

    public function regEstadoNew(){

        $data = \Input::all();

        try{

            $this->proformaRep->newEstado($data['tipo'],$data['proforma'],$data['fecha'],$data['observacion']);

            $mensaje = ['mensaje'=>'Correcto','type'=>'1'];


            return \Response::json($mensaje);

        }catch(\Exception $e){

            $mensaje = ['mensaje'=>'Incorrecto'.$e,'type'=>'0'];


            return \Response::json($mensaje);

        }


    }


    public function getEstadoByID($id){

        return $this->proformaRep->getEstadoByID($id);

    }

    public function updateEstado(){

        $data = \Input::all();

        try{

            $this->proformaRep->editEstado($data['idEstado'],$data['tipo'],
                $data['proforma'],$data['fecha'],$data['observacion']);

            $mensaje = ['mensaje'=>'Correcto','type'=>'1'];


            return \Response::json($mensaje);

        }catch(\Exception $e){

            $mensaje = ['mensaje'=>'Incorrecto'.$e,'type'=>'0'];


            return \Response::json($mensaje);

        }

    }


    private function validateEstadoBeforeUp($data){

        $bandera = $this->proformaRep->getEstadoByProformaAndFecha($data['fecha'],$data['proforma']);

        return $bandera;
    }

    public function getReportAdminByProforms()
    {
        $data = \Input::all();

        $proformas = $this->proformaRep->getProformaByFechasbyAreasWithDetails($data['fecha_ini'],$data['fecha_fin'],$data['area']);

        return \Response::json($proformas);

        //dd($proformas);
    }


    public function viewGetReportByProforms(){

        return view('RH/Reportes/viewReportAdminByProforms');

    }

    public function excelReportProformAbstract($f_i,$f_f,$area){

        $proformas = $this->proformaRep->getProformaByFechasbyAreasWithDetails($f_i,$f_f,$area);

        \Excel::create('New file', function($excel) use ($proformas){

            $excel->sheet('New sheet', function($sheet) use ($proformas) {

                $sheet->loadView('RH.Exports.excelProformDetailAbstract',array('proformas' => $proformas));

            });

        })->export('xls');;

    }

    public function getCostoOfAreaByFechas($f_i,$f_f){

        $proformas = $this->proformaRep->getGananciaRealRHPorAreaByFechas($f_i,$f_f);

        return \Response::json($proformas);

    }



    

}
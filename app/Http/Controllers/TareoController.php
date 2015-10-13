<?php

namespace symi\Http\Controllers;
use Symi\Repositories\ProformaRep;
use Symi\Repositories\AreaRep;
use Symi\Repositories\TareoRep;

class TareoController extends Controller{

    protected $proformaRep;
    protected $areaRep;
    protected $tareoRep;

    public function __construct(ProformaRep $proformaRep,AreaRep $areaRep,TareoRep $tareoRep){

        $this->proformaRep = $proformaRep;
        $this->areaRep = $areaRep;
        $this->tareoRep = $tareoRep;

    }

    public function index(){

    }

    public function viewTareo()
    {
        $tareos = $this->tareoRep->all();
        $areas = $this->areaRep->all();
    	return view('RH/tareo/viewTareos',compact('tareos','areas'));
    }

    public function newTareo()
    {

        $areas = $this->areaRep->all();

        return view('RH/tareo/viewNewTareo',compact('areas'));
    }


    public function viewUpdateTareo($id)
    {
        $areas = $this->areaRep->all();
        $tareo = $this->tareoRep->find($id);

        return view('RH/tareo/viewUpdateTareo',compact('tareo','areas'));
    }

    public function regTareo()
    {
        $data = \Input::all();
         

        $tareo = array('fecha'=>$data['fecha'],'area_id'=>$data['idArea'],'observacion'=>$data['observacion']);
        
        /*primero registramos el tareo*/
        $bandera = $this->tareoRep->regTareo($tareo);

        if ($bandera>0) {
            /*luego registramos sus detalles*/


            /*aca se agrega los detalle del tareo del personal*/
            foreach ($data['detallePersonal'] as $detalle) {
                
                $a = $this->tareoRep->regDetalleTareoPesonal($detalle,$bandera);
                //return \Response::json($a);    
            }
            
            /*aca se agrega los detalle de avance*/
            foreach ($data['detalleAvanceProforma'] as $detalle) {
                try {
                    $this->tareoRep->RegAvanceProforma($detalle,$bandera);
                    
                } catch (\Exception $e) {
                    //return \Response::json($e);
                   
                }
            }
            //return \Response::json($data['detalleAvanceProforma']);
        }
       // return \Response::json($bandera);

    }

    public function getDetallePersonal()
    {
        $data = \Input::all();
        $personal = $this->tareoRep->find($data['id'])->detalleTareo;
        return \Response::json($personal);
    }

    public function getDetalleAvance()
    {
        $data = \Input::all();
        $avances = $this->tareoRep->find($data['id'])->AvanceProforma;
        return \Response::json($avances);
    }


    public function updateTareo()
    {
        $data = \Input::all();


        /**/

        $tareo = $this->tareoRep->find($data['idTareo']);        
        $tareo->fecha = $data['fecha'];
        $tareo->observacion = $data['observacion'];
        $tareo->area_id = $data['idArea'];
        $tareo->save();

        $this->tareoRep->DeleteDetallesTareo($tareo->id);
         /*aca se agrega los detalle del tareo del personal*/
            foreach ($data['detallePersonal'] as $detalle) {
                
                $a = $this->tareoRep->regDetalleTareoPesonal($detalle,$tareo->id);
                //return \Response::json($a);    
            }
            
            /*aca se agrega los detalle de avance*/
            foreach ($data['detalleAvanceProforma'] as $detalle) {
                try {
                    $this->tareoRep->RegAvanceProforma($detalle,$tareo->id);
                    
                } catch (\Exception $e) {
                    //return \Response::json($e);
                   
                }
            }


        /**/

        return \Response::json($tareo);
    }

    public function getTareosByAreaAndFecha()
    {
        $data = \Input::all();



        if (isset($data['fecha_inicio']) && isset($data['fecha_fin']) ) {

           // return \Response::json("con fechas");
            $tareos = $this->tareoRep->getTareosByAreaAndFecha($data['area'],$data['fecha_inicio'],
                $data['fecha_fin']);
        } else {

            $tareos = $this->tareoRep->getTareoByArea($data['area']);         
        }
        
        return \Response::json($tareos);

    }


}
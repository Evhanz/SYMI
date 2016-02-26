<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 14/07/2015
 * Time: 05:29 PM
 */

namespace Symi\Repositories;
use Symi\Entities\Tareo;
use Symi\Entities\Area;
use Symi\Entities\Persona;
use Symi\Entities\Proforma;
use Symi\Entities\PersonalTareo;
use Symi\Entities\ProformaTareo;

class TareoRep {

    public function all(){
        return Tareo::all();
    }

    public function find($id)
    {
        # code...
        return Tareo::find($id);
    }

    public function regTareo($data)
    {
        $tareo = new Tareo();
        $tareo->fecha = $data['fecha'];
        $tareo->observacion = $data['observacion'];
        $tareo->area_id = $data['area_id'];
        if ($tareo->save()) {
            return $tareo->id;
        }else 
            return 'no';

    }

    public function regDetalleTareoPesonal($detalle,$tareoID)
    {

        $persona = Persona::find($detalle['id']);
        $tareo = Tareo::find($tareoID);
        $tareo->detalleTareo()->attach($persona,['h_trabajadas' => $detalle['hora'],
            'costo_h' => $persona->costo_h,'proforma_id' => $detalle['idProforma']]);
        
    }

    public function RegAvanceProforma($detalle,$tareoID)
    {

        /*detalle['id']  ---  es el id de proforma*/

        $tareo = Tareo::find($tareoID);

        $tareo->AvanceProforma()->attach($detalle['id'],['avance_ref'=>$detalle['avance']]);

    }

    public function DeleteDetallesTareo($tareoId)
    {

       PersonalTareo::where('tareo_id',$tareoId)->delete();
       ProformaTareo::where('tareo_id',$tareoId)->delete();
        
    }

    public function getTareosByAreaAndFecha($area,$fechaInicio,$fechaFin)
    {
        /*se copmento par usar otra forma de utilizar los get Model
        $tareos = Tareo::select('tareos.id','tareos.fecha','areas.descripcion as area')
                        ->join('areas', 'areas.id', '=', 'tareos.area_id')
                        ->where('area_id','like',$area)
                        ->where('fecha','>=',$fechaInicio)
                        ->where('fecha','<=',$fechaFin)
                        ->get();*/

        $tareos = Tareo::where('fecha','>=',$fechaInicio)
                        ->where('fecha','<=',$fechaFin)->with('area')
                        ->orderBy('fecha','desc')
                        ->get();
        return $tareos;
        
    }

    public function getTareoByArea($area)
    {
        /*
        $tareos = Tareo::select('tareos.id','tareos.fecha','areas.descripcion as area')
                        ->join('areas', 'areas.id', '=', 'tareos.area_id')
                        ->where('area_id','like',$area)->get();*/

         $tareos = Tareo::where('area_id','like',$area)
                        ->with('area')
                        ->orderBy('fecha','desc')
                        ->get();            

        return $tareos;
    }

    /*solo usar en caso de emergencia nunca usar en produccion*/

    public function updateCostosPersonal()
    {

        /*
        # code...
        $personalTareos = PersonalTareo::all();

        foreach ($personalTareos as $personalTareo) {
            
            $idPersona = $personalTareo->persona_id;

            $persona = Persona::find($idPersona);

            $personalTareo->costo_h = $persona->costo_h;
            $personalTareo->save();

        }*/

        

    }

    public function getInitTareoAll()
    {
        $proformas = Tareo::orderBy('id','desc')->take(20)->with('area')->get();

        return $proformas;
    }


   


}
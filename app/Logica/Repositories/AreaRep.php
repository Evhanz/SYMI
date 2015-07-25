<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 14/07/2015
 * Time: 05:29 PM
 */

namespace Symi\Repositories;
use Symi\Entities\Area;


class AreaRep {

    public function all(){
        return Area::all();
    }


    public function getById($id){
        return Area::find($id);
    }


    public function getAreaByCriterio($criterio){


        $areas = Area::where('descripcion', 'like','%'.$criterio.'%')->get();
        return $areas;

    }

    public function regArea($data){

        $area = new Area();

        $area->descripcion = $data['descripcion'];
        $area->observacion = $data['observacion'];

        if($area->save()){
            return 1;
        }else {
            return "Los datos no son correctos";
        }


    }









}
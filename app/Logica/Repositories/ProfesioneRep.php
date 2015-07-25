<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 13/07/2015
 * Time: 11:12 AM
 */

namespace Symi\Repositories;
use Symi\Entities\Profesione;

class ProfesioneRep {

    public function all(){
        $profesiones = Profesione::all();
        return $profesiones;
    }


    public function getProfesionByCriterio($criterio){
        $criterio ='%'.$criterio.'%';
        $profesiones = Profesione::where('descripcion', 'like',$criterio)->get();

        return $profesiones;

    }

    public function regProfesion($data){

        $profesion = new Profesione();
        $profesion->descripcion = $data['descripcion'];
        $profesion->observacion = $data['observacion'];

        if($profesion->save()){
            return 1;
        }else{
            return "No es posible guardar la profesion revise los datos de ingreso";
        }


    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 14/07/2015
 * Time: 05:28 PM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\AreaRep;


class AreaController extends Controller{

    public $areaRep;

    public function __construct(AreaRep $areaRep){
        $this->areaRep = $areaRep;
    }

    public function index(){

        dd($this->areaRep->all());
    }


    public function viewArea($criterio){

        if($criterio == '&'){
            $areas = $this->areaRep->all();
        }else{
            $areas = $this->areaRep->getAreaByCriterio($criterio);
        }

        return view('RH/personal/viewArea',compact('areas'));

    }

    public function regArea(){

        $data = \Input::all();

        $bandera = $this->areaRep->regArea($data);

        if($bandera == 1){
            return \Redirect::route('viewAreas',['criterio' => "&"])->with(array('confirm' => 'Area Registrada'));
        }else{
            return \Redirect::route('viewAreas',['criterio' => "&"])->with(array('fail' => $bandera));

        }


    }

    public function viewAsignarArea($id){


        $area = $this->areaRep->getById($id);




        return view('RH/personal/viewAreaTrabajador',compact('area'));

    }


    public function regEncargadoArea(){





    }





}
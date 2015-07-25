<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 13/07/2015
 * Time: 06:30 PM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\ProfesioneRep;


class ProfesioneController extends Controller {

    public $profesioneRep;

    public function __construct(ProfesioneRep $profesioneRep){

        $this->profesioneRep = $profesioneRep;
    }

    public function getProfesiones($criterio){

        if($criterio == '&'){
            $criterio = '';
        }

        $profesiones = $this->profesioneRep->getProfesionByCriterio($criterio);

        return view('RH/personal/viewProfesion',compact('profesiones'));

    }


    public function regProfesion(){
        $data = \Input::all();

        $bandera = $this->profesioneRep->regProfesion($data);

        if($bandera == 1){
            return \Redirect::route('viewProfesiones',['criterio' => "&"])->with(array('confirm' => 'Profesion Registrada'));
        }else{
            return \Redirect::route('viewProfesiones',['criterio' => "&"])->with(array('fail' => $bandera));

        }


    }

    public function index(){

        dd('hola');
    }



}
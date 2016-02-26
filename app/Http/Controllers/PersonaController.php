<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 07/07/2015
 * Time: 12:36 PM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\PersonaRep;
use Symi\Repositories\ProfesioneRep;


class PersonaController extends Controller{

    public $personaRep;
    public $profesioneRep;

    public function __construct(PersonaRep $personaRep,ProfesioneRep $profesioneRep){

        $this->personaRep = $personaRep;
        $this->profesioneRep = $profesioneRep;


    }

    public function index(){
        $personas = $this->personaRep->all();

        dd($personas);

    }

    public function viewGetAllPersonas(){

        $personas = $this->personaRep->getAllPersonas();
        return view('RH/personal/personas',compact('personas'));

    }

    public function getPersonaByCriterios($criterio,$dni){

        $personas = $this->personaRep->getPersonasByCriterios($criterio,$dni);
        return view('RH/personal/personas',compact('personas','criterio','dni'));


    }

    public function viewNewPeronal(){

        $profesiones = $this->profesioneRep->all();

        return view('RH/personal/viewNewPersonal',compact('profesiones'));

    }


    public function regPersonal(){

        $data = \Input::all();

        $bandera = $this->personaRep->regPersona($data);

        if($bandera === 1){
            return \Redirect::route('personal')->with(array('confirm' => 'Personal Registrado'));
        }
        else{
            $profesiones = $this->profesioneRep->all();
            return view('RH/personal/viewNewPersonal',compact('data','profesiones'))->withErrors($bandera);
        }

    }


    public function getPersonalArea(){

    }

    public function updatePersonal($id)
    {

        $profesiones = $this->profesioneRep->all();
        return view('RH/personal/viewUpdatePersonal',compact('profesiones','id'));
        
    }

    public function getPersonalByID()
    {   
        $data = \Input::all();

        $personal = $this->personaRep->find($data['id']);

        return \Response::json($personal);
    }

    public function editPersonal()
    {
        $data = \Input::all();
        $id = $data['id'];
        $bandera = $this->personaRep->editPersonal($data);

        
        if($bandera === 1){
            return \Redirect::route('personal')->with(array('confirm' => 'Personal Actualizado'));
        }
        else{
            $profesiones = $this->profesioneRep->all();
            return  redirect()->back()->withInput()->withErrors($bandera);
        }
    }


    /*Servicios*/

    public function ServiceGetHorasByFechas()
    {
        $data = \Input::all();
        $id = $data['id'];

        $personal = $this->personaRep->find($id);

        $horas = $this->personaRep->GetHorasByFechas($id,$data['fecha_ini'],$data['fecha_fin']);

        return \Response::json($horas);


        
    }




}
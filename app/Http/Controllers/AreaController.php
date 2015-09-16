<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 14/07/2015
 * Time: 05:28 PM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\AreaRep;
use Symi\Repositories\PersonaRep;
use Symi\Entities\Area;


class AreaController extends Controller{

    public $areaRep;
    public $personaRep;

    public function __construct(AreaRep $areaRep,PersonaRep $personaRep){
        $this->areaRep = $areaRep;
        $this->personaRep = $personaRep;
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

    public function editArea()
    {
      $data = \Input::all();
      $bandera = $this->areaRep->editArea($data);
      if($bandera == 1){
            return \Redirect::route('viewAreas',['criterio' => "&"])->with(array('confirm' => 'Area Editada Correctamente'));
        }else{
            return \Redirect::route('viewAreas',['criterio' => "&"])->with(array('fail' => $bandera));

        }
    }


    public function viewAsignarArea($id){

        $encargado = 0;
        $area = $this->areaRep->getById($id);


        $personal = Area::find($id)->personal()->get();

        //para traer todos los empleados 
        $empleados = $personal->filter(function ($item) {
                if ($item->pivot->estado == true) {
                    return $item;
                }
            });
        //----


        //para saber cuantos encargados hay 
        $personal = $personal->filter(function ($item) {
                if ($item->pivot->tipo == 'encargado' && $item->pivot->estado == true) {
                    return $item;
                }
            });
        //----

        if ($personal->count() >=1)
            $encargado =1;    


        return view('RH/personal/viewAreaTrabajador',compact('area','encargado','empleados'));

    }



    //esto es para registrar a un encargado
    public function regEncargadoArea(){

      $data = \Input::all();

       // dd($data); idArea
      
      $personalGet = $this->personaRep->getPersonalByDNI($data['dni']);



      /*primero se valida*/

      $val = $this->areaRep->getExistPersonal($personalGet);

      if ($val == 0) {
        
        $area = Area::find($data['idArea']);

       
        $bandera = $this->areaRep->regPersonaArea($area,$personalGet,"encargado");

        if ($bandera == 'ok') {

          //dd('registrado');
          return \Redirect::route('viewAreaTrabajador',['id' => $data['idArea']])->with(array('confirm' => 'Encargado Registrado'));

        
        } else {
          return \Redirect::route('viewAreaTrabajador',['id' => $data['idArea']])->with(array('fail' => 'Error: Empleado'.$bandera));
        }
      } else {
        return \Redirect::route('viewAreaTrabajador',['id' => $data['idArea']])->with(array('fail' => 'Error: Empleado ya registrado , en otra area o aqui'));
      }       


    }


     //esto es para registrar a un empleado
    public function regEmpleadoArea(){

        $data = \Input::all();

       // dd($data); idArea

       $personalGet = $this->personaRep->getPersonalByDNI($data['dni']);

       $val = $this->areaRep->getExistPersonal($personalGet);

      if ($val == 0) {
        
        $area = Area::find($data['idArea']);

       
        $bandera = $this->areaRep->regPersonaArea($area,$personalGet,"empleado");

        if ($bandera == 'ok') {

          //dd('registrado');
          return \Redirect::route('viewAreaTrabajador',['id' => $data['idArea']])->with(array('confirm' => 'Encargado Registrado'));

        
        } else {
          return \Redirect::route('viewAreaTrabajador',['id' => $data['idArea']])->with(array('fail' => 'Error: Empleado'.$bandera));
        }
      } else {
        return \Redirect::route('viewAreaTrabajador',['id' => $data['idArea']])->with(array('fail' => 'Error: Empleado ya registrado , en otra area o aqui'));
      }      
       
    }


    /*==== para servicios =====*/

    public function getAreasJSON()
    {
      $areas = $this->areaRep->all();

      return $areas->toJson();
    }

    public function getPersonalByAreaId(){

      $data = \Input::all();
      $idArea = $data['area'];

      $area = Area::find($idArea);
      $personal = $area->personal;

      return \Response::json($personal);


    }

    public function prueba($id){
      
      $area = Area::find($id);
      $personal = $area->personal;
      dd($personal);

    }

    public function getAreaById()
    {
      $data = \Input::all();
      $area = Area::find($data['id']);

      return  \Response::json($area);
    }


}
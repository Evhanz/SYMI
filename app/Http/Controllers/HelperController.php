<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 17/07/2015
 * Time: 10:28 AM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\PersonaRep;


class HelperController extends Controller{

    public $personaRep;

    public function __construct(PersonaRep $personaRep){
        $this->personaRep= $personaRep;
    }


    public function getPersonalByDNI(){

        $data = \Input::all();
        //return $data['dni'];
       $personal = $this->personaRep->getPersonalByDNI($data['dni']);
       return $personal->toJson();


    }




}
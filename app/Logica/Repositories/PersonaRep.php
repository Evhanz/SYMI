<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 25/06/2015
 * Time: 04:25 PM
 */

namespace Symi\Repositories;
use Symi\Entities\Persona;

class PersonaRep  {

    public function all(){
        $persona = Persona::all();
        return $persona;
    }




}
<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 17/07/2015
 * Time: 10:28 AM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\PersonaRep;
use Symi\Repositories\ProformaRep;


class HelperController extends Controller{

    public $personaRep;
    public $proformaRep;

    public function __construct(PersonaRep $personaRep,ProformaRep $proformaRep){
        $this->personaRep= $personaRep;
        $this->proformaRep = $proformaRep;
    }


    public function getPersonalByDNI(){

        $data = \Input::all();
        //return $data['dni'];
       $personal = $this->personaRep->getPersonalByDNI($data['dni']);
       return $personal->toJson();


    }

    public function hGetProformaById(){

        $data = \Input::all();
        $numero = $data['id'];


        $proforma = $this->proformaRep->GetProformaByNumero($numero);

        return \Response::json($proforma);


    }

    public function prueba(){

        
        
        $personal = $this->personaRep->orderPersonal();

        return \Response::json($personal);

        /*

        $proforma = $this->proformaRep->GetProformaByNumero($numero);

        return \Response::json($proforma);*/

    }

    public function getNumberProforma()
    {
        $data = \Input::all();
        $id = $data['idProforma'];

        $proforma = $this->proformaRep->find($id);

        return $proforma->numero;

    }




}
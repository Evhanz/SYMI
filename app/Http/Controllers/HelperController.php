<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 17/07/2015
 * Time: 10:28 AM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\ContratoRep;
use Symi\Repositories\PersonaRep;
use Symi\Repositories\ProformaRep;
use Symi\Repositories\TareoRep;


class HelperController extends Controller{

    public $personaRep;
    public $proformaRep;
    public $tareoRep;
    public $contratoRep;

    public function __construct(PersonaRep $personaRep,ProformaRep $proformaRep,
                                TareoRep $tareoRep,ContratoRep $contratoRep){
        $this->personaRep= $personaRep;
        $this->proformaRep = $proformaRep;
        $this->tareoRep = $tareoRep;
        $this->contratoRep = $contratoRep;
    }


    public function getPersonalByDNI(){

        $data = \Input::all();
        //return $data['dni'];
       $personal = $this->personaRep->getPersonalByDNI($data['dni']);
       return $personal->toJson();


    }

    /*este metodo trae a una proforma por el numero*/
    public function hGetProformaById(){

        $data = \Input::all();
        $numero = $data['id'];


        $proforma = $this->proformaRep->GetProformaFindByNumero($numero);

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


    public function updateCostosPersonal()
    {
        /*no usar
        $this->tareoRep->updateCostosPersonal();
        dd('Pro');
        */

    }

    public function sendMail()
    {

        $data = ['email'=>'eidel_12@hotmail.com','subject'=>'enviando ','body'=>'esto solo es un mensaje de prueba'];

        try{
            $sent = \Mail::send('main/main', $data, function($message) use ($data)
            {
                //remitente
                $message->from($data['email'],'eidelman');

                //asunto
                $message->subject($data['subject']);

                //receptor
                $message->to('eidelhs@gmail.com','eidel');

            });


            if( ! $sent) dd("something wrong");
            dd($sent);

        }catch(\Exception $e){
            dd($e);

        }

    }


    public function fecha(){

        /*
        $fecha = date('Y-m-d');

        dd($fecha);
        */

        $contratos = $this->contratoRep->getContratosPorVencer();



        return view('emails/mailContratosVencidos',compact('contratos'));




    }



}
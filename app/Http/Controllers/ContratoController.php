<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 24/06/2015
 * Time: 04:32 PM
 */

namespace symi\Http\Controllers;
use Symi\Repositories\ContratoRep;

class ContratoController extends Controller{

    protected $contratoRep;

    public function __construct(ContratoRep $contratoRep){

        $this->contratoRep = $contratoRep;

    }

    public function index(){

    	$contratos = $this->contratoRep->all();

    	return view('RH/Contratos/viewAllContratos',compact('contratos'));


    }

    public function regContrato()
    {
        $data = \Input::all();

        $bandera = $this->validateRegContrato($data['f_inicio'],$data['f_fin'],$data['idPersonal']);

        if($bandera == 0){
            try{

                $this->contratoRep->regContrato($data);

                return  redirect()->back()->with(array('confirm' => 'Contrato creado correctamente'));

            }catch(\Exception $e){

                return  redirect()->back()->withInput()->withErrors($e);

            }

        }else{
            return  redirect()->back()->with(array('error' => 'ya existe un contrato en esas fechas'));
        }



    }

    public function editContrato()
    {
        $data = \Input::all();


        $bandera = $this->validateRegContrato($data['f_inicio'],$data['f_fin'],$data['idPersonal']);

        if($bandera <= 1){
            try{
                $this->contratoRep->editContrato($data);
                return  redirect()->back()->with(array('confirm' => 'Contrato actualizado correctamente'));

            }catch(\Exception $e){
               return  redirect()->back()->withInput()->withErrors($e);

            }

        }else{
            return  redirect()->back()->with(array('error' => 'ya existe un contrato en esas fechas'));

        }


    }

    public function renovContrato()
    {
        $data = \Input::all();


        try{

            /*primero se cambia el estado del contrato a renovado*/

            $this->contratoRep->changeStateContrato('renovado',$data['idContrato']);


            /*luego se crear el nuevo contrato*/

            $this->contratoRep->regContrato($data);

            return  redirect()->back()->with(array('confirm' => 'Renovacion creada correctamente'));

        }catch(\Exception $e){

            return  redirect()->back()->withInput()->withErrors($e);

        }


    }

    private function validateRegContrato($f_inicio,$f_fin,$id_persona){

        $bandera = count($this->contratoRep->getContratoByFechas($f_inicio,$f_fin,$id_persona));

        return $bandera;

    }

    public function getById($id){

        $contrato = $this->contratoRep->getContratoById($id);
        return \Response::json($contrato);
    }




}
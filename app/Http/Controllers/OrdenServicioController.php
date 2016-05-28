<?php

namespace symi\Http\Controllers;

use Symi\Repositories\OrdenServicioRep;


class OrdenServicioController extends Controller
{

    protected $ordenServicioRep;



    public function __construct(OrdenServicioRep $ordenServicioRep)
    {
        $this->ordenServicioRep = $ordenServicioRep;
    }

    public function viewAllOS()
    {

        $os = $this->ordenServicioRep->allOrdenServicio();

        return view('RH/os/viewAllOS',compact('os'));


    }


    public function regOS()
    {
        $data = \Input::all();

        if($data['tipo']=='nuevo'){

            try{
                $bandera =  $this->ordenServicioRep->regOrdenServicio($data);

                if($bandera == "ok"){

                    return "ok";

                }else{
                    return "error-{";
                }

            }catch(\Exception $e){

                return "error-'";

            }

        }else{
            try{
                $bandera =  $this->ordenServicioRep->editOrdenServicio($data);

                if($bandera == "ok"){

                    return "ok";

                }else{
                    return 'errores :'.$bandera;
                }

            }catch(\Exception $e){

                return "error: ".$e;

            }
        }
        //return \Response::json($data);

    }

    public function getOsByIdProforma($id)
    {
        $os = $this->ordenServicioRep->getOrdenServicioByIdProforma($id);

        return $os;
    }


}

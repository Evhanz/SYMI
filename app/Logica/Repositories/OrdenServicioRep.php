<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 23/05/2016
 * Time: 10:09
 */

namespace Symi\Repositories;

use Symi\Entities\OrdenServicio;

class OrdenServicioRep
{


    public function allOrdenServicio(){

        $ordenServicio = OrdenServicio::all();

        return $ordenServicio;

    }

    public function getOrdenServicioByIdProforma($id){

        $ordenServicio = OrdenServicio::where('id_proforma','=',$id)->first();

        return  $ordenServicio;
    }

    public function regOrdenServicio($data)
    {


        /*sacamos los datos qu quedan fuera de validacion*/

        $adjunto = $data['adjunto'];
        $observacion = $data['observacion'];

        /*-----------*/

        $rules = [

            'descripcion'=>'required',
            'numero'=>'required|unique:orden_servicio',
            'n_pedido'=>'required',
            'monto'=>'required',
            'color'=>'required',
            'id_proforma'=>'required'
        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $os = new OrdenServicio($data);
            $os->observacion = $observacion;
            if($adjunto!='-')
            {
                $extension = strtolower($adjunto->getClientOriginalExtension());
                $fileName = $data['numero'].$extension;
                $path = public_path() . '\subidas\os';
                // $path = "subidas/proformas/";
                $adjunto->move($path,$fileName);
            }


            $os->save();

            return "ok";



        }else{
            return "error";
        }



    }


    public function editOrdenServicio($data)
    {

        /*sacamos los datos qu quedan fuera de validacion*/

        $adjunto = $data['adjunto'];
        $observacion = $data['observacion'];
        $id = $data['idOS'];

        /*-----------*/

        $rules = [

            'descripcion'=>'required',
            'numero'=>'required|unique:orden_servicio,numero,'.$data['idOS'],
            'n_pedido'=>'required',
            'monto'=>'required',
            'color'=>'required',
            'id_proforma'=>'required'
        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $os = OrdenServicio::find($id);
            $os->descripcion = $data['descripcion'];
            $os->numero = $data['numero'];
            $os->n_pedido = $data['n_pedido'];
            $os->monto = $data['monto'];
            $os->color = $data['color'];
            $os->id_proforma = $data['id_proforma'];
            $os->observacion = $observacion;
            if($adjunto!='-')
            {
                $extension = strtolower($adjunto->getClientOriginalExtension());
                $fileName = $data['numero'].$extension;
                $path = public_path() . '\subidas\os';
                // $path = "subidas/proformas/";
                $adjunto->move($path,$fileName);
            }
            $os->save();
            return "ok";
        }else{
            return $validation->messages();
        }

    }


}
<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 15/07/2015
 * Time: 09:43 AM
 */

namespace Symi\Repositories;
use Symi\Entities\Proforma;


class ProformaRep {

    public function all(){
        return Proforma::all();
    }

    public function regProforma($data){

        $rules=[

            'numero' => 'required|min:4',
            'descripcion' => 'required|min:4',
            'monto_MO' => 'required|min:4',
            'f_inicio' => 'required',
            'n_dias' => 'required',

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

    }

}
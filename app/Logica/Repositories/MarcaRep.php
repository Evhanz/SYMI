<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 24/06/2015
 * Time: 04:06 PM
 */

namespace Symi\Repositories;
use Symi\Entities\Marca;

class MarcaRep {

    public function find($id){
        return Marca::find($id);
    }


}
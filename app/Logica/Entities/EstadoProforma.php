<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 27/06/2015
 * Time: 12:13 PM
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;

class EstadoProforma extends Model{

    public function proforma(){

        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Proforma','proforma_id','id');
    }

}
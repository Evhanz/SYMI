<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 27/06/2015
 * Time: 11:07 AM
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;

class ProformaTareo extends Model{

    protected $table = 'proforma_tareo';

    public function proforma(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Proforma','proforma_id','id');
    }

    public function tareo(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Tareo','tareo_id','id');
    }



}
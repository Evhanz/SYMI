<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 27/06/2015
 * Time: 12:13 PM
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;

class Contrato extends Model{

	protected $table = 'contratos';

	public function personal(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Persona','id_persona','id');
    }

}
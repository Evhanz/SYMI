<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 27/06/2015
 * Time: 12:10 PM
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;

class Tareo extends Model{

    /*relacion de tareo con area*/
    public function area()
    {
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Area','area_id','id');
    }



	/*en la BD la tabla es persona_tareos*/
	public function detalleTareo(){
        return $this->belongsToMany('Symi\Entities\Persona')
        ->withPivot('h_trabajadas','costo_h','proforma_id');
    }



    /*en la BD la tabla es proforma_tareos*/
    public function AvanceProforma()
    {
    	return $this->belongsToMany('Symi\Entities\Proforma')
        ->withPivot('avance_ref');
    
    }

}
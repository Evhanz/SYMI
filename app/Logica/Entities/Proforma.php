<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 27/06/2015
 * Time: 12:10 PM
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;

class Proforma extends Model{

	protected $fillable = array('numero','descripcion','monto_MO','maquinaria_equipo','materiales','f_inicio',
        'n_dias','maquinaria_equipo','materiales','tipo_moneda');

	public function area(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Area','area_id','id');
    }

    public function estados(){

        return $this->hasMany('Symi\Entities\EstadoProforma','proforma_id','id');

    }

    public function avance(){
        return $this->hasMany('Symi\Entities\ProformaTareo','proforma_id','id');
    }



}
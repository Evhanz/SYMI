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

    protected $subdescripcion;

	protected $fillable = array('numero','descripcion','monto_MO','maquinaria_equipo','materiales','f_inicio',
        'n_dias','maquinaria_equipo','materiales','tipo_moneda','h_proformadas','utilidad');

	public function area(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Area','area_id','id');
    }

    public function ordenServicio(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\OrdenServicio','id_os','id');
    }

    public function estados(){
        return $this->hasMany('Symi\Entities\EstadoProforma','proforma_id','id');
    }

    public function avance(){
        return $this->hasMany('Symi\Entities\ProformaTareo','proforma_id','id');
    }

    public function getSubdescripcionAttribute(){

        $sub = $this->descripcion;

        return substr($sub, 0, 30);

    }



}
<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 25/06/2015
 * Time: 04:25 PM
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;

class Persona extends Model {

    protected $fullname;

    protected $fillable = array('nombres','apellidoP','apellidoM','dni',
        'celular');


    //para formatear los nombre
    public function getFullnameAttribute() {
        return $this->nombres.' '.$this->apellidoP.' '.$this->apellidoM;
    }

    public function profesion(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Profesione','profesion_id','id');
    }

    public function area(){
        return $this->belongsToMany('Symi\Entities\Area')
        ->withPivot('f_inicio','f_fin','estado','tipo');
    }

}
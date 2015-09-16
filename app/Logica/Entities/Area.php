<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 27/06/2015
 * Time: 12:13 PM
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;

class Area extends Model{

    public function personal(){
        return $this->belongsToMany('Symi\Entities\Persona')
        ->withPivot('f_inicio','f_fin','estado','tipo');
    }



}
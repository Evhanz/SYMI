<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 23/05/2016
 * Time: 10:07
 */

namespace Symi\Entities;


use Illuminate\Database\Eloquent\Model;
class OrdenServicio extends Model
{

    protected $table="orden_servicio";

    protected $fillable = array('descripcion','numero','n_pedido','monto',
        'color');


    public function proforma(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->hasMany('Symi\Entities\Proforma','id_proforma','id');
    }


}
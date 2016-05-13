<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 17/03/2016
 * Time: 07:16 PM
 */

namespace Symi\Entities;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'producto';

    public function categoria(){
        //$this->belongsTo('entitie', 'local_key', 'parent_key');
        return $this->belongsTo('Symi\Entities\Categoria','Categoria_id','id');
    }

}
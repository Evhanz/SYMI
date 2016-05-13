<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 18/03/2016
 * Time: 12:52 PM
 */

namespace Symi\Repositories;

use Symi\Entities\Producto;
use Symi\Entities\Categoria;

class ProductoRep
{
    public function all(){
        return Producto::all();
    }

    public function regProducto($data){



    }

    public function getByCategoriaAndCriterio($data)
    {

        $criterio = '%'.$data['criterio'].'%';
        $categoria = $data['categoria'];

        if($categoria==0)
        {
            $producto = Producto::where('descripcion','like',$criterio)
                        ->with('categoria')
                        ->get();
        }else{

            $producto = Producto::where('descripcion','like',$criterio)
                ->where('Categoria_id','=',$categoria)
                ->with('categoria')
                ->get();

        }


        return $producto;

    }


    public function regProductoOfInsertExcelTipo1($data)
    {



        /*primero obtenemos si existe la categoria*/

        $categoria = Categoria::where('descripcion','like',$data->tipo)->first();

        if(count($categoria)<1){

            $categoria = new Categoria();
            $categoria->descripcion = $data->tipo;
            $categoria->save();
        }


        /*---------------*/

        $cant_pro = count(Producto::where('idproducto','like',$data->codigo)->get());

        if(!$cant_pro>0){
            $producto = new Producto();

            $producto->idproducto = $data->codigo;
            $producto->descripcion = $data->descripcion;
            $producto->modelo = $data->modelo;
            $producto->serie = $data->serie;
            $producto->marca = $data->marca;
            $producto->estado = $data->estado;
            $producto->alias = $data->alias;
            $producto->energia_necesaria = $data->energia_necesario;
            $producto->Categoria_id = $categoria->id;
            $producto->save();
        }




    }

    public function getAllCategorias(){
        $categoria = Categoria::all();

        return $categoria;
    }

}
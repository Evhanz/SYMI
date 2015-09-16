<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 14/07/2015
 * Time: 05:29 PM
 */

namespace Symi\Repositories;
use Symi\Entities\Area;



class AreaRep {

    public function all(){
        return Area::all();
    }


    public function getById($id){
        return Area::find($id);
    }


    public function getAreaByCriterio($criterio){


        $areas = Area::where('descripcion', 'like','%'.$criterio.'%')->get();
        return $areas;

    }

    public function regArea($data){

        $area = new Area();

        $area->descripcion = $data['descripcion'];
        $area->observacion = $data['observacion'];

        if($area->save()){
            return 1;
        }else {
            return "Los datos no son correctos";
        }

    }

    public function editArea($data){

        $area = Area::find($data['id']);

        $area->descripcion = $data['descripcion'];
        $area->observacion = $data['observacion'];

        if($area->save()){
            return 1;
        }else {
            return "Los datos no son correctos";
        }

    }

    public function regPersonaArea($area,$personalGet,$tipo)
    {
        


       $mensaje = ''; 

       try {
        $area->personal()->attach($personalGet,['f_inicio'=>date("Y-m-d H:i:s"),
                'f_fin' => date("Y-m-d H:i:s"),'estado' => true,'tipo' => $tipo]);
        $mensaje = 'ok'; 
           
       } catch (\Exception $e) {
           $mensaje = $e;
       }

       



       /*Se comento por que se cree que el algoritmo es sobre abundate
        y la solucion ya a sido dada en el metodo de validacion
        por lo que es mejor quitarlo*/
       /*
       
       $personal = $area->personal()->get();

       //
       $personal = $personal->filter(function ($item) {
            if ($item->pivot->estado == true) {
                return $item;
            }
        });

       

       if ($personal->count() >= 1 ) {


            //la variable bandera es para delimitar si se encutra un dato
            $bandera = 0;
           
            //funcion correcta para filtrar collections -- pasar a otra capa
           $encargados = $personal->filter(function ($item) {
                if ($item->pivot->estado == true) {
                    return $item;
                }
            });


           foreach ($encargados as $encargado) {
               
               if($encargado->id == $personalGet->id){
                    $bandera =1;
               }
           }



            //quiere decir que si no encuentra resultados iguales se asigna
           if ($bandera==0) {

               $area->personal()->attach($personalGet,['f_inicio'=>date("Y-m-d H:i:s"),
                'f_fin' => date("Y-m-d H:i:s"),'estado' => true,'tipo' => $tipo]);
               $mensaje = 'ok'; 

           }else{
                $mensaje = 'repetido';
           }

           //dd($bandera);

        }else{
           
            $area->personal()->attach($personalGet,['f_inicio'=>date("Y-m-d H:i:s"),
                'f_fin' => date("Y-m-d H:i:s"),'estado' => true,'tipo' => $tipo]);
            $mensaje = 'ok'; 

        }*/


        return $mensaje;
        
    }


    /*pasar a una capa de validacion */
    public function getExistPersonal($personalGet)
    {
        $areas = Area::all();
        $bandera = 0;

        foreach ($areas as $area) {

            /*recuperamos de la tablas pivot*/
            $personal = $area->personal()->get();
            /*sacamos solo los que estan activos*/
            $personal = $personal->filter(function ($item) {
                if ($item->pivot->estado == true) {
                    return $item;
                }
            });


            /*para saber si en alguna otra */
            foreach ($personal as $person) {

                if ($person->id == $personalGet->id) {
                    $bandera = 1;
                } 
            }

        }

        return $bandera;

        
    }









}
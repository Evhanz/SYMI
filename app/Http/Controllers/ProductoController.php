<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 18/03/2016
 * Time: 12:29 PM
 */

namespace symi\Http\Controllers;

use PhpSpec\Exception\Exception;
use Symi\Repositories\ProductoRep;


class ProductoController extends Controller
{

    public $productoRep;

    public function __construct(ProductoRep $productoRep)
    {
        $this->productoRep = $productoRep;

    }

    public function index(){

        return view('Logistica/Productos/productoIn');
    }

    public function importarDatos(){

        if(\Input::hasFile('file')) {

            //esto es para mover el archivo y guardarlo

            /*
            $extension = strtolower(\Input::file('file')->getClientOriginalExtension());
            $fileName = uniqid().'.'.$extension;
            $path = "subidas";

            \Input::file('file')
                ->move($path,$fileName);
            */


            $extension = strtolower(\Input::file('file')->getClientOriginalExtension());
            $fileName = 'Archivo'.'.'.$extension;
            $path = "subidas";
            \Input::file('file')->move($path,$fileName);

            $ruta = public_path() . '\subidas\Archivo.'.$extension;


            try{
                \Excel::filter('chunk')->load($ruta)->chunk(250, function($results)
                {
                    $data = $results->all();

                    foreach($data as $item){

                      $this->productoRep->regProductoOfInsertExcelTipo1($item);

                    }

                   //dd($data);
                });

            }catch(Exception $e){

                echo "error ";
            }




          //  dd(\Input::file('file'));


        }else{

        }
        //return "archivo guardado";

        echo "completado";

    }

    public function getByCategoriaAndCriterio(){


        $data = \Input::all();

        $productos = $this->productoRep->getByCategoriaAndCriterio($data);


        return \Response::json($productos);



    }


    public function getAllCategoria(){

        $categoria = $this->productoRep->getAllCategorias();

        return \Response::json($categoria);

    }
}
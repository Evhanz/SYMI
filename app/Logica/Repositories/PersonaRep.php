<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 25/06/2015
 * Time: 04:25 PM
 */

namespace Symi\Repositories;
use Symi\Entities\Persona;

class PersonaRep  {

    public function all(){
        $persona = Persona::all()->paginate(10);
        return $persona;
    }

    public function getAllPersonas(){
        $persona = Persona::paginate(10);
        return $persona;
    }

    public function getPersonalByDNI($dni){

        try{
            $personal = Persona::where('dni','like',$dni)->firstOrFail();
        }catch (\Exception $e){

            $personal = new Persona();
            $personal->id ="error";
            $personal->nombres = "Error: Persona no encontrada";
        }

        return $personal;
    }


    public function getPersonasByCriterios($criterio,$dni){

        if($criterio=="&"){
            $criterio ="";
        }
        if($dni!='0'){

            $criterio ='%'.$criterio.'%';
            $personas = Persona::where('dni', 'like',$dni)->where(function ($query) use ($criterio){
                $query->where('nombres', 'like',$criterio);
                $query->orWhere('apellidoP', 'like',$criterio);
                $query->orWhere('apellidoM', 'like',$criterio);
            })->paginate(10);

        }else{

            $criterio ='%'.$criterio.'%';
            $personas = Persona::where(function ($query) use ($criterio){
                $query->where('nombres', 'like',$criterio);
                $query->orWhere('apellidoP', 'like',$criterio);
                $query->orWhere('apellidoM', 'like',$criterio);
            })->paginate(10);

        }

        return $personas;
    }

    public function regPersona($data){

        $profesion = $data['profesion'];

        $rules=[

            'nombres' => 'required|min:4',
            'apellidoP' => 'required|min:4',
            'apellidoM' => 'required|min:4',
            'dni' => 'required|min:8|numeric',
            'celular' => 'min:7',

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){

            $persona = new Persona($data);
            $persona->estado = true;
            $persona->profesion_id = $profesion;
            $persona->save();
            return 1;


        }else
        {
            return $validation->messages();
        }
    }

}
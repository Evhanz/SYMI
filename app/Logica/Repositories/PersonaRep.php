<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 25/06/2015
 * Time: 04:25 PM
 */

namespace Symi\Repositories;
use Symi\Entities\Persona;
use Symi\Entities\PersonalTareo;
use Illuminate\Support\Facades\DB;

class PersonaRep  {

    public function all(){
        $persona = Persona::all()->paginate(10);
        return $persona;
    }

    public function find($id)
    {
        $persona = Persona::find($id);
        return $persona;
    }

    /*se envia todo el personal*/
    public function getAllPersonas(){
        $persona = Persona::orderBy('nombres', 'asc')->paginate(10);
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
            })->orderBy('nombres', 'asc')->paginate(10);

        }else{

            $criterio ='%'.$criterio.'%';
            $personas = Persona::where(function ($query) use ($criterio){
                $query->where('nombres', 'like',$criterio);
                $query->orWhere('apellidoP', 'like',$criterio);
                $query->orWhere('apellidoM', 'like',$criterio);
            })->orderBy('nombres', 'asc')->paginate(10);

        }

        return $personas;
    }

    public function regPersona($data){

        $profesion = $data['profesion'];
        $fotocheck = $data['fotocheck'];
        $costo_h = $data['costo_h'];

        $rules=[

            'nombres' => 'required|min:4',
            'apellidoP' => 'required|min:4',
            'apellidoM' => 'required|min:4',
            'dni' => 'required|min:8|numeric|unique:personas',
            'celular' => 'min:7'

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){
            $persona = new Persona($data);
            $persona->estado = true;
            $persona->profesion_id = $profesion;
            $persona->fotocheck = $fotocheck;
            $persona->costo_h = $costo_h;
            $persona->save();
            return 1;


        }else
        {
            return $validation->messages();
        }
    }

    public function editPersonal($data){

        $profesion = $data['profesion'];
        $fotocheck = $data['fotocheck'];
        $costo_h = $data['costo_h'];
        $id = $data['id'];

        $rules=[

            'nombres' => 'required|min:4',
            'apellidoP' => 'required|min:4',
            'apellidoM' => 'required|min:4',
            'dni' => 'required|min:8|numeric|unique:personas,dni,'.$data['id'],
            'celular' => 'min:7'

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();

        if($isValid){
            $persona = Persona::find($id);
            $persona->nombres = $data['nombres'];
            $persona->apellidoP = $data['apellidoP'];
            $persona->apellidoM = $data['apellidoM'];
            $persona->dni = $data['dni'];
            $persona->celular = $data['celular'];
            $persona->estado = true;
            $persona->profesion_id = $profesion;
            $persona->fotocheck = $fotocheck;
            $persona->costo_h = $costo_h;
            $persona->save();
            return 1;

        }else
        {
            return $validation->messages();
        }
    }

    public function changestate($id){
        $persona = Persona::find($id);

        if($persona->estado == 1){
            $persona->estado = 0;
        }else{
            $persona->estado = 1;
        }

        return $persona->id;

    }



    /*funcion para pruebas de ordenamiento*/

    public function orderPersonal()
    {
        
        $personas = Persona::orderBy('nombres', 'asc')->paginate(10);
        return $personas;

    }


    /*servicios*/

    public function GetHorasByFechas($id,$fecha_ini,$fecha_fin)
    {

        $horas = DB::table('persona_tareo')
            ->join('tareos', 'persona_tareo.tareo_id', '=', 'tareos.id')
            ->join('proformas', 'persona_tareo.proforma_id', '=', 'proformas.id')
            ->select('persona_tareo.id','persona_tareo.h_trabajadas', 'tareos.fecha','tareos.id as tareo_id','proformas.numero')
            ->where('persona_tareo.persona_id','like',$id)
            ->where('tareos.fecha','>=',$fecha_ini)
            ->where('tareos.fecha','<=',$fecha_fin)
            ->orderBy('tareos.fecha','asc')
            ->get();

//->groupBy('persona_tareo.h_trabajadas', 'tareos.fecha','tareos.id')
        return $horas;
    }


}
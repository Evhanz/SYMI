<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 15/07/2015
 * Time: 09:43 AM
 */

namespace Symi\Repositories;
use Symi\Entities\Area;
use Symi\Entities\PersonalTareo;
use Symi\Entities\Proforma;
use Symi\Entities\EstadoProforma;
use Symi\Entities\ProformaTareo;


class ProformaRep {

    public function all(){
        return Proforma::all();
    }

    public function find($id)
    {
        return Proforma::find($id);
    }

    /*get Proformaspor coincidencia*/
    public function GetProformaByNumero($numero){

        try{
            $proforma = Proforma::where('numero','like',$numero)->orWhere('numero','like','%'.$numero.'%')->get();
        }catch (\Exception $e){

            $proforma = 0;
        }

        return $proforma;

    }


    /*get proformas por num numero unico*/
    public function GetProformaFindByNumero($numero){

        try{
            $proforma = Proforma::where('numero','like',$numero)->firstOrFail();
        }catch (\Exception $e){

            $proforma = 0;
        }

        return $proforma;

    }

    public function getProformaByArea($area)
    {
        /*
        $proformas = Proforma::select('proformas.id','proformas.numero','proformas.descripcion','areas.descripcion as area')
                             ->join('areas', 'areas.id', '=', 'proformas.area_id')
                             ->where('area_id','like',$area)
                             ->get();
        */
        $proformas = Proforma::where('area_id','like',$area)->with('area')->get();
        return $proformas;
    }


    public function regProforma($data){

        $area = $data['area'];
        $adjunto = $data['adjunto'];


        $rules=[

            'numero' => 'required|min:4|unique:proformas',
            'descripcion' => 'required|min:4',
            'monto_MO' => 'required',
            'f_inicio' => 'required',
            'n_dias' => 'required',
            'maquinaria_equipo' => 'required',
            'materiales' =>'required',
            'tipo_moneda'=>'required',
            'h_proformadas'=>'required',
            'utilidad'=>'min:0'

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();
        
        if ($isValid) {


            $proforma = new Proforma($data);
            $proforma->f_fin = date('Y-m-d');
            $proforma->area_id = $area;


            if($proforma->save()){
                
                if(!isset($adjunto)||$adjunto!=null){

                    $extension = strtolower($adjunto->getClientOriginalExtension());
                    $fileName = $proforma->numero.'.'.$extension;
                    $path = public_path() . '\subidas\proformas';
                   // $path = "subidas/proformas/";
                    $adjunto->move($path,$fileName);

                }

                $estado = $this->newEstado('creada',$proforma->id,date('Y-m-d'),'Se creo');
            }
            return 1;

        }else{
            return $validation->messages();
        }

    }

    public function updateProforma($data){

        $area = $data['area'];
        $id = $data['id'];


        $rules=[

            'numero' => 'required|min:4|unique:proformas,numero,'.$data['id'],
            'descripcion' => 'required|min:4',
            'monto_MO' => 'required|min:4',
            'f_inicio' => 'required|date',
            'n_dias' => 'required',
            'maquinaria_equipo' => 'required',
            'materiales' =>'required',
            'tipo_moneda' => 'required',
            'h_proformadas' => 'required',
            'utilidad'=>'min:0'

        ];

        $data = array_only($data,array_keys($rules));
        $validation = \Validator::make($data,$rules);

        $isValid = $validation->passes();
        
        if ($isValid) {

            $proforma = Proforma::find($id);
            $proforma->numero = $data['numero'];
            $proforma->descripcion = $data['descripcion'];
            $proforma->monto_MO = $data['monto_MO'];
            $proforma->maquinaria_equipo = $data['maquinaria_equipo'];
            $proforma->materiales = $data['materiales'];
            $proforma->f_inicio = $data['f_inicio'];
            $proforma->n_dias = $data['n_dias'];
            $proforma->tipo_moneda = $data['tipo_moneda'];
            $proforma->area_id = $area;
            $proforma->h_proformadas = $data['h_proformadas'];
            $proforma->save();
            return 1;

        }else{
            return $validation->messages();
        }

    }

    public function newEstado($tipo,$idProforma,$fecha,$observacion)
    {
        $estado = new EstadoProforma();
        $estado->tipo = $tipo;
        $estado->fecha = $fecha;
        $estado->observacion = $observacion;
        $estado->proforma_id = $idProforma;
        $estado->save();

        return $estado;
    }

    public function getInitAlldata()
    {
        $proformas = Proforma::orderBy('id','desc')->with('area')->take(20)->get();

        return $proformas;
    }

    public function getProformaNoClosed(){

        $proformas  = Proforma::join('proforma_tareo', 'proforma_tareo.proforma_id', '=', 'proformas.id')
            ->join('estado_proformas', 'proformas.id', '=', 'estado_proformas.proforma_id')
            ->where('proformas.numero','NOT LIKE','%-%')
            ->whereNotIn('proformas.id', function($q){
                $q->select('proforma_id')->from('estado_proformas')->where('tipo','=','finalizada');
            })
            ->groupBy('proformas.id','proformas.numero')->limit(200)
            ->get(['proformas.id','proformas.numero', \DB::raw('MAX(proforma_tareo.avance_ref) as avance')]);

        /*
            SELECT
            proformas.id,
            proformas.numero,
            estado_proformas.tipo
            FROM
            proformas
            INNER JOIN proforma_tareo ON proformas.id = proforma_tareo.proforma_id
            INNER JOIN estado_proformas ON proformas.id = estado_proformas.proforma_id
            WHERE
            proformas.id NOT IN (SELECT proforma_id from estado_proformas where tipo = 'finalizada' )
            GROUP BY
            proformas.id,
            proformas.numero

         * */

        return $proformas;

    }

    public function getEstadoOfProforma($id)
    {

        $estados = EstadoProforma::where('proforma_id','=',$id)->get();
        return $estados;

    }

    public function getEstadoByProformaAndFecha($fecha,$idProforma){

        $estados = EstadoProforma::where('fecha','>',$fecha)
            ->where('proforma_id','=',$idProforma)->count();

        return $estados;

    }

    public function getEstadoByID($id){

        return EstadoProforma::find($id);

    }

    public function editEstado($idEstado,$tipo,$proforma,$fecha,$observacion){

        $estado = EstadoProforma::find($idEstado);
        $estado->tipo = $tipo;
        $estado->proforma_id = $proforma;
        $estado->fecha = $fecha;
        $estado->observacion = $observacion;
        $estado->save();

    }


    /*esta funcion es para el reporte
    que es necesario para administracion
    y sus detalles necesarios*/
    public function  getProformaByFechasbyAreasWithDetails($fecha_i,$fecha_f,$area)
    {

        /*primero traermos todas las proformas que estan dentro del rango*/
        $proformas = Proforma::join('proforma_tareo','proforma_tareo.proforma_id','=','proformas.id')
        ->join('areas','proformas.area_id','=','areas.id')
        ->join('tareos', function($join){
            $join->on('tareos.area_id','=','areas.id')
                ->on('proforma_tareo.tareo_id','=','tareos.id');
        })->where('tareos.fecha','>=',$fecha_i)
        ->where('tareos.fecha','<=',$fecha_f)
        ->where('areas.id','=',$area)
        ->groupBy('proformas.numero')
        ->get(['proformas.id','proformas.numero','areas.descripcion']);


        /*traer su avance */
        foreach($proformas as $item){
            $item->avance_tareo = $this->getAvancesByProformaId($item->id,$fecha_i,$fecha_f);
        }

        /*Llenar las proformas de acuerdo al dia */

        /*----primero sacare los dias trancurridos*/
        $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
        $dias 	= abs($dias);
        $dias = floor($dias);

        foreach($proformas as $item){

            $avances = array();

            for($i=0;$i<=$dias;$i++){

                $nuevafecha = date('Y-m-d', strtotime("$fecha_i + ".$i." day"));

                $a = $this->getNewAvance($nuevafecha,$item->avance_tareo);

                array_push($avances,$a);
            }

            $item->avance_tareo = $avances;
        }

        return $proformas;
    }

    public function getAvancesByProformaId($idProforma,$fecha_i,$fecha_f)
    {

        /*PRIMERO TRAEMOS LOS VALORES NECESARIOS PARA LOS AVANCES DEL REPORTE*/

        $avances = ProformaTareo::join('tareos','proforma_tareo.tareo_id','=','tareos.id')
            ->join('persona_tareo','persona_tareo.tareo_id','=','tareos.id')
            ->where('proforma_tareo.proforma_id','=',$idProforma)
            ->where('tareos.fecha','>=',$fecha_i)
            ->where('tareos.fecha','<=',$fecha_f)
            ->groupBy('proforma_tareo.avance_ref','tareos.fecha')
            ->get(['proforma_tareo.avance_ref','tareos.fecha',\DB::raw('Sum(persona_tareo.h_trabajadas) as ht')]);

        for($i=0;$i<count($avances);$i++){
            if($i==0){
                $avances[$i]->avance_real = $avances[$i]->avance_ref;
            }else{
                $avances[$i]->avance_real = $avances[$i]->avance_ref - $avances[$i-1]->avance_ref;
            }
        }

        return $avances;
    }

    private function getNewAvance($fecha,$avances){
        $bandera = 1;
        $avance  = new ProformaTareo();
        foreach($avances as $item){
            if($item->fecha == $fecha){
                $avance = $item;
                $bandera = 0;
            }

        }

        if($bandera == 1){
            $avance->avance_ref = '0';
            $avance->avance_real = '0';
            $avance->fecha = $fecha;
            $avance->ht = '0';

        }

        return $avance;

    }


    /*ganancias por proforma de unas fechas dadas*/
    public function getGananciaRealRHPorAreaByFechas($f_i,$f_f){

        $areas = Area::where('estado','=',1)->get();


        /*de cada area sacamos el total*/
        foreach($areas as $area){

            /*primero obetenemos todas las proformas que fueron trabajadas en la fecha establecida*/
            $area->proformas =  $this->getProformasByFechas($f_i,$f_f,$area->id);
          //  $area->proformas = $this->getProformaByFechasbyAreasWithDetails($f_i,$f_f,$area->id);

            /*luego sacamos el costo real que se pudo obetener de cada area */
            $area->total = $this->getCostoAreadeAllProformas($area->proformas);
        }
        return $areas;

    }


    private function getProformasByFechas($f_i,$f_f,$area){



        $proformas = PersonalTareo::join('proformas','persona_tareo.proforma_id','=','proformas.id')
            ->join('tareos','persona_tareo.tareo_id','=','tareos.id')
            ->where('tareos.area_id','=',$area)
            ->where('tareos.fecha','>=',$f_i)
            ->where('tareos.fecha','<=',$f_f)
            ->where('proformas.numero','not like','%G%')
            ->groupBy('proformas.numero')
            ->get(['proformas.numero','proformas.monto_MO',\DB::raw('Sum(persona_tareo.h_trabajadas*costo_h) AS producto'),
                \DB::raw('proformas.monto_MO - Sum(persona_tareo.h_trabajadas*costo_h)  AS res_real')]);

        /*
         * SELECT
proformas.numero,
Sum(persona_tareo.h_trabajadas*costo_h) AS producto,
proformas.monto_MO,
proformas.monto_MO - Sum(persona_tareo.h_trabajadas*costo_h)  AS res_real
FROM
persona_tareo
INNER JOIN proformas ON persona_tareo.proforma_id = proformas.id
INNER JOIN tareos ON persona_tareo.tareo_id = tareos.id
WHERE
tareos.fecha >= '2016-01-01' AND
tareos.fecha <= '2016-01-31' AND
tareos.area_id = 1 AND
proformas.numero NOT LIKE '%G%'
GROUP BY
proformas.numero

         *
         *
         * */

        return $proformas;

    }

    /*scar la suma de todo es costo*/

    private function getCostoAreadeAllProformas($proformas){

        $suma = 0;

        foreach($proformas as $proforma){

            $suma += $proforma->res_real;


        }

        return $suma;

    }





}
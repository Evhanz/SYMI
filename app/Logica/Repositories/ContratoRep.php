<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 24/06/2015
 * Time: 04:06 PM
 */

namespace Symi\Repositories;
use Carbon\Carbon;
use Symi\Entities\Contrato;

class ContratoRep {


	public function all()
	{
		# code...
		$contratos = Contrato::all();
		return $contratos;
	}

	public function getContratoByFechas($f_inicio , $f_fin,$idPersona)
	{

		$contratos = Contrato::where('id_persona','=',$idPersona)
			->where(function ($query) use ($f_inicio, $f_fin) {
			$query->where('f_inicio', '>=', $f_inicio);
			$query->where('f_inicio', '<=', $f_fin);
		})->orWhere(function ($query) use ($f_inicio, $f_fin) {
			$query->where('f_fin', '>=', $f_inicio);
			$query->where('f_fin', '<=', $f_fin);
		})->orWhere(function ($query) use ($f_inicio, $f_fin) {
			$query->where('f_inicio', '<=', $f_inicio);
			$query->where('f_fin', '>=', $f_fin);
		})->orWhere('estado','like','creado')
			->get();

		/*

                SELECT  * FROM
        contratos
        WHERE
        (contratos.f_inicio >= '2016-01-23' and contratos.f_inicio <= '2016-01-25' ) OR
        (contratos.f_fin >= '2016-01-23' and contratos.f_fin <= '2016-01-25' )  OR
        (contratos.f_inicio <= '2016-01-23' and  contratos.f_fin >= '2016-01-25' )

        */

		return $contratos;
	}


	public function regContrato($data)
	{

		$contrato = new Contrato();

		$contrato->f_inicio = $data['f_inicio'];
		$contrato->f_fin = $data['f_fin'];
		$contrato->estado = 'creado';
		$contrato->id_persona = $data['idPersonal'];
		$contrato->pago = $data['pago'];

		$contrato->save();


	}

	public function editContrato($data)
	{

		$contrato = Contrato::find($data['idContrato']);

		$contrato->f_inicio = $data['f_inicio'];
		$contrato->f_fin = $data['f_fin'];
		$contrato->id_persona = $data['idPersonal'];
		$contrato->pago = $data['pago'];

		$contrato->save();


	}
	
	
	/*cambiar estado de contrato*/

	public function changeStateContrato($estado,$idContrato)
	{

		$contrato = Contrato::find($idContrato);
		$contrato->estado = $estado;

		if($estado == 'renovado' || $estado == 'baja')
		{
			$contrato->f_baja = date('Y-m-d');

		}

		$contrato->save();

		
	}

	public function getContratoById($id){

		$contrato = Contrato::where('id','=',$id)->with('personal')->first();


		return $contrato;

	}

	/*esto es para una tarea programada
	pasar esto a otra capa
	por que no cumple con el concepto
	de repositorio , si no como
	de operación*/

	public function updateContratosCaducados(){

		$now = date('Y-m-d');

		$rows = Contrato::where('estado', '=', 'creado')->where('f_fin','<=',$now)->update(['estado' => 'caducado']);

		//return $rows;
	}


	public function getContratosPorVencer()
	{

		$now = Carbon::now();

		$now = $now->addDay(5)->format('Y-m-d');

		$contratos = Contrato::where('f_fin','<=',$now)->where('estado','like','creado')->get();

		return $contratos;


	}


}
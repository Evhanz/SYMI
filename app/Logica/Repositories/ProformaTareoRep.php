<?php
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 24/06/2015
 * Time: 04:06 PM
 */

namespace Symi\Repositories;
use Symi\Entities\ProformaTareo;

class ProformaTareoRep {

	public function getProformaTareoByProforma($idProforma)
	{
		//$proformaTAre

		$proformaTareos = ProformaTareo::where('proforma_id','like',$idProforma)->get();
		return $proformaTareos;

	}


}
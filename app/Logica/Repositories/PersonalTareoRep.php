<?php
	
namespace Symi\Repositories;
use Symi\Entities\PersonalTareo;

class PersonalTareoRep {

	public function getTareoPersonalByProforma($idProforma)
	{
		$personalTareo = PersonalTareo::where('proforma_id','like',$idProforma)->get();
		return $personalTareo;
	}

	


}
<?php

namespace symi\Http\Controllers;
use Symi\Repositories\PersonaRep;
use Symi\Repositories\AreaRep;
use Symi\Repositories\TareoRep;

class ReportesController extends Controller{

    protected $personaRep;
    protected $areaRep;
    protected $tareoRep;

    public function __construct(PersonaRep $personaRep,AreaRep $areaRep,TareoRep $tareoRep){

        $this->personaRep = $personaRep;
        $this->areaRep = $areaRep;
        $this->tareoRep = $tareoRep;

    }

    public function index(){

    }

    /*Reportes por Personal*/

    public function getViewByHorasPersonalForDates()
    {
    	# code...

    	return view('RH/Reportes/viewHorasTrabajadasByEmploy');
    }





}
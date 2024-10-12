<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TablaUbicacione;
use App\Models\Reporte;

class ReporteController extends Controller
{
    public function reporte_area(){
        
		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		return view('frontend.reporte.all_reporte_area',compact('area_trabajo'));
		
    }
	
	public function listar_reporte_area_ajax(Request $request){
		
		$reporte_model = new Reporte;
		$p[]=$request->empresa;
		$p[]=$request->id_area_trabajo;
		$p[]=$request->id_unidad_trabajo;
		$p[]=$request->numero_documento;
		$p[]=$request->persona;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $reporte_model->listar_reporte_area_ajax($p);
		$iTotalDisplayRecords = isset($data[0]->totalrows)?$data[0]->totalrows:0;
		
		$result["PageStart"] = $request->NumeroPagina;
		$result["pageSize"] = $request->NumeroRegistros;
		$result["SearchText"] = "";
		$result["ShowChildren"] = true;
		$result["iTotalRecords"] = $iTotalDisplayRecords;
		$result["iTotalDisplayRecords"] = $iTotalDisplayRecords;
		$result["aaData"] = $data;
		
		echo json_encode($result);
		
	}
	
	
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoCambio;
use App\Models\TablaMaestra;
use Auth;

class TipoCambioController extends Controller
{
    
	public function index()
    {
		$tablaMaestra_model = new TablaMaestra;
		$tipo_moneda = $tablaMaestra_model->getMaestroByTipo(1);
		
		return view('frontend.tipo_cambio.all',compact('tipo_moneda'));
    }
	
	public function listar_tipo_cambio_ajax(Request $request){
		
		$tipoCambio_model = new TipoCambio;
		$p[]=$request->fecha;
		$p[]=$request->id_tipo_moneda_compra;
        $p[]=$request->id_tipo_moneda_venta;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $tipoCambio_model->listar_tipo_cambio_ajax($p);
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
	
	public function modal_tipo_cambio($id){
		
		$id_user = Auth::user()->id;
		$tipoCambio = new TipoCambio;
		if($id>0)$tipoCambio = TipoCambio::find($id);
		else $tipoCambio = new TipoCambio;
		
		$tablaMaestra_model = new TablaMaestra;
		$tipo_moneda = $tablaMaestra_model->getMaestroByTipo(1);
				
		return view('frontend.tipo_cambio.modal_tipo_cambio',compact('id','tipoCambio','tipo_moneda'));
	
	}
	
	public function send(Request $request){
		
		$id_user = Auth::user()->id;
        
		if($request->id == 0){
			$tipoCambio = new TipoCambio;
		}else{
			$tipoCambio = TipoCambio::find($request->id);
		}
		
		$tipoCambio->fecha = $request->fecha;
		$tipoCambio->id_tipo_moneda_compra = $request->id_tipo_moneda_compra;
		$tipoCambio->id_tipo_moneda_venta = $request->id_tipo_moneda_venta;
		$tipoCambio->valor_compra = $request->valor_compra;
		$tipoCambio->valor_venta = $request->valor_venta;
		$tipoCambio->estado = 1;
		$tipoCambio->save();
		
    }
	
	public function eliminar_tipo_cambio($id,$estado)
    {
		$tipoCambio = TipoCambio::find($id);
		$tipoCambio->estado = $estado;
		$tipoCambio->save();

		echo $tipoCambio->id;

    }
		
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TdiasFeriado;

class TdiasFeriadoController extends Controller
{
   
    /*public function index()
    {
        return view('frontend.manten.tdias-feriado');
        
    }*/

    public function create()
    {

        return view('frontend.feriado.create');
        
    }

    public function listar_feriado_ajax(Request $request){
		
		$t_dias_feriado_model = new TdiasFeriado;
		$p[]=$request->denominacion;
		$p[]=$request->fecha;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $t_dias_feriado_model->listar_feriado_ajax($p);
		$iTotalDisplayRecords = isset($data[0]->totalrows)?$data[0]->totalrows:0;
		
		$result["PageStart"] = $request->NumeroPagina;
		$result["pageSize"] = $request->NumeroRegistros;
		$result["SearchText"] = "";
		$result["ShowChildren"] = true;
		$result["iTotalRecords"] = $iTotalDisplayRecords;
		$result["iTotalDisplayRecords"] = $iTotalDisplayRecords;
		$result["aaData"] = $data;

		echo json_encode($result);
		//print_r ($result);
	}

    public function modal_feriado($id){
		//$id_user = Auth::user()->id;

		if($id>0) {
            $t_dias_feriado = TdiasFeriado::find($id);
        }else{ 
            $t_dias_feriado = new TdiasFeriado;
        }
        
		/*$tabla_model = new TablaUbicacione;		
        $concepto_model = new Concepto();
		$planilla_model = new Tplanilla;

		$tipPlanilla = $planilla_model->getPlanilla(1);
		$concepto = $concepto_model->getConceptoAll();*/

		return view('frontend.feriado.modal_feriado',compact('id','t_dias_feriado'));
	}

    public function send_feriado(Request $request){
		
		if($request->id == 0){
			$t_dias_feriado = new TdiasFeriado;
		}else{
			$t_dias_feriado = TdiasFeriado::find($request->id);
		}
		
		$t_dias_feriado->fech_feri_tdf = $request->fecha_feriado;
		$t_dias_feriado->flag_mdia_tdf = $request->flag_medio_dia;
		$t_dias_feriado->sali_mdia_tdf = $request->fecha_salida_medio_dia;
		$t_dias_feriado->moti_feri_tdf = $request->motivo_feriado;
		$t_dias_feriado->flag_nlab_tdf = $request->flag_no_laborable;
		$t_dias_feriado->flag_recu_tdf = $request->flag_recuperacion;
        $t_dias_feriado->fech_irec_tdf = $request->fecha_inicio_recuperacion;
		$t_dias_feriado->fech_frec_tdf = $request->fecha_fin_recuperacion;
		$t_dias_feriado->save();
    }

    public function eliminar_feriado($id,$estado)
    {
		$feriado = TdiasFeriado::find($id);
		$feriado->estado = $estado;
		$feriado->save();

		echo $feriado->id;

    }

}

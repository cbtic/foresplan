<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConceptoPlane;
use App\Models\Tplanilla;
use App\Models\Empresa;
use App\Models\Concepto;

class ConceptoPlanController extends Controller
{
    public function create()
    {
		$planilla_model = new Tplanilla;
		$planilla = $planilla_model->getPlanilla(1);
		$empresa_model = new Empresa();		
		$empresa = $empresa_model->getEmpresaAll("1");
        $concepto_model = new Concepto();		
		$concepto = $concepto_model->getConceptoAll();
		//$meses = Mese::get();

        return view('frontend.concepto_plan.create',compact('planilla','empresa','concepto'));
    }

    public function listar_concepto_plan_ajax(Request $request){
		
		$concepto_plan_model = new ConceptoPlane;
		$p[]=$request->planilla;
		$p[]=$request->subplanilla;
		$p[]=$request->concepto;
		$p[]=$request->predeterminado;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $concepto_plan_model->listar_concepto_plan_ajax($p);
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

    public function send_concepto_plan(Request $request){

		if($request->id == 0){
			$concepto_plan = new ConceptoPlane;
		}else{
			$concepto_plan = ConceptoPlane::find($request->id);
		}
		
		$concepto_plan->id_planilla = $request->planilla;
		$concepto_plan->id_subplanilla = $request->subplanilla;
		$concepto_plan->id_concepto = $request->concepto;
		$concepto_plan->predeterminado = $request->predeterminado;
		$concepto_plan->save();

	}

    public function eliminar_concepto_plan($id,$estado)
    {
		$concepto_plan = ConceptoPlane::find($id);
		$concepto_plan->estado = $estado;
		$concepto_plan->save();

		echo $concepto_plan->id;

    }

    public function modal_concepto_plan($id){

		//echo($id_persona); exit();
		
		if($id>0)$concepto_plan = ConceptoPlane::find($id);
		else $concepto_plan = new ConceptoPlane;

        $planilla_model = new Tplanilla;
		$planilla = $planilla_model->getPlanilla(1);
		$empresa_model = new Empresa();		
		$empresa = $empresa_model->getEmpresaAll("1");
        $concepto_model = new Concepto();		
		$concepto = $concepto_model->getConceptoAll();
		
		return view('frontend.concepto_plan.modal_concepto_plan',compact('id','concepto_plan','planilla','empresa','concepto'));
	
	}
}

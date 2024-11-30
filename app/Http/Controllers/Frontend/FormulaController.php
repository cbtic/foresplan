<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formula;
use App\Models\TablaUbicacione;
use App\Models\Concepto;
use App\Models\Tplanilla;
use Auth;

class FormulaController extends Controller
{
    public function create()
    {
        $tabla_model = new TablaUbicacione;		
        $concepto_model = new Concepto();
		$planilla_model = new Tplanilla;

		$tipPlanilla = $planilla_model->getPlanilla(1);
		$concepto = $concepto_model->getConceptoAll();

        return view('frontend.formula.create',compact('tipPlanilla','concepto'));
        
    }

    public function listar_formula_ajax(Request $request){
		
		$formula_model = new Formula;
		$p[]=$request->planilla;
		$p[]=$request->subplanilla;
		$p[]=$request->concepto;
		$p[]=$request->formula;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $formula_model->listar_formula_ajax($p);
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

    public function modal_formula($id){
		$id_user = Auth::user()->id;

		if($id>0) {
            $formula = Formula::find($id);
        }else{ 
            $formula = new Formula;
        }
        
		$tabla_model = new TablaUbicacione;		
        $concepto_model = new Concepto();
		$planilla_model = new Tplanilla;

		$tipPlanilla = $planilla_model->getPlanilla(1);
		$concepto = $concepto_model->getConceptoAll();

		return view('frontend.formula.modal_formula',compact('id','formula','tipPlanilla','concepto'));
	}

    public function send_formula(Request $request){
		
		if($request->id == 0){
			$formula = new Formula;
		}else{
			$formula = Formula::find($request->id);
		}
		
		$formula->id_planilla = $request->id_tipo_planilla_;
		$formula->id_subplanilla = $request->sub_tipo_planilla_;
		$formula->id_concepto = $request->concepto_;
		$formula->formula_for = $request->formula_;
		$formula->estado = 'A';
		$formula->orden = $request->orden_;
		$formula->save();
    }

    public function eliminar_formula($id,$estado)
    {
		$persona = Persona::find($id);
		$persona->estado = $estado;
		$persona->save();

		echo $persona->id;

    }
}

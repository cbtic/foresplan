<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tplanilla;
use App\Models\MetaPersona;
use App\Models\Tperiodo;
use App\Models\Empresa;
use App\Models\ConceptoPersona;
use App\Models\ConceptoPlane;
use App\Models\Mese;
use App\Models\TablaUbicacione;
use App\Models\PlanillaCalculada;
use App\Models\Resumene;


class PlanillaCalculadaController extends Controller
{
    public function create()
    {
		$planilla_model = new Tplanilla;
		$planilla = $planilla_model->getPlanilla(1);
		$empresa_model = new Empresa();		
		$empresa = $empresa_model->getEmpresaAll("1");
		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		$meses[1]="ENERO";
		$meses[2]="FEBRERO";
		$meses[3]="MARZO";
		$meses[4]="ABRIL";
		$meses[5]="MAYO";
		$meses[6]="JUNIO";
		$meses[7]="JULIO";
		$meses[8]="AGOSTO";
		$meses[9]="SETIEMBRE";
		$meses[10]="OCTUBRE";
		$meses[11]="NOVIEMBRE";
		$meses[12]="DICIEMBRE";

		
		//$periodo = Tperiodo::where('esta_plan_tpe','2')->first();

		$periodo_model = new Tperiodo;
		$periodos = $periodo_model->getPeriodos();


        return view('frontend.planilla.create',compact('planilla','meses','area_trabajo','empresa', 'periodos'));
    }


    public function listar_planilla()
    {
		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		$meses[1]="ENERO";
		$meses[2]="FEBRERO";
		$meses[3]="MARZO";
		$meses[4]="ABRIL";
		$meses[5]="MAYO";
		$meses[6]="JUNIO";
		$meses[7]="JULIO";
		$meses[8]="AGOSTO";
		$meses[9]="SETIEMBRE";
		$meses[10]="OCTUBRE";
		$meses[11]="NOVIEMBRE";
		$meses[12]="DICIEMBRE";

		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");


	
        return view('frontend.planilla.create',compact('meses','area_trabajo'));
        //
    }
	public function listar_planilla_ajax(Request $request){
		
		$planilla_model = new PlanillaCalculada;
		$p[]=$request->id_area_trabajo;
		$p[]=$request->id_unidad_trabajo;
		$p[]=$request->id_persona;
		$p[]=$request->id_periodo;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $planilla_model->listar_planilla_ajax($p);
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
	
	public function listar_planilla_resumen_ajax(Request $request){
		
		$planilla_model = new PlanillaCalculada;
		$p[]=$request->id_persona;
		$p[]=$request->id_periodo;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $planilla_model->listar_planilla_resumen_ajax($p);
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
	
	public function listar_metas_persona_ajax(Request $request){
		
		$planilla_model = new Tplanilla;
		$p[]=$request->id_ubicacion;
		$p[]=$request->id_planilla;
		$p[]=$request->id_subplanilla;
		$p[]=$request->anio;
		$p[]=$request->mes;
		$p[]=$request->NumeroPagina;
		//$p[]=$request->NumeroRegistros;
		$p[]=9999999;
		$data = $planilla_model->listar_metas_persona_ajax($p);
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

	public function listar_metas_persona($id_ubicacion,$id_planilla,$id_subplanilla,$anio,$mes){
		
		$planilla_model = new Tplanilla;
		//$metas_persona = $planilla_model->getMetasPersona($id_ubicacion,$id_planilla,$id_subplanilla,$anio,$mes);
		$p[]=$id_ubicacion;
		$p[]=$id_planilla;
		$p[]=$id_subplanilla;
		$p[]=$anio;
		$p[]=$mes;
		$p[]=1;
		$p[]=9999999;
		$metas_persona = $planilla_model->listar_metas_persona_ajax($p);
		
        return view('frontend.planilla.listar_metas_persona_ajax',compact('metas_persona'));

    }
	

	public function obtener_concepto_planilla($id_periodo, $id_persona){

		$concepto_model = new PlanillaCalculada();
		
		$ingreso = $concepto_model->getConceptoPlanillaByIdPeri($id_periodo, $id_persona, 1);
		$egreso = $concepto_model->getConceptoPlanillaByIdPeri($id_periodo, $id_persona, 2);
		$aportaciones = $concepto_model->getConceptoPlanillaByIdPeri($id_periodo, $id_persona, 3);
		//dd($concepto); exit();
        return view('frontend.planilla.concepto_planilla_ajax',compact('ingreso','egreso','aportaciones'));

    }
	
	public function obtener_concepto_planilla_resumen($id_periodo, $id_persona){

		$concepto_model = new PlanillaCalculada();
		
		$ingreso = $concepto_model->getConceptoPlanillaResumenByIdPeri($id_periodo, $id_persona, 1);
		//$egreso = $concepto_model->getConceptoPlanillaResumenByIdPeri($id_periodo, $id_persona, 2);
		$asistencia = $concepto_model->getConceptoPlanillaResumenByIdPeri($id_periodo, $id_persona, 4);
		//dd($concepto); exit();
        return view('frontend.planilla.concepto_planilla_resumen_ajax',compact('ingreso','asistencia'));

    }
	
	public function obtener_periodo($id_ubicacion,$id_planilla,$id_subplanilla,$anio,$mes,$rd_tipo){
	
		$periodo = Tperiodo::where('id_ubicacion',$id_ubicacion)->where('id_planilla',$id_planilla)->where('id_subplanilla',$id_subplanilla)->where('ano_peri_tpe',$anio)->where('id_mes',$mes)->where('id_tipo_planilla',$rd_tipo)->where('id_tipo_planilla', '!=', 2)->first();
		echo json_encode($periodo);
		
	}
	
	public function send(Request $request){

		//echo "Aqui.."; exit();
		
		//$cantidad_periodo = Tperiodo::where('id_ubicacion',$request->id_ubicacion)->where('id_planilla',$request->id_planilla)->where('id_subplanilla',$request->id_subplanilla)->where('ano_peri_tpe',$request->anio)->where('id_mes',$request->mes)->count();
		
		$periodo_bus = Tperiodo::where('id_ubicacion',$request->id_ubicacion)->where('id_planilla',$request->id_planilla)->where('id_subplanilla',$request->id_subplanilla)->where('ano_peri_tpe',$request->anio)->where('id_mes',$request->mes)->where('id_tipo_planilla',$request->rd_tipo)->where('id_tipo_planilla', '!=', 2)->first();
		
		$id_periodo = (isset($periodo_bus->id))?$periodo_bus->id:0;
		
		if($id_periodo==0){
			$periodo = new Tperiodo;
			$periodo->id_ubicacion = $request->id_ubicacion;
			$periodo->id_planilla = $request->id_planilla;
			$periodo->id_subplanilla = $request->id_subplanilla;
			$periodo->ano_peri_tpe = $request->anio;
			$periodo->id_mes = $request->mes;
			$periodo->fech_inic_tpe = $request->fech_inic_tpe;
			$periodo->fech_fina_tpe = $request->fech_fina_tpe;
			$periodo->esta_plan_tpe = 1;
			$periodo->id_tipo_planilla = $request->rd_tipo;
			$periodo->save();
			$id_periodo = $periodo->id;
		}
		
		if($request->rd_tipo == 1){
			$concepto_persona_model = new ConceptoPersona;
			$concepto_persona_model->procesar_concepto_persona($id_periodo); 
		}
		
		echo $id_periodo;
		
		//if($cantidad_periodo==0){
			
			/*
			if(isset($request->personas)):
				foreach ($request->personas as $key => $value):
					$metaPersona = new MetaPersona;
					$metaPersona->id_periodo = $id_periodo;
					$metaPersona->id_ubicacion = $request->id_ubicacion;
					$metaPersona->id_planilla = $request->id_planilla;
					$metaPersona->id_subplanilla = $request->id_subplanilla;
					$metaPersona->id_persona = $value;
					$metaPersona->anno_ejec_eje = $request->anio;
					$metaPersona->estado = 1;
					$metaPersona->save();
				endforeach;
			endif;
			*/
			
		//}

		
	}
	
	public function obtener_concepto_persona($id_periodo,$id_persona){
		
		$planilla_model = new Tplanilla;
		$concepto = $planilla_model->getConceptoPersona($id_periodo,$id_persona);
		
        return view('frontend.planilla.concepto_persona_ajax',compact('concepto','id_periodo','id_persona'));

    }
	
	public function obtener_concepto_persona_resumen($id_planilla,$id_subplanilla,$id_persona){
		
		$planilla_model = new Tplanilla;
		$concepto = $planilla_model->getConceptoPersonaResumen($id_planilla,$id_subplanilla,$id_persona);
		
        return view('frontend.planilla.concepto_persona_resumen_ajax',compact('concepto','id_planilla','id_subplanilla','id_persona'));

    }
	
	public function obtener_sub_planilla($id_planilla){
        $planilla_model = new Tplanilla;
		$subplanilla = $planilla_model->getSubPlanilla($id_planilla);
        echo json_encode($subplanilla);
	}
	
	public function eliminar_concepto_persona($id)
    {
		$conceptoPersona = ConceptoPersona::find($id);
		$conceptoPersona->estado = 0;
		$conceptoPersona->save();

		echo $conceptoPersona->id;

    }
	
	public function eliminar_meta_persona($id)
    {
		$metaPersona = MetaPersona::find($id);
		$metaPersona->estado = 0;
		$metaPersona->save();

		echo $metaPersona->id;

    }
	
	public function modal_concepto_persona($id,$id_periodo,$id_persona){

		//echo($id_persona); exit();
		
		if($id>0)$concepto_persona = ConceptoPersona::find($id);
		else $concepto_persona = new ConceptoPersona;
		
		$periodo = Tperiodo::find($id_periodo);
		$id_planilla = $periodo->id_planilla;
		$id_subplanilla = $periodo->id_subplanilla;
		
		$concepto_plan_model = new ConceptoPlane;
		$concepto = $concepto_plan_model->getConceptoPlan($id_planilla,$id_subplanilla);
		
		return view('frontend.planilla.modal_persona_concepto',compact('id','concepto_persona','concepto','id_periodo','id_persona'));
	
	}
	
	public function modal_concepto_persona_resumen($id,$id_planilla,$id_subplanilla,$id_persona){
		
		if($id>0)$concepto_persona = Resumene::find($id);
		else $concepto_persona = new Resumene;
		//print_r($concepto_persona);
		$concepto_plan_model = new ConceptoPlane;
		$concepto = $concepto_plan_model->getConceptoPlan($id_planilla,$id_subplanilla);
		
		return view('frontend.planilla.modal_persona_concepto_resumen',compact('id','concepto_persona','concepto','id_planilla','id_subplanilla','id_persona'));
	
	}
	
	public function modal_persona($id_periodo){
		
		return view('frontend.planilla.modal_persona',compact('id_periodo'));
	
	}
	
	public function send_concepto_persona(Request $request){
		
		$periodo = Tperiodo::find($request->id_periodo);
		$id_planilla = $periodo->id_planilla;
		$id_subplanilla = $periodo->id_subplanilla;
		$id_ubicacion = $periodo->id_ubicacion;
		
		$cuenta = ConceptoPersona::where('estado',1)
		->where('id','<>',$request->id)
		->where('id_periodo',$request->id_periodo)
		->where('id_ubicacion',$id_ubicacion)
		->where('id_ubicacion',$id_ubicacion)
		->where('id_planilla',$id_planilla)
		->where('id_subplanilla',$id_subplanilla)
		->where('id_persona',$request->id_persona)
		->where('id_concepto',$request->id_concepto)->count();

		if($cuenta != 0){
			echo "1";
			exit();
		}
		
		if($request->id == 0){
			$concepto_persona = new ConceptoPersona;
			$concepto_persona->id_periodo = $request->id_periodo;
			$concepto_persona->id_ubicacion = $id_ubicacion;
			$concepto_persona->id_planilla = $id_planilla;
			$concepto_persona->id_subplanilla = $id_subplanilla;
			$concepto_persona->id_persona = $request->id_persona;
			$concepto_persona->id_concepto = $request->id_concepto;
			$concepto_persona->mont_fijo_cmf = $request->precio;
			$concepto_persona->estado = "1";
			$concepto_persona->save();
		}else{
			$concepto_persona = ConceptoPersona::find($request->id);
			$concepto_persona->id_concepto = $request->id_concepto;
			$concepto_persona->mont_fijo_cmf = $request->precio;
			$concepto_persona->save();
		}
    }
	
	public function send_resumen(Request $request){
		
		if($request->id == 0){
			$resumen = new Resumene;
			$resumen->id_planilla = $request->id_planilla;
			$resumen->id_subplanilla = $request->id_subplanilla;
			$resumen->id_persona = $request->id_persona;
			$resumen->id_concepto = $request->id_concepto;
			$resumen->cant_conc_res = $request->cant_conc_res;
			$resumen->id_ubicacion = $request->id_ubicacion;
			//$resumen->estado = "1";
			$resumen->save();
		}else{
			$resumen = Resumene::find($request->id);
			$resumen->id_concepto = $request->id_concepto;
			$resumen->cant_conc_res = $request->cant_conc_res;
			$resumen->save();
		}
    }
	
	
	public function send_meta_persona(Request $request){
		
		/*
		$periodo = Tperiodo::find($request->id_periodo);
		
		$id_planilla = $periodo->id_planilla;
		$id_subplanilla = $periodo->id_subplanilla;
		$id_ubicacion = $periodo->id_ubicacion;
		$anio = $periodo->ano_peri_tpe;
		
		$meta_persona = new MetaPersona;
		$meta_persona->id_periodo = $request->id_periodo;
		$meta_persona->id_persona = $request->id_persona;
		$meta_persona->id_planilla = $id_planilla;
		$meta_persona->id_subplanilla = $id_subplanilla;
		$meta_persona->id_ubicacion = $id_ubicacion;
		$meta_persona->anno_ejec_eje = $anio;
		$meta_persona->estado = "1";
		$meta_persona->save();
		*/
		
		$concepto_persona_model = new ConceptoPersona;
		$concepto_persona_model->add_concepto_persona($request->id_periodo,$request->id_persona);	
	
    }
	
	public function create_resumen_asistencia()
    {
		$planilla_model = new Tplanilla;
		$planilla = $planilla_model->getPlanilla(1);
		$empresa_model = new Empresa();		
		$empresa = $empresa_model->getEmpresaAll("1");
		
		$meses[1]="ENERO";
		$meses[2]="FEBRERO";
		$meses[3]="MARZO";
		$meses[4]="ABRIL";
		$meses[5]="MAYO";
		$meses[6]="JUNIO";
		$meses[7]="JULIO";
		$meses[8]="AGOSTO";
		$meses[9]="SETIEMBRE";
		$meses[10]="OCTUBRE";
		$meses[11]="NOVIEMBRE";
		$meses[12]="DICIEMBRE";

        return view('frontend.planilla.create_resumen_asistencia',compact('planilla','meses','empresa'));
    }
	
	/*
			
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
*/

	public function listar_planilla_persona()
	{
		$planilla_model = new Tplanilla;
		$planilla = $planilla_model->getPlanilla(1);
		$empresa_model = new Empresa();		
		$empresa = $empresa_model->getEmpresaAll("1");
		$meses = Mese::get();

		return view('frontend.planilla.listar_planilla_persona',compact('planilla','meses','empresa'));
		//
	}

	public function listar_planilla_resumen()
    {
		/*
		$planilla_model = new Tplanilla;
		$planilla = $planilla_model->getPlanilla(1);
		$empresa_model = new Empresa();		
		$empresa = $empresa_model->getEmpresaAll("1");
		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		*/
		$periodo_model = new Tperiodo;
		$periodos = $periodo_model->getPeriodos();

        return view('frontend.planilla.listar_planilla_resumen',compact('periodos'));
    }
	
	public function listar_planilla_persona_ajax(Request $request){
		
		$planilla_model = new Tplanilla;
		$p[]=$request->id_ubicacion;
		$p[]=$request->id_planilla;
		$p[]=$request->id_subplanilla;
		$p[]=$request->anio;
		$p[]=$request->mes;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		//$p[]=9999999;
		$data = $planilla_model->listar_planilla_persona_ajax($p);
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

	public function create_planilla_persona()
    {
		$planilla_model = new Tplanilla;
		$planilla = $planilla_model->getPlanilla(1);
		$empresa_model = new Empresa();		
		$empresa = $empresa_model->getEmpresaAll("1");
		$meses = Mese::get();

        return view('frontend.planilla.create_planilla_persona',compact('planilla','meses','empresa'));
    }
	
	public function agregar_persona_planilla($id){
		
		$planilla_model = new Tplanilla;
		$periodo = $planilla_model->getPeriodoById($id);
		/*
		$p[]=$periodo->id_ubicacion;
		$p[]=$periodo->id_planilla;
		$p[]=$periodo->id_subplanilla;
		$p[]=$periodo->anio;
		$p[]=$periodo->mes;
		$p[]=1;
		$p[]=10000;
		$metas_persona = $planilla_model->listar_metas_persona_ajax($p);
		*/
		return view('frontend.planilla.edit_planilla_persona',compact('periodo','id'));
		
	}
	
	public function obtener_metas_persona_json($id_ubicacion,$id_planilla,$id_subplanilla,$anio,$mes){
        $planilla_model = new Tplanilla;
		$metas_persona = $planilla_model->getMetasPersona($id_ubicacion,$id_planilla,$id_subplanilla,$anio,$mes);
        echo json_encode($metas_persona);
	}
	
	public function obtener_metas_persona($id_periodo){
		
		$planilla_model = new Tplanilla;
		$metas_persona = $planilla_model->getMetasPersona($id_periodo);
		
        return view('frontend.planilla.metas_persona_ajax',compact('metas_persona','id_periodo'));

    }
	
	public function actualizar_periodo($id,$estado)
    {
		$sw = true;
		$msg = "";

		$periodo = Tperiodo::find($id);
		$periodo->esta_plan_tpe = $estado;
		$periodo->save();
		
		$planilla_model = new Tplanilla;
		$planilla_model->cerrar_periodo($id);
		
		$array["sw"] = $sw;
        $array["msg"] = $msg;
        echo json_encode($array);

	}
	
	public function generar_planilla_calculada_periodo($id)
    {
		$sw = true;
		$msg = "";
		
		$planilla_model = new Tplanilla;
		$planilla_model->generar_planilla_calculada($id);

		$periodo = Tperiodo::find($id);
		$periodo->esta_plan_cer = '2';
		$periodo->save();
		
		$array["sw"] = $sw;
        $array["msg"] = $msg;
        echo json_encode($array);

	}

	public function eliminar_planilla_calculada_periodo($id)
    {
		$sw = true;
		$msg = "";
		
		$planilla_model = new Tplanilla;
		$planilla_model->elimina_planilla_calculada($id);

		$periodo = Tperiodo::find($id);
		$periodo->esta_plan_cer = '1';
		$periodo->save();
		
		$array["sw"] = $sw;
        $array["msg"] = $msg;
        echo json_encode($array);

	}
	
	
}

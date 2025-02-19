<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DetaOperacione;
use App\Models\Persona;
use App\Models\PersonaDetalle;
use App\Models\DocumentoIdentidade;
use App\Models\TablaUbicacione;
use App\Models\Empresa;
use App\Models\Ubigeo;
use App\Models\UnidadTrabajo;
use App\Models\Asistencia;
use Carbon\Carbon;

use Auth;


class DetaOperacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.manten.deta-operacione');
        //
    }

    public function create()
    {
		$empresa = Empresa::all();
		$tabla_model = new TablaUbicacione;

		$justificacion = $tabla_model->getTablaUbicacionAll("tipo_justificaciones","1");

        return view('frontend.papeleta.create',compact('empresa','justificacion'));
    }

    public function listar_papeleta_ajax(Request $request){
		
		$persona_model = new DetaOperacione;
		$p[]=$request->numero_documento;
		$p[]=$request->persona;
		$p[]=$request->tipo;
		$p[]=$request->empresa;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $persona_model->listar_papeleta_ajax($p);
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

    public function modal_papeleta($id){
		$id_user = Auth::user()->id;
        $papeleta_model = new DetaOperacione;
        //$papeleta = $papeleta_model->getPapeletaById($id);
        if($id>0) $papeleta = $papeleta_model->getPapeletaById($id);else $papeleta = new DetaOperacione;
                
		$tabla_model = new TablaUbicacione;		
		$justificacion = $tabla_model->getTablaUbicacionAll("tipo_justificaciones","1");
		//print_r ($justificacion);exit();
		return view('frontend.papeleta.modal_papeleta',compact('id','papeleta','justificacion'));
	}

    public function obtener_papeleta($tipo_documento,$numero_documento){

        $persona_model = new Persona;
        $sw = true;
        $persona = $persona_model->getPersona($tipo_documento,$numero_documento);
        $array["sw"] = $sw;
        $array["persona"] = $persona;
        echo json_encode($array);

    }
	
	
	public function fecha_formato($fecha){
		//echo $fecha;exit();
		$fecha = substr($fecha,0,10);
		$fecha_tmp = explode('-',$fecha);
		$fecha = $fecha_tmp[2]."-".$fecha_tmp[1]."-".$fecha_tmp[0];
		return $fecha;
	}
	
    public function send_papeleta(Request $request){
		
		if($request->id == 0){
			if($request->tipo_oper_top =="D"){
				$fech_inic_ope = str_replace("/","-",$request->fech_inic_ope);
				$fech_fina_ope = str_replace("/","-",$request->fech_fina_ope);
			}
			if($request->tipo_oper_top =="H"){
				$fecha = str_replace("/","-",$request->fecha);
			}

			
			$papeleta = new DetaOperacione();
			$papeleta->fech_oper_ope = Carbon::now()->timezone('America/Lima')->format('Y-m-d H:i:s');
			$papeleta->fech_elab_ope = Carbon::now()->timezone('America/Lima')->format('Y-m-d H:i:s');			
            $papeleta->id_ubicacion = $request->id_ubicacion;
            $papeleta->id_persona = $request->id_persona;
            $papeleta->id_tipo_operacion = $request->id_tipo_operacion;
            $papeleta->tipo_oper_top = $request->tipo_oper_top;
			$papeleta->tipo_hora_ope = $request->tipo_oper_top;
			if($papeleta->tipo_oper_top =="D"){
            	$papeleta->fech_inic_ope = $fech_inic_ope." ".$request->horainicope;
            	$papeleta->fech_fina_ope = $fech_fina_ope." ".$request->horafinaope;
			}
			if($papeleta->tipo_oper_top =="H"){
            	$papeleta->fech_inic_ope = $fecha." ".$request->horainicope;
            	$papeleta->fech_fina_ope = $fecha." ".$request->horafinaope;
			}

			if($papeleta->tipo_oper_top =="D"){$papeleta->nume_dias_ope = $request->total;}
			if($papeleta->tipo_oper_top =="H"){$papeleta->nume_minut_ope = $request->total;}
            $papeleta->nume_reso_ope = $request->nume_reso_ope;
            $papeleta->obse_oper_ope = $request->obse_oper_ope;
            $papeleta->esta_oper_ope = "1";
			$papeleta->eliminado = "N";            
			$papeleta->save();
			
			/**************************/
			
			if($request->tipo_oper_top =="D"){
				$fech_inic_ope_tmp = $this->fecha_formato($fech_inic_ope);
				$fech_fina_ope_tmp = $this->fecha_formato($fech_fina_ope);
			}
			if($request->tipo_oper_top =="H"){
				$fech_inic_ope_tmp = $this->fecha_formato($fecha);
				$fech_fina_ope_tmp = $this->fecha_formato($fecha);
			}

			$now = Carbon::parse($fech_inic_ope_tmp);
			$end = Carbon::parse($fech_fina_ope_tmp);

			$dias = $end->diffInDays($now);
			$dias++;
			
			$fech_marc_rel = $fech_inic_ope_tmp;
			
			for($i=0;$i<$dias;$i++){ 
			
				$fech_marc_rel_tmp = $this->fecha_formato($fech_marc_rel);
				$asistencia1 = Asistencia::where('id_persona',$request->id_persona)->where('fech_regi_mar',$fech_marc_rel_tmp)->first();

				$asistencia_model = new Asistencia;
				$data = $asistencia_model->recupera_hora_turno_persona($request->id_persona, $fech_marc_rel_tmp);
				$hora_entrada = isset($data->hora_entrada)?$data->hora_entrada:"";
				$hora_salida = isset($data->hora_salida)?$data->hora_salida:"";
/*
				$persona_model = new Persona;
				$persona = $persona_model->getPersonaExt($this->getTipoDocumentoR($tipo_documento), $numero_documento);
				$persona_act->numero_documento = $persona->numero_documento;
*/	




				if($asistencia1){
					$asistencia = Asistencia::find($asistencia1->id);
					/*
					$asistencia->fech_marc_rel = $fech_marc_rel_tmp;
					$asistencia->hora_entr_rel = $request->horainicope;
					$asistencia->fech_sali_rel = $fech_marc_rel_tmp;
					$asistencia->hora_sali_rel = $request->horafinaope;
					$asistencia->id_deta_operacion = $papeleta->id;
					*/
					

					$asistencia->fech_regi_eas = $fech_marc_rel_tmp;
					$asistencia->tipo_marc_eas = $request->tipo_oper_top;
					$asistencia->hora_marc_eas = $request->horainicope.":00";
					$asistencia->hora_marc_sal = $request->horafinaope.":00";
					$asistencia->nume_bole_eas = $papeleta->id;
					$asistencia->flag_bole_eas = "S";
					$asistencia->id_deta_operacion = $papeleta->id;
					$asistencia->fech_regi_mar = $fech_marc_rel_tmp;

					$asistencia->save();
					$asistencia_model = new Asistencia;
					$asistencia_model->recalcular_asistenciaP($asistencia->id);

				}else{
					if($request->tipo_oper_top =="D"){
						$asistencia = new Asistencia();
						/*
						$asistencia->id_persona = $request->id_persona;
						$asistencia->fech_marc_rel = $fech_marc_rel_tmp;
						$asistencia->hora_entr_rel = $request->horainicope;
						$asistencia->fech_sali_rel = $fech_marc_rel_tmp;
						$asistencia->hora_sali_rel = $request->horafinaope;
						$asistencia->fech_regi_eas = Carbon::now()->timezone('America/Lima')->format('Y-m-d H:i:s');
						$asistencia->fech_regi_mar = $fech_marc_rel_tmp;
						$asistencia->id_deta_operacion = $papeleta->id;
						*/
						$asistencia->fech_marc_rel = $fech_marc_rel_tmp;
						
						$asistencia->id_persona = $request->id_persona;
						//$asistencia->fech_marc_rel = $fech_marc_rel_tmp;
						//$asistencia->hora_entr_rel = $request->horainicope.":00";
						//$asistencia->fech_sali_rel = $fech_marc_rel_tmp;
						//$asistencia->hora_sali_rel = $request->horafinaope.":00";
						//$asistencia->fech_regi_eas = $fech_marc_rel_tmp;
						$asistencia->fech_regi_eas = Carbon::now()->timezone('America/Lima')->format('Y-m-d H:i:s');
						$asistencia->fech_regi_mar = $fech_marc_rel_tmp;
						$asistencia->id_deta_operacion = $papeleta->id;

						$asistencia->tipo_marc_eas = $request->tipo_oper_top;
						$asistencia->flag_bole_eas = "S";
						$asistencia->hora_marc_eas = $request->horainicope.":00";
						$asistencia->hora_marc_sal = $request->horafinaope.":00";
						$asistencia->nume_bole_eas = $papeleta->id;

						$asistencia->hora_entrada = $hora_entrada;
						$asistencia->hora_salida = $hora_salida;

						$asistencia->save();
						
						$asistencia_model = new Asistencia;
						$asistencia_model->recalcular_asistenciaP($asistencia->id);

					}
					else{
						echo "Solo se aplica omision de marcación cuando exista alguna Asistemcia";

					}
				}
				
				$fech_marc_rel = $now->addDay(1);
			}
			
			
		}else{
			$papeleta = DetaOperacione::find($request->id);
            $papeleta->id_tipo_operacion = $request->id_tipo_operacion;
            $papeleta->tipo_oper_top = $request->tipo_oper_top;
			$papeleta->tipo_hora_ope = $request->tipo_oper_top;
			if($papeleta->tipo_oper_top =="D"){
            	$papeleta->fech_inic_ope = str_replace("-","/",$request->fech_inic_ope)." ".$request->horainicope;
            	$papeleta->fech_fina_ope = str_replace("-","/",$request->fech_fina_ope)." ".$request->horafinaope;
			}

			if($papeleta->tipo_oper_top =="H"){
            	$papeleta->fech_inic_ope = str_replace("-","/",$request->fecha)." ".$request->horainicope;
            	$papeleta->fech_fina_ope = str_replace("-","/",$request->fecha)." ".$request->horafinaope;
			}

			if($papeleta->tipo_oper_top =="D"){$papeleta->nume_dias_ope = $request->total;}
			if($papeleta->tipo_oper_top =="H"){$papeleta->nume_minut_ope = $request->total;}
            $papeleta->nume_reso_ope = $request->nume_reso_ope;
            $papeleta->obse_oper_ope = $request->obse_oper_ope;
			$papeleta->save();
			
			/**************************/
			if($request->tipo_oper_top =="D"){
				$fech_inic_ope = str_replace("/","-",$request->fech_inic_ope);
				$fech_fina_ope = str_replace("/","-",$request->fech_fina_ope);
			}
			if($request->tipo_oper_top =="H"){
				$fecha = str_replace("/","-",$request->fecha);
			}
			
			if($request->tipo_oper_top =="D"){
				$fech_inic_ope_tmp = $this->fecha_formato($fech_inic_ope);
				$fech_fina_ope_tmp = $this->fecha_formato($fech_fina_ope);
			}
			if($request->tipo_oper_top =="H"){
				$fech_inic_ope_tmp = $this->fecha_formato($fecha);
				$fech_fina_ope_tmp = $this->fecha_formato($fecha);
			}
			
			$now = Carbon::parse($fech_inic_ope_tmp);
			$end = Carbon::parse($fech_fina_ope_tmp);

			$dias = $end->diffInDays($now);
			$dias++;
			
			$fech_marc_rel = $fech_inic_ope_tmp;
			
			for($i=0;$i<$dias;$i++){ 
			
				$fech_marc_rel_tmp = $this->fecha_formato($fech_marc_rel);
				
				$asistencia1 = Asistencia::where('id_persona',$papeleta->id_persona)->where('fech_regi_mar',$fech_marc_rel_tmp)->first();

				if($asistencia1){
					$asistencia = Asistencia::find($asistencia1->id);
					$asistencia->fech_marc_rel = $fech_marc_rel_tmp;
					//$asistencia->hora_entr_rel = $request->horainicope.":00";
					$asistencia->hora_entr_rel = $request->horainicope;
					$asistencia->fech_sali_rel = $fech_marc_rel_tmp;
					//$asistencia->hora_sali_rel = $request->horafinaope.":00";
					$asistencia->hora_sali_rel = $request->horafinaope;
					$asistencia->id_deta_operacion = $papeleta->id;
					$asistencia->save();
					
					$asistencia_model = new Asistencia;
					$asistencia_model->recalcular_asistenciaP($asistencia->id);
			
					$fech_marc_rel = $now->addDay(1);
					
				}
				
			}
			
			
		}
		
    }
	
	public function eliminar_papeleta($id,$estado)
    {
		$papeleta = DetaOperacione::find($id);
		$papeleta->eliminado = $estado;
		$papeleta->save();


		$asistencia = Asistencia::where('id_deta_operacion',$id)->get();

		foreach ($asistencia as $b) {
			$asis = Asistencia::find($b->id);
			$asis->tipo_marc_eas = null;
			$asis->fech_regi_eas = null;
			$asis->hora_marc_eas = null;
			$asis->hora_marc_sal = null;
			$asis->nume_bole_eas = null;
			$asis->flag_bole_eas = null;
			$asis->id_deta_operacion = null;
			//$asis->fech_marc_rel = null;
			$asis->hora_entr_rel = null;
			$asis->hora_sali_rel = null;
			$asis->minu_tard_eas = null;
			$asis->minu_apor_eas = null;
			$asis->minu_dife_eas = null;
			$asis->fech_sali_rel = null;
			$asis->fech_marc_rel = null;
			$asis->minu_dife_pap = null;


			//$asistencia->fech_regi_mar = "";
			$asis->save();
			}


		echo $papeleta->id;
    }

	public function buscar_papeleta($tipo_documento,$numero_documento){


		$sw = 1;//encontrado en Felmo
		//$tarjeta = NULL;
		$persona = Persona::where('tipo_documento',$tipo_documento)->where('numero_documento',$numero_documento)->where('estado','A')->first();

		if($persona) $persona_detalle = PersonaDetalle::where('id_persona', '=', $persona->id)->where('estado', '=', 'A')->first();
		else $persona_detalle = new PersonaDetalle;


		
		if(!$persona){
			
			$persona_model = new Persona;
			$persona = $persona_model->getPersonaExt($this->getTipoDocumentoR($tipo_documento), $numero_documento);

			//print_r("tipo->".$tipo_documento);
			//print_r("numero->".$numero_documento);
			//print_r($persona);
			

			if($persona){
				
				$persona_act = new Persona;

				//print($persona->tipo_documento);
				$persona_act->tipo_documento = $tipo_documento;				
				$persona_act->numero_documento = $persona->numero_documento;
				$persona_act->apellido_paterno = $persona->apellido_paterno;
				$persona_act->apellido_materno = $persona->apellido_materno;
				$persona_act->nombres = $persona->nombres;
				$persona_act->fecha_nacimiento = $persona->fecha_nacimiento;
				$persona_act->sexo = $persona->sexo;			
				$persona_act->estado = 'A';
				$persona_act->save();

				$persona = Persona::where('tipo_documento',$tipo_documento)->where('numero_documento',$numero_documento)->where('estado','A')->first();
				//print_r("Persona Act -> ".$persona);
				
/*
				$persona_detalle_act = new PersonaDetalle;
				$persona_detalle_act->telefono = $persona->telefono;
				$persona_detalle_act->email = $persona->email;
				$persona_detalle_act->email = $persona->direccion;
				$persona_detalle_act->save();
*/

			}
				
			if(!$persona){
				$sw = 3;//no existe
				
				$arrContextOptions=array(
					"ssl"=>array(
						"verify_peer"=>false,
						"verify_peer_name"=>false,
					),
				);
				//$url = $this->apiperu_dev($numero_documento);
				//print_r($numero_documento);exit();
				$url = $persona_model->apiperu_dev($numero_documento);
				//print_r($url);exit();
				$datos = json_decode($url,true);
				if(isset($datos["data"])){
					$dato = $datos["data"];
					$persona = new Persona;
					$persona->tipo_documento = '1';
					$persona->numero_documento = $dato['numero'];
					$persona->apellido_paterno = $dato['apellido_paterno'];
					$persona->apellido_materno = $dato['apellido_materno'];
					$persona->nombres = $dato['nombres'];
					$persona->estado = 'A';
					$persona->save();

					$persona = Persona::where('tipo_documento',$tipo_documento)->where('numero_documento',$numero_documento)->where('estado','A')->first();
					

					$sw = 2;//encontrado en Reniec
				}		
			}
		}
		/*
		if(isset($persona->id) && $persona->id > 0){
			$persona_model = new Persona;
			$tarjeta = $persona_model->getTarjetaByIdPersona($persona->numero_documento);
		}
		*/

		//$sw = true;
		//print_r("sw -> ".$sw);
		//print_r("Persona Act -> ".$persona);

        $array["sw"] = $sw;
        $array["persona"] = $persona;
		$array["persona_detalle"] = $persona_detalle;
		//$array["tarjeta"] = $tarjeta;
        echo json_encode($array);

    }

	public function getTipoDocumento($tipo){
        $codigo = "";
		
        switch ($tipo) {
            case "DNI":
                $codigo = "1";
            break;
            case "CARNET_EXTRANJERIA":
                $codigo = "2";
            break;
            case "PASAPORTE":
                $codigo = "3";
            break;
            case "CEDULA":
                $codigo = "4";
            break;
            case "PTP/PTEP":
                $codigo = "5";
            break;                        
            default:
            $codigo = "";
        }

        return $codigo;

    }
	
	public function getTipoDocumentoR($id){
        $tipo = "";
		
        switch ($id) {
            case "1":
                $tipo = "DNI";
            break;
            case "2":
                $tipo = "CARNET_EXTRANJERIA2";
            break;
            case "3":
                $tipo = "PASAPORTE";
            break;
            case "4":
                $tipo = "CEDULA";
            break;
            case "5":
                $tipo = "PTP/PTEP";
            break;                        
            default:
            $tipo = "";
        }

        return $tipo;

    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\DocumentoIdentidade;

class TarjetaController extends Controller
{
    public function create()
    {
		//$area_model = new Area;
		//$area = $area_model->getArea();
		$persona = new Persona;
		$documento_identidad = new DocumentoIdentidade;
        return view('frontend.tarjeta.create',compact('persona','documento_identidad'));
    }

    public function listar_tarjeta_ajax(Request $request){

		$tarjeta_model = new Tarjeta;
		$p[]=$request->numero_documento;
		$p[]=$request->persona;
		$p[]=$request->numero_tarjeta;
		$p[]=$request->id_area;
		$p[]=$request->id_plan;
		$p[]=$request->estado;
		$p[]=$request->tipo_documento;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $tarjeta_model->listar_tarjeta_ajax($p);
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

	public function modal_tarjeta($id){
		$id_user = Auth::user()->id;
		return view('frontend.tarjeta.modal_tarjeta',compact('id'));

	}

	public function list_persona($term)
    {
		$persona_model = new Persona;
		$persona = $persona_model->getPersonaBuscar($term);
		return response()->json($persona);
    }

	public function send_tarjeta(Request $request){

		$sw = true;
		$msg = "";

		if($request->id == 0){

			$tarjetaExiste = Tarjeta::where("numero_tarjeta",$request->numero_tarjeta)->where("estado","1")->get();

			if(count($tarjetaExiste)==0){

				$tarjeta = new Tarjeta;
				$tarjeta->persona_id = $request->persona_id;
				$tarjeta->numero_tarjeta = $request->numero_tarjeta;
				$tarjeta->estado = "1";
				$tarjeta->save();
				$id_tarjeta = $tarjeta->id;


				$ws_model = new TablaMaestra;

				$estado_ws = $ws_model->getCajaAllTipo('TARJETERO');
				$flagWs = isset($estado_ws[0]->codigo)?$estado_ws[0]->codigo:1;

				if ($flagWs==2){
					$model = new Tarjeta();
					$model->zkteco_crear_item3($tarjeta->persona_id,$tarjeta->numero_tarjeta,$id_tarjeta);
				}

			}else{
				$sw = false;
				$msg = "El Numero de Tarjeta ingresado ya existe !!!";
			}

		}else{
			$tarjeta = Tarjeta::find($request->id);
			//$solicitud->monto_aprobado = $request->monto_aprobado;
			//$solicitud->fecha_aprobacion = Carbon::now()->timezone('America/Lima')->format('Y-m-d H:i:s');
			$tarjeta->save();
		}

		$array["sw"] = $sw;
        $array["msg"] = $msg;
        echo json_encode($array);

    }

	public function eliminar_tarjeta($id,$estado)
    {
		$sw = true;
		$msg = "";

		$tarjeta = Tarjeta::find($id);

		$tarjetaExiste = Tarjeta::where("numero_tarjeta",$tarjeta->numero_tarjeta)->where("estado","1")->get();

		if(count($tarjetaExiste)==0 || $estado==2){

			$tarjeta->estado = $estado;
			$tarjeta->save();

			$ws_model = new TablaMaestra;
			$estado_ws = $ws_model->getCajaAllTipo('TARJETERO');
			$flagWs = isset($estado_ws[0]->codigo)?$estado_ws[0]->codigo:1;

			//print ("tarjeta ->".$flagWs);
			//print ("estado ->".$estado);

			if ($flagWs==2){
				//$model = new Tarjeta();
				$zkpush = new Zkpush();
				//print ("estado ->".$estado);
				if($estado=="1"){
					//$model->zkteco_crear_item2($tarjeta->persona_id,$tarjeta->numero_tarjeta,$tarjeta->id);
					$zkpush->zkpush_nuevo_crear_item('1',$tarjeta->persona_id,$tarjeta->numero_tarjeta);
				}else{
					//$model->zkteco_eliminar_acceso($tarjeta->persona_id,$tarjeta->numero_tarjeta,$tarjeta->id); 
					$zkpush->zkpush_nuevo_crear_item('0',$tarjeta->persona_id,$tarjeta->numero_tarjeta);

					/*******INICIO FLAG NEGATIVO**********/
						
					$persona = Persona::find($tarjeta->persona_id);
					$persona->flag_negativo = 1;
					$persona->save();
	
					$negativo = new Negativo;
					$negativo->persona_id = $tarjeta->persona_id;
					$negativo->flag_negativo = 1;
					$negativo->observacion = utf8_encode("Inactivaci n masivo y manual de la tarjeta por el sistema");
					$negativo->fecha = Carbon::now()->format('Y-m-d');
					$negativo->save();
					
					/*******FIN FLAG NEGATIVO**********/
					
				}

			}
			//exit();

		}else{
			$sw = false;
			$msg = "El Numero de Tarjeta ingresado ya existe !!!";
		}
		//echo $tarjeta->id;

		$array["sw"] = $sw;
        $array["msg"] = $msg;
        echo json_encode($array);

	}
	
	public function eliminar_tarjeta_bloque(Request $request){

		$mov = $request->mov;
		$estado=2;
		
		foreach ($mov as $key => $value) {
            $id = $value;
			$tarjeta = Tarjeta::find($id);
			$tarjetaExiste = Tarjeta::where("numero_tarjeta",$tarjeta->numero_tarjeta)->where("estado","1")->get();

			if(count($tarjetaExiste)==0 || $estado==2){
	
				$tarjeta->estado = $estado;
				$tarjeta->save();
	
				$ws_model = new TablaMaestra;
				$estado_ws = $ws_model->getCajaAllTipo('TARJETERO');
				$flagWs = isset($estado_ws[0]->codigo)?$estado_ws[0]->codigo:1;
	
				if ($flagWs==2){
					//$model = new Tarjeta();
					$zkpush = new Zkpush();
					if($estado=="1"){
						//$model->zkteco_crear_item2($tarjeta->persona_id,$tarjeta->numero_tarjeta,$tarjeta->id);
						$zkpush->zkpush_nuevo_crear_item('1',$tarjeta->persona_id,$tarjeta->numero_tarjeta);
					}else{
						//$model->zkteco_eliminar_acceso($tarjeta->persona_id,$tarjeta->numero_tarjeta,$tarjeta->id); 
						$zkpush->zkpush_nuevo_crear_item('0',$tarjeta->persona_id,$tarjeta->numero_tarjeta);
						
						/*******INICIO FLAG NEGATIVO**********/
						
						$persona = Persona::find($tarjeta->persona_id);
						$persona->flag_negativo = 1;
						$persona->save();
		
						$negativo = new Negativo;
						$negativo->persona_id = $tarjeta->persona_id;
						$negativo->flag_negativo = 1;
						$negativo->observacion = utf8_encode("Inactivaci n masivo y manual de la tarjeta por el sistema");
						$negativo->fecha = Carbon::now()->format('Y-m-d');
						$negativo->save();
						
						/*******FIN FLAG NEGATIVO**********/
						
					}
	
				}
	
			}
			
        }

    }
}


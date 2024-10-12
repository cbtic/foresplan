<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TablaMaestra;
use App\Models\IngresoVehiculoTronco;
use App\Models\IngresoVehiculoTroncoTipoMadera;
use App\Models\IngresoVehiculoTroncoCubicaje;
use App\Models\IngresoVehiculoTroncoImagene;
use App\Models\Vehiculo;
use App\Models\Empresa;
use App\Models\Conductores;
use App\Models\EmpresasConductoresVehiculo;
use App\Models\Pago;
use Auth;
use Carbon\Carbon;

class IngresoVehiculoTroncoController extends Controller
{
    public function index(){

		$tablaMaestra_model = new TablaMaestra;
		$tipo_madera = $tablaMaestra_model->getMaestroByTipo(42);
		$tipo_documento = $tablaMaestra_model->getMaestroByTipo(9);
		
		return view('frontend.ingreso.create',compact('tipo_madera','tipo_documento'));

	}
	
	public function modal_placa($id){
		
		$id_user = Auth::user()->id;
		//$tablaMaestra_model = new TablaMaestra;
		if($id>0) $vehiculo = Vehiculo::find($id);else $vehiculo = new Vehiculo;
		//$tipo_concurso = $tablaMaestra_model->getMaestroByTipo(101);

		return view('frontend.vehiculo.modal_vehiculo_ingreso',compact('id','vehiculo'/*,'tipo_concurso'*/));

    }
	
	public function modal_empresa($id){
		
		$id_user = Auth::user()->id;
		//$tablaMaestra_model = new TablaMaestra;
		if($id>0) $empresa = Empresa::find($id);else $empresa = new Empresa;
		//$tipo_concurso = $tablaMaestra_model->getMaestroByTipo(101);

		return view('frontend.empresa.modal_empresa_ingreso',compact('id','empresa'/*,'tipo_concurso'*/));

    }
	
	public function modal_conductor($id){
		
		$id_user = Auth::user()->id;
		$tablaMaestra_model = new TablaMaestra;
		if($id>0) $conductor = Conductores::find($id);else $conductor = new Conductores;
		$tipo_documento = $tablaMaestra_model->getMaestroByTipo(9);

		return view('frontend.conductores.modal_conductor_ingreso',compact('id','conductor','tipo_documento'));

    }

	public function obtener_datos_vehiculo($placa){

		$sw = true;
		$msg = "";
		$ingresoVehiculoTronco_model = new IngresoVehiculoTronco;
		$vehiculo = $ingresoVehiculoTronco_model->getEmpresaConductorVehiculos($placa);
		
		if(!$vehiculo){
			$vehiculo = Vehiculo::Where("placa",$placa)->Where("estado",1)->first();
			if($vehiculo){
				$vehiculo->id_vehiculos = $vehiculo->id;
			}else{
				$sw = false;
				$msg = "El Vehiculo ingresado no existe !!!";
			}
			
		}
		
		$array["sw"] = $sw;
		$array["msg"] = $msg;
        $array["vehiculo"] = $vehiculo;
        echo json_encode($array);
		
	}

	public function send_ingreso(Request $request){

		$id_user = Auth::user()->id;

		$ingresoVehiculoTronco = new IngresoVehiculoTronco;
		$ingresoVehiculoTronco->fecha_ingreso = $request->fecha_ingreso;
		$ingresoVehiculoTronco->fecha_salida = $request->fecha_ingreso;
		$ingresoVehiculoTronco->id_empresa_transportista = $request->id_empresa_transportista;
		$ingresoVehiculoTronco->id_empresa_proveedor = $request->id_empresa_transportista;//0;
		$ingresoVehiculoTronco->id_vehiculos = $request->id_vehiculos;
		$ingresoVehiculoTronco->id_conductores = $request->id_conductores;
		$ingresoVehiculoTronco->id_encargados = 1;
		$ingresoVehiculoTronco->id_procedencias = 0;
		$ingresoVehiculoTronco->save();
		$id_ingreso_vehiculo_troncos = $ingresoVehiculoTronco->id;
		
		/*************************/
		
		$vehiculo = Vehiculo::find($request->id_vehiculos);
		
		$path = "img/ingreso/".$vehiculo->placa;
        if (!is_dir($path)) {
            mkdir($path);
        }
		
		$img_foto = $request->img_foto;
		
		if(count($img_foto)>0){
			$path = "img/ingreso/".$vehiculo->placa."/".str_replace("/","-",$request->fecha_ingreso);
			if (!is_dir($path)) {
				mkdir($path);
			}
		}
		
		foreach($img_foto as $row){
			
			if($row!=""){
				$filepath_tmp = public_path('img/ingreso/tmp/');
				$filepath_nuevo = public_path('img/ingreso/'.$vehiculo->placa.'/'.str_replace("/","-",$request->fecha_ingreso).'/');
				
				if (file_exists($filepath_tmp.$row)) {
					copy($filepath_tmp.$row, $filepath_nuevo.$row);
				}
				
				$ingresoVehiculoTroncoImagen = new IngresoVehiculoTroncoImagene;
				$ingresoVehiculoTroncoImagen->id_ingreso_vehiculo_troncos = $id_ingreso_vehiculo_troncos;
				$ingresoVehiculoTroncoImagen->ruta_imagen = "img/ingreso/".$vehiculo->placa."/".str_replace("/","-",$request->fecha_ingreso)."/".$row;
				$ingresoVehiculoTroncoImagen->id_tipo_maderas = 0;
				$ingresoVehiculoTroncoImagen->estado = 1;
				$ingresoVehiculoTroncoImagen->save();
			}
			
		}
		
		/*************************/
		
		$ingresoVehiculoTroncoTipoMadera = new IngresoVehiculoTroncoTipoMadera;
		$ingresoVehiculoTroncoTipoMadera->id_ingreso_vehiculo_troncos = $id_ingreso_vehiculo_troncos;
		$ingresoVehiculoTroncoTipoMadera->id_tipo_maderas = $request->tipo_maderas_id;
		$ingresoVehiculoTroncoTipoMadera->cantidad = $request->cantidad;
		$ingresoVehiculoTroncoTipoMadera->estado = 1;
		$ingresoVehiculoTroncoTipoMadera->save();
		$id_ingreso_vehiculo_tronco_tipo_maderas = $ingresoVehiculoTroncoTipoMadera->id;
		
		for($i=1;$i<=$request->cantidad;$i++){
			$ingresoVehiculoTroncoCubicaje = new IngresoVehiculoTroncoCubicaje;
			$ingresoVehiculoTroncoCubicaje->id_ingreso_vehiculo_tronco_tipo_maderas=$id_ingreso_vehiculo_tronco_tipo_maderas;
			$ingresoVehiculoTroncoCubicaje->diametro_1= 0;
			$ingresoVehiculoTroncoCubicaje->diametro_2 = 0;
			$ingresoVehiculoTroncoCubicaje->diametro_dm = 0;
			$ingresoVehiculoTroncoCubicaje->longitud = 0;
			$ingresoVehiculoTroncoCubicaje->volumen_m3 = 0;
			$ingresoVehiculoTroncoCubicaje->volumen_pies = 0;
			$ingresoVehiculoTroncoCubicaje->volumen_total_m3 = 0;
			$ingresoVehiculoTroncoCubicaje->volumen_total_pies = 0;
			$ingresoVehiculoTroncoCubicaje->precio_unitario = 0;
			$ingresoVehiculoTroncoCubicaje->precio_total = 0;
			$ingresoVehiculoTroncoCubicaje->save();
		}
		
		
		$empresasConductoresVehiculoExiste = EmpresasConductoresVehiculo::where("id_empresas",$request->id_empresa_transportista)->where("id_vehiculos",$request->id_vehiculos)->where("id_conductores",$request->id_conductores)->where("estado",1)->get();
		if(count($empresasConductoresVehiculoExiste)==0){
			$empresasConductoresVehiculo = new EmpresasConductoresVehiculo;
			$empresasConductoresVehiculo->id_empresas = $request->id_empresa_transportista;
			$empresasConductoresVehiculo->id_vehiculos = $request->id_vehiculos;
			$empresasConductoresVehiculo->id_conductores = $request->id_conductores;
			$empresasConductoresVehiculo->estado = "1";
			$empresasConductoresVehiculo->save();
		}
		
    }

	public function listar_ingreso_vehiculo_tronco_ajax(Request $request){

		$ingresoVehiculoTronco_model = new IngresoVehiculoTronco();
		$p[]=$request->placa;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $ingresoVehiculoTronco_model->listar_ingreso_vehiculo_tronco_ajax($p);
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

	public function cubicaje(){

		//$tablaMaestra_model = new TablaMaestra;
		//$tipo_madera = $tablaMaestra_model->getMaestroByTipo(42);

		return view('frontend.cubicaje.create'/*,compact('tipo_madera')*/);

	}

	public function cargar_cubicaje($id){

		$ingresoVehiculoTronco_model = new IngresoVehiculoTronco;
        $cubicaje = $ingresoVehiculoTronco_model->getIngresoVehiculoTroncoCubicajeById($id);

        return view('frontend.cubicaje.cubicaje_ajax',compact('cubicaje'));

    }
	
	public function cargar_reporte_cubicaje($id){
		 
		$ingresoVehiculoTronco_model = new IngresoVehiculoTronco;
        $cubicaje = $ingresoVehiculoTronco_model->getIngresoVehiculoTroncoCubicajeReporteById($id);
		
        return view('frontend.cubicaje.cubicaje_reporte_ajax',compact('cubicaje'));
		
    }
	
	public function send_cubicaje(Request $request){
		
		$id_user = Auth::user()->id;
		
		$id_ingreso_vehiculo_tronco_cubicaje = $request->id_ingreso_vehiculo_tronco_cubicaje;
		$diametro_1 = $request->diametro_1;
		$diametro_2 = $request->diametro_2;
		$diametro_dm = $request->diametro_dm;
		$longitud = $request->longitud;
		$volumen_m3 = $request->volumen_m3;
		$volumen_pies = $request->volumen_pies;
		$volumen_total_m3 = $request->volumen_total_m3;
		$volumen_total_pies = $request->volumen_total_pies;
		$precio_unitario = $request->precio_unitario;
		$precio_total = $request->precio_total;
		$precio_total_final = 0;
		

		foreach($id_ingreso_vehiculo_tronco_cubicaje as $key=>$row){

			$ingresoVehiculoTroncoCubicaje = IngresoVehiculoTroncoCubicaje::find($row);
			$ingresoVehiculoTroncoCubicaje->diametro_1= $diametro_1[$key];
			$ingresoVehiculoTroncoCubicaje->diametro_2 = $diametro_2[$key];
			$ingresoVehiculoTroncoCubicaje->diametro_dm = $diametro_dm[$key];
			$ingresoVehiculoTroncoCubicaje->longitud = $longitud[$key];
			$ingresoVehiculoTroncoCubicaje->volumen_m3 = $volumen_m3[$key];
			$ingresoVehiculoTroncoCubicaje->volumen_pies = $volumen_pies[$key];
			$ingresoVehiculoTroncoCubicaje->volumen_total_m3 = $volumen_total_m3[$key];
			$ingresoVehiculoTroncoCubicaje->volumen_total_pies = $volumen_total_pies[$key];
			$ingresoVehiculoTroncoCubicaje->precio_unitario = $precio_unitario[$key];
			$ingresoVehiculoTroncoCubicaje->precio_total = $precio_total[$key];
			$ingresoVehiculoTroncoCubicaje->save();
			
			$precio_total_final+=$precio_total[$key];
		}
		
		$ingresoVehiculoTroncoTipoMadera = IngresoVehiculoTroncoTipoMadera::find($request->id_ingreso_vehiculo_tronco_tipo_maderas);
		$ingresoVehiculoTroncoTipoMadera->total = $precio_total_final;
		$ingresoVehiculoTroncoTipoMadera->save();
		
		/**************************************/
		
		$id_ingreso_vehiculo_troncos = $ingresoVehiculoTroncoTipoMadera->id_ingreso_vehiculo_troncos;
		$ingresoVehiculoTronco = IngresoVehiculoTronco::find($id_ingreso_vehiculo_troncos);
		
		$empresa = Empresa::find($ingresoVehiculoTronco->id_empresa_transportista);
		
		$pago = new Pago;
		$pago->id_modulo = 1;
		$pago->pk_registro = $id_ingreso_vehiculo_troncos;
		$pago->fecha = Carbon::now()->format('Y-m-d');
		$pago->comprobante_destinatario = $empresa->razon_social;
		$pago->comprobante_direccion = $empresa->direccion;
		$pago->comprobante_ruc = $empresa->ruc;
		$pago->subtotal = $precio_total_final;
		$pago->impuesto = 0;
		$pago->total = $precio_total_final;
		$pago->letras = "";
		$pago->id_moneda = 1;
		$pago->estado_pago = "N";
		$pago->estado = "1";
		$pago->id_usuario_inserta = $id_user;
		$pago->save();

    }
	
	public function upload_imagen_ingreso(Request $request){
		
		$path = "img/ingreso";
        if (!is_dir($path)) {
            mkdir($path);
        }
		
		$path = "img/ingreso/tmp";
        if (!is_dir($path)) {
            mkdir($path);
        }
		
		/*
        $path = "files/" . $ht . "/resolucion";
        if (!is_dir($path)) {
            mkdir($path);
        }
		*/
		
    	$filepath = public_path('img/ingreso/tmp/');
		move_uploaded_file($_FILES["file"]["tmp_name"], $filepath.$_FILES["file"]["name"]);
		echo $_FILES['file']['name'];
		
	}
	
	public function modal_ingreso_imagen($id){
		 
		$ingresoVehiculoTroncoImagene_model = new IngresoVehiculoTroncoImagene;
        $ingresoVehiculoTroncoImagen = $ingresoVehiculoTroncoImagene_model->getIngresoVehiculoTroncoImagenById($id);
		
        return view('frontend.ingreso.modal_ingreso_imagen',compact('ingresoVehiculoTroncoImagen'));
		
    }
		


}

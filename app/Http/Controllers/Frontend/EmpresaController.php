<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Empresa;
//use App\Models\Negativo;
use App\Models\TablaMaestra;
use Auth;

class EmpresaController extends Controller
{

	public function __construct(){
		
		$this->middleware(function ($request, $next) {
			if(!Auth::check()) {
                return redirect('login');
            }
			return $next($request);
    	});
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$afiliacion_model = new Afiliacion;
        //$afiliacion = $afiliacion_model->getAfiliacionesAll();
        return view('frontend.empresa.all'/*,compact('afiliacion')*/);
    }
	
	public function consulta_usuario_empresa()
    {
        //$afiliacion_model = new Afiliacion;
        //$afiliacion = $afiliacion_model->getAfiliacionesAll();
        return view('frontend.empresa.all_usuario_empresa'/*,compact('afiliacion')*/);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
    }

    public function send_ajax(Request $request)
    {
        if ($request->ajax()) {

           // print_r ($request);
           // exit();
        	
			
			
            request()->validate([
                'empresa_numero_ruc' => 'required|min:11|max:11',
                'empresa_razon_social' => 'required',
                'empresa_direccion' => 'required',
                'empresa_telefono' => 'required|min:7',
                'empresa_email' => 'required|min:5'
                ]);
             
			$empresa_model = new Empresa();
			$empresa_valida = $empresa_model->getValidaEmpresaByRuc($request->empresa_numero_ruc);
			if(!isset($empresa_valida)){
				$data_empresa = $request->except('_method', '_token');
				$data_empresa["ruc"] = $request->empresa_numero_ruc;
				$data_empresa["nombre_comercial"] = $request->empresa_razon_social;
				$data_empresa["razon_social"] = $request->empresa_razon_social;
				$data_empresa["direccion"] = $request->empresa_direccion;
				$data_empresa["representante"] = "Representante";
				$data_empresa["email"] = $request->empresa_email;
				$data_empresa["telefono"] = $request->empresa_telefono;
				
				$result_empresa = Empresa::create($data_empresa);
				
				$ubicacion_trabajo = UbicacionTrabajo::firstOrCreate(['ubicacion_empresa_id' => $result_empresa->id, 'ubicacion_unidad_id' => 1, 'ubicacion_estado' => 'A']);
	
				if($result_empresa){ 
					$arr = array('msg' => 'La empresa ha sido ingresada con exito en el sistema!', 'status' => true, 'empresa'=>$data_empresa);
				} else {
					$arr = array('msg' => 'Revisar los datos enviados antes de completar la inscripción!', 'status' => false);
				}
			
			}else{
				$arr = array('msg' => 'La empresa ya existe en el sistema!', 'status' => true, 'empresa'=>$empresa_valida);
			}
			
			
        } else {
            $arr = array('msg' => 'Error al mandar los datos en formato desconocido!', 'status' => false);
        }

        return Response()->json($arr);
    }

    public function send_nueva_empresa_ajax(Request $request)
    {
        if ($request->ajax()) {

            request()->validate([
                'empresa_numero_ruc' => 'required|min:11|max:11',
                'empresa_razon_social' => 'required|min:3',
                'empresa_direccion' => 'required|min:8|max:256',
                'empresa_email' => 'required|email',
                ]);
                 
            $data_empresa = $request->except('_method', '_token');

            $data_empresa["ruc"] = $request->empresa_numero_ruc;
            $data_empresa["nombre_comercial"] = $request->empresa_razon_social;
            $data_empresa["razon_social"] = $request->empresa_razon_social;
            $data_empresa["direccion"] = $request->empresa_direccion;
            $data_empresa["representante"] = "Representante";
            $data_empresa["email"] = $request->empresa_email;
            // $data_empresa["telefono"] = "999999999";

            $result_empresa = Empresa::create($data_empresa);

            $ubicacion_trabajo = UbicacionTrabajo::firstOrCreate(['ubicacion_empresa_id' => $result_empresa->id, 'ubicacion_unidad_id' => 1, 'ubicacion_estado' => 'A']);

            if($result_empresa){ 
                $arr = array('id_ubicacion' => $ubicacion_trabajo["id"], 'ruc' => $data_empresa["ruc"], 'razon_social' => $data_empresa["razon_social"],'email' => $data_empresa["email"], 'direccion' => $data_empresa["direccion"], 'msg' => 'La empresa ha sido ingresada con exito en el sistema!', 'status' => true);
            } else {
                $arr = array('msg' => 'Revisar los datos enviados antes de completar la inscripción!', 'status' => false);
            }
        } else {
            $arr = array('msg' => 'Error al mandar los datos en formato desconocido!', 'status' => false);
        }

        return Response()->json($arr);
    }

    public function buscar_ajax(Request $request)
    {
        if ($request->ajax()) {
            
            if ($request->numero_ruc_dni != '') {
                request()->validate(['numero_ruc_dni' => 'required|min:8|max:11']);
            }

            $data_empresa = $request->except('_method', '_token');
            $data_empresa["numero_ruc_dni"] = $request->numero_ruc_dni;
            $persona_o_empresa = array('particular' => 'persona', 'empresa' => 'empresa');
            $result_empresa=[]; $result_persona=[];

            if ($request->numero_ruc_dni != '') {
                if ($request->empresa_particular == 'particular') {   
					/*
                    $id_empresa=0;                    
                    $result_empresa = Empresa::where('ruc', $data_empresa["numero_ruc_dni"])->get()->all();
                    if (count($result_empresa)) {
                        $id_empresa = $result_empresa[0]["id"];
                    }

                    if ($id_empresa == 0) {
                        $result_persona = Persona::where('numero_documento', 
                        $data_empresa["numero_ruc_dni"])->get()->all();
                    } else {
					
                        $result_ubicacion = UbicacionTrabajo::where('ubicacion_empresa_id', $result_empresa[0]["id"])->get()->all();
                        $ubicacion_id = isset($result_ubicacion[0]["id"])?$result_ubicacion[0]["id"]:0;
                        $result_persona = Persona::where('numero_documento', $data_empresa["numero_ruc_dni"])
						//->where('ubicacion_id',$ubicacion_id)
						->get()->all(); 
                    }
					*/
						$result_persona = Persona::where('numero_documento', $data_empresa["numero_ruc_dni"])->where('estado', 1)->get()->all();
                        if (count($result_persona)) {
						
							if($request->empresa_id > 0){
								$ubicacion_trabajo = UbicacionTrabajo::firstOrCreate(['ubicacion_empresa_id' => $request->empresa_id, 'ubicacion_unidad_id' => 1, 'ubicacion_estado' => 'A']);
								$result_afiliado = Afiliacion::where('persona_id', $result_persona[0]["id"])->where('ubicacion_id',$ubicacion_trabajo->id)->get()->all();
								if (count($result_afiliado) && $result_afiliado[0]["ubicacion_id"] > 0) {
									$ubicacion_id = $result_afiliado[0]["ubicacion_id"];
								}else{
									$data_afiliacion["persona_id"] = $result_persona[0]["id"];
									$data_afiliacion["codigo"] = $result_persona[0]["codigo"];
									$data_afiliacion["fecha_inicio"] = Carbon::now()->format('Y-m-d');
									$data_afiliacion["fecha_vencimiento"] = Carbon::now()->addDay(365)->format('Y-m-d');
									$data_afiliacion["estado"] = true;
									$data_afiliacion["area_id"] = 14;
									$data_afiliacion["ubicacion_id"] = $ubicacion_trabajo->id;
									$data_afiliacion["titular_id"] = 0;
									$result_afiliacion = Afiliacion::create($data_afiliacion);
									$ubicacion_id = $ubicacion_trabajo->id;
								}
							}else{
							
								$result_afiliado = Afiliacion::where('persona_id', $result_persona[0]["id"])->where('estado', 1)->get()->all();
								if (count($result_afiliado) && $result_afiliado[0]["ubicacion_id"] > 0) {
									$ubicacion_id = $result_afiliado[0]["ubicacion_id"];
								}else{
									$data_afiliacion["persona_id"] = $result_persona[0]["id"];
									$data_afiliacion["codigo"] = $result_persona[0]["codigo"];
									$data_afiliacion["fecha_inicio"] = Carbon::now()->format('Y-m-d');
									$data_afiliacion["fecha_vencimiento"] = Carbon::now()->addDay(365)->format('Y-m-d');
									$data_afiliacion["estado"] = true;
									$data_afiliacion["area_id"] = 14;
									$data_afiliacion["ubicacion_id"] = 3070;
									$data_afiliacion["titular_id"] = 0;
									$result_afiliacion = Afiliacion::create($data_afiliacion);
									$ubicacion_id = 3070;
								}
								
							}
							
							
                        }
                } else {
                        $result_empresa = Empresa::where('ruc', $data_empresa["numero_ruc_dni"])->get()->all();
                        if (count($result_empresa)) {
                            //$result_ubicacion = UbicacionTrabajo::where('ubicacion_empresa_id', $result_empresa[0]["id"])->get()->all();
                            //$ubicacion_id = isset($result_ubicacion[0]["id"])?$result_ubicacion[0]["id"]:0;
							$ubicacion_trabajo = UbicacionTrabajo::firstOrCreate(['ubicacion_empresa_id' => $result_empresa[0]["id"], 'ubicacion_unidad_id' => 1, 'ubicacion_estado' => 'A']);
							$ubicacion_id = $ubicacion_trabajo->id;
                        }
                }
            }

            if(count($result_empresa)+count($result_persona) == 0){ 
                $arr = array('numero_ruc_dni' => $data_empresa["numero_ruc_dni"], 'nueva' => $persona_o_empresa[$request->empresa_particular], 'msg' => 'La '.$persona_o_empresa[$request->empresa_particular].' no se encuentra registrada en el sistema o no tiene afiliacion, la persona no puede registrar servicios.', 'status' => false);
            } else {
                //Incluyendo los resultados:
                if ($request->empresa_particular == 'particular') {  
					
					if (count($result_persona) == 0) {
						$arr = array('numero_ruc_dni' => $data_empresa["numero_ruc_dni"], 'nueva' => $persona_o_empresa[$request->empresa_particular], 'msg' => 'La '.$persona_o_empresa[$request->empresa_particular].' no se encuentra registrada en el sistema o no tiene afiliacion, la persona no puede registrar servicios.', 'status' => false);
					}else{
						$arr = array('nombre_completo' => $result_persona[0]["apellido_paterno"].' '.$result_persona[0]["apellido_materno"].', '.$result_persona[0]["nombres"], 'numero_documento' => $result_persona[0]["numero_documento"],'persona_id' => $result_persona[0]["id"],'ubicacion_id' => $ubicacion_id, 'email' => $result_persona[0]["email"], 'flag_negativo' => $result_persona[0]["flag_negativo"], 'msg' => 'Encontramos '.(count($result_empresa)+count($result_persona)).' ocurrencias!', 'status' => true);
					}
                    
                } else {
					
					if (count($result_empresa) == 0) {
						$arr = array('numero_ruc_dni' => $data_empresa["numero_ruc_dni"], 'nueva' => $persona_o_empresa[$request->empresa_particular], 'msg' => 'La '.$persona_o_empresa[$request->empresa_particular].' no se encuentra registrada en el sistema.', 'status' => false);
					}else{
						$arr = array('razon_social' => $result_empresa[0]["razon_social"], 'nombre_comercial' => $result_empresa[0]["nombre_comercial"], 'nombre_comercial' => $result_empresa[0]["nombre_comercial"], 'direccion' => $result_empresa[0]["direccion"], 'email' => $result_empresa[0]["email"], 'ruc' => $result_empresa[0]["ruc"], 'persona_id' => 0,'ubicacion_id' => $ubicacion_id,  'msg' => 'Encontramos '.(count($result_empresa)+count($result_persona)).' ocurrencias!', 'status' => true);
					}
                    
                }
            }
        } else {
            $arr = array('msg' => 'Error al mandar los datos en formato desconocido!', 'status' => false);
        }

        //echo Response()->json($arr);
        //print_r ('aqui');
        //exit();
        return Response()->json($arr);
    }

    public function obtener_empresa_id($id){

        $empresa_model = new Empresa;        
        $sw = true;
        $empresa = $empresa_model->getEmpresaId($id);
        $array["sw"] = $sw;
        $array["empresa"] = $empresa;
        echo json_encode($array);

    }
	
	public function listar_empresa_ajax(Request $request){
		
		$empresa_model = new Empresa;
		$p[]=$request->razon_social;
		$p[]=$request->ruc;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $empresa_model->listar_empresa_ajax($p);
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
	
	public function listar_usuario_empresa_ajax(Request $request){
		
		$empresa_model = new Empresa;
		$p[]=$request->usuario;
		$p[]=$request->email;
		$p[]=$request->razon_social;
		$p[]=$request->ruc;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $empresa_model->listar_usuario_empresa_ajax($p);
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
	
	public function modal_usuario_empresa($id){
		$id_user = Auth::user()->id;
		
		$userUbicaciones_model = new UserUbicacione;
		if($id>0)$userUbicacion = $userUbicaciones_model->getUserUbicacionById($id);
		else $userUbicacion = new UserUbicacione;
		
		return view('frontend.empresa.modal_usuario_empresa',compact('id','userUbicacion'));
	
	}
	
	public function modal_empresa($id){
		$id_user = Auth::user()->id;
		$empresa = new Empresa;
		if($id>0)$empresa = Empresa::find($id);
		else $empresa = new Empresa;
		//$solicitud_model = new Solicitude;
		//$fecha_actual = Carbon::now()->timezone('America/Lima')->format('Y-m-d H:i:s');
		//$solicitud = $solicitud_model->getSolicitudById($id);
		//$usuario = User::find($id_user);
		return view('frontend.empresa.modal_empresa',compact('id','empresa'));
	
	}

    public function consultaRucWS($ruc){
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apiperu.dev/api/ruc/'.$ruc,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 20b6666ddda099db4204cf53854f8ca04d950a4eead89029e77999b0726181cb'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
	
	public function send(Request $request){
		
		$sw = true;
		$msg = "";

        $validaRuc = $this -> consultaRucWS($request->ruc);

        //print_r ($validaRuc);
        //exit();


		
		if($request->id == 0){
			
			$empresaExiste = Empresa::where("ruc",$request->ruc)->get();
			if(count($empresaExiste)==0){
				$empresa = new Empresa;
				$empresa->ruc = $request->ruc;
				$empresa->razon_social = $request->razon_social;
				$empresa->nombre_comercial = $request->razon_social;
				$empresa->direccion = $request->direccion;
				$empresa->email = $request->email;
				$empresa->telefono = $request->telefono;
				$empresa->representante = "Representante";
				//$empresa->costo_estacionamiento = $request->costo_estacionamiento;
				//$empresa->costo_volumen = $request->costo_volumen;
				$empresa->save();
				$ubicacion_trabajo = UbicacionTrabajo::firstOrCreate(['ubicacion_empresa_id' => $empresa->id, 'ubicacion_unidad_id' => 1, 'ubicacion_estado' => 'A']);
			}else{
				$sw = false;
				$msg = "El Ruc ingresado ya existe !!!";
			}
			
		}else{
			//$empresaExiste = Empresa::where("ruc",$request->ruc)->where("ruc",$request->ruc)->get();
			$empresaExiste = Empresa::where('ruc', '=', trim($request->ruc))->where('estado', '1')->where('id', '!=', $request->id)->get();
			if(count($empresaExiste)==0){
				$empresa = Empresa::find($request->id);
				$empresa->ruc = $request->ruc;
				$empresa->razon_social = $request->razon_social;
				$empresa->nombre_comercial = $request->razon_social;
				$empresa->direccion = $request->direccion;
				$empresa->email = $request->email;
				$empresa->telefono = $request->telefono;
				//$empresa->costo_estacionamiento = $request->costo_estacionamiento;
				//$empresa->costo_volumen = $request->costo_volumen;
				$empresa->save();
			}else{
				$sw = false;
				$msg = "El Ruc ingresado ya existe !!!";
			}
			
		}
		
		$array["sw"] = $sw;
        $array["msg"] = $msg;
        echo json_encode($array);
		
		
    }
	
	public function send_empresa_ingreso(Request $request){
		
		$sw = true;
		$msg = "";
		$empresa = NULL;
        $validaRuc = $this -> consultaRucWS($request->ruc);

        //print_r ($validaRuc);
        //exit();


		
		if($request->id == 0){
			
			$empresaExiste = Empresa::where("ruc",$request->ruc)->get();
			if(count($empresaExiste)==0){
				$empresa = new Empresa;
				$empresa->ruc = $request->ruc;
				$empresa->razon_social = $request->razon_social;
				$empresa->nombre_comercial = $request->razon_social;
				$empresa->direccion = $request->direccion;
				$empresa->email = $request->email;
				$empresa->telefono = $request->telefono;
				$empresa->representante = "Representante";
				//$empresa->costo_estacionamiento = $request->costo_estacionamiento;
				//$empresa->costo_volumen = $request->costo_volumen;
				$empresa->save();
				//$ubicacion_trabajo = UbicacionTrabajo::firstOrCreate(['ubicacion_empresa_id' => $empresa->id, 'ubicacion_unidad_id' => 1, 'ubicacion_estado' => 'A']);
			}else{
				$empresa = $empresaExiste[0];
				$sw = false;
				$msg = "El Ruc ingresado ya existe !!!";
			}
			
		}else{
			//$empresaExiste = Empresa::where("ruc",$request->ruc)->where("ruc",$request->ruc)->get();
			$empresaExiste = Empresa::where('ruc', '=', trim($request->ruc))->where('estado', '1')->where('id', '!=', $request->id)->get();
			if(count($empresaExiste)==0){
				$empresa = Empresa::find($request->id);
				$empresa->ruc = $request->ruc;
				$empresa->razon_social = $request->razon_social;
				$empresa->nombre_comercial = $request->razon_social;
				$empresa->direccion = $request->direccion;
				$empresa->email = $request->email;
				$empresa->telefono = $request->telefono;
				//$empresa->costo_estacionamiento = $request->costo_estacionamiento;
				//$empresa->costo_volumen = $request->costo_volumen;
				$empresa->save();
			}else{
				$sw = false;
				$msg = "El Ruc ingresado ya existe !!!";
			}
			
		}
		
		$array["sw"] = $sw;
        $array["msg"] = $msg;
		$array["empresa"] = $empresa;
        echo json_encode($array);
		
		
    }
	
	public function send_usuario_empresa(Request $request){
		
		$ubicacion_id = 0;
		$id_proveedor = 0;
		
		if($request->tipo=="0")$ubicacion_id=$request->ubicacion_id;
		if($request->tipo=="1")$id_proveedor=$request->id_proveedor;
		
		if($request->id == 0){		
			$userUbicaciones = new UserUbicacione;
			$userUbicaciones->user_id = $request->user_id;
			$userUbicaciones->ubicacion_id = $ubicacion_id;
			$userUbicaciones->id_proveedor = $id_proveedor;
			$userUbicaciones->estado = "A";
			$userUbicaciones->save();
		}else{
			$userUbicaciones = UserUbicacione::find($request->id);
			$userUbicaciones->user_id = $request->user_id;
			$userUbicaciones->ubicacion_id = $ubicacion_id;
			$userUbicaciones->id_proveedor = $id_proveedor;
			$userUbicaciones->estado = "A";
			$userUbicaciones->save();
		}
    }
	
	public function list_usuario($term)
    {
		$empresa_model = new Empresa;
		$usuario = $empresa_model->getUsuarioBuscar($term);
		return response()->json($usuario);
    }
	
	public function list_empresa($term)
    {
		$empresa_model = new Empresa;
		$empresa = $empresa_model->getEmpresaBuscar($term);
		return response()->json($empresa);
    }
	
	public function buscar_empresa_ruc($ruc)
    {
		$empresa_model = new Empresa;
		$empresa = $empresa_model->getEmpresaByRuc($ruc);
		return response()->json($empresa);
    }


    public function eliminar_empresa($id,$estado)
    {
		$empresa = Empresa::find($id);
		$empresa->estado = $estado;
		$empresa->save();

		echo $empresa->id;

    }
	
	public function eliminar_usuario_empresa($id,$estado)
    {
		if($estado==1)$estado_="A";
		if($estado==0)$estado_="E";
		
		$userUbicaciones = UserUbicacione::find($id);
		$userUbicaciones->estado = $estado_;
		$userUbicaciones->save();

		echo $userUbicaciones->id;

    }
	
	public function obtener_empresa($ruc){

        $sw = true;
		$msg = "";
		
		$empresa = Empresa::Where("ruc",$ruc)->Where("estado","1")->first();
		if(!$empresa){
			$sw = false;
			$msg = "La Empresa ingresado no existe !!!";
		}
	
		$array["sw"] = $sw;
		$array["msg"] = $msg;
        $array["empresa"] = $empresa;
        echo json_encode($array);

    }
	
}
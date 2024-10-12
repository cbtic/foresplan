<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Persona;
use App\Models\Conductores;
//use App\Models\Negativo;
use App\Models\TablaMaestra;
use App\Models\Ubigeo;

use Auth;

class PersonaController extends Controller
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
        return view('frontend.persona.all');
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
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }

    public function obtener_persona($tipo_documento,$numero_documento){

        $persona_model = new Persona;
        $sw = true;
        $persona = $persona_model->getPersona($tipo_documento,$numero_documento);
        //print_r($persona);exit();
        $array["sw"] = $sw;
        $array["persona"] = $persona;
        echo json_encode($array);

    }
	
	public function obtener_persona_conductor($tipo_documento,$numero_documento){

        $persona_model = new Persona;
        $sw = true;
		$msg = "";
		$conductor = NULL;
		
        $persona = $persona_model->getPersona($tipo_documento,$numero_documento);
		
		if($persona){
        	$conductor = Conductores::Where("id_personas",$persona->id)->Where("estado","ACTIVO")->first();
			if(!$conductor){
				$sw = false;
				$msg = "El Conductor ingresado no existe !!!";
			}
		}else{
			$sw = false;
			$msg = "El Conductor ingresado no existe !!!";
		}
		
		$array["sw"] = $sw;
		$array["msg"] = $msg;
        $array["persona"] = $persona;
		$array["conductor"] = $conductor;
        echo json_encode($array);

    }

	public function listar_persona_ajax(Request $request){

       // echo("ok"); exit();

		$persona_model = new Persona;
		$p[]=$request->numero_documento;
		$p[]=$request->persona;
        $p[]=$request->empresa;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;

		$data = $persona_model->listar_persona_ajax($p);
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

	public function modal_persona($id){
		$id_user = Auth::user()->id;
        /*
		$persona = new Persona;
		$negativo = "";
		if($id>0){
			$persona = Persona::find($id);
			//$negativo = Negativo::where('persona_id',$id)->orderBy('id', 'desc')->first();
		} else {
			$persona = new Persona;
		}
        		
		$tablaMaestra_model = new TablaMaestra;		
		$tipo_documento = $tablaMaestra_model->getMaestroByTipo("9");
        
		return view('frontend.persona.modal_persona',compact('id','persona','negativo','tipo_documento'));
*/


		$tablaMaestra_model = new TablaMaestra;
		$persona = new Persona;

		if($id>0){
			$persona = Persona::find($id);
		}else{
			$persona = new Persona;
		}
		
		$sexo = $tablaMaestra_model->getMaestroByTipo(2);
		$tipo_documento = $tablaMaestra_model->getMaestroByTipo(9);
		$grupo_sanguineo = $tablaMaestra_model->getMaestroByTipo(26);
		$nacionalidad = $tablaMaestra_model->getMaestroByTipo(41);
        
		$ubigeo_model = new Ubigeo;
		$departamento = $ubigeo_model->getDepartamento();
		
		//$universidad = $tablaMaestra_model->getMaestroByTipo(85);
		//$especialidad = $tablaMaestra_model->getMaestroByTipo(86);
		
		return view('frontend.persona.modal_persona',compact('id','persona','sexo','tipo_documento','grupo_sanguineo','nacionalidad','departamento'));        

	}

    public function obtener_provincia($idDepartamento){
		
		$ubigeo_model = new Ubigeo;
		$provincia = $ubigeo_model->getProvincia($idDepartamento);
		echo json_encode($provincia);
	}
	
	public function obtener_distrito($id_departamento,$idProvincia){
		
		$ubigeo_model = new Ubigeo;
		$distrito = $ubigeo_model->getDistrito($id_departamento,$idProvincia);
		echo json_encode($distrito);
	}

	public function modal_persona_vacuna($id_persona){

		$maestra_model = new TablaMaestra;
		$vacuna = $maestra_model->getMaestroByTipo('VACUNA');
		$fabricante = $maestra_model->getMaestroByTipo('FABRICANTE');

		$persona_vacuna_model = new PersonaVacuna;
		$fecha_actual = $persona_vacuna_model->fecha_actual();
		$vacunas = $persona_vacuna_model->getVacunaByPersona($id_persona);
		$dosis[1] = "1";
		$dosis[2] = "2";
		$dosis[3] = "3";
		$dosis[4] = "4";
		$dosis[5] = "5";
		return view('frontend.persona.modal_persona_vacuna',compact('id_persona','fecha_actual','vacunas','vacuna','fabricante','dosis'));

	}

	public function modal_persona_sanidad($id_persona){

		$maestra_model = new TablaMaestra;

		$persona_sanidad_model = new PersonaSanidade;
		$fecha_actual = $persona_sanidad_model->fecha_actual();
		$sanidades = $persona_sanidad_model->getSanidadByPersona($id_persona);

		return view('frontend.persona.modal_persona_sanidad',compact('id_persona','fecha_actual','sanidades'));

	}

	public function modal_flag_negativo($id_persona){

		$negativo_model = new Negativo;
		$negativo = $negativo_model->getNegativoByPersona($id_persona);

		return view('frontend.persona.modal_persona_negativo',compact('id_persona','negativo'));

	}

	public function send_persona_vacuna(Request $request){

		if($request->img_foto!=""){
			$filepath_tmp = public_path('img/frontend/tmp_vacuna/');
			$filepath_nuevo = public_path('img/carnet_vacunacion/');
			if (file_exists($filepath_tmp.$request->img_foto)) {
				copy($filepath_tmp.$request->img_foto, $filepath_nuevo.$request->img_foto);
			}
		}

		$personaVacuna = new PersonaVacuna;
		$personaVacuna->id_persona = $request->id_persona;
		$personaVacuna->fecha_vacuna = $request->fecha;
		$personaVacuna->id_vacuna = $request->id_vacuna;
		$personaVacuna->dosis = $request->dosis;
		$personaVacuna->id_fabricante = $request->id_fabricante;
		$personaVacuna->foto = $request->img_foto;
		$personaVacuna->estado = 1;
		$personaVacuna->save();
    }

	public function send_persona_sanidad(Request $request){

		if($request->img_foto!=""){
			$filepath_tmp = public_path('img/frontend/tmp_sanidad/');
			$filepath_nuevo = public_path('img/carnet_sanidad/');
			if (file_exists($filepath_tmp.$request->img_foto)) {
				copy($filepath_tmp.$request->img_foto, $filepath_nuevo.$request->img_foto);
			}
		}

		$personaSanidad = new PersonaSanidade;
		$personaSanidad->id_persona = $request->id_persona;
		$personaSanidad->carnet_sanidad = $request->carnet_sanidad;
		$personaSanidad->fecha_inicio = $request->fecha_inicio;
		$personaSanidad->fecha_fin = $request->fecha_fin;
		$personaSanidad->foto = $request->img_foto;
		$personaSanidad->estado = 1;
		$personaSanidad->save();
    }


    public function consultaDniWS($dni){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apiperu.dev/api/dni/'.$dni,
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
        echo $response;
    }

	public function upload(Request $request){

    	$filepath = public_path('img/frontend/tmp/');
		move_uploaded_file($_FILES["file"]["tmp_name"], $filepath.$_FILES["file"]["name"]);
		echo $_FILES['file']['name'];
	}

	public function upload_vacuna(Request $request){

    	$filepath = public_path('img/frontend/tmp_vacuna/');
		move_uploaded_file($_FILES["file"]["tmp_name"], $filepath.$_FILES["file"]["name"]);
		echo $_FILES['file']['name'];
	}

	public function upload_sanidad(Request $request){

    	$filepath = public_path('img/frontend/tmp_sanidad/');
		move_uploaded_file($_FILES["file"]["tmp_name"], $filepath.$_FILES["file"]["name"]);
		echo $_FILES['file']['name'];
	}


	public function send(Request $request){

        $sw = true;
		$msg = "";

        //$validaDni = $this -> consultaDniWS($request->numero_documento);
        //print_r ($validaDni);
        //exit();


        //print_r($buscapersona->count());
        //exit();

        //if ($buscapersona)

        //$id_r =  $request->id;

		if($request->img_foto!=""){
			$filepath_tmp = public_path('img/frontend/tmp/');
			$filepath_nuevo = public_path('img/dni_asociados/');
			if (file_exists($filepath_tmp.$request->img_foto)) {
				copy($filepath_tmp.$request->img_foto, $filepath_nuevo.$request->img_foto);
			}
		}

		if($request->img_foto=="")$request->img_foto="ruta";

		if($request->id == 0){
            $buscapersona = Persona::where("numero_documento", $request->numero_documento)->where("estado", "1")->get();

            if ($buscapersona->count()==0){

                $codigo=$request->codigo;
                $telefono = $request->telefono;
                $email = $request->email;
/*
                if($codigo==""){
                    $array_tipo_documento = array('DNI' => 'DNI','CARNET_EXTRANJERIA' => 'CE','PASAPORTE' => 'PAS','RUC' => 'RUC','CEDULA' => 'CED','PTP/PTEP' => 'PTP/PTEP', 'CPP/CSR' => 'CPP/CSR');
                    $codigo = $array_tipo_documento[$request->tipo_documento]."-".$request->numero_documento;
                }
*/
                if($telefono=="")$telefono="999999999";
                if($email=="")$email="mail@mail.com";

                $persona = new Persona;
                $persona->id_tipo_documento = $request->tipo_documento;
                $persona->numero_documento = $request->numero_documento;
                $persona->apellido_paterno = $request->apellido_paterno;
                $persona->apellido_materno = $request->apellido_materno;
                $persona->nombres = $request->nombre;
               // $persona->codigo = $codigo;
                //$persona->ocupacion = $request->ocupacion;
                $persona->fecha_nacimiento = $request->fecha_nacimiento;
                $persona->id_sexo =  $request->sexo;
                //$persona->telefono = "999999999";
                $persona->telefono = $telefono;
                //$persona->email = "mail@mail.com";
                $persona->email = $email;
                //$persona->foto = "mail@mail.com";
                $persona->foto = $request->img_foto;
                $persona->estado = "1";
                $persona->numero_ruc = $request->ruc;
                //$persona->flag_negativo = $request->flag_negativo;
                $persona->save();
/*
                $negativo = new Negativo;
                $negativo->persona_id = $persona->id;
                $negativo->flag_negativo = $request->flag_negativo;
                $negativo->observacion = $request->observacion;
                $negativo->fecha = Carbon::now()->format('Y-m-d');
                */
            }
            else{
                $sw = false;
                $msg = "El DNI ingresado ya existe !!!";
            }


		}else{

            //$buscapersona = Persona::where("numero_documento", $request->numero_documento)->where("estado", "1")->get();
            //echo $buscapersona[0]->id;
            //exit();
            //$request->id = $buscapersona[0]->id;

			$persona = Persona::find($request->id);
			$persona->id_tipo_documento = $request->tipo_documento;
			$persona->numero_documento = $request->numero_documento;
			$persona->apellido_paterno = $request->apellido_paterno;
			$persona->apellido_materno = $request->apellido_materno;
			$persona->nombres = $request->nombre;
			//$persona->codigo = $request->codigo;
            //$persona->ocupacion = $request->ocupacion;
			$persona->telefono = $request->telefono;
			$persona->email = $request->email;
			$persona->foto = $request->img_foto;
            $persona->numero_ruc = $request->ruc;
			//$flag_negativo = $persona->flag_negativo;

            //$persona->flag_negativo = $request->flag_negativo;
            //print ($persona->ruc);exit();
			$persona->save();

/*
            if($flag_negativo!=$request->flag_negativo){
                $negativo = new Negativo;
                $negativo->persona_id = $persona->id;
                $negativo->flag_negativo = $request->flag_negativo;
                $negativo->observacion = $request->observacion;
                $negativo->fecha = Carbon::now()->format('Y-m-d');
                $negativo->save();
            }else{
                $negativo = Negativo::where('persona_id',$persona->id)->orderBy('id', 'desc')->first();
                if($negativo && $negativo->observacion=="" && $request->observacion!=""){
                    $negativo->observacion = $request->observacion;
                    $negativo->save();
                }
             }
             */
        }

        $array["sw"] = $sw;
        $array["msg"] = $msg;
        echo json_encode($array);

    }

	public function eliminar_persona($id,$estado)
    {
		$persona = Persona::find($id);
		$persona->estado = $estado;
		$persona->save();

		echo $persona->id;

    }

	public function list_persona($term)
    {
		$persona_model = new Persona;
		$persona = $persona_model->getPersonaBuscar($term);
		return response()->json($persona);
    }

    public function zkteco_api_token($user = "admin", $password = "123456") {
        $url = env('ZKTECO_URL_LOGIN','http://192.168.0.20:8097/login/autenticacion?jLogin={"Username":"'.$user.'","Password":"'.$password.'"}');

        //this is the data you will send with the POST
        $fields = array(
            'jLogin' => '[
                    {
                        "Username": "'.$user.'",
                        "Password": "'.$password.'"
                    }
                ]
                '
        );

        /*ready the data in HTTP request format
         *(like the querystring in an HTTP GET, after the '?') */
        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        //perform the HTTP VERB
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        return $result;
    }

    public function zkteco_api($punto_acceso = 'Conectar', $Pin, $CardNo, $verbo = 'GET', $token) {

        // Llamando al token antes de cada Accion:
        $token = str_replace('"','',$this->zkteco_api_token());

        /* EJEMPLOS:
            zkteco_api('Conectarse','', '', '', 'GET', 'TOKEN'); // Probar conexion
            zkteco_api('InsertarEmpleado','9868826', '9868826', '', 'POST', 'TOKEN'); // Crear usuario con ID y DNI
            zkteco_api('EliminarEmpleado','9868826', '9868826', '', 'DELETE', 'TOKEN'); // Eliminar usuario con ID y DNI
            zkteco_api('AgregarAcceso','9868826', '9868826', '', 'POST', 'TOKEN'); // Brindar acceso a usuario con ID y DNI
            zkteco_api('EliminarAcceso','9868826', '9868826', '', 'DELETE', 'TOKEN'); // Quitar acceso a usuario con ID y DNI

            Solo en caso la operacion haya sido exitosa devuelve:
            "\u0027Success\u0027:\u0027true\u0027"
        */

        $url = env('ZKTECO_URL','http://192.168.0.20:8097/acceso/').$punto_acceso.'?jData=[{"Pin":"'.$Pin.'","CardNo":"'.$CardNo.'","Password":""}]';

        //this is the data you will send with the DELETE
        $fields = array(
            'jData' => '[
                    {
                        "Pin": "'.$Pin.'",
                        "CardNo": "'.$CardNo.'",
                        "Password": ""
                    }
                ]
                '
        );

        /*ready the data in HTTP request format
         *(like the querystring in an HTTP GET, after the '?') */
        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        /*if you need to do basic authentication use these lines,
         *otherwise comment them out (like, if your authenticate to your API
         *by sending information in the $fields, above. */
        //  $username = 'your_username';
        //  $password = 'your_password';
        //  curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
        /*end authentication*/

        curl_setopt($ch, CURLOPT_URL, $url);
        //echo("URL: ".$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verbo);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        /*unless you have installed root CAs you can't verify the remote server's
         *certificate.  Disable checking if this is suitable for your application*/
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Enviando el token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$token
        ));

        //echo 'Authorization: Bearer '.$token;
        //perform the HTTP VERB
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        return $result;
     }

    public function buscar_persona_ajax(Request $request){

        $buscar = $request->buscar;

        $personas = Persona::where("apellido_paterno", "ilike", "%".$buscar."%")->get();

        $array["buscar"] = $buscar;
        $array["resultado"] = $personas;
        echo json_encode($array);

    }
}

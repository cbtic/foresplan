<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use App\Models\TablaMaestra;
use App\Http\Requests\VehiculoRequest;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class VehiculoController extends Controller
{

	public function __construct(){

		$this->middleware(function ($request, $next) {
			if(!Auth::check()) {
                return redirect('login');
            }
			return $next($request);
    	});
	}

    public function index()
    {
        $vehiculos = Vehiculo::latest()->paginate(10);

        return view('frontend.vehiculos.index', compact('vehiculos'));
    }

	public function modal_vehiculo($id){
		$id_user = Auth::user()->id;
		if($id>0)$vehiculo = Vehiculo::find($id);
		else $vehiculo = new Vehiculo;

		return view('frontend.vehiculo.modal_vehiculo',compact('id','vehiculo'));

	}

	public function listar_vehiculo_ajax(Request $request){

		$vehiculo_model = new Vehiculo;
		$p[]="";
		$p[]="";
		$p[]="";
		$p[]="";
		$p[]="";
		$p[]="1";
        $p[]="";
		$p[]="";
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $vehiculo_model->listar_vehiculo_ajax($p);
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

	public function send(Request $request){

		$id_user = Auth::user()->id;

		if($request->id == 0){
			$vehiculo = new Vehiculo;
			$vehiculo->placa = $request->placa;
			$vehiculo->ejes = $request->ejes;
			$vehiculo->peso_tracto = $request->peso_tracto;
			$vehiculo->peso_carreta = $request->peso_carreta;
			$vehiculo->peso_seco = $request->peso_seco;
			$vehiculo->exonerado = $request->exonerado;
			$vehiculo->control = $request->control;
			$vehiculo->bloqueado = $request->bloqueado;
			$vehiculo->id_usuario_inserta = $id_user;
			$vehiculo->id_usuario_actualiza = $id_user;
			$vehiculo->estado = "1";
			$vehiculo->save();
		}else{
			$vehiculo = Vehiculo::find($request->id);
			$vehiculo->placa = $request->placa;
			$vehiculo->ejes = $request->ejes;
			$vehiculo->peso_tracto = $request->peso_tracto;
			$vehiculo->peso_carreta = $request->peso_carreta;
			$vehiculo->peso_seco = $request->peso_seco;
			$vehiculo->exonerado = $request->exonerado;
			$vehiculo->control = $request->control;
			$vehiculo->bloqueado = $request->bloqueado;
			$vehiculo->id_usuario_actualiza = $id_user;
			$vehiculo->save();
		}
    }

	public function send_vehiculo_ingreso(Request $request){

		$id_user = Auth::user()->id;
		$sw = true;
		$msg = "";

		if($request->id == 0){
			$vehiculoExiste = Vehiculo::where("placa",$request->placa)->get();
			if(count($vehiculoExiste)==0){
				$vehiculo = new Vehiculo;
				$vehiculo->placa = $request->placa;
				$vehiculo->ejes = $request->ejes;
				$vehiculo->peso_tracto = $request->peso_tracto;
				$vehiculo->peso_carreta = $request->peso_carreta;
				$vehiculo->peso_seco = $request->peso_seco;
				$vehiculo->exonerado = $request->exonerado;
				$vehiculo->control = $request->control;
				$vehiculo->bloqueado = $request->bloqueado;
				$vehiculo->id_usuario_inserta = $id_user;
				$vehiculo->id_usuario_actualiza = $id_user;
				$vehiculo->estado = "1";
				$vehiculo->save();
			}else{
				$vehiculo = $vehiculoExiste[0];
				$sw = false;
				$msg = "El Vehiculo ingresado ya existe !!!";
			}
		}else{
			$vehiculo = Vehiculo::find($request->id);
			$vehiculo->placa = $request->placa;
			$vehiculo->ejes = $request->ejes;
			$vehiculo->peso_tracto = $request->peso_tracto;
			$vehiculo->peso_carreta = $request->peso_carreta;
			$vehiculo->peso_seco = $request->peso_seco;
			$vehiculo->exonerado = $request->exonerado;
			$vehiculo->control = $request->control;
			$vehiculo->bloqueado = $request->bloqueado;
			$vehiculo->id_usuario_actualiza = $id_user;
			$vehiculo->save();
		}

		//echo json_encode($vehiculo);
		$array["sw"] = $sw;
		$array["msg"] = $msg;
		$array["vehiculo"] = $vehiculo;
        echo json_encode($array);
    }

	public function eliminar_vehiculo($id,$estado)
    {
		$vehiculo = Vehiculo::find($id);
		$vehiculo->estado = $estado;
		$vehiculo->save();

		echo $vehiculo->id;

    }

    public function create()
    {
        return view('frontend.vehiculos.create');
    }

    public function show(Vehiculo $vehiculos)
    {
        return view('frontend.vehiculos.show', compact('vehiculos'));
    }

    public function store(VehiculoRequest $request)
    {
		$id_user = Auth::user()->id;
        $request['id_usuario_actualiza'] = $id_user;
        $request['id_usuario_inserta'] = $id_user;

        $vehiculos = Vehiculo::create($request->all());

        $vehiculos->empresas()->sync($request->id_empresas);

        $vehiculos->conductores()->sync($request->id_conductores);

        return redirect()->route('frontend.vehiculos.index');
    }

    public function edit(Vehiculo $vehiculos)
    {
        return view('frontend.vehiculos.edit', compact('vehiculos'));
    }

    public function update(VehiculoRequest $request, Vehiculo $vehiculos)
    {
		$id_user = Auth::user()->id;
        $request['id_usuario_actualiza'] = $id_user;

        $vehiculos->update($request->all());

        $vehiculos->empresas()->sync($request->id_empresas);

        $vehiculos->conductores()->sync($request->id_conductores);

        return redirect()->route('frontend.vehiculos.index');
    }

    public function destroy(Vehiculo $vehiculos)
    {
        if ($vehiculos->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado el vehículo: '.$vehiculos['placa']);
        }
        return redirect()->route('frontend.vehiculos.index');
    }
}

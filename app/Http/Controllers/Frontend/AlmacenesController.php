<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\AlmaceneRequest;
use App\Models\Almacene;
use App\Models\Ubigeo;
use App\Models\User;
use App\Models\Almacen_usuario;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class AlmacenesController extends Controller
{

	public function __construct(){

		$this->middleware(function ($request, $next) {
			if(!Auth::check()) {
                return redirect('login');
            }
			return $next($request);
    	});
	}

    public function create(){

		/*$tablaMaestra_model = new TablaMaestra;
		$tipo_madera = $tablaMaestra_model->getMaestroByTipo(42);
		$tipo_documento = $tablaMaestra_model->getMaestroByTipo(9);*/
		
		
		return view('frontend.almacenes.create');

	}

    /*public function create()
    {
        return view('frontend.almacenes.create');
    }

    public function store(AlmaceneRequest $request)
    {
        Almacene::create($request->all());

        return redirect()->route('frontend.almacenes.index');
    }

    public function edit(Almacene $almacenes)
    {

        return view('frontend.almacenes.edit', compact('almacenes'));
    }

    public function update(AlmaceneRequest $request, Almacene $almacenes)
    {
        $almacenes->update($request->all());

        // return redirect()->route('frontend.almacenes.show', $almacenes->id);
        return redirect()->route('frontend.almacenes.index');
    }

    public function show(Almacene $almacenes)
    {
        return view('frontend.almacenes.show', compact('almacenes'));
    }

    public function destroy(Almacene $almacenes)
    {
        if ($almacenes->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado el almacen: '.$almacenes['codigo']);
        }
        return redirect()->route('frontend.almacenes.index');
    }*/

    public function modal_almacen($id){
		
		$ubigeo_model = new Ubigeo;
		$almacen_model = new Almacene;
		$almacen_usuario_model = new Almacen_usuario;
		$user_model = new User;
		$departamento = $ubigeo_model->getDepartamento();
		$codigo = $almacen_model->getCodigo();
		$user = $user_model->getUserAll();

		if($id>0){
			$almacen = Almacene::find($id);
			$almacen_usuario = Almacen_usuario::where('id_almacen',$id)->get();
			//$usuario = $almacen_usuario_model->getUsuariosByAlmacen($id);
		}else{
			$almacen = new Almacene;
			$almacen_usuario = null;
			//$usuario = null;
		}

		//var_dump($codigo[0]->codigo);exit();

		return view('frontend.almacenes.modal_almacenes_nuevoAlmacen',compact('id','departamento','codigo','almacen','user','almacen_usuario'));

    }

    public function listar_almacenes_ajax(Request $request){

		$almacenes_model = new Almacene();
		$p[]=$request->denominacion;
		$p[]=$request->encargado;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $almacenes_model->listar_almacenes_ajax($p);
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

    public function send_almacen(Request $request){
		
		$id_user = Auth::user()->id;
		$usuario = $request->usuario;

		if($request->id == 0){
			$almacen = new Almacene;
		}else{
			$almacen = Almacene::find($request->id);
		}
		
		$almacen->sigla = $request->sigla;
		$almacen->codigo = $request->codigo;
		$almacen->denominacion = $request->denominacion;
		$almacen->id_ubigeo = $request->distrito;
		$almacen->direccion = $request->direccion;
		$almacen->estado = 1;
		$almacen->telefono = $request->telefono;
		$almacen->encargado = $request->encargado;
		//$almacen->id_user = $request->usuario;
		$almacen->save();

		foreach($usuario as $usuario_id){
			$almacen_usuario = new Almacen_usuario;
			$almacen_usuario->id_user = $usuario_id;
			$almacen_usuario->id_almacen = $almacen->id;
			$almacen_usuario->id_usuario_inserta = $id_user;
			$almacen_usuario->estado = 1;
			$almacen_usuario->save();
		}

		/*$almacen_usuario->id_user = $request->usuario;
		$almacen_usuario->id_almacen = $almacen->id;
		$almacen_usuario->id_usuario_inserta = $id_user;
		$almacen_usuario->estado = 1;
		$almacen_usuario->save();*/

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

	public function eliminar_almacen($id,$estado)
    {
		$almacen = Almacene::find($id);

		$almacen->estado = $estado;
		$almacen->save();

		echo $almacen->id;
    }

	public function modal_usuario($id){
		 
		$almacen_model = new Almacene;
        $usuario = $almacen_model->getUsuarioAlmacen($id);
		
        return view('frontend.almacenes.modal_usuario',compact('usuario'));
		
    }

	public function obtener_provincia_distrito($id){
		
		$almacen_model = new Almacene;
		$ubigeo_usuario = $almacen_model->getProvinciaDistritoById($id);
		
		echo json_encode($ubigeo_usuario);
	}

	public function cargar_usuario($id)
    {

		$almacen_usuario_model = new Almacen_usuario;

		$usuario = $almacen_usuario_model->getUsuariosByAlmacen($id);

		return response()->json($usuario);
    }
	
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClienteUser;
use App\Domains\Auth\Models\Cliente;
use App\Domains\Auth\Models\User;
use Auth;

class ClienteUserController extends Controller
{
    public function __construct(){

		$this->middleware(function ($request, $next) {
			if(!Auth::check()) {
                return redirect('login');
            }
			return $next($request);
    	});
	}
    
    public function create()
    {

        $cliente = Cliente::all();
        $usuario = User::all();

        return view('frontend.cliente_usuario.create',compact('cliente','usuario'));
    }

    public function listar_cliente_user_ajax(Request $request){
		
		$cliente_user_model = new ClienteUser;
		$p[]=$request->cliente;
		$p[]=$request->usuario;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $cliente_user_model->listar_cliente_user_ajax($p);
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

    public function modal_cliente_user($id){

		$id_user = Auth::user()->id;
		//$menu = new ClienteUser;
        $cliente = Cliente::all();
        $usuario = User::all();

		if($id>0){
            $cliente_user = ClienteUser::find($id);
        }else{
            $cliente_user = new ClienteUser;
        }
	
		//$tipo_documento = DocumentoIdentidade::all();

		return view('frontend.cliente_usuario.modal_cliente_usuario',compact('id','cliente_user','cliente','usuario'));
	}

    public function send_cliente_user(Request $request){
		
        $id_user = Auth::user()->id;
        
		if($request->id == 0){
			
			$cliente_user = new ClienteUser;
			$cliente_user->cliente_id = $request->cliente;
			$cliente_user->user_id = $request->usuario;
			$cliente_user->save();
		}else{
			$cliente_user = ClienteUser::find($request->id);
			$cliente_user->cliente_id = $request->cliente;
			$cliente_user->user_id = $request->usuario;
			$cliente_user->save();
		}
    }
}

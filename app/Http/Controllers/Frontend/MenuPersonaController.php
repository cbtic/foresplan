<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentoIdentidade;
use App\Models\Persona;
use App\Models\Menu;
use App\Models\MenuPersona;
use Auth;

class MenuPersonaController extends Controller
{

    public function __construct(){

		$this->middleware(function ($request, $next) {
			if(!Auth::check()) {
                return redirect('login');
            }
			return $next($request);
    	});
	}
    
    public function create_menu()
    {
        return view('frontend.menu_persona.create_menu');
    }

    public function create_persona_menu()
    {
        return view('frontend.menu_persona.create_persona_menu');
    }

    public function listar_menu_ajax(Request $request){
		
		$menu_model = new Menu;
		$p[]=$request->denominacion;
		$p[]=$request->fecha;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $menu_model->listar_menu_ajax($p);
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

    public function listar_menu_persona_ajax(Request $request){
		
		$menu_persona_model = new MenuPersona;
		$p[]=$request->numero_documento;
		$p[]=$request->persona;
		$p[]=$request->fecha;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $menu_persona_model->listar_menu_persona_ajax($p);
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

    public function modal_menu($id){

		$id_user = Auth::user()->id;
		$menu = new Menu;
		if($id>0){
            $menu = Menu::find($id);
        }else{
            $menu = new Menu;
        } 
	
		$tipo_documento = DocumentoIdentidade::all();

		return view('frontend.menu_persona.modal_menu',compact('id','menu'));
	}

    public function modal_persona_menu($id){

		$id_user = Auth::user()->id;

        //$menu_model = new Menu;

		if($id>0){
            $menu_persona = MenuPersona::find($id);
        }else{
            $menu_persona = new MenuPersona;
        }

		$tipo_documento = DocumentoIdentidade::all();

        //$menu = $menu_model->getMenuByDia();

		return view('frontend.menu_persona.modal_menu_persona',compact('id','menu_persona','tipo_documento'));
	}

    public function send_menu(Request $request){
		
        $id_user = Auth::user()->id;
        
		if($request->id == 0){
			
			$menu = new Menu;
			$menu->denominacion = $request->denominacion;
			$menu->precio = $request->precio;
            $menu->fecha = $request->fecha;
            $menu->id_usuario_inserta = $id_user;
			$menu->estado = "1";
			$menu->save();
		}else{
			$menu = Menu::find($request->id);
			$menu->denominacion = $request->denominacion;
			$menu->precio = $request->precio;
            $menu->fecha = $request->fecha;
            $menu->id_usuario_inserta = $id_user;
			$menu->estado = "1";
			$menu->save();
		}
    }

    public function send_menu_persona(Request $request){
		
        $id_user = Auth::user()->id;
        
		if($request->id == 0){
			
			$menu_persona = new MenuPersona;
			$menu_persona->id_persona = $request->id_persona;
			$menu_persona->id_menu = $request->menu;
            $menu_persona->hora = $request->hora;
            $menu_persona->fecha = $request->fecha;
            $menu_persona->id_usuario_inserta = $id_user;
			$menu_persona->estado = "1";
			$menu_persona->save();
		}else{
			$menu_persona = MenuPersona::find($request->id);
			$menu_persona->id_persona = $request->id_persona;
			$menu_persona->id_menu = $request->menu;
            $menu_persona->hora = $request->hora;
            $menu_persona->fecha = $request->fecha;
            $menu_persona->id_usuario_inserta = $id_user;
			$menu_persona->estado = "1";
			$menu_persona->save();
		}
    }
	
	public function eliminar_menu($id,$estado)
    {
		$menu = Menu::find($id);
		$menu->estado = $estado;
		$menu->save();

		echo $menu->id;
    }

    public function eliminar_menu_persona($id,$estado)
    {
		$menu_persona = MenuPersona::find($id);
		$menu_persona->estado = $estado;
		$menu_persona->save();

		echo $menu_persona->id;
    }

    public function obtener_menu($fecha){
        
		$menu_model = new Menu;
		$menu = $menu_model->getMenuByFecha($fecha);
		
		echo json_encode($menu);
	}
}

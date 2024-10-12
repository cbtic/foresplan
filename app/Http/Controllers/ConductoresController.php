<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConductoresRequest;
use App\Models\Conductores;
use App\Models\Persona;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class ConductoresController extends Controller
{
    public function index()
    {
        $conductores = Conductores::latest()->paginate(10);

        return view('frontend.conductores.index', compact('conductores'));
    }

    public function create()
    {
        return view('frontend.conductores.create');
    }

    public function store(ConductoresRequest $request)
    {
        Conductores::create($request->all());

        return redirect()->route('frontend.conductores.index');
    }

    public function edit(Conductores $conductores)
    {

        return view('frontend.conductores.edit', compact('conductores'));
    }

    public function update(ConductoresRequest $request, Conductores $conductores)
    {
        $conductores->update($request->all());

        // return redirect()->route('frontend.conductores.show', $conductores->id);
        return redirect()->route('frontend.conductores.index');
    }

    public function show(Conductores $conductores)
    {
        return view('frontend.conductores.show', compact('conductores'));
    }

    public function destroy(Conductores $conductores)
    {
        if ($conductores->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado al conductor '.$conductores->personas['nombre_completo_sin_dni']);
        }

        return redirect()->route('frontend.conductores.index');
    }

	public function send_conductor_ingreso(Request $request){

		$id_user = Auth::user()->id;
		$sw = true;
		$msg = "";

		if($request->id == 0){

			if($request->id_personas==0){
				$persona = new Persona;
				$persona->id_tipo_documento = $request->id_tipo_documento;
				$persona->numero_documento = $request->numero_documento;
				$persona->apellido_paterno = $request->apellido_paterno;
				$persona->apellido_materno = $request->apellido_materno;
				$persona->nombres = $request->nombres;
				$persona->fecha_nacimiento = "1990-01-01";
				$persona->estado = "A";
				$persona->save();
				$request->id_personas = $persona->id;
			}

			$conductorExiste = Conductores::where("id_personas",$request->id_personas)->get();
			if(count($conductorExiste)==0){
				$conductor = new Conductores;
				$conductor->licencia = $request->licencia;
				$conductor->id_personas = $request->id_personas;
				$conductor->fecha_licencia = Carbon::now()->format('Y-m-d');
				$conductor->estado = "ACTIVO";
				$conductor->save();
			}else{
				$conductor = $conductorExiste[0];
				$sw = false;
				$msg = "El Conductor ingresado ya existe !!!";
			}


		}else{
			$conductor = Conductores::find($request->id);
			$conductor->licencia = $request->licencia;
			$conductor->id_personas = $request->id_personas;
			$conductor->save();
		}

		$persona = Persona::find($conductor->id_personas);

		$array["sw"] = $sw;
		$array["msg"] = $msg;
		$array["persona"] = $persona;
		$array["conductor"] = $conductor;
        echo json_encode($array);

    }

}

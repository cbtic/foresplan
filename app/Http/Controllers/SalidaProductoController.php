<?php

namespace App\Http\Controllers;

use App\Models\SalidaProducto;
use App\Http\Requests\SalidaProductoRequest;
use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SalidaProductoController extends Controller
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
        $salida_productos = SalidaProducto::latest()->paginate(10);

        return view('frontend.salida_productos.index', compact('salida_productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.salida_productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salida_productos = SalidaProducto::create($request->all());

        return redirect()->route('frontend.salida_productos.edit', compact('salida_productos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SalidaProducto $salida_productos)
    {
        // dd($salida_productos);exit;

        return view('frontend.salida_productos.show', compact('salida_productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SalidaProducto $salida_productos)
    {
        return view('frontend.salida_productos.edit', compact('salida_productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalidaProductoRequest $request, SalidaProducto $salida_productos)
    {
        $salida_productos->update($request->all());

        return redirect()->route('frontend.salida_productos.edit', compact('salida_productos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalidaProducto $salida_productos)
    {
        if ($salida_productos->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado la entrada '.$salida_productos['id']);
        };
        return redirect()->route('frontend.salida_productos.index');
    }
}

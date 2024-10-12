<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use App\Models\Kardex;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use App\Models\SalidaProductoDetalle;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\SalidaProductoRequest;
use App\Http\Requests\SalidaProductoDetalleRequest;

class SalidaProductoDetalleController extends Controller
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
    public function index($salida_producto)
    {
        // dd(2);
        $salida_producto_detalles = SalidaProductoDetalle::latest()->paginate(10);

        return view('frontend.salida_producto_detalles.index', compact('salida_producto_detalles', 'salida_producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($salida_producto)
    {
        return view('frontend.salida_producto_detalles.create', compact('salida_producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // exit;
        $salida_producto_detalles = SalidaProductoDetalle::create($request->all());

        $kardex = Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto]
        );

        $kardex = Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto],
            ['salidas_cantidad' => ($kardex->salidas_cantidad + $salida_producto_detalles->cantidad)]
        );

        Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto],
            ['saldos_cantidad' => ($kardex->entradas_cantidad - $kardex->salidas_cantidad)]
        );

        $movimiento = new Movimiento;
        $movimiento->id_producto = $salida_producto_detalles->id_producto;
        $movimiento->numero_lote = $salida_producto_detalles->numero_lote;
        $movimiento->tipo_movimiento = 'SALIDA';
        $movimiento->entrada_salida_cantidad = $salida_producto_detalles->cantidad;
        $movimiento->costo_entrada_salida = $salida_producto_detalles->costo;
        $movimiento->id_users = Auth::id();
        $movimiento->id_personas = Auth::id();
        $movimiento->fecha_movimiento = date_format(new DateTime(), 'Y-m-d H:i:s');
        $movimiento->save();

        return redirect()->route('frontend.salida_productos.edit', $salida_producto_detalles['id_salida_productos']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SalidaProductoDetalle $salida_producto_detalles)
    {
        return view('frontend.salida_producto_detalles.show', compact('salida_producto_detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function edit(SalidaProductoDetalle $salida_producto_detalles)
     {
         return view('frontend.salida_producto_detalles.edit', compact('salida_producto_detalles'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalidaProductoDetalleRequest $request, SalidaProductoDetalle $salida_producto_detalles)
    {
        $kardex = Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto]
        );

        $kardex = Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto],
            ['salidas_cantidad' => ($kardex->salidas_cantidad + $request->cantidad - $salida_producto_detalles->cantidad)]
        );

        Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto],
            ['saldos_cantidad' => ($kardex->entradas_cantidad - $kardex->salidas_cantidad)]
        );

        $salida_producto_detalles->update($request->all());

        return redirect()->route('frontend.salida_productos.edit', $salida_producto_detalles['id_salida_productos']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalidaProductoDetalle $salida_producto_detalles)
    {
        $kardex = Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto]
        );

        $kardex = Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto],
            ['salidas_cantidad' => ($kardex->salidas_cantidad - $salida_producto_detalles->cantidad)]
        );

        Kardex::updateOrCreate(
            ['id_producto' => $salida_producto_detalles->id_producto],
            ['saldos_cantidad' => ($kardex->entradas_cantidad - $kardex->salidas_cantidad)]
        );

        if ($salida_producto_detalles->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado la salida '.$salida_producto_detalles['id']);
        };
        return redirect()->route('frontend.salida_productos.edit', $salida_producto_detalles['id_salida_productos']);
    }
}

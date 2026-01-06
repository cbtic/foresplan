<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerceroController extends Controller
{
    public function index()
    {
        // carga inicial (sin filtros o con sede por defecto)
        // $terceros = DB::select('SELECT * FROM sp_listar_pagos_terceros_por_sede(?, ?, ?)', [null, null, null]);

        // return view('frontend.terceros.index', compact('terceros'));
        return view('frontend.terceros.index');
    }

    public function buscar(Request $request)
    {
        // parámetros DataTables
        $page      = (int) $request->input('NumeroPagina', 1);
        $perPage   = (int) $request->input('NumeroRegistros', 10);
        $offset    = ($page - 1) * $perPage;

        // filtros
        $num_documento   = $request->input('numero_documento') ?: null;
        $busqueda_nombre = $request->input('persona') ?: null;
        $id_sede         = $request->input('id_sede') ?: null;

        // obtenemos TODOS los terceros según filtros
        $rows = DB::select(
            'SELECT * FROM sp_listar_pagos_terceros_por_sede(?, ?, ?)',
            [$id_sede, $num_documento, $busqueda_nombre]
        );

        $total = count($rows);

        // paginar manualmente
        $dataPage = array_slice($rows, $offset, $perPage);

        $data = [];
        foreach ($dataPage as $r) {
            $data[] = [
                'id_pe'            => $r->id_persona,
                'tipo_documento'   => $r->tipo_documento,
                'numero_documento' => $r->numero_documento,
                'persona'          => trim($r->apellido_paterno . ' ' . $r->apellido_materno . ' ' . $r->nombres),
                'fecha_nacimiento' => $r->fecha_nacimiento,
                'sexo'             => $r->sexo,
                'condicion_laboral'=> $r->condicion_laboral,
                'area_trabajo'     => $r->area_trabajo,
                'unidad_trabajo'   => $r->unidad_trabajo,
                // 'razon_social'     => null,
                'estado'           => $r->estado,                  // o lo que corresponda
                'mont_cont_ctr'    => null,
                'id_pd'            => $r->id_persona,       // o id de persona_detalles si lo necesitas
            ];
        }

        // respuesta en formato DataTables server-side
        return response()->json([
            'sEcho'                => (int) $request->input('sEcho', 1),
            'iTotalRecords'        => $total,
            'iTotalDisplayRecords' => $total,
            'aaData'               => $data,
        ]);
    }
}

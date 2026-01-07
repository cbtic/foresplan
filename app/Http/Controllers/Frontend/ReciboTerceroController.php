<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\MedioPago;
use App\Models\ReciboTercero;
use Illuminate\Http\Request;

class ReciboTerceroController extends Controller
{
    public function create(Persona $persona)
    {
        $medioPagos = MedioPago::orderBy('codigo')->get();

        // return view('terceros.recibos.create', compact('tercero', 'medioPagos'));
        return view('frontend.terceros.recibos._form', ['persona'=>$persona, 'medioPagos'=>$medioPagos]);
    }

    public function store(Request $request, Persona $persona)
    {
        $data = $request->validate([
            'medio_pago_id'    => ['required', 'exists:medio_pagos,id'],
            'descripcion'      => ['required', 'string'],
            'observacion'      => ['nullable', 'string'],
            'importe'          => ['required', 'numeric'],
            'fecha_emision'    => ['required', 'date'],
            'fecha_pago'       => ['required', 'date'],
            'retencion'        => ['nullable', 'boolean']
            // no se valida importe_retenido, se calcula para evitar inyecciones
        ]);

        $data['retencion'] = $request->boolean('retencion');

        if ($data['retencion']) {
          $data['importe_retenido'] = round($data['importe'] * 0.08, 2);
        } else {
          $data['importe_retenido'] = 0;
        }

        $data['persona_id'] = $persona->id;

        ReciboTercero::create($data);

        return redirect()
            ->route('frontend.terceros.index')
            ->with('success', 'Recibo registrado correctamente.');
    }
}

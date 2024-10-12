<?php

namespace App\Http\Controllers;

use App\Http\Requests\TablasMaestrasRequest;
use App\TablasMaestras;

class TablasMaestrasController extends Controller
{
    public function index()
    {
        $tablas_maestras = TablasMaestras::latest()->paginate(12);

        return view('tablas_maestras.index', compact('tablas_maestras'));
    }

    public function create()
    {
        return view('tablas_maestras.create');
    }

    public function store(TablasMaestrasRequest $request)
    {
        TablasMaestras::create($request->all());

        return redirect()->route('tablas_maestras.index');
    }

    public function edit(TablasMaestras $tablas_maestras)
    {
        return view('tablas_maestras.edit', compact('tablas_maestras'));
    }

    public function update(TablasMaestrasRequest $request, TablasMaestras $tablas_maestras)
    {
        $tablas_maestras->update($request->all());

        return redirect()->route('tablas_maestras.show', $tablas_maestras->id);
    }

    public function show(TablasMaestras $tablas_maestras)
    {
        return view('tablas_maestras.show', compact('tablas_maestras'));
    }

    public function destroy(TablasMaestras $tablas_maestras)
    {
        $tablas_maestras->delete();

        return redirect()->route('tablas_maestras.index');
    }
}

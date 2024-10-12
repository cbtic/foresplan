<?php

namespace App\Http\Controllers;

use App\Http\Requests\TablasMaestrasRequest;
use App\Models\TablaMaestra;

class TablaMaestraController extends Controller
{
    public function index()
    {
        $tablamaestras = TablaMaestra::latest()->paginate(10);

        return view('frontend.tablamaestras.index', compact('tablamaestras'));
    }

    public function create()
    {
        return view('frontend.tablamaestras.create');
    }

    public function store(TablasMaestrasRequest $request)
    {
        Tablamaestra::create($request->all());

        return redirect()->route('frontend.tablamaestras.index');
    }

    public function edit(Tablamaestra $tablamaestras)
    {
        return view('frontend.tablamaestras.edit', compact('tablamaestras'));
    }

    public function update(TablasMaestrasRequest $request, Tablamaestra $tablamaestras)
    {
        $tablamaestras->update($request->all());

        // return redirect()->route('frontend.tablamaestras.show', $tablamaestras->id);
        return redirect()->route('frontend.tablamaestras.index');
    }

    public function show(Tablamaestra $tablamaestras)
    {
        return view('frontend.tablamaestras.show', compact('tablamaestras'));
    }

    public function destroy(Tablamaestra $tablamaestras)
    {
        $tablamaestras->delete();

        return redirect()->route('frontend.tablamaestras.index');
    }
}

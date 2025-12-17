<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Sede;

use App\Http\Controllers\Controller;
use App\Domains\Auth\Http\Requests\Backend\Sede\StoreSedeRequest;
use App\Domains\Auth\Http\Requests\Backend\Sede\UpdateSedeRequest;
use App\Domains\Auth\Http\Requests\Backend\Sede\DeleteSedeRequest;
use App\Domains\Auth\Models\Sede;
use App\Domains\Auth\Services\SedeService;

/**
 * Class SedeController.
 */
class SedeController extends Controller
{
    protected SedeService $sedeService;

    public function __construct(SedeService $sedeService)
    {
        $this->sedeService = $sedeService;
    }

    /**
     * Listado de sedes.
     */
    public function index()
    {
        $sedes = Sede::orderBy('denominacion')->paginate(15);

        return view('backend.auth.sede.index')
            ->withSedes($sedes);
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        return view('backend.auth.sede.create');
    }

    /**
     * Guarda una sede nueva.
     */
    public function store(StoreSedeRequest $request)
    {
        $this->sedeService->store($request->validated());

        return redirect()
            ->route('admin.auth.sede.index')
            ->withFlashSuccess(__('La sede fue creada correctamente.'));
    }

    /**
     * Formulario de edición.
     */
    public function edit(Sede $sede)
    {
        return view('backend.auth.sede.edit')
            ->withSede($sede);
    }

    /**
     * Actualiza una sede.
     */
    public function update(UpdateSedeRequest $request, Sede $sede)
    {
        $this->sedeService->update($sede, $request->validated());

        return redirect()
            ->route('admin.auth.sede.index')
            ->withFlashSuccess(__('La sede fue actualizada correctamente.'));
    }

    /**
     * Soft delete de una sede.
     */
    public function destroy(DeleteSedeRequest $request, Sede $sede)
    {
        $this->sedeService->destroy($sede);

        return redirect()
            ->route('admin.auth.sede.index')
            ->withFlashSuccess(__('La sede fue eliminada correctamente.'));
    }
}

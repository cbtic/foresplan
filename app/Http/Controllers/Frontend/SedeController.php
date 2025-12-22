<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SedeController extends Controller
{
    public function cambiarSedeActual(Request $request)
    {
        $user = Auth::user();

        // Validar que venga un id de sede
        $request->validate([
            'sede_id' => ['required', 'integer'],
        ]);

        $sedeId = (int) $request->input('sede_id');

        // Validar que la sede elegida pertenece a las sedes visibles del usuario
        $sedesPermitidas = $user->sedesFromRoles();
        $esValida = $sedesPermitidas->contains('id', $sedeId);

        if (! $esValida) {
            return back()->withErrors(['sede' => 'No tienes acceso a esta sede.']);
        }

        // Guardar en sesión la sede actual
        session(['current_sede_id' => $sedeId]);

        // Volver a la página anterior
        return back();
    }
}

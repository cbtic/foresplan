<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSedeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      $user = Auth::user();

        // Sin login
        if (! $user) {
            return redirect()->route('frontend.auth.login');
        }

        // Acceso total por tipo
        if ($user->type === 'admin') {
            return $next($request);
        }

        // Acceso restringido sin rol 'jefe RRHH'
        if (! $user->hasRole('jefe RRHH')) {
            return redirect()
                ->route('frontend.index')
                ->withErrors(['sede' => 'No tienes permiso para acceder a esta sección.']);
        }

        // Rol jefe RRHH: acceso total
        return $next($request);

    }
}

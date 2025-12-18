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

        if ($user->hasRole('Jefe RRHH')) {
            return $next($request);
        }

        return $next($request);

    }
}

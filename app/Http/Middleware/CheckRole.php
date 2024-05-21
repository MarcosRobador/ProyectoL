<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario autenticado tiene el rol especificado
        if (!Auth::check() || !Auth::user()->roles->contains('name', $role)) {
            // Si no tiene el rol, redirigir a una página de error o de inicio
            return redirect('/');
        }

        return $next($request);
    }
}

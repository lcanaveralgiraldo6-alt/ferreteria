<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmpleadoMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Si NO hay usuario autenticado, redirige al login
        if (!$user) {
            return redirect()->route('login');
        }

        // Si es ADMIN, permitir TODO sin restricciones
        if ($user->role_id == 1) {
            return $next($request);
        }

        // Si es EMPLEADO, permitir solo rutas de empleado
        if ($user->role_id == 2) {
            return $next($request);
        }

        // Si no es ninguno de los anteriores, denegar acceso
        abort(403, 'Acceso denegado.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmpleadoMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role_id == 1) {
            return $next($request);
        }

        if ($user->role_id == 2) {
            return $next($request);
        }

        abort(403, 'Acceso denegado.');
    }
}

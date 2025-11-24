<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // El admin tiene acceso total, no se bloquea nada
        return $next($request);
    }
}

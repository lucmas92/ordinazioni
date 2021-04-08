<?php

namespace Lucmas\Reservations\Middleware;

use Closure;

class Active
{

    public function handle($request, Closure $next)
    {
        logger('Licenza valida!');
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            return redirect('/login');
        }

        if (! in_array(Auth::user()->role, $roles)) {
            abort(403, 'Accès interdit');
        }

        return $next($request);
    }
}

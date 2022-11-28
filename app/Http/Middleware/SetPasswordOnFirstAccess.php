<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetPasswordOnFirstAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!$request->user()->is_first_access) {
            return $next($request);
        }

        return redirect(route('first-access.edit'));
    }
}

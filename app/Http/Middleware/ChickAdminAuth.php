<?php

namespace App\Http\Middleware;

use Closure;

class ChickAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->getType() == 'Admin') {
            return $next($request);
        } else {
            abort(403);
        }
    }
}

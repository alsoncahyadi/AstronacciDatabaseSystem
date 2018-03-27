<?php

namespace App\Http\Middleware;

use Closure;

class CheckGreen
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
        if ($request->user() === null) {
            return response("Insufficient permissions", 401);
        }
        
        if ($request->user()->hasGreen($request->user()->username)) {
            return $next($request);
        }
        return response("Insufficient permissions", 401);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class AdminArea
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( auth()->user() && auth()->user()->isAdmin()) {
            return $next($request);
        }
        // if(Gate::allows('admin'))
        // {
        //     return $next($request);
        // }
        return abort(403, 'You are not authorized to visit this page');
    }
}

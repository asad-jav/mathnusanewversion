<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TeacherArea
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        // if(Gate::any(['admin', 'teacher'])) {
        //     return $next($request);
        // }
        if( auth()->user() && auth()->user()->role_id == '3' || auth()->user()->role_id == '1') {
            return $next($request);
        }
        return abort(403, 'You are not authorized to visit this page');
    }
}

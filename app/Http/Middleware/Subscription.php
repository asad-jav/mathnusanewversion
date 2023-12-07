<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()) {
            
            if(Auth::user()->isAdmin()) {
                return $next($request);
            }
            
            $subscriptions = Auth::user()->subscriptions()->get();

            if ($subscriptions->isEmpty()) {
                return redirect()->route('packages');
            } else {
                foreach($subscriptions as $sub) {
                    if ($sub->pastDue()) {
                        return redirect()->route('packages');
                    } 
                }
                return $next($request);
            }
        }
        return $next($request);
    }
}

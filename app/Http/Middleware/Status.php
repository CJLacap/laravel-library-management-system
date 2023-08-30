<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Status
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::User()->status == 'blocked'){
            Auth::logout();
            return redirect()->route('login')->with('expired', 'Session expired! Your account status has been blocked. Please contact the Administrator.');
        }
            return $next($request);
    }
}

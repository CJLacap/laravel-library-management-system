<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
        foreach ($roles as $role){
            if ($request->user()->hasRole($role)){

                return $next($request);
            }

        }

        if($request->user()->hasRole('admin')){

            return redirect()->route('admin.dashboard');

        }elseif($request->user()->hasRole('librarian')){

            return redirect()->route('librarian.dashboard');

        }elseif($request->user()->hasRole('user')){

            return redirect()->route('dashboard');
        
        }else{

            return redirect()->route('login');
        }
        
    }
}

<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $mode): Response
    {
        if(auth()->user()->mode == $mode){
          return $next($request);
        }

        if (auth()->user()->mode == 'admin') 
        {
            return redirect(RouteServiceProvider::HOME_ADMIN);
        }
        if (auth()->user()->mode == 'user') 
        {
            return redirect(RouteServiceProvider::HOME_USER);
        }
    }
}

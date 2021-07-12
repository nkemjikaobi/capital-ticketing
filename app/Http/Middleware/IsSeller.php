<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->id !== 2){
            return redirect('home');
        }
        
        return $next($request);
    }
}

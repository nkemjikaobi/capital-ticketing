<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                 $account_type = Auth::user()->account_type; 
                    switch ($account_type) {
                        case 1:
                            return '/home';
                            break;

                        case 2:
                            return '/home';
                            break; 

                        case 3:
                            return '/admin/index';
                            break;

                        default:
                            return '/home'; 
                            break;
                    }
            }
        }

        return $next($request);
    }
}

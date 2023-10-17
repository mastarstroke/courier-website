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
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     
    //  This $guards function handle various authenticated request of all users, redirect admin to 
    // admin dashboard, courier to courier dashboard, suspended courier to suspended dashboard
    //  and users back to welcome page.

    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }
            if(Auth::guard($guard)->check() && Auth::user()->role_id == 0){
                return redirect()->route('welcome');
            }
            if(Auth::guard($guard)->check() && Auth::user()->role_id == 3){
                return redirect()->route('courier-suspended');
            }
            else if(Auth::guard($guard)->check() && Auth::user()->role_id == 2){
                return redirect()->route('courier.dashboard');
            }

            else 
            {
                return $next($request);
            }
        }

    }
}
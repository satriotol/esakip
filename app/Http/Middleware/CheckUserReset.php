<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckUserReset
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
        $excludedRoutes = [
            'user.resetPassword',
            'logout'
        ];
        // Check if the user is authenticated and if the user needs to be reset
        if (Auth::check() && Auth::user()->is_reset && !in_array(Route::currentRouteName(), $excludedRoutes) && !Route::is('dashboard')) {
            // Redirect to dashboard route
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}

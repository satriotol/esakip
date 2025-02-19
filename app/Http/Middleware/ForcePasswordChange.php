<?php

namespace App\Http\Middleware;

use Closure;

class ForcePasswordChange
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
        if (auth()->check()) {
            $user = auth()->user();
            if ($request->route()->getName() === 'password.change.form' && !$user->is_reset) {
                return redirect(route('dashboard'))->withErrors('Anda tidak diizinkan mengakses halaman ini.');
            }

            if ($user->is_reset && $request->route()->getName() !== 'password.change.form') {
                return redirect()->route('password.change.form');
            }
        }

        return $next($request);
    }
}
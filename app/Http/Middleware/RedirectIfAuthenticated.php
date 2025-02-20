<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect based on role
                if (Auth::user()->role === 'Admin') {
                    return redirect()->route('user.index'); // Change this route name to match UserIndex
                } else {
                    return redirect()->route('app.cashew_Layout'); // Change this to your Client dashboard route
                }
            }
        }
        return $next($request);
    }
}
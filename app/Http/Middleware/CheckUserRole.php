<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth; // Import Auth facade here
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        return redirect()->route('app.cashew_Layout'); // Ensure correct route name
    }
}
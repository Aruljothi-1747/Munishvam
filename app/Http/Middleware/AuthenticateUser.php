<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
          return redirect()->route('otp_login.otp_login')->with('error', 'Please login first.');
        }

        // Optionally, check if the user has the required role
        if ($role && Auth::user()->role !== $role) {
            return redirect()->route('otp_login.otp_login')->with('error', 'You do not have permission to access this page.');
        }


        // Proceed with the request
        return $next($request);
    }
}
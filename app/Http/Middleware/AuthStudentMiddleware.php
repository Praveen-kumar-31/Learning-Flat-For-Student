<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthStudentMiddleware
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            // User is not authenticated, redirect to login page
            return redirect('/ulogin');
        }

        // Check if the authenticated user is a student
        if (Auth::guard($guard)->check())  {
            return $next($request);
        }

        // If the user is not a student, redirect to an unauthorized page or handle it as per your requirements
        return redirect('/');
    }
    // public function handle(Request $request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->check()) {
    //         return $next($request);
    //     }
        
    //     return redirect('/');
    // }
}

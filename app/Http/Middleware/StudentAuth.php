<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the student is authenticated
        if (!Auth::guard('student')->check()) {
            // If not authenticated, redirect to student login page
            return redirect()->route('student.auth');
        }

        // Ensure the student guard is used for the request
        Auth::shouldUse('student');

        return $next($request);
    }
}

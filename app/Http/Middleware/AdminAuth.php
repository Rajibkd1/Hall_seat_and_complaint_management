<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login.page');
        }

        $admin = Auth::guard('admin')->user();

        // Check if admin is verified
        if (!$admin->is_verified) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login.page')->with('error', 'Your account is not verified yet.');
        }

        Auth::shouldUse('admin');

        return $next($request);
    }
}

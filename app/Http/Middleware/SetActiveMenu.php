<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetActiveMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();

        $activeMenu = '';
        if (str_starts_with($routeName, 'admin.dashboard')) {
            $activeMenu = 'dashboard';
        } elseif (str_starts_with($routeName, 'admin.students')) {
            $activeMenu = 'students';
        } elseif (str_starts_with($routeName, 'admin.complaints')) {
            $activeMenu = 'complaints';
        } elseif (str_starts_with($routeName, 'admin.notices')) {
            $activeMenu = 'notices';
        } elseif (str_starts_with($routeName, 'admin.applications')) {
            $activeMenu = 'applications';
        }

        session(['active_admin_menu' => $activeMenu]);

        return $next($request);
    }
}

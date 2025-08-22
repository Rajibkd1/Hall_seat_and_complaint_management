<?php

namespace App\Helpers;

class RouteHelper
{
    public static function getRoleBasedRoute($routeName, $parameters = [])
    {
        $admin = auth('admin')->user();
        
        if (!$admin) {
            return route('admin.' . $routeName, $parameters);
        }

        // Determine the route prefix based on role_type
        $prefix = 'admin'; // default
        
        if ($admin->role_type === 'provost') {
            $prefix = 'provost';
        } elseif ($admin->role_type === 'co_provost') {
            $prefix = 'co-provost';
        } elseif ($admin->role_type === 'staff') {
            $prefix = 'staff';
        }

        // Build the route name
        $fullRouteName = $prefix . '.' . $routeName;
        
        // Check if the route exists, fallback to admin route if not
        if (\Illuminate\Support\Facades\Route::has($fullRouteName)) {
            return route($fullRouteName, $parameters);
        }
        
        return route('admin.' . $routeName, $parameters);
    }
}

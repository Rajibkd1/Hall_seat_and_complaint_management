<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'student-auth' => \App\Http\Middleware\StudentAuth::class,
            'student-profile-access' => \App\Http\Middleware\StudentProfileAccess::class,
            'admin-auth' => \App\Http\Middleware\AdminAuth::class,
            'super-admin-auth' => \App\Http\Middleware\SuperAdminAuth::class,
            'role-permission' => \App\Http\Middleware\RolePermission::class,
            'set-active-menu' => \App\Http\Middleware\SetActiveMenu::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

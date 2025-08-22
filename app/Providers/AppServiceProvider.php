<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\AdminLayoutComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register RouteHelper
        require_once app_path('Helpers/RouteHelper.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the AdminLayoutComposer for all admin views
        View::composer([
            'admin.*',
            'co_provost.*',
            'staff.*'
        ], AdminLayoutComposer::class);
    }
}

<?php

namespace App\View\Composers;

use Illuminate\View\View;

class AdminLayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $layout = 'layouts.admin_app'; // Default fallback
        
        try {
            if (auth('admin')->check()) {
                $admin = auth('admin')->user();
                
                if ($admin && isset($admin->role_type)) {
                    switch ($admin->role_type) {
                        case 'provost':
                            $layout = 'layouts.provost_app';
                            break;
                        case 'co_provost':
                            $layout = 'layouts.co_provost_app';
                            break;
                        case 'staff':
                            $layout = 'layouts.staff_app';
                            break;
                        default:
                            $layout = 'layouts.admin_app';
                            break;
                    }
                }
            }
        } catch (\Exception $e) {
            // If there's any error, fallback to default layout
            $layout = 'layouts.admin_app';
        }
        
        $view->with('layout', $layout);
    }
}

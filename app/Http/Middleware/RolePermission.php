<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
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

        // Check permissions
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($admin, $permission)) {
                abort(403, 'Unauthorized access.');
            }
        }

        return $next($request);
    }

    private function hasPermission($admin, $permission)
    {
        switch ($permission) {
            case 'allocate_seats':
                return $admin->canAllocateSeats();

            case 'approve_notices':
                return $admin->canApproveNotices();

            case 'create_admins':
                return $admin->canCreateAdmins();

            case 'verify_applications':
                return $admin->canVerifyApplications();

            case 'manage_complaints':
                return $admin->canManageComplaints();

            case 'view_students':
                return $admin->canViewStudents();

            case 'provost_only':
                return $admin->isProvost();

            case 'co_provost_or_above':
                return $admin->isProvost() || $admin->isCoProvost();

            case 'staff_or_above':
                return $admin->isProvost() || $admin->isCoProvost() || $admin->isStaff();

            // Direct role checks
            case 'Provost':
                return $admin->role === 'Provost' || $admin->role_type === 'provost';

            case 'Co-Provost':
                return $admin->role === 'Co-Provost' || $admin->role_type === 'co_provost';

            case 'Staff':
                return $admin->role === 'Staff' || $admin->role_type === 'staff';

            default:
                return false;
        }
    }
}

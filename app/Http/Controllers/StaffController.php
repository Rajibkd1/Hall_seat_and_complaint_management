<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Complaint;
use App\Models\HallNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    protected $adminController;

    public function __construct()
    {
        $this->adminController = new AdminController();
    }

    // Delegate methods to AdminController (limited for Staff)
    public function complaints()
    {
        return $this->adminController->complaints();
    }

    public function viewComplaint($id)
    {
        return $this->adminController->viewComplaint($id);
    }

    public function updateComplaintStatus(Request $request, $id)
    {
        return $this->adminController->updateComplaintStatus($request, $id);
    }

    public function notices()
    {
        return $this->adminController->notices();
    }

    // Original Staff-specific methods
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)
                     ->where('role', 'Staff')
                     ->first();

        if (!$admin || !Hash::check($request->password, $admin->password_hash)) {
            return redirect()->route('staff.login')->with('error', 'Invalid credentials');
        }

        Auth::guard('admin')->login($admin);
        return redirect()->route('staff.dashboard');
    }

    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();
        
        // Get statistics
        $stats = [
            'students' => Student::count(),
            'pending_complaints' => Complaint::where('status', 'pending')->count(),
            'resolved_complaints' => Complaint::where('status', 'resolved')->count(),
            'active_notices' => HallNotice::where('status', 'active')->count()
        ];

        return view('staff.dashboard', compact('admin', 'stats'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('staff.login');
    }
}

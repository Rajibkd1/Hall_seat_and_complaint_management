<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\SeatApplication;
use App\Models\HallNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CoProvostController extends Controller
{
    protected $adminController;

    public function __construct()
    {
        $this->adminController = new AdminController();
    }

    // Delegate methods to AdminController
    public function students()
    {
        return $this->adminController->students();
    }

    public function viewStudentProfile($student_id)
    {
        return $this->adminController->viewStudentProfile($student_id);
    }

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

    public function createNotice()
    {
        return $this->adminController->createNotice();
    }

    public function storeNotice(Request $request)
    {
        return $this->adminController->storeNotice($request);
    }

    public function editNotice($id)
    {
        return $this->adminController->editNotice($id);
    }

    public function updateNotice(Request $request, $id)
    {
        return $this->adminController->updateNotice($request, $id);
    }

    public function destroyNotice($id)
    {
        return $this->adminController->destroyNotice($id);
    }

    public function applications()
    {
        return app(\App\Http\Controllers\SeatApplicationController::class)->adminIndex();
    }

    public function viewApplication($application)
    {
        return app(\App\Http\Controllers\SeatApplicationController::class)->adminShow($application);
    }

    public function updateApplicationStatus(Request $request, $application)
    {
        return app(\App\Http\Controllers\SeatApplicationController::class)->updateStatus($request, $application);
    }

    public function sendApplicationEmail(Request $request, $application)
    {
        return app(\App\Http\Controllers\SeatApplicationController::class)->sendEmail($request, $application);
    }

    // Co-Provost Seat Management (View Only)
    public function seats()
    {
        return app(SeatController::class)->index(request());
    }

    public function getRooms(Request $request = null)
    {
        return app(SeatController::class)->getRooms($request ?? request());
    }

    public function getRoomSeats(Request $request = null)
    {
        return app(SeatController::class)->getRoomSeats($request ?? request());
    }

    public function getSeatDetails($seat)
    {
        return app(SeatController::class)->getSeatDetails($seat);
    }

    public function getAvailableStudents()
    {
        return app(SeatController::class)->getAvailableStudents();
    }

    // Original Co-Provost-specific methods
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)
            ->where('role', 'Co-Provost')
            ->first();

        if (!$admin || !Hash::check($request->password, $admin->password_hash)) {
            return redirect()->route('co-provost.login')->with('error', 'Invalid credentials');
        }

        Auth::guard('admin')->login($admin);
        return redirect()->route('co-provost.dashboard');
    }

    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();

        // Get statistics
        $stats = [
            'students' => Student::count(),
            'pending_applications' => SeatApplication::where('status', 'pending')->count(),
            'pending_notices' => HallNotice::where('approval_status', 'pending')->count(),
            'total_notices' => HallNotice::where('admin_id', $admin->admin_id)->count()
        ];

        return view('co_provost.dashboard', compact('admin', 'stats'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('co-provost.login');
    }
}

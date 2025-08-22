<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\SeatApplication;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentVerificationCode;

class ProvostController extends Controller
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

    public function approveNotice(Request $request, $id)
    {
        $notice = \App\Models\HallNotice::findOrFail($id);
        $notice->approval_status = 'approved';
        $notice->approved_by = auth('admin')->id();
        $notice->approved_at = now();
        $notice->save();

        return redirect()->back()->with('success', 'Notice approved successfully.');
    }

    public function rejectNotice(Request $request, $id)
    {
        $notice = \App\Models\HallNotice::findOrFail($id);
        $notice->approval_status = 'rejected';
        $notice->approved_by = auth('admin')->id();
        $notice->approved_at = now();
        $notice->save();

        return redirect()->back()->with('success', 'Notice rejected successfully.');
    }

    public function applications()
    {
        return app(\App\Http\Controllers\SeatApplicationController::class)->adminIndex();
    }

    public function applicationsIndex()
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

    public function seats(Request $request)
    {
        $floor = $request->get('floor', 1);
        $block = $request->get('block', 'Front');

        // Get available applications for seat assignment
        $availableApplications = \App\Models\SeatApplication::where('status', 'approved')
            ->whereDoesntHave('seatAllotments')
            ->with('student')
            ->get();

        // Get overall seat statistics
        $seatStats = \App\Models\Seat::select('status', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $totalSeats = \App\Models\Seat::count();
        $occupiedSeats = $seatStats['occupied'] ?? 0;
        $availableSeats = $seatStats['vacant'] ?? 0;
        $maintenanceSeats = $seatStats['maintenance'] ?? 0;

        // Get total number of rooms
        $totalRooms = \App\Models\Seat::distinct('room_number')->count('room_number');

        return view('provost.seats.index', compact(
            'floor',
            'block',
            'availableApplications',
            'totalSeats',
            'occupiedSeats',
            'availableSeats',
            'maintenanceSeats',
            'totalRooms'
        ));
    }

    public function seatsIndex(Request $request)
    {
        return $this->seats($request);
    }

    public function getRooms(Request $request)
    {
        return app(\App\Http\Controllers\SeatController::class)->getRooms($request);
    }

    public function getRoomSeats(Request $request)
    {
        return app(\App\Http\Controllers\SeatController::class)->getRoomSeats($request);
    }

    public function getSeatDetails($seat)
    {
        return app(\App\Http\Controllers\SeatController::class)->getSeatDetails($seat);
    }

    public function assignSeat(Request $request)
    {
        return app(\App\Http\Controllers\SeatController::class)->assignSeat($request);
    }

    public function releaseSeat($seat)
    {
        return app(\App\Http\Controllers\SeatController::class)->releaseSeat($seat);
    }

    public function getAvailableStudents()
    {
        return app(\App\Http\Controllers\SeatController::class)->getAvailableStudents();
    }

    public function showAssignmentPage($seatId)
    {
        return app(\App\Http\Controllers\SeatController::class)->showAssignmentPage($seatId);
    }

    public function showCreateAdmin()
    {
        return app(\App\Http\Controllers\AdminAuthController::class)->showCreateAdmin();
    }

    public function createAdmin(Request $request)
    {
        return app(\App\Http\Controllers\AdminAuthController::class)->createAdmin($request);
    }

    public function create_admin()
    {
        return app(\App\Http\Controllers\AdminAuthController::class)->showCreateAdmin();
    }

    public function sendAdminOTP(Request $request)
    {
        return app(\App\Http\Controllers\AdminAuthController::class)->sendAdminOTP($request);
    }

    // Original Provost-specific methods
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)
            ->where('role', 'Provost')
            ->first();

        if (!$admin || !Hash::check($request->password, $admin->password_hash)) {
            return redirect()->route('provost.login')->with('error', 'Invalid credentials');
        }

        Auth::guard('admin')->login($admin);
        return redirect()->route('provost.dashboard');
    }

    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();

        // Get comprehensive statistics for Provost
        $stats = [
            'students' => Student::count(),
            'co_provosts' => Admin::where('role', 'Co-Provost')
                ->where('hall_name', $admin->hall_name)
                ->count(),
            'staff' => Admin::where('role', 'Staff')
                ->where('hall_name', $admin->hall_name)
                ->count(),
            'pending_applications' => SeatApplication::where('status', 'pending')->count(),
            'active_complaints' => \App\Models\Complaint::whereIn('status', ['pending', 'in_progress'])->count()
        ];

        return view('provost.dashboard', compact('admin', 'stats'));
    }

    public function showCreateCoProvost()
    {
        $admin = Auth::guard('admin')->user();
        return view('provost.create_co_provost', compact('admin'));
    }

    public function showCreateStaff()
    {
        $admin = Auth::guard('admin')->user();
        return view('provost.create_staff', compact('admin'));
    }

    public function storeCoProvost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
            'otp' => 'required|string|size:6',
        ]);

        // Verify OTP
        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->otp)
            ->first();

        if (!$verification) {
            return redirect()->back()->with('error', 'Invalid or expired OTP');
        }

        $currentAdmin = Auth::guard('admin')->user();

        // Create Co-Provost
        $coProvost = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'Co-Provost',
            'designation' => $request->designation,
            'department' => $request->department,
            'hall_name' => $currentAdmin->hall_name,
            'created_by' => $currentAdmin->admin_id,
            'is_verified' => true,
            'password_hash' => Hash::make($request->password),
        ]);

        // Delete used OTP
        $verification->delete();

        return redirect()->route('provost.dashboard')
            ->with('success', 'Co-Provost created successfully!');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
            'otp' => 'required|string|size:6',
        ]);

        // Verify OTP
        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->otp)
            ->first();

        if (!$verification) {
            return redirect()->back()->with('error', 'Invalid or expired OTP');
        }

        $currentAdmin = Auth::guard('admin')->user();

        // Create Staff
        $staff = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'Staff',
            'designation' => $request->designation,
            'department' => 'Support', // Staff doesn't have specific department
            'hall_name' => $currentAdmin->hall_name,
            'created_by' => $currentAdmin->admin_id,
            'is_verified' => true,
            'password_hash' => Hash::make($request->password),
        ]);

        // Delete used OTP
        $verification->delete();

        return redirect()->route('provost.dashboard')
            ->with('success', 'Staff member created successfully!');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('provost.login');
    }
}

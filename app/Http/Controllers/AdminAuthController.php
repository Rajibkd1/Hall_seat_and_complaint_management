<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentVerificationCode;
use Carbon\Carbon;

class AdminAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required',
            'role' => 'required',
            'department' => 'required',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'department' => $request->department,
            'teacher_id' => $request->teacher_id,
            'password_hash' => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);

        return response()->json(['message' => 'Admin registered successfully']);
    }

    public function showCreateAdmin()
    {
        // Only Provost can access this
        $admin = Auth::guard('admin')->user();
        if (!$admin->isProvost()) {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.create_admin');
    }

    public function sendAdminOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins,email',
        ]);

        // Only Provost can create admins
        $admin = Auth::guard('admin')->user();
        if (!$admin->isProvost()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in database
        EmailVerification::updateOrCreate(
            ['email' => $request->email],
            ['code' => $otp, 'created_at' => now()]
        );

        // Send OTP via email
        try {
            Mail::to($request->email)->send(new StudentVerificationCode($otp));
            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully to ' . $request->email
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|max:20',
            'contact_number' => 'required|string|max:20',
            'role_type' => 'required|in:co_provost,staff',
            'department' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'password' => 'required|min:6|confirmed',
            'otp' => 'required|numeric|digits:6',
        ]);

        // Only Provost can create admins
        $currentAdmin = Auth::guard('admin')->user();
        if (!$currentAdmin->isProvost()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Verify OTP
        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->otp)
            ->where('created_at', '>=', Carbon::now()->subMinutes(10))
            ->first();

        if (!$verification) {
            return redirect()->back()->with('error', 'Invalid or expired OTP');
        }

        // Create Admin (Co-Provost or Staff)
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_number' => $request->contact_number,
            'role' => $request->role_type === 'co_provost' ? 'Co-Provost' : 'Staff',
            'role_type' => $request->role_type,
            'designation' => $request->designation,
            'hall_name' => $currentAdmin->hall_name, // Inherit from Provost
            'department' => $request->department,
            'password_hash' => Hash::make($request->password),
            'is_verified' => true,
            'verified_at' => now(),
            'created_by' => $currentAdmin->admin_id
        ]);

        // Delete used OTP
        $verification->delete();

        return redirect()->route('admin.dashboard')->with('success', ucfirst(str_replace('_', '-', $request->role_type)) . ' created successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password_hash)) {
            return redirect()->route('admin.login.page')->with('error', 'Invalid credentials');
        }

        Auth::guard('admin')->login($admin);

        // Redirect to role-specific dashboard
        switch ($admin->role_type) {
            case 'provost':
                return redirect()->route('admin.dashboard');
            case 'co_provost':
                return redirect()->route('co-provost.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            default:
                return redirect()->route('admin.dashboard');
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page');
    }
}

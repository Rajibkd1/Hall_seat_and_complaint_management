<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use App\Models\Admin;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentVerificationCode;
use Carbon\Carbon;

class SuperAdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('super_admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $superAdmin = SuperAdmin::where('email', $request->email)->first();

        if (!$superAdmin || !Hash::check($request->password, $superAdmin->password_hash)) {
            return redirect()->route('super_admin.login')->with('error', 'Invalid credentials');
        }

        Auth::guard('super_admin')->login($superAdmin);

        return redirect()->route('super_admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('super_admin')->logout();
        return redirect()->route('super_admin.login');
    }

    public function showProvostRegistration()
    {
        return view('super_admin.register_provost');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins,email',
        ]);

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

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->otp)
            ->where('created_at', '>=', Carbon::now()->subMinutes(10))
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully'
        ]);
    }

    public function registerProvost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|max:20',
            'contact_number' => 'required|string|max:20',
            'hall_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
            'otp' => 'required|numeric|digits:6',
        ]);

        // Verify OTP again
        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->otp)
            ->where('created_at', '>=', Carbon::now()->subMinutes(10))
            ->first();

        if (!$verification) {
            return redirect()->back()->with('error', 'Invalid or expired OTP');
        }

        // Create Provost
        $provost = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_number' => $request->contact_number,
            'role' => 'Provost',
            'role_type' => Admin::ROLE_PROVOST,
            'designation' => $request->designation,
            'hall_name' => $request->hall_name,
            'department' => $request->department,
            'password_hash' => Hash::make($request->password),
            'is_verified' => true,
            'verified_at' => now(),
            'created_by' => Auth::guard('super_admin')->id()
        ]);

        // Delete used OTP
        $verification->delete();

        return redirect()->route('super_admin.dashboard')->with('success', 'Provost registered successfully');
    }
}

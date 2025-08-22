<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Admin;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentVerificationCode;

class StudentAuthController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        if (Student::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => 'exists',
                'message' => 'This email is already registered. Please login instead.'
            ], 200);
        }
        $code = rand(100000, 999999);

        EmailVerification::updateOrCreate(
            ['email' => $request->email],
            ['code' => $code]
        );
        Mail::to($request->email)->send(new StudentVerificationCode($code));

        return response()->json(['status' => 'success', 'message' => 'Verification code sent to email.']);
    }
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$verification) {
            return response()->json(['status' => 'fail', 'message' => 'Invalid verification code.']);
        }

        return response()->json(['status' => 'success', 'message' => 'Email verified successfully.']);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'university_id' => 'required',
            'email' => 'required|email|unique:students,email',
            'code' => 'required',
            'phone' => 'required',
            'department' => 'required',
            'session_year' => 'required',
            'password' => 'required|min:6',
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$verification) {
            return redirect()->back()->with('error', 'Invalid verification code.');
        }
        $student = Student::create([
            'name' => $request->name,
            'university_id' => $request->university_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'session_year' => $request->session_year,
            'password_hash' => Hash::make($request->password),
        ]);

        EmailVerification::where('email', $request->email)->delete();

        Auth::guard('student')->login($student);

        return redirect()->route('student.dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in as a student
        $student = Student::where('email', $request->email)->first();
        if ($student && Hash::check($request->password, $student->password_hash)) {
            Auth::guard('student')->login($student);
            return redirect()->route('student.dashboard');
        }

        // Attempt to log in as an admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password_hash)) {
            Auth::guard('admin')->login($admin);
            
            // Redirect based on role
            switch ($admin->role) {
                case 'Provost':
                    return redirect()->route('provost.dashboard');
                case 'Co-Provost':
                    return redirect()->route('co-provost.dashboard');
                case 'Staff':
                    return redirect()->route('staff.dashboard');
                default:
                    return redirect()->route('admin.dashboard');
            }
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }

    public function showAuthForm($form_type = 'login')
    {
        return view('student.auth', ['form_type' => $form_type]);
    }
    public function dashboard()
    {
        $student = Auth::guard('student')->user();

        if (!$student) {
            return redirect()->route('student.login');
        }

        $stats = [
            'total_complaints' => \App\Models\Complaint::where('student_id', $student->student_id)->count(),
            'pending_complaints' => \App\Models\Complaint::where('student_id', $student->student_id)->where('status', 'pending')->count(),
            'resolved_complaints' => \App\Models\Complaint::where('student_id', $student->student_id)->where('status', 'resolved')->count(),
            'recent_notices' => \App\Models\HallNotice::active()->orderBy('date_posted', 'desc')->limit(3)->get(),
        ];

        $recentComplaints = \App\Models\Complaint::where('student_id', $student->student_id)
            ->orderBy('submission_date', 'desc')
            ->limit(5)
            ->get();
        session(['active_nav' => 'dashboard']);
        return view('student.dashboard', compact('student', 'stats', 'recentComplaints'));
    }
}

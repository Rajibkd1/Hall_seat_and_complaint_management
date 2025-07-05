<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
        $request->validate(['email' => 'required|email|unique:students,email']);

        $code = rand(100000, 999999);

        EmailVerification::updateOrCreate(
            ['email' => $request->email],
            ['code' => $code]
        );
        Mail::to($request->email)->send(new StudentVerificationCode($code));

        return response()->json(['message' => 'Verification code sent to email.']);
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
            'session_year' => 'required|integer',
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

        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password_hash)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        Auth::guard('student')->login($student);

        return redirect()->route('student.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }
    public function dashboard()
    {
        $student = Auth::guard('student')->user();
        return view('student.dashboard', compact('student'));
    }
}

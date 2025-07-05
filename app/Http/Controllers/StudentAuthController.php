<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'university_id' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'department' => 'required',
            'session_year' => 'required|integer',
            'password' => 'required|min:6',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'university_id' => $request->university_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'session_year' => $request->session_year,
            'password_hash' => Hash::make($request->password),
        ]);

        Auth::guard('student')->login($student);
        return redirect()->route('student.login.page')->with('success', 'Registration successful! Please log in.');
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

        return redirect()->route('student.dashboard')->with('student', $student);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }
}

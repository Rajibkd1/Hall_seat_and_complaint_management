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
            'current_address' => 'required',
            'permanent_address' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'guardian_alive_status' => 'required|boolean',
            'guardian_contact' => 'required',
            'password' => 'required|min:6',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'university_id' => $request->university_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'session_year' => $request->session_year,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'guardian_alive_status' => $request->guardian_alive_status,
            'guardian_contact' => $request->guardian_contact,
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

        
// return redirect()->route('student.dashboard');

        return response()->json(['message' => 'Student logged in successfully']);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return response()->json(['message' => 'Student logged out successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return redirect()->route('admin.dashboard');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'Admin logged out successfully']);
    }
}

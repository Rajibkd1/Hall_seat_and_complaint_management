<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $superAdmin = Auth::guard('super_admin')->user();

        // Get statistics
        $totalProvosts = Admin::provosts()->verified()->count();
        $totalCoProvosts = Admin::coProvosts()->verified()->count();
        $totalStaff = Admin::staff()->verified()->count();
        $recentProvosts = Admin::provosts()->verified()->latest()->take(5)->get();

        return view('super_admin.dashboard', compact(
            'superAdmin',
            'totalProvosts',
            'totalCoProvosts',
            'totalStaff',
            'recentProvosts'
        ));
    }

    public function provosts()
    {
        $provosts = Admin::provosts()->verified()->with('createdAdmins')->paginate(10);
        return view('super_admin.provosts', compact('provosts'));
    }

    public function viewProvost($id)
    {
        $provost = Admin::provosts()->verified()->with(['createdAdmins', 'notices', 'seatAllotments'])->findOrFail($id);
        return view('super_admin.view_provost', compact('provost'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HallNotice;
use App\Models\Student;
use App\Models\SeatApplication;
use App\Models\Complaint;
use App\Models\Seat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get notices for the homepage
        $notices = HallNotice::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(6) // Limit to 6 for better homepage layout
            ->get();

        // Get statistics for the homepage
        $statistics = [
            'total_students' => Student::count(),
            'total_applications' => SeatApplication::count(),
            'approved_applications' => SeatApplication::where('status', 'approved')->count(),
            'total_seats' => Seat::count(),
            'occupied_seats' => Seat::where('status', 'occupied')->count(),
            'resolved_complaints' => Complaint::where('status', 'resolved')->count(),
            'active_notices' => HallNotice::where('status', 'active')->count(),
        ];

        // Calculate additional metrics
        $statistics['satisfaction_rate'] = $statistics['total_applications'] > 0 
            ? round(($statistics['approved_applications'] / $statistics['total_applications']) * 100) 
            : 0;
        
        $statistics['occupancy_rate'] = $statistics['total_seats'] > 0 
            ? round(($statistics['occupied_seats'] / $statistics['total_seats']) * 100) 
            : 0;

        return view('homepage', [
            'notices' => $notices,
            'statistics' => $statistics
        ]);
    }

    public function showPublicNotice($id)
    {
        $notice = HallNotice::where('notice_id', $id)->where('status', 'active')->firstOrFail();
        return response()->json($notice);
    }
}

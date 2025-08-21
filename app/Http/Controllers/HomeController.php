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
        // Get official notices for the institutional homepage
        $notices = HallNotice::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(6) // Limit to 6 for optimal institutional layout
            ->get();

        // Get comprehensive institutional statistics
        $statistics = [
            // Core institutional metrics
            'total_students' => Student::count(),
            'total_applications' => SeatApplication::count(),
            'approved_applications' => SeatApplication::where('status', 'approved')->count(),
            'pending_applications' => SeatApplication::where('status', 'pending')->count(),
            'total_seats' => Seat::count(),
            'occupied_seats' => Seat::where('status', 'occupied')->count(),
            'available_seats' => Seat::where('status', 'available')->count(),
            'resolved_complaints' => Complaint::where('status', 'resolved')->count(),
            'active_notices' => HallNotice::where('status', 'active')->count(),
            
            // Additional institutional metrics
            'total_complaints' => Complaint::count(),
            'pending_complaints' => Complaint::where('status', 'pending')->count(),
            'processing_applications' => SeatApplication::where('status', 'processing')->count(),
        ];

        // Calculate institutional performance metrics
        $statistics['approval_rate'] = $statistics['total_applications'] > 0 
            ? round(($statistics['approved_applications'] / $statistics['total_applications']) * 100) 
            : 0;
        
        $statistics['occupancy_rate'] = $statistics['total_seats'] > 0 
            ? round(($statistics['occupied_seats'] / $statistics['total_seats']) * 100) 
            : 0;

        $statistics['resolution_rate'] = $statistics['total_complaints'] > 0 
            ? round(($statistics['resolved_complaints'] / $statistics['total_complaints']) * 100) 
            : 0;

        $statistics['availability_rate'] = $statistics['total_seats'] > 0 
            ? round(($statistics['available_seats'] / $statistics['total_seats']) * 100) 
            : 0;

        // Institutional service quality metrics
        $statistics['service_efficiency'] = $statistics['approval_rate'] >= 80 ? 'Excellent' : 
            ($statistics['approval_rate'] >= 60 ? 'Good' : 'Improving');
        
        $statistics['facility_utilization'] = $statistics['occupancy_rate'] >= 85 ? 'Optimal' : 
            ($statistics['occupancy_rate'] >= 70 ? 'Good' : 'Available');

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

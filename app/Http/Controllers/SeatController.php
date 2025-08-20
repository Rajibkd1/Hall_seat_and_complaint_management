<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\SeatApplication;
use App\Models\SeatAllotment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    public function index(Request $request)
    {
        $floor = $request->get('floor', 1);
        $block = $request->get('block', 'Front');
        
        // Get available applications for seat assignment
        $availableApplications = SeatApplication::where('status', 'approved')
                                              ->whereDoesntHave('seatAllotments')
                                              ->with('student')
                                              ->get();
        
        // Get overall seat statistics
        $seatStats = Seat::select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->pluck('count', 'status')
                        ->toArray();
        
        $totalSeats = Seat::count();
        $occupiedSeats = $seatStats['occupied'] ?? 0;
        $availableSeats = $seatStats['vacant'] ?? 0;
        $maintenanceSeats = $seatStats['maintenance'] ?? 0;
        
        // Get total number of rooms
        $totalRooms = Seat::distinct('room_number')->count('room_number');
        
        return view('admin.seats.index', compact(
            'floor', 
            'block', 
            'availableApplications',
            'totalSeats',
            'occupiedSeats',
            'availableSeats',
            'maintenanceSeats',
            'totalRooms'
        ));
    }
    
    public function getRooms(Request $request)
    {
        $floor = $request->get('floor', 1);
        $block = $request->get('block', 'Front');
        
        // Get room numbers with their status counts
        $roomsData = Seat::where('floor', $floor)
                        ->where('block', $block)
                        ->select('room_number', 'status', DB::raw('count(*) as count'))
                        ->groupBy('room_number', 'status')
                        ->orderBy('room_number')
                        ->get();
        
        // Process room data to get status for each room
        $rooms = [];
        $totalCounts = ['occupied' => 0, 'vacant' => 0, 'maintenance' => 0];
        
        foreach ($roomsData as $data) {
            $roomNumber = $data->room_number;
            
            if (!isset($rooms[$roomNumber])) {
                $rooms[$roomNumber] = [
                    'room_number' => $roomNumber,
                    'occupied' => 0,
                    'vacant' => 0,
                    'maintenance' => 0,
                    'total' => 0
                ];
            }
            
            $rooms[$roomNumber][$data->status] = $data->count;
            $rooms[$roomNumber]['total'] += $data->count;
            $totalCounts[$data->status] += $data->count;
        }
        
        // Determine room status based on seat occupancy
        foreach ($rooms as &$room) {
            if ($room['occupied'] == $room['total']) {
                $room['status'] = 'Occupied';
            } elseif ($room['vacant'] == $room['total']) {
                $room['status'] = 'Available';
            } elseif ($room['maintenance'] > 0) {
                $room['status'] = 'Maintenance';
            } else {
                $room['status'] = 'Partially Occupied';
            }
        }
        
        return response()->json([
            'success' => true,
            'rooms' => array_values($rooms),
            'totalCounts' => $totalCounts,
            'floor' => $floor,
            'block' => $block
        ]);
    }
    
    public function getRoomSeats(Request $request)
    {
        $floor = $request->get('floor');
        $block = $request->get('block');
        $roomNumber = $request->get('room_number');
        
        // Get seats for the specific room
        $seats = Seat::where('floor', $floor)
                    ->where('block', $block)
                    ->where('room_number', $roomNumber)
                    ->orderBy('bed_number')
                    ->get();
        
        // Transform seats to show as A, B, C, D, Fifth
        $transformedSeats = $seats->map(function($seat) {
            return [
                'seat_id' => $seat->seat_id,
                'status' => $seat->status,
                'room_number' => $seat->room_number,
                'bed_number' => $seat->bed_number
            ];
        });
        
        return response()->json([
            'success' => true,
            'seats' => $transformedSeats,
            'room_number' => $roomNumber,
            'floor' => $floor,
            'block' => $block
        ]);
    }
    
    public function getSeatDetails($seatId)
    {
        $seat = Seat::with(['seatAllotments.student', 'seatAllotments.seatApplication'])
                   ->findOrFail($seatId);
        
        $currentAllotment = $seat->seatAllotments()
                                ->where('status', 'active')
                                ->with(['student', 'seatApplication'])
                                ->first();
        
        return response()->json([
            'success' => true,
            'seat' => $seat,
            'allotment' => $currentAllotment
        ]);
    }
    
    public function assignSeat(Request $request)
    {
        $request->validate([
            'seat_id' => 'required|exists:seats,seat_id',
            'application_id' => 'required|exists:seat_applications,application_id'
        ]);
        
        try {
            DB::beginTransaction();
            
            $seat = Seat::findOrFail($request->seat_id);
            $application = SeatApplication::findOrFail($request->application_id);
            
            // Check if seat is available
            if ($seat->status !== 'vacant') {
                return response()->json([
                    'success' => false,
                    'message' => 'Seat is not available for assignment'
                ], 400);
            }
            
            // Check if student already has a seat
            $existingAllotment = SeatAllotment::where('student_id', $application->student_id)
                                            ->where('status', 'active')
                                            ->first();
            
            if ($existingAllotment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student already has an active seat assignment'
                ], 400);
            }
            
            // Create seat allotment
            SeatAllotment::create([
                'seat_id' => $seat->seat_id,
                'student_id' => $application->student_id,
                'application_id' => $application->application_id,
                'admin_id' => auth('admin')->id(),
                'start_date' => now(),
                'status' => 'active'
            ]);
            
            // Update seat status
            $seat->update(['status' => 'occupied']);
            
            // Update application status
            $application->update(['status' => 'allocated']);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Seat assigned successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign seat: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function releaseSeat($seatId)
    {
        try {
            DB::beginTransaction();
            
            $seat = Seat::findOrFail($seatId);
            
            // Find active allotment
            $allotment = SeatAllotment::where('seat_id', $seatId)
                                    ->where('status', 'active')
                                    ->first();
            
            if (!$allotment) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active allotment found for this seat'
                ], 400);
            }
            
            // Update allotment status
            $allotment->update([
                'status' => 'completed',
                'end_date' => now()
            ]);
            
            // Update seat status
            $seat->update(['status' => 'vacant']);
            
            // Update application status back to approved
            $application = SeatApplication::find($allotment->application_id);
            if ($application) {
                $application->update(['status' => 'approved']);
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Seat released successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to release seat: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAvailableStudents()
    {
        $students = SeatApplication::where('status', 'approved')
                                  ->whereDoesntHave('seatAllotments', function($query) {
                                      $query->where('status', 'active');
                                  })
                                  ->with('student')
                                  ->get()
                                  ->map(function($application) {
                                      return [
                                          'application_id' => $application->application_id,
                                          'name' => $application->student->name ?? $application->student_name,
                                          'email' => $application->student->email ?? 'N/A'
                                      ];
                                  });

        return response()->json([
            'success' => true,
            'students' => $students
        ]);
    }
}

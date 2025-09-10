<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\SeatApplication;
use App\Models\SeatAllotment;
use App\Models\Student;
use App\Mail\SeatAssignmentNotification;
use App\Mail\SeatReleaseNotification;
use App\Helpers\SmsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $transformedSeats = $seats->map(function ($seat) {
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
        try {
            // Load seat with all necessary relationships using the new helper methods
            $seat = Seat::with([
                'currentAllotment', // This will load student, admin, and application through the relationship
                'seatAllotments.student',
                'seatAllotments.admin',
                'seatAllotments.application'
            ])->findOrFail($seatId);

            // Get the current active allotment using the helper method
            $currentAllotment = $seat->currentAllotment;

            // If no active allotment but seat is occupied, try to find the most recent allotment
            if (!$currentAllotment && $seat->status === 'occupied') {
                $currentAllotment = $seat->seatAllotments()
                    ->with(['student', 'admin', 'application'])
                    ->latest('start_date')
                    ->first();
            }

            // Prepare the response data
            $responseData = [
                'success' => true,
                'seat' => $seat->makeHidden(['seatAllotments']), // Hide the full allotments list to reduce payload
                'allotment' => $currentAllotment
            ];

            // Add student information if available
            if ($currentAllotment && $currentAllotment->student) {
                $responseData['student'] = $currentAllotment->student;
            }

            // Add admin information if available
            if ($currentAllotment && $currentAllotment->admin) {
                $responseData['admin'] = $currentAllotment->admin;
            }

            // Add application information if available
            if ($currentAllotment && $currentAllotment->application) {
                $responseData['application'] = $currentAllotment->application;
            }

            return response()->json($responseData);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Seat not found',
                'error' => 'The requested seat does not exist.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error loading seat details: ' . $e->getMessage(), [
                'seat_id' => $seatId,
                'exception' => $e
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error loading seat details',
                'error' => 'An unexpected error occurred while loading seat information.'
            ], 500);
        }
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
            $application = SeatApplication::with('student')->findOrFail($request->application_id);

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

            // Create seat allotment with renewal settings
            $allotment = SeatAllotment::create([
                'seat_id' => $seat->seat_id,
                'student_id' => $application->student_id,
                'application_id' => $application->application_id,
                'admin_id' => auth('admin')->id(),
                'start_date' => now(),
                'status' => 'active',
                'renewal_required' => true,
                'renewal_reminder_sent' => false,
                'allocation_expiry_date' => now()->addYear()->format('Y-m-d')
            ]);

            // Update seat status
            $seat->update(['status' => 'occupied']);

            // Update application status
            $application->update(['status' => 'allocated']);

            // Send email notification to student
            try {
                if ($application->student && $application->student->email) {
                    Mail::to($application->student->email)->send(
                        new SeatAssignmentNotification($application->student, $seat, $allotment)
                    );
                    Log::info('Seat assignment email sent successfully', [
                        'student_id' => $application->student_id,
                        'seat_id' => $seat->seat_id,
                        'allotment_id' => $allotment->allotment_id
                    ]);
                }
            } catch (\Exception $emailException) {
                // Log email error but don't fail the assignment
                Log::error('Failed to send seat assignment email: ' . $emailException->getMessage(), [
                    'student_id' => $application->student_id,
                    'seat_id' => $seat->seat_id,
                    'allotment_id' => $allotment->allotment_id,
                    'exception' => $emailException
                ]);
            }

            // Send SMS notification to student
            try {
                if ($application->student && $application->student->phone) {
                    $smsResult = SmsHelper::sendSeatAssignmentSms(
                        $application->student->phone,
                        $seat->room_number,
                        $seat->bed_number,
                        $seat->block,
                        $seat->floor
                    );

                    if ($smsResult['success']) {
                        Log::info('Seat assignment SMS sent successfully', [
                            'student_id' => $application->student_id,
                            'student_phone' => $application->student->phone,
                            'seat_id' => $seat->seat_id,
                            'allotment_id' => $allotment->allotment_id
                        ]);
                    } else {
                        Log::error('Failed to send seat assignment SMS', [
                            'student_id' => $application->student_id,
                            'student_phone' => $application->student->phone,
                            'seat_id' => $seat->seat_id,
                            'allotment_id' => $allotment->allotment_id,
                            'error' => $smsResult['message']
                        ]);
                    }
                }
            } catch (\Exception $smsException) {
                // Log SMS error but don't fail the assignment
                Log::error('SMS sending exception in seat assignment: ' . $smsException->getMessage(), [
                    'student_id' => $application->student_id,
                    'student_phone' => $application->student->phone ?? 'N/A',
                    'seat_id' => $seat->seat_id,
                    'allotment_id' => $allotment->allotment_id,
                    'exception' => $smsException
                ]);
            }

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

    public function releaseSeat($seatId, Request $request)
    {
        try {
            DB::beginTransaction();

            $seat = Seat::findOrFail($seatId);

            // Find active allotment with student and application relationships
            $allotment = SeatAllotment::where('seat_id', $seatId)
                ->where('status', 'active')
                ->with(['student', 'application'])
                ->first();

            if (!$allotment) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active allotment found for this seat'
                ], 400);
            }

            // Validate request data for release with message
            $request->validate([
                'release_reason' => 'required|string|min:10|max:1000',
                'student_email' => 'required|email',
                'student_name' => 'required|string'
            ]);

            $releaseReason = $request->release_reason;
            $studentEmail = $request->student_email;
            $studentName = $request->student_name;

            // Update allotment status
            $allotment->update([
                'status' => 'ended',
                'end_date' => now()
            ]);

            // Update seat status
            $seat->update(['status' => 'vacant']);

            // Update application status back to approved
            $application = SeatApplication::find($allotment->application_id);
            if ($application) {
                $application->update(['status' => 'approved']);
            }

            // Send email notification to student
            try {
                if ($studentEmail) {
                    $seatDetails = [
                        'room_number' => $seat->room_number,
                        'bed_number' => $seat->bed_number,
                        'floor' => $seat->floor,
                        'block' => $seat->block
                    ];

                    $releasedBy = auth('admin')->user()->name ?? 'Hall Administration';

                    Mail::to($studentEmail)->send(
                        new SeatReleaseNotification($studentName, $seatDetails, $releaseReason, $releasedBy)
                    );

                    Log::info('Seat release email sent successfully', [
                        'student_email' => $studentEmail,
                        'seat_id' => $seatId,
                        'release_reason' => $releaseReason
                    ]);
                }
            } catch (\Exception $emailException) {
                // Log email error but don't fail the release process
                Log::error('Failed to send seat release email: ' . $emailException->getMessage(), [
                    'student_email' => $studentEmail,
                    'seat_id' => $seatId,
                    'release_reason' => $releaseReason,
                    'exception' => $emailException
                ]);
            }

            // Send SMS notification to student
            try {
                if ($allotment->student && $allotment->student->phone) {
                    $smsResult = SmsHelper::sendSeatReleaseSms(
                        $allotment->student->phone,
                        $seat->room_number,
                        $seat->bed_number,
                        $releaseReason
                    );

                    if ($smsResult['success']) {
                        Log::info('Seat release SMS sent successfully', [
                            'student_id' => $allotment->student_id,
                            'student_phone' => $allotment->student->phone,
                            'seat_id' => $seatId,
                            'release_reason' => $releaseReason
                        ]);
                    } else {
                        Log::error('Failed to send seat release SMS', [
                            'student_id' => $allotment->student_id,
                            'student_phone' => $allotment->student->phone,
                            'seat_id' => $seatId,
                            'release_reason' => $releaseReason,
                            'error' => $smsResult['message']
                        ]);
                    }
                }
            } catch (\Exception $smsException) {
                // Log SMS error but don't fail the release process
                Log::error('SMS sending exception in seat release: ' . $smsException->getMessage(), [
                    'student_id' => $allotment->student_id ?? 'N/A',
                    'student_phone' => $allotment->student->phone ?? 'N/A',
                    'seat_id' => $seatId,
                    'release_reason' => $releaseReason,
                    'exception' => $smsException
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Seat released successfully and notification sent to student'
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
            ->whereDoesntHave('seatAllotments', function ($query) {
                $query->where('status', 'active');
            })
            ->with('student')
            ->get()
            ->map(function ($application) {
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

    public function showAssignmentPage($seatId)
    {
        $seat = Seat::findOrFail($seatId);

        // Check if seat is available for assignment
        if ($seat->status !== 'vacant') {
            return redirect()->back()->with('error', 'This seat is not available for assignment.');
        }

        // Get available students for assignment
        $availableStudents = SeatApplication::where('status', 'approved')
            ->whereDoesntHave('seatAllotments', function ($query) {
                $query->where('status', 'active');
            })
            ->with('student')
            ->get();

        return view('admin.seats.assign', compact('seat', 'availableStudents'));
    }
}

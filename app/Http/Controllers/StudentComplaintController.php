<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentComplaintController extends Controller
{
    // Display complaint list
    public function complaintList()
    {
        $student = Auth::user();

        if (!$student instanceof \App\Models\Student) {
            return redirect()->route('student.login')->with('error', 'Unauthorized access.');
        }

        $complaints = Complaint::where('student_id', $student->student_id)
            ->orderBy('submission_date', 'desc')
            ->paginate(10);

        $stats = [
            'total' => Complaint::where('student_id', $student->student_id)->count(),
            'pending' => Complaint::where('student_id', $student->student_id)->where('status', 'pending')->count(),
            'in_progress' => Complaint::where('student_id', $student->student_id)->where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('student_id', $student->student_id)->where('status', 'resolved')->count(),
        ];

        return view('student.complaint_list', compact('complaints', 'stats', 'student'));
    }

    // Display create complaint form
    public function createComplaint()
    {
        return view('student.create_complaint');
    }

    // Store new complaint
    public function storeComplaint(Request $request)
    {
        $request->validate([
            'category' => 'required|in:electrical,water,roommate,medical,harassment,safety,other',
            'description' => 'required|string|max:1000',
            'emergency_flag' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $student = Auth::user();

        if (!$student instanceof \App\Models\Student) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
        }

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('complaints', $imageName, 'public');
            $imageUrl = Storage::url($imagePath);
        }

        $complaint = Complaint::create([
            'student_id' => $student->student_id,
            'category' => $request->category,
            'description' => $request->description,
            'emergency_flag' => $request->emergency_flag,
            'status' => 'pending',
            'submission_date' => now(),
            'image_url' => $imageUrl,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Complaint submitted successfully!',
            'tracking_id' => 'CM-' . date('Y') . '-' . str_pad($complaint->complaint_id, 3, '0', STR_PAD_LEFT)
        ]);
    }

    // Display track complaint page
    public function trackComplaint()
    {
        $student = Auth::user();

        if (!$student instanceof \App\Models\Student) {
            return redirect()->route('student.login')->with('error', 'Unauthorized access.');
        }

        $complaints = Complaint::where('student_id', $student->student_id)
            ->orderBy('submission_date', 'desc')
            ->get();

        return view('student.track_complaint', compact('complaints', 'student'));
    }

    // Search complaint by tracking ID
    public function searchComplaint(Request $request)
    {
        $request->validate([
            'tracking_id' => 'required|string'
        ]);

        $student = Auth::user();

        if (!$student instanceof \App\Models\Student) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
        }

        $trackingId = $request->tracking_id;

        // Extract complaint ID from tracking ID (format: CM-YYYY-XXX)
        if (preg_match('/CM-\d{4}-(\d{3})/', $trackingId, $matches)) {
            $complaintId = (int)$matches[1];

            $complaint = Complaint::where('complaint_id', $complaintId)
                ->where('student_id', $student->student_id)
                ->first();

            if ($complaint) {
                return response()->json([
                    'success' => true,
                    'complaint' => $complaint,
                    'tracking_id' => 'CM-' . date('Y') . '-' . str_pad($complaint->complaint_id, 3, '0', STR_PAD_LEFT)
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Complaint not found with the provided tracking ID.'
        ]);
    }

    // Delete complaint
    // Delete complaint
    public function deleteComplaint(Complaint $complaint)
    {
        $student = Auth::guard('student')->user(); // Use the correct guard

        if (!$student instanceof \App\Models\Student || $complaint->student_id !== $student->student_id) {
            abort(403, 'Unauthorized access to complaint.');
        }

        // Only allow deletion of pending complaints
        if ($complaint->status !== 'pending') {
            return back()->with('error', 'Only pending complaints can be deleted.');
        }

        if ($complaint->image_url) {
            $imagePath = str_replace('/storage/', '', $complaint->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $complaint->delete();

        return redirect()->route('student.complaint_list')->with('success', 'Complaint deleted successfully!');
    }
}

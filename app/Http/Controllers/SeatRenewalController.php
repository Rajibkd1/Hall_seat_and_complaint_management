<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatRenewalApplication;
use App\Models\SeatAllotment;
use App\Models\Student;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SeatRenewalReminder;
use App\Mail\SeatRenewalStatusUpdate;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SeatRenewalController extends Controller
{
    // Student methods
    public function showRenewalForm()
    {
        $student = Auth::guard('student')->user();

        // Get the student's active seat allotment
        $allotment = SeatAllotment::where('student_id', $student->student_id)
            ->where('status', 'active')
            ->with(['seat', 'student'])
            ->first();

        if (!$allotment) {
            return redirect()->route('student.dashboard')
                ->with('error', 'No active seat allocation found.');
        }

        if (!$allotment->canApplyForRenewal()) {
            return redirect()->route('student.dashboard')
                ->with('error', 'You are not eligible for seat renewal at this time.');
        }

        if ($allotment->hasPendingRenewalApplication()) {
            return redirect()->route('student.dashboard')
                ->with('info', 'You already have a pending renewal application.');
        }

        return view('student.seat_renewal_form', compact('allotment', 'student'));
    }

    public function submitRenewalApplication(Request $request)
    {
        $student = Auth::guard('student')->user();

        $request->validate([
            'current_semesters' => 'required|integer|min:1|max:20',
            'last_semester_cgpa' => 'required|numeric|min:0|max:4.00',
            'result_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'additional_comments' => 'nullable|string|max:1000',
        ]);

        $allotment = SeatAllotment::where('student_id', $student->student_id)
            ->where('status', 'active')
            ->first();

        if (!$allotment || !$allotment->canApplyForRenewal()) {
            return redirect()->back()->with('error', 'You are not eligible for seat renewal.');
        }

        if ($allotment->hasPendingRenewalApplication()) {
            return redirect()->back()->with('error', 'You already have a pending renewal application.');
        }

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('result_file')) {
            $file = $request->file('result_file');
            $fileName = 'renewal_result_' . $student->student_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('renewal_documents', $fileName, 'public');
        }

        // Create renewal application
        $renewalApplication = SeatRenewalApplication::create([
            'allotment_id' => $allotment->allotment_id,
            'student_id' => $student->student_id,
            'current_semesters' => $request->current_semesters,
            'last_semester_cgpa' => $request->last_semester_cgpa,
            'result_file_path' => $filePath,
            'additional_comments' => $request->additional_comments,
            'status' => 'pending',
            'submission_date' => now(),
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Your seat renewal application has been submitted successfully.');
    }

    public function viewRenewalStatus()
    {
        $student = Auth::guard('student')->user();

        $renewalApplications = SeatRenewalApplication::where('student_id', $student->student_id)
            ->with(['allotment.seat', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.renewal_status', compact('renewalApplications'));
    }

    // Admin methods
    public function index(Request $request)
    {
        $query = SeatRenewalApplication::with([
            'student',
            'allotment.seat',
            'reviewer'
        ]);

        // Search by student name
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->whereHas('student', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('university_id', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->get('status') !== 'all') {
            $query->where('status', $request->get('status'));
        }

        // Default sorting: pending first, then by submission date
        $query->orderByRaw("CASE 
            WHEN status = 'pending' THEN 1 
            WHEN status = 'approved' THEN 2 
            WHEN status = 'rejected' THEN 3 
            ELSE 4 
        END")
            ->orderBy('submission_date', 'desc');

        $renewalApplications = $query->get();

        // Get counts for filter buttons
        $statusCounts = [
            'all' => SeatRenewalApplication::count(),
            'pending' => SeatRenewalApplication::where('status', 'pending')->count(),
            'approved' => SeatRenewalApplication::where('status', 'approved')->count(),
            'rejected' => SeatRenewalApplication::where('status', 'rejected')->count(),
        ];

        return view('admin.renewal_applications.index', compact('renewalApplications', 'statusCounts'));
    }

    public function show(SeatRenewalApplication $renewalApplication)
    {
        $renewalApplication->load(['student', 'allotment.seat', 'reviewer']);

        return view('admin.renewal_applications.show', compact('renewalApplication'));
    }

    public function approve(Request $request, SeatRenewalApplication $renewalApplication)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $admin = Auth::guard('admin')->user();

        // Store original expiry date for response message
        $originalExpiryDate = $renewalApplication->allotment->allocation_expiry_date;

        $renewalApplication->update([
            'status' => 'approved',
            'reviewed_by' => $admin->admin_id,
            'reviewed_at' => now(),
            'admin_notes' => $request->admin_notes,
        ]);

        // Extend the seat allocation by 1 year from the current expiry date
        $renewalApplication->allotment->extendAllocation(12);

        // Get the new expiry date for confirmation
        $newExpiryDate = $renewalApplication->allotment->fresh()->allocation_expiry_date;

        // Send notification email
        Mail::to($renewalApplication->student->email)
            ->send(new SeatRenewalStatusUpdate($renewalApplication, 'approved'));

        return redirect()->route('admin.renewal_applications.index')
            ->with('success', 'Renewal application approved successfully. Seat allocation extended by 1 year from the current expiry date.');
    }

    public function reject(Request $request, SeatRenewalApplication $renewalApplication)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $admin = Auth::guard('admin')->user();

        $renewalApplication->update([
            'status' => 'rejected',
            'reviewed_by' => $admin->admin_id,
            'reviewed_at' => now(),
            'admin_notes' => $request->admin_notes,
        ]);

        // Send notification email
        Mail::to($renewalApplication->student->email)
            ->send(new SeatRenewalStatusUpdate($renewalApplication, 'rejected'));

        return redirect()->route('admin.renewal_applications.index')
            ->with('success', 'Renewal application rejected.');
    }

    // Utility method to send renewal reminders
    public function sendRenewalReminders()
    {
        $allotments = SeatAllotment::where('status', 'active')
            ->where('renewal_required', true)
            ->where('renewal_reminder_sent', false)
            ->where('allocation_expiry_date', '<=', Carbon::now()->addDays(30))
            ->with(['student', 'seat'])
            ->get();

        $sentCount = 0;
        foreach ($allotments as $allotment) {
            if ($allotment->needsRenewalReminder()) {
                Mail::to($allotment->student->email)
                    ->send(new SeatRenewalReminder($allotment));

                $allotment->update(['renewal_reminder_sent' => true]);
                $sentCount++;
            }
        }

        return response()->json([
            'message' => "Renewal reminders sent to {$sentCount} students.",
            'sent_count' => $sentCount
        ]);
    }

    public function sendCustomEmail(Request $request, SeatRenewalApplication $renewalApplication)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $admin = Auth::guard('admin')->user();

        try {
            \App\Services\EmailService::sendCustomRenewalEmail(
                $renewalApplication,
                $request->subject,
                $request->message,
                $admin->name
            );

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Custom email sent successfully to ' . $renewalApplication->student->name
                ]);
            }

            return redirect()->route('admin.renewal_applications.show', $renewalApplication)
                ->with('success', 'Custom email sent successfully to ' . $renewalApplication->student->name);
        } catch (\Exception $e) {
            \Log::error('Failed to send custom email', [
                'renewal_application_id' => $renewalApplication->renewal_id,
                'student_email' => $renewalApplication->student->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.renewal_applications.show', $renewalApplication)
                ->with('error', 'Failed to send email. Please try again.');
        }
    }

    public function sendTemplateEmail(Request $request, SeatRenewalApplication $renewalApplication)
    {
        $request->validate([
            'template' => 'required|string|in:office_visit,incomplete_documents,additional_info,meeting_schedule,urgent_action,general_inquiry',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'additional_notes' => 'nullable|string|max:1000',
        ]);

        $admin = Auth::guard('admin')->user();

        try {
            \App\Services\EmailService::sendTemplateRenewalEmail(
                $renewalApplication,
                $request->subject,
                $request->message,
                $request->additional_notes,
                $admin->name
            );

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Template email sent successfully to ' . $renewalApplication->student->name
                ]);
            }

            return redirect()->route('admin.renewal_applications.show', $renewalApplication)
                ->with('success', 'Template email sent successfully to ' . $renewalApplication->student->name);
        } catch (\Exception $e) {
            \Log::error('Failed to send template email', [
                'renewal_application_id' => $renewalApplication->renewal_id,
                'student_email' => $renewalApplication->student->email,
                'template' => $request->template,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.renewal_applications.show', $renewalApplication)
                ->with('error', 'Failed to send email. Please try again.');
        }
    }

    // PDF Export Methods
    public function downloadRenewalApplicationsPDF(Request $request)
    {
        $query = SeatRenewalApplication::with([
            'student',
            'allotment.seat',
            'reviewer'
        ]);

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->whereHas('student', function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('university_id', 'like', "%{$searchTerm}%");
            });
        }

        // Apply status filter
        $status = $request->get('status', 'all');
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // Apply same sorting as index
        $query->orderByRaw("CASE 
            WHEN status = 'pending' THEN 1 
            WHEN status = 'approved' THEN 2 
            WHEN status = 'rejected' THEN 3 
            ELSE 4 
        END")
            ->orderBy('submission_date', 'desc');

        $renewalApplications = $query->get();

        // Get counts for the report
        $statusCounts = [
            'all' => SeatRenewalApplication::count(),
            'pending' => SeatRenewalApplication::where('status', 'pending')->count(),
            'approved' => SeatRenewalApplication::where('status', 'approved')->count(),
            'rejected' => SeatRenewalApplication::where('status', 'rejected')->count(),
        ];

        $pdf = Pdf::loadView('admin.renewal_applications.pdf_report', compact('renewalApplications', 'statusCounts', 'status'));

        $filename = 'renewal_applications_' . $status . '_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    public function downloadSingleRenewalApplicationPDF(SeatRenewalApplication $renewalApplication)
    {
        $renewalApplication->load(['student', 'allotment.seat', 'reviewer']);

        $pdf = Pdf::loadView('admin.renewal_applications.single_application_pdf', compact('renewalApplication'));

        $filename = 'renewal_application_' . $renewalApplication->renewal_id . '_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }
}

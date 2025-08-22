<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatApplication;
use App\Models\Student;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ApplicationStatusUpdated;
use App\Mail\AdminMessageEmail;
use Barryvdh\DomPDF\Facade\Pdf;

class SeatApplicationController extends Controller
{
    public function showForm()
    {
        $student = Auth::guard('student')->user();
        $studentId = $student->student_id;

        $existingApplication = SeatApplication::where('student_id', $studentId)->first();

        session(['active_nav' => 'seat_application']);

        return view('student.seat_application', compact('student', 'existingApplication'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'university_id' => 'required|string|max:50',
            'academic_year' => 'required|string|max:50',
            'guardian_name' => 'required|string|max:255',
            'guardian_mobile' => 'required|string|max:20',
            'guardian_relationship' => 'required|string|max:100',

            'program' => 'required|string',
            'semester_year' => 'nullable|integer',
            'semester_term' => 'nullable|integer',
            'cgpa' => 'required|numeric|min:0|max:4',

            'physical_condition' => 'required|string',
            'family_status' => 'required|string',

            'permanent_address' => 'nullable|string',
            'current_address' => 'nullable|string',

            'activities' => 'nullable|array',
            'activities.*' => 'string|in:bncc,rover',
            'other_info' => 'nullable|array',
            'other_info.*' => 'string|in:ethnic,foreign',

            'declaration_info_correct' => 'accepted',
            'declaration_will_stay' => 'accepted',
            'declaration_seven_days' => 'accepted',
            'application_date' => 'required|date',

            'university_id_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'marksheet' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'birthCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'financialCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'deathCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'medicalCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'activityCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        $universityId = $request->input('university_id');
        $student = Student::where('university_id', $universityId)->first();
        if (!$student) {
            return back()->withErrors(['university_id' => 'Invalid University ID'])->withInput();
        }

        $studentId = $student->student_id;
        $uploadFields = [
            'university_id_doc' => 'university_id_doc',
            'marksheet' => 'marksheet_doc',
            'birthCertificate' => 'birth_certificate_doc',
            'financialCertificate' => 'financial_certificate_doc',
            'deathCertificate' => 'death_certificate_doc',
            'medicalCertificate' => 'medical_certificate_doc',
            'activityCertificate' => 'activity_certificate_doc',
            'signature' => 'signature_doc',
        ];

        $filePaths = [];

        foreach ($uploadFields as $input => $column) {
            if ($request->hasFile($input)) {
                $file = $request->file($input);
                $filename = $universityId . '_' . $input . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs("applications/{$universityId}", $filename, 'public');
                $filePaths[$column] = $path;
            }
        }


        // Create new application record
        $application = new SeatApplication([
            'student_id' => $studentId,
            'student_name' => $request->input('student_name'),
            'department' => $request->input('department'),
            'academic_year' => $request->input('academic_year'),
            'guardian_name' => $request->input('guardian_name'),
            'guardian_mobile' => $request->input('guardian_mobile'),
            'guardian_relationship' => $request->input('guardian_relationship'),

            'program' => $request->input('program'),
            'semester_year' => $request->input('semester_year'),
            'semester_term' => $request->input('semester_term'),
            'cgpa' => $request->input('cgpa'),

            'physical_condition' => $request->input('physical_condition'),
            'family_status' => $request->input('family_status'),

            'permanent_address' => $request->input('permanent_address'),
            'current_address' => $request->input('current_address'),

            'activities' => json_encode($request->input('activities', [])),
            'other_info' => json_encode($request->input('other_info', [])),

            'declaration_info_correct' => true,
            'declaration_will_stay' => true,
            'declaration_seven_days' => true,
            'application_date' => $request->input('application_date'),

            // Default values (adjust if needed)
            'home_distance_km' => 0,
            'financial_need' => false,
            'guardian_yearly_income' => 0,
            'special_quota' => null,
            'disciplinary_status' => 'clear',
            'BNCC_status' => null,
            'documents_uploaded' => '[]',
            'special_note' => null,
            'type' => 'new',
            'status' => 'pending',
            'score' => 0,
            'submission_date' => now(),
            'admin_override' => false,
            'notes' => null,
        ]);

        // Assign uploaded file paths to model attributes
        foreach ($filePaths as $column => $path) {
            $application->{$column} = $path;
        }

        $application->save();

        return redirect()->back()->with('success', 'Seat application submitted successfully.');
    }
    // List all applications for admin
    public function adminIndex()
    {
        $applications = SeatApplication::with('student')->orderBy('application_date', 'desc')->get();
        return view('admin.applications.index', compact('applications'));
    }

    // Show details of a specific application for admin
    public function adminShow(SeatApplication $application)
    {
        $application->load('student');
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, SeatApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,verified,rejected,waitlisted',
            'email_message' => 'nullable|string|max:2000',
            'send_email' => 'nullable|boolean',
        ]);

        $oldStatus = $application->status;
        $newStatus = $validated['status'];
        $statusChanged = $oldStatus !== $newStatus;
        $sendEmailRequested = $request->has('send_email') && $request->input('send_email') == '1';

        // Update status if it has changed
        if ($statusChanged) {
            $application->status = $newStatus;
            $application->save();

            // Create audit log entry
            $admin = Auth::guard('admin')->user();
            AuditLog::create([
                'application_id' => $application->application_id,
                'admin_id' => $admin ? $admin->admin_id : null,
                'action_type' => 'status_update',
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'message' => $validated['email_message'] ?? null,
                'details' => json_encode([
                    'changed_by_admin' => $admin ? $admin->name : 'System',
                    'timestamp' => now()->toDateTimeString(),
                    'email_requested' => $sendEmailRequested
                ])
            ]);
        }

        $message = 'Application status ' . ($statusChanged ? 'updated to ' . $newStatus : 'remains ' . $oldStatus) . '.';

        // Send email notification if requested by admin (regardless of status change)
        $emailSent = false;
        if ($sendEmailRequested) {
            $student = $application->student;

            if ($student && $student->email) {
                try {
                    $emailMessage = $validated['email_message'] ?? ($statusChanged ? 'Your application status has been updated.' : 'Message from administration regarding your application.');
                    Mail::to($student->email)->send(
                        new ApplicationStatusUpdated($application, $emailMessage, $application->status)
                    );
                    $emailSent = true;
                    $message .= ' Email notification sent successfully.';

                    // Log successful email sending
                    Log::info('Application status email sent successfully', [
                        'application_id' => $application->application_id,
                        'student_email' => $student->email,
                        'status' => $application->status,
                        'admin_id' => Auth::guard('admin')->id()
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to send application status email', [
                        'application_id' => $application->application_id,
                        'student_email' => $student->email ?? 'N/A',
                        'error' => $e->getMessage(),
                        'admin_id' => Auth::guard('admin')->id()
                    ]);
                    $message .= ' However, email notification failed to send. Please check email configuration.';
                }
            } else {
                $message .= ' However, no valid email address found for student.';
                Log::warning('Email requested but no student email found', [
                    'application_id' => $application->application_id,
                    'student_id' => $application->student_id
                ]);
            }
        } elseif ($statusChanged) {
            $message .= ' No email notification sent (not requested).';
        }

        return redirect()->route('admin.applications.view', $application->application_id)
            ->with('success', $message)
            ->with('show_status_update_modal', true)
            ->with('email_sent', $emailSent);
    }

    public function sendEmail(Request $request, SeatApplication $application)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $student = $application->student;

        if (!$student || !$student->email) {
            Log::warning('Custom email attempted but no student email found', [
                'application_id' => $application->application_id,
                'student_id' => $application->student_id,
                'admin_id' => Auth::guard('admin')->id()
            ]);

            return redirect()
                ->route('admin.applications.view', $application->application_id)
                ->with('error', 'Could not find student email address.');
        }

        try {
            Mail::to($student->email)->send(
                new AdminMessageEmail($validated['subject'], $validated['message'])
            );

            // Log successful email sending
            Log::info('Custom admin email sent successfully', [
                'application_id' => $application->application_id,
                'student_email' => $student->email,
                'subject' => $validated['subject'],
                'admin_id' => Auth::guard('admin')->id()
            ]);

            return redirect()
                ->route('admin.applications.view', $application->application_id)
                ->with('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send custom admin email', [
                'application_id' => $application->application_id,
                'student_email' => $student->email,
                'subject' => $validated['subject'],
                'error' => $e->getMessage(),
                'admin_id' => Auth::guard('admin')->id()
            ]);

            return redirect()
                ->route('admin.applications.view', $application->application_id)
                ->with('error', 'Failed to send email. Please check email configuration and try again.');
        }
    }

    // List approved and verified applications
    public function approvedApplications()
    {
        $approvedApplications = SeatApplication::with('student')
            ->where('status', 'approved')
            ->orderBy('application_date', 'desc')
            ->get();

        return view('admin.applications.approved', compact('approvedApplications'));
    }

    // Show details of approved application
    public function approvedShow(SeatApplication $application)
    {
        // Ensure the application is approved
        if ($application->status !== 'approved') {
            return redirect()->route('admin.applications.approved')
                ->with('error', 'This application is not approved.');
        }

        $application->load('student');
        return view('admin.applications.approved_show', compact('application'));
    }

    // Generate PDF report of approved applications
    public function generatePDFReport()
    {
        $approvedApplications = SeatApplication::with('student')
            ->where('status', 'approved')
            ->orderBy('application_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.applications.pdf_report', compact('approvedApplications'));

        return $pdf->stream('approved_applications_report_' . date('Y-m-d') . '.pdf');
    }

    // Download PDF report
    public function downloadPDFReport()
    {
        $approvedApplications = SeatApplication::with('student')
            ->where('status', 'approved')
            ->orderBy('application_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.applications.pdf_report', compact('approvedApplications'));

        return $pdf->download('approved_applications_report_' . date('Y-m-d') . '.pdf');
    }

    // List allocated students
    public function allocatedStudents()
    {
        // Set active menu for navigation
        session(['active_admin_menu' => 'allocated_students']);
        
        $allocatedStudents = \App\Models\SeatAllotment::with([
            'student',
            'seat',
            'application',
            'admin'
        ])
            ->where('status', 'active')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('admin.applications.allocated', compact('allocatedStudents'));
    }

    // Show details of allocated student
    public function allocatedShow(\App\Models\SeatAllotment $allotment)
    {
        // Set active menu for navigation
        session(['active_admin_menu' => 'allocated_students']);
        
        // Ensure the allotment is active
        if ($allotment->status !== 'active') {
            return redirect()->route('admin.applications.allocated')
                ->with('error', 'This seat allotment is not active.');
        }

        $allotment->load(['student', 'seat', 'application', 'admin']);
        return view('admin.applications.allocated_show', compact('allotment'));
    }

    // Generate PDF report of allocated students
    public function generateAllocatedPDFReport()
    {
        $allocatedStudents = \App\Models\SeatAllotment::with([
            'student',
            'seat',
            'application',
            'admin'
        ])
            ->where('status', 'active')
            ->orderBy('start_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.applications.allocated_pdf_report', compact('allocatedStudents'));

        return $pdf->stream('allocated_students_report_' . date('Y-m-d') . '.pdf');
    }

    // Download PDF report of allocated students
    public function downloadAllocatedPDFReport()
    {
        $allocatedStudents = \App\Models\SeatAllotment::with([
            'student',
            'seat',
            'application',
            'admin'
        ])
            ->where('status', 'active')
            ->orderBy('start_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.applications.allocated_pdf_report', compact('allocatedStudents'));

        return $pdf->download('allocated_students_report_' . date('Y-m-d') . '.pdf');
    }
}

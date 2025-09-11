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
use App\Helpers\SmsHelper;
use Barryvdh\DomPDF\Facade\Pdf;

class SeatApplicationController extends Controller
{
    public function showForm()
    {
        $student = Auth::guard('student')->user();
        $studentId = $student->student_id;

        $existingApplication = SeatApplication::where('student_id', $studentId)->first();

        // Get seat allocation information for renewal button
        $seatAllotment = \App\Models\SeatAllotment::where('student_id', $studentId)
            ->where('status', 'active')
            ->with(['seat'])
            ->first();

        // Check if student profile is complete before allowing seat application
        $missingFields = $this->checkProfileCompleteness($student);

        if (!empty($missingFields)) {
            session(['active_nav' => 'seat_application']);
            return view('student.seat_application', compact('student', 'existingApplication', 'missingFields', 'seatAllotment'));
        }

        session(['active_nav' => 'seat_application']);

        return view('student.seat_application', compact('student', 'existingApplication', 'seatAllotment'));
    }

    /**
     * Show the form for editing the specified seat application.
     */
    public function edit(SeatApplication $application)
    {
        // Check if the application belongs to the authenticated student
        $student = Auth::guard('student')->user();
        if ($application->student_id !== $student->student_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the application can be edited (within 3 days)
        if (!$application->canBeEdited()) {
            return redirect()->route('student.seat_application')
                ->with('error', 'The application can no longer be edited or deleted.');
        }

        return view('student.edit_application', compact('application', 'student'));
    }

    /**
     * Update the specified seat application in storage.
     */
    public function update(Request $request, SeatApplication $application)
    {
        // Check if the application belongs to the authenticated student
        $student = Auth::guard('student')->user();
        if ($application->student_id !== $student->student_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the application can be edited (within 3 days)
        if (!$application->canBeEdited()) {
            return redirect()->route('student.seat_application')
                ->with('error', 'The application can no longer be edited or deleted.');
        }

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'university_id' => 'required|string|max:50',
            'academic_year' => 'required|string|max:50',
            // Family member information
            'family_member' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_profession' => 'required|string|max:255',
            'mother_profession' => 'required|string|max:255',
            'other_guardian' => 'nullable|string|max:255',
            'guardian_monthly_income' => 'required|numeric|min:0',

            'program' => 'required|string',
            'number_of_semester' => 'required|integer|min:1|max:20',
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
            'marksheet' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'birthCertificate' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'financialCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'deathCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'medicalCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'activityCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png',
            'other_doc_1' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'other_doc_2' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'other_doc_3' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $universityId = $request->input('university_id');
        $uploadFields = [
            'university_id_doc' => 'university_id_doc',
            'marksheet' => 'marksheet_doc',
            'birthCertificate' => 'birth_certificate_doc',
            'financialCertificate' => 'financial_certificate_doc',
            'deathCertificate' => 'death_certificate_doc',
            'medicalCertificate' => 'medical_certificate_doc',
            'activityCertificate' => 'activity_certificate_doc',
            'signature' => 'signature_doc',
            'other_doc_1' => 'other_doc_1',
            'other_doc_2' => 'other_doc_2',
            'other_doc_3' => 'other_doc_3',
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

        // Update application record
        $application->update([
            'student_name' => $request->input('student_name'),
            'department' => $request->input('department'),
            'academic_year' => $request->input('academic_year'),

            // Family member information
            'family_member' => $request->input('family_member'),
            'father_name' => $request->input('father_name'),
            'mother_name' => $request->input('mother_name'),
            'father_profession' => $request->input('father_profession'),
            'mother_profession' => $request->input('mother_profession'),
            'other_guardian' => $request->input('other_guardian'),
            'guardian_monthly_income' => $request->input('guardian_monthly_income'),

            'program' => $request->input('program'),
            'number_of_semester' => $request->input('number_of_semester'),
            'cgpa' => $request->input('cgpa'),

            'physical_condition' => $request->input('physical_condition'),
            'family_status' => $request->input('family_status'),

            'division' => $request->input('division'),
            'district' => $request->input('district'),

            'permanent_address' => $request->input('permanent_address'),
            'current_address' => $request->input('current_address'),

            'activities' => json_encode($request->input('activities', [])),
            'other_info' => json_encode($request->input('other_info', [])),

            'declaration_info_correct' => true,
            'declaration_will_stay' => true,
            'declaration_seven_days' => true,
            'application_date' => $request->input('application_date'),
        ]);

        // Update uploaded file paths
        foreach ($filePaths as $column => $path) {
            $application->{$column} = $path;
        }

        $application->save();

        return redirect()->route('student.seat_application')->with('success', 'Seat application updated successfully.');
    }

    /**
     * Remove the specified seat application from storage.
     */
    public function destroy(SeatApplication $application)
    {
        // Check if the application belongs to the authenticated student
        $student = Auth::guard('student')->user();
        if ($application->student_id !== $student->student_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the application can be deleted (within 3 days)
        if (!$application->canBeEdited()) {
            return redirect()->route('student.seat_application')
                ->with('error', 'The application can no longer be edited or deleted.');
        }

        // Delete associated files
        $fileFields = [
            'university_id_doc',
            'marksheet_doc',
            'birth_certificate_doc',
            'financial_certificate_doc',
            'death_certificate_doc',
            'medical_certificate_doc',
            'activity_certificate_doc',
            'signature_doc',
        ];

        foreach ($fileFields as $field) {
            if ($application->{$field}) {
                Storage::disk('public')->delete($application->{$field});
            }
        }

        $application->delete();

        return redirect()->route('student.seat_application')->with('success', 'Seat application deleted successfully.');
    }

    /**
     * Check if student profile has all required fields for seat application
     */
    private function checkProfileCompleteness(Student $student)
    {
        $missingFields = [];

        // Check required fields
        if (empty($student->profile_image)) {
            $missingFields[] = 'profile_image';
        }

        if (empty($student->id_card_front)) {
            $missingFields[] = 'id_card_front';
        }

        if (empty($student->id_card_back)) {
            $missingFields[] = 'id_card_back';
        }

        if (empty($student->phone)) {
            $missingFields[] = 'phone';
        }

        if (empty($student->university_id)) {
            $missingFields[] = 'university_id';
        }

        return $missingFields;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'university_id' => 'required|string|max:50',
            'academic_year' => 'required|string|max:50',
            // Family member information
            'family_member' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'father_profession' => 'required|string|max:255',
            'mother_profession' => 'required|string|max:255',
            'other_guardian' => 'nullable|string|max:255',
            'guardian_monthly_income' => 'required|numeric|min:0',

            'program' => 'required|string',
            'number_of_semester' => 'required|integer|min:1|max:20',
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
            'marksheet' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'birthCertificate' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'financialCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'deathCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'medicalCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'activityCertificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'signature' => 'nullable|file|mimes:jpg,jpeg,png',
            'other_doc_1' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'other_doc_2' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'other_doc_3' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
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
            'other_doc_1' => 'other_doc_1',
            'other_doc_2' => 'other_doc_2',
            'other_doc_3' => 'other_doc_3',
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

            // Family member information
            'family_member' => $request->input('family_member'),
            'father_name' => $request->input('father_name'),
            'mother_name' => $request->input('mother_name'),
            'father_profession' => $request->input('father_profession'),
            'mother_profession' => $request->input('mother_profession'),
            'other_guardian' => $request->input('other_guardian'),
            'guardian_monthly_income' => $request->input('guardian_monthly_income'),

            'program' => $request->input('program'),
            'number_of_semester' => $request->input('number_of_semester'),
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
    // Generate PDF for a specific application
    public function downloadApplicationPDF($applicationId)
    {
        $application = SeatApplication::find($applicationId);

        if (!$application) {
            return redirect()->route('student.seat_application')->with('error', 'Application not found.');
        }

        // Check if the current user is authorized to view this application
        $user = Auth::user();
        $guard = Auth::getDefaultDriver();

        // If user is a student, check if they own this application
        if ($guard === 'student' && $application->student_id !== $user->student_id) {
            abort(403, 'Unauthorized action.');
        }

        $student = $application->student; // Get the associated student
        $pdf = Pdf::loadView('admin.applications.application_pdf', compact('application', 'student'));
        return $pdf->download('application_' . $application->application_id . '.pdf');
    }
    public function adminIndex(Request $request)
    {
        // Set active menu for navigation
        session(['active_admin_menu' => 'applications']);

        $query = SeatApplication::with('student');

        // Apply priority filters
        if ($request->filled('priority_filters')) {
            $filters = $request->input('priority_filters');

            if (in_array('phd', $filters)) {
                $query->where(function ($q) {
                    $q->where('program', 'like', '%phd%')
                        ->orWhere('program', 'like', '%doctorate%');
                });
            }

            if (in_array('high_cgpa', $filters)) {
                $query->where('cgpa', '>=', 3.5);
            }

            if (in_array('distance', $filters)) {
                $query->where('home_distance_km', '>=', 50);
            }

            if (in_array('guardian_deceased', $filters)) {
                $query->where(function ($q) {
                    $q->whereNotNull('death_certificate_doc')
                        ->orWhere('family_status', 'like', '%deceased%')
                        ->orWhere('family_status', 'like', '%orphan%');
                });
            }

            if (in_array('extracurricular', $filters)) {
                $query->whereRaw('JSON_LENGTH(activities) >= 3');
            }

            if (in_array('senior_student', $filters)) {
                $query->where('semester_year', '>=', 3);
            }
        }

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('department', 'like', "%{$search}%");
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Apply department filter
        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        // Apply academic year filter
        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->input('academic_year'));
        }

        // Apply number of semesters filter
        if ($request->filled('number_of_semester')) {
            $query->where('number_of_semester', $request->input('number_of_semester'));
        }

        // Apply sorting
        $sortBy = $request->input('sort_by', 'score');
        $sortOrder = $request->input('sort_order', 'desc');

        switch ($sortBy) {
            case 'priority_score':
            case 'score':
                $query->orderBy('score', $sortOrder);
                break;
            case 'cgpa':
                $query->orderBy('cgpa', $sortOrder);
                break;
            case 'distance':
                $query->orderBy('home_distance_km', $sortOrder);
                break;
            case 'date':
                $query->orderBy('application_date', $sortOrder);
                break;
            default:
                $query->orderBy('score', 'desc');
        }

        $applications = $query->get();

        // Calculate priority scores for applications that don't have them
        foreach ($applications as $application) {
            if (empty($application->score)) {
                $application->calculatePriorityScore();
                $application->save();
            }
        }

        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Show priority-based applications with detailed scoring
     */
    public function priorityIndex(Request $request)
    {
        $query = SeatApplication::with('student');

        // Apply priority filters
        if ($request->filled('priority_filters')) {
            $filters = $request->input('priority_filters');

            if (in_array('phd', $filters)) {
                $query->where(function ($q) {
                    $q->where('program', 'like', '%phd%')
                        ->orWhere('program', 'like', '%doctorate%');
                });
            }

            if (in_array('high_cgpa', $filters)) {
                $query->where('cgpa', '>=', 3.5);
            }

            if (in_array('distance', $filters)) {
                $query->where('home_distance_km', '>=', 50);
            }

            if (in_array('guardian_deceased', $filters)) {
                $query->where(function ($q) {
                    $q->whereNotNull('death_certificate_doc')
                        ->orWhere('family_status', 'like', '%deceased%')
                        ->orWhere('family_status', 'like', '%orphan%');
                });
            }

            if (in_array('extracurricular', $filters)) {
                $query->whereRaw('JSON_LENGTH(activities) >= 3');
            }

            if (in_array('senior_student', $filters)) {
                $query->where('semester_year', '>=', 3);
            }
        }

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Always sort by priority score for priority view
        $query->orderBy('score', 'desc');

        $applications = $query->get();

        // Calculate priority scores for applications that don't have them
        foreach ($applications as $application) {
            if (empty($application->score)) {
                $application->calculatePriorityScore();
                $application->save();
            }
        }

        return view('admin.applications.priority', compact('applications'));
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

        // Send email and SMS notifications
        $emailSent = false;
        $smsSent = false;
        $student = $application->student;

        // Send email notification if requested by admin
        if ($sendEmailRequested && $student && $student->email) {
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
        } elseif ($sendEmailRequested) {
            $message .= ' However, no valid email address found for student.';
            Log::warning('Email requested but no student email found', [
                'application_id' => $application->application_id,
                'student_id' => $application->student_id
            ]);
        } elseif ($statusChanged) {
            $message .= ' No email notification sent (not requested).';
        }

        // Send SMS notification automatically when status changes (regardless of email request)
        if ($statusChanged && $student && $student->phone) {
            try {
                $smsResult = SmsHelper::sendApplicationStatusSms(
                    $student->phone,
                    $application->status,
                    $validated['email_message'] ?? null
                );

                if ($smsResult['success']) {
                    $smsSent = true;
                    $message .= ' SMS notification sent successfully.';

                    Log::info('Application status SMS sent successfully', [
                        'application_id' => $application->application_id,
                        'student_phone' => $student->phone,
                        'status' => $application->status,
                        'admin_id' => Auth::guard('admin')->id()
                    ]);
                } else {
                    Log::error('Failed to send application status SMS', [
                        'application_id' => $application->application_id,
                        'student_phone' => $student->phone,
                        'error' => $smsResult['message'],
                        'admin_id' => Auth::guard('admin')->id()
                    ]);
                    $message .= ' However, SMS notification failed to send.';
                }
            } catch (\Exception $e) {
                Log::error('SMS sending exception', [
                    'application_id' => $application->application_id,
                    'student_phone' => $student->phone ?? 'N/A',
                    'error' => $e->getMessage(),
                    'admin_id' => Auth::guard('admin')->id()
                ]);
                $message .= ' However, SMS notification failed to send.';
            }
        } elseif ($statusChanged && (!$student || !$student->phone)) {
            Log::warning('SMS could not be sent - no student phone found', [
                'application_id' => $application->application_id,
                'student_id' => $application->student_id,
                'has_student' => $student ? 'yes' : 'no',
                'has_phone' => $student && $student->phone ? 'yes' : 'no'
            ]);
            $message .= ' However, no valid phone number found for SMS.';
        }

        return redirect()->route('admin.applications.view', $application->application_id)
            ->with('success', $message)
            ->with('show_status_update_modal', true)
            ->with('email_sent', $emailSent)
            ->with('sms_sent', $smsSent);
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
    public function approvedApplications(Request $request)
    {
        $query = SeatApplication::with('student')
            ->where('status', 'approved');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('department', 'like', "%{$search}%");
        }

        // Apply department filter
        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        // Apply academic year filter
        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->input('academic_year'));
        }

        // Apply number of semesters filter
        if ($request->filled('number_of_semester')) {
            $query->where('number_of_semester', $request->input('number_of_semester'));
        }

        // Apply CGPA filter
        if ($request->filled('cgpa_min')) {
            $query->where('cgpa', '>=', $request->input('cgpa_min'));
        }

        if ($request->filled('cgpa_max')) {
            $query->where('cgpa', '<=', $request->input('cgpa_max'));
        }

        // Apply seat status filter
        if ($request->filled('seat_status')) {
            if ($request->input('seat_status') === 'assigned') {
                $query->whereHas('seatAllotments', function ($q) {
                    $q->where('status', 'active');
                });
            } elseif ($request->input('seat_status') === 'needs_seat') {
                $query->whereDoesntHave('seatAllotments', function ($q) {
                    $q->where('status', 'active');
                });
            }
        }

        // Apply sorting
        $sortBy = $request->input('sort_by', 'application_date');
        $sortOrder = $request->input('sort_order', 'desc');

        switch ($sortBy) {
            case 'name':
                $query->join('students', 'seat_applications.student_id', '=', 'students.student_id')
                    ->orderBy('students.name', $sortOrder)
                    ->select('seat_applications.*');
                break;
            case 'cgpa':
                $query->orderBy('cgpa', $sortOrder);
                break;
            case 'department':
                $query->orderBy('department', $sortOrder);
                break;
            case 'application_date':
            default:
                $query->orderBy('application_date', $sortOrder);
                break;
        }

        $approvedApplications = $query->get();

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
    public function allocatedStudents(Request $request)
    {
        // Set active menu for navigation
        session(['active_admin_menu' => 'allocated_students']);

        $query = \App\Models\SeatAllotment::with([
            'student',
            'seat',
            'application',
            'admin'
        ])->where('status', 'active');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('university_id', 'like', "%{$search}%");
            })->orWhereHas('seat', function ($q) use ($search) {
                $q->where('room_number', 'like', "%{$search}%");
            });
        }

        // Apply department filter
        if ($request->filled('department')) {
            $query->whereHas('application', function ($q) use ($request) {
                $q->where('department', $request->input('department'));
            });
        }

        // Apply session year filter
        if ($request->filled('academic_year')) {
            $query->whereHas('application', function ($q) use ($request) {
                $q->where('academic_year', $request->input('academic_year'));
            });
        }

        // Apply number of semesters filter
        if ($request->filled('number_of_semester')) {
            $query->whereHas('application', function ($q) use ($request) {
                $q->where('number_of_semester', $request->input('number_of_semester'));
            });
        }

        // Apply block filter
        if ($request->filled('block')) {
            $query->whereHas('seat', function ($q) use ($request) {
                $q->where('block', $request->input('block'));
            });
        }

        // Apply floor filter
        if ($request->filled('floor')) {
            $query->whereHas('seat', function ($q) use ($request) {
                $q->where('floor', $request->input('floor'));
            });
        }

        $allocatedStudents = $query->orderBy('start_date', 'desc')->get();

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

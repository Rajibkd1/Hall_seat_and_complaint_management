<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Complaint;
use App\Models\HallNotice;
use App\Models\SeatApplication;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get current admin information
        $admin = auth()->guard('admin')->user();

        // Get statistics
        $totalStudents = Student::count();
        $totalApplications = SeatApplication::count();
        $totalComplaints = Complaint::count();
        $totalNotices = HallNotice::count();

        // Get recent statistics
        $pendingApplications = SeatApplication::where('status', 'pending')->count();
        $pendingComplaints = Complaint::where('status', 'pending')->count();
        $activeNotices = HallNotice::where('status', 'active')->count();
        $recentStudents = Student::where('created_at', '>=', now()->subDays(7))->count();

        // Get recent notices (last 4)
        $recentNotices = HallNotice::with('admin')
            ->orderBy('date_posted', 'desc')
            ->limit(4)
            ->get();

        // Get recent complaints (last 4)
        $recentComplaints = Complaint::with('student')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        // Get recent applications (last 4)
        $recentApplications = SeatApplication::with('student')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('admin.dashboard', compact(
            'admin',
            'totalStudents',
            'totalApplications',
            'totalComplaints',
            'totalNotices',
            'pendingApplications',
            'pendingComplaints',
            'activeNotices',
            'recentStudents',
            'recentNotices',
            'recentComplaints',
            'recentApplications'
        ));
    }

    public function students()
    {
        $students = Student::all();
        return view('admin.students.students', compact('students'));
    }

    public function viewStudentProfile($student_id)
    {
        $student = Student::where('student_id', $student_id)->first();
        return view('admin.students.student_profile', compact('student'));
    }

    public function accountRequests()
    {
        $students = Student::where('profile_completed', true)
            ->where('is_active', false)
            ->orderBy('profile_completed_at', 'desc')
            ->get();

        return view('admin.students.account_requests', compact('students'));
    }

    public function viewAccountRequest($student_id)
    {
        $student = Student::where('student_id', $student_id)
            ->where('profile_completed', true)
            ->where('is_active', false)
            ->firstOrFail();

        return view('admin.students.student_detail', compact('student'));
    }

    public function activateAccount(Request $request, $student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();

        if (!$student->profile_completed) {
            return redirect()->back()->with('error', 'Student profile is not completed yet.');
        }

        $student->update([
            'is_active' => true,
            'activated_at' => now()
        ]);

        // Send activation email
        try {
            Mail::to($student->email)->send(new \App\Mail\AccountActivationConfirmation($student));
        } catch (\Exception $e) {
            \Log::error('Failed to send activation email: ' . $e->getMessage());
        }

        // Determine the correct redirect route based on admin role
        $admin = auth()->guard('admin')->user();
        if ($admin->role === 'Provost') {
            return redirect()->route('provost.students')->with('success', 'Account activated successfully! Activation email sent to student.');
        } elseif ($admin->role === 'Co-Provost') {
            return redirect()->route('co-provost.students')->with('success', 'Account activated successfully! Activation email sent to student.');
        } else {
            return redirect()->route('admin.students')->with('success', 'Account activated successfully! Activation email sent to student.');
        }
    }

    public function complaints()
    {
        $complaints = Complaint::with('student')->get();
        return view('admin.complaints.complaints', compact('complaints'));
    }

    public function viewComplaint($id)
    {
        $complaint = Complaint::with('student')->where('complaint_id', $id)->first();
        return view('admin.complaints.view_complaint', compact('complaint'));
    }

    public function updateComplaintStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'admin_comment' => 'nullable|string',
        ]);

        $complaint = Complaint::where('complaint_id', $id)->firstOrFail();
        $complaint->status = $request->status;
        $complaint->admin_comment = $request->admin_comment;
        $complaint->save();

        return redirect()->route('admin.complaint.view', $id)->with('success', 'Complaint status updated successfully.');
    }

    public function notices()
    {
        $notices = HallNotice::all();
        return view('admin.notices.notices', compact('notices'));
    }

    public function createNotice()
    {
        return view('admin.notices.create_notice');
    }

    public function storeNotice(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:hall_notices',
            'notice_type' => 'required|in:announcement,event,deadline',
            'description' => 'required|string',
            'date_posted' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        HallNotice::create([
            'title' => $request->title,
            'notice_type' => $request->notice_type,
            'description' => $request->description,
            'date_posted' => $request->date_posted,
            'status' => $request->status,
            'admin_id' => auth()->guard('admin')->id(),
        ]);

        return redirect()->route('admin.notices')->with('success', 'Notice created successfully.');
    }

    public function editNotice($id)
    {
        $notice = HallNotice::findOrFail($id);
        return view('admin.notices.edit_notice', compact('notice'));
    }

    public function updateNotice(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:hall_notices,title,' . $id . ',notice_id',
            'description' => 'required|string',
            'date_posted' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $notice = HallNotice::findOrFail($id);
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->date_posted = $request->date_posted;
        $notice->status = $request->status;
        $notice->save();

        return redirect()->route('admin.notices')->with('success', 'Notice updated successfully.');
    }

    public function destroyNotice($id)
    {
        $notice = HallNotice::findOrFail($id);
        $notice->delete();

        return redirect()->route('admin.notices')->with('success', 'Notice deleted successfully.');
    }

    public function applications()
    {
        $applications = SeatApplication::with('student')->get();
        return view('admin.applications.applications', compact('applications'));
    }

    public function viewApplication($id)
    {
        $application = SeatApplication::with('student')->where('application_id', $id)->first();
        return view('admin.applications.view_application', compact('application'));
    }

    public function updateApplicationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $application = SeatApplication::where('application_id', $id)->firstOrFail();
        $application->status = $request->status;
        $application->save();

        return redirect()->route('admin.applications.view', $id)->with('success', 'Application status updated successfully.');
    }

    // Generate PDF report of all students
    public function generateStudentsPDFReport()
    {
        $students = Student::orderBy('name', 'asc')->get();

        $pdf = Pdf::loadView('admin.students.students_pdf_report', compact('students'));

        return $pdf->stream('students_directory_report_' . date('Y-m-d') . '.pdf');
    }

    // Download PDF report of all students
    public function downloadStudentsPDFReport()
    {
        $students = Student::orderBy('name', 'asc')->get();

        $pdf = Pdf::loadView('admin.students.students_pdf_report', compact('students'));

        return $pdf->download('students_directory_report_' . date('Y-m-d') . '.pdf');
    }
}

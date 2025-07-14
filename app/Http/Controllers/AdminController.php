<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Complaint;
use App\Models\HallNotice;
use App\Models\SeatApplication;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
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
            'title' => 'required|string|max:255|unique:hall_notices,title,'.$id.',notice_id',
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
}

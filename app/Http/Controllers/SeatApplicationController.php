<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatApplication;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
                $filename = $universityId . '_' . $input . '_' . time() . '.' . $file->getClientOriginalExtension();
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
}

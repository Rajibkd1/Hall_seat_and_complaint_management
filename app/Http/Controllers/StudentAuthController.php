<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Admin;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentVerificationCode;

class StudentAuthController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        if (Student::where('email', $request->email)->exists()) {
            return response()->json([
                'status' => 'exists',
                'message' => 'This email is already registered. Please login instead.'
            ], 200);
        }
        $code = rand(100000, 999999);

        EmailVerification::updateOrCreate(
            ['email' => $request->email],
            ['code' => $code]
        );
        Mail::to($request->email)->send(new StudentVerificationCode($code));

        return response()->json(['status' => 'success', 'message' => 'Verification code sent to email.']);
    }
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$verification) {
            return response()->json(['status' => 'fail', 'message' => 'Invalid verification code.']);
        }

        return response()->json(['status' => 'success', 'message' => 'Email verified successfully.']);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'university_id' => 'required',
            'email' => 'required|email|unique:students,email',
            'code' => 'required',
            'phone' => 'required',
            'department' => 'required',
            'session_year' => 'required',
            'password' => 'required|min:6',
        ]);

        $verification = EmailVerification::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$verification) {
            return redirect()->back()->with('error', 'Invalid verification code.');
        }
        $student = Student::create([
            'name' => $request->name,
            'university_id' => $request->university_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'session_year' => $request->session_year,
            'password_hash' => Hash::make($request->password),
            'is_active' => false,
            'profile_completed' => false,
        ]);

        EmailVerification::where('email', $request->email)->delete();

        Auth::guard('student')->login($student);

        return redirect()->route('student.profile')->with('success', 'Account created successfully! Please complete your profile to activate your account.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in as a student
        $student = Student::where('email', $request->email)->first();
        if ($student && Hash::check($request->password, $student->password_hash)) {
            // Check if account is active and profile is completed
            if (!$student->isAccountActive()) {
                Auth::guard('student')->login($student);
                return redirect()->route('student.profile')->with('warning', 'Your account is not yet activated. Please complete your profile and wait for admin approval.');
            }

            if (!$student->isProfileCompleted()) {
                Auth::guard('student')->login($student);
                return redirect()->route('student.profile')->with('warning', 'Please complete your profile to activate your account.');
            }

            Auth::guard('student')->login($student);
            return redirect()->route('student.dashboard');
        }

        // Attempt to log in as an admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password_hash)) {
            Auth::guard('admin')->login($admin);

            // Redirect based on role
            switch ($admin->role) {
                case 'Provost':
                    return redirect()->route('provost.dashboard');
                case 'Co-Provost':
                    return redirect()->route('co-provost.dashboard');
                case 'Staff':
                    return redirect()->route('staff.dashboard');
                default:
                    return redirect()->route('admin.dashboard');
            }
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        try {
            \Log::info('Logout attempt for student: ' . (auth('student')->user() ? auth('student')->user()->email : 'No user'));

            Auth::guard('student')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            \Log::info('Logout successful, redirecting to homepage');
            return redirect('/')->with('success', 'You have been logged out successfully.');
        } catch (\Exception $e) {
            \Log::error('Logout error: ' . $e->getMessage());
            return redirect('/')->with('error', 'An error occurred during logout.');
        }
    }

    public function showAuthForm($form_type = 'login')
    {
        return view('student.auth', ['form_type' => $form_type]);
    }
    public function dashboard()
    {
        $student = Auth::guard('student')->user();

        if (!$student) {
            return redirect()->route('student.login');
        }

        // Get seat allocation information
        $seatAllotment = \App\Models\SeatAllotment::where('student_id', $student->student_id)
            ->where('status', 'active')
            ->with(['seat'])
            ->first();

        // Get renewal application status
        $renewalApplication = null;
        if ($seatAllotment) {
            $renewalApplication = \App\Models\SeatRenewalApplication::where('allotment_id', $seatAllotment->allotment_id)
                ->where('status', 'pending')
                ->first();

            // Check if student needs renewal reminder and send email
            $this->checkAndSendRenewalReminder($seatAllotment);
        }

        $stats = [
            'total_complaints' => \App\Models\Complaint::where('student_id', $student->student_id)->count(),
            'pending_complaints' => \App\Models\Complaint::where('student_id', $student->student_id)->where('status', 'pending')->count(),
            'resolved_complaints' => \App\Models\Complaint::where('student_id', $student->student_id)->where('status', 'resolved')->count(),
            'recent_notices' => \App\Models\HallNotice::active()->orderBy('date_posted', 'desc')->limit(3)->get(),
        ];

        $recentComplaints = \App\Models\Complaint::where('student_id', $student->student_id)
            ->orderBy('submission_date', 'desc')
            ->limit(5)
            ->get();
        session(['active_nav' => 'dashboard']);
        return view('student.dashboard', compact('student', 'stats', 'recentComplaints', 'seatAllotment', 'renewalApplication'));
    }

    /**
     * Check if student needs renewal reminder and send appropriate email
     */
    private function checkAndSendRenewalReminder($seatAllotment)
    {
        // Don't send if student has already renewed
        if ($seatAllotment->hasActiveRenewalApplication()) {
            return;
        }

        // Check for 29-day reminder
        if ($seatAllotment->needsReminderEmail(29)) {
            $this->sendReminderEmail($seatAllotment, 29);
        }
        // Check for 20-day reminder
        elseif ($seatAllotment->needsReminderEmail(20)) {
            $this->sendReminderEmail($seatAllotment, 20);
        }
        // Check for 10-day reminder
        elseif ($seatAllotment->needsReminderEmail(10)) {
            $this->sendReminderEmail($seatAllotment, 10);
        }
    }

    /**
     * Send the appropriate reminder email based on days remaining
     */
    private function sendReminderEmail($seatAllotment, $daysThreshold)
    {
        try {
            $mailable = null;

            switch ($daysThreshold) {
                case 29:
                    $mailable = new \App\Mail\SeatRenewalReminder29Days($seatAllotment);
                    break;
                case 20:
                    $mailable = new \App\Mail\SeatRenewalReminder20Days($seatAllotment);
                    break;
                case 10:
                    $mailable = new \App\Mail\SeatRenewalReminder10Days($seatAllotment);
                    break;
            }

            if ($mailable) {
                \Illuminate\Support\Facades\Mail::to($seatAllotment->student->email)
                    ->send($mailable);

                // Mark this specific reminder as sent
                $seatAllotment->markReminderSent($daysThreshold);

                \Illuminate\Support\Facades\Log::info("Renewal reminder email sent to student ({$daysThreshold} days)", [
                    'student_id' => $seatAllotment->student_id,
                    'allotment_id' => $seatAllotment->allotment_id,
                    'remaining_days' => $seatAllotment->remaining_days,
                    'reminder_type' => $daysThreshold . '_days'
                ]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send renewal reminder email ({$daysThreshold} days)", [
                'student_id' => $seatAllotment->student_id,
                'allotment_id' => $seatAllotment->allotment_id,
                'remaining_days' => $seatAllotment->remaining_days,
                'reminder_type' => $daysThreshold . '_days',
                'error' => $e->getMessage()
            ]);
        }
    }
}

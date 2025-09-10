<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\ContactMessage;
use App\Mail\ContactFormEmail;

class ContactController extends Controller
{
    /**
     * Display the contact page
     */
    public function index()
    {
        session(['active_nav' => 'contact_us']);
        return view('student.contact_us');
    }

    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please enter a subject.',
            'message.required' => 'Please enter your message.',
            'message.max' => 'Your message is too long. Please keep it under 2000 characters.',
        ]);

        try {
            // Get the authenticated student if available
            $student = auth('student')->user();

            // Create contact message record
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'student_id' => $student ? $student->student_id : null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Send email to administrators
            $this->sendContactEmail($contactMessage);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your message has been sent successfully. We will get back to you soon!'
                ]);
            }

            return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
        } catch (\Exception $e) {
            Log::error('Contact form submission failed: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send your message. Please try again later.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to send your message. Please try again later.');
        }
    }

    /**
     * Send contact form email to administrators
     */
    private function sendContactEmail(ContactMessage $contactMessage)
    {
        try {
            // Get all administrators who can receive contact messages
            $admins = \App\Models\Admin::where('is_verified', true)
                ->whereIn('role_type', ['provost', 'co_provost', 'staff'])
                ->get();

            if ($admins->isNotEmpty()) {
                foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new ContactFormEmail($contactMessage));
                }
            }

            Log::info('Contact form email sent successfully', [
                'contact_message_id' => $contactMessage->id,
                'admin_count' => $admins->count()
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email: ' . $e->getMessage());
            // Don't throw the exception here to avoid breaking the form submission
        }
    }
}

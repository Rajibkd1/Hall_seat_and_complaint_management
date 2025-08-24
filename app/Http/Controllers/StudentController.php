<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{


    public function profile()
    {
        $student = Auth::guard('student')->user();

        // Load seat details if student has an active seat
        $seatDetails = null;
        if ($student->hasActiveSeat()) {
            $seatDetails = $student->getSeatDetails();
        }

        session(['active_nav' => 'profile']);
        return view('student.profile', compact('student', 'seatDetails'));
    }

    public function editProfile()
    {
        $student = Auth::guard('student')->user();

        session(['active_nav' => 'profile']);
        return view('student.edit_profile', compact('student'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Student $student */
        $student = Auth::guard('student')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'university_id' => 'required|string|max:255|unique:students,university_id,' . $student->student_id . ',student_id',
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'session_year' => 'required',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_card_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $dataToUpdate = $request->except(['profile_image', 'id_card_front', 'id_card_back', 'email', '_token']);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if it exists
            if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
                Storage::disk('public')->delete($student->profile_image);
            }

            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = 'profile_' . $student->university_id . '_' . time() . '.' . $extension;
            $path = $file->storeAs('profile_images', $filename, 'public');

            $dataToUpdate['profile_image'] = $path;
        }

        // Handle ID card front upload
        if ($request->hasFile('id_card_front')) {
            // Delete old ID card front if it exists
            if ($student->id_card_front && Storage::disk('public')->exists($student->id_card_front)) {
                Storage::disk('public')->delete($student->id_card_front);
            }

            $file = $request->file('id_card_front');
            $extension = $file->getClientOriginalExtension();
            $filename = 'id_front_' . $student->university_id . '_' . time() . '.' . $extension;
            $path = $file->storeAs('id_cards', $filename, 'public');

            $dataToUpdate['id_card_front'] = $path;
        }

        // Handle ID card back upload
        if ($request->hasFile('id_card_back')) {
            // Delete old ID card back if it exists
            if ($student->id_card_back && Storage::disk('public')->exists($student->id_card_back)) {
                Storage::disk('public')->delete($student->id_card_back);
            }

            $file = $request->file('id_card_back');
            $extension = $file->getClientOriginalExtension();
            $filename = 'id_back_' . $student->university_id . '_' . time() . '.' . $extension;
            $path = $file->storeAs('id_cards', $filename, 'public');

            $dataToUpdate['id_card_back'] = $path;
        }

        try {
            $student->update($dataToUpdate);

            // Check if request is AJAX (for backward compatibility)
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully!',
                    'student' => $student->fresh()->load('seatAllotment.seat')
                ]);
            }

            // For regular form submission, redirect with success message
            return redirect()->route('student.profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());

            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating your profile. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }

            // For regular form submission, redirect back with error
            return back()->withErrors(['error' => 'An error occurred while updating your profile. Please try again.'])->withInput();
        }
    }

    public function uploadIdCard(Request $request)
    {
        /** @var \App\Models\Student $student */
        $student = Auth::guard('student')->user();

        $validator = Validator::make($request->all(), [
            'id_card' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:front,back'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $type = $request->input('type', 'front');
            $fieldName = 'id_card_' . $type;
            
            // Delete old ID card if it exists
            if ($student->$fieldName && Storage::disk('public')->exists($student->$fieldName)) {
                Storage::disk('public')->delete($student->$fieldName);
            }

            // Store new ID card
            $file = $request->file('id_card');
            $extension = $file->getClientOriginalExtension();
            $filename = 'id_' . $type . '_' . $student->university_id . '_' . time() . '.' . $extension;
            $path = $file->storeAs('id_cards', $filename, 'public');

            // Update student record
            $student->update([$fieldName => $path]);

            return response()->json([
                'success' => true,
                'message' => 'ID Card uploaded successfully!',
                'image_url' => asset('storage/' . $path),
                'type' => $type
            ]);

        } catch (\Exception $e) {
            Log::error('ID Card upload error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while uploading the ID card. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

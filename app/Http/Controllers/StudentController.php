<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{


    public function profile()
    {
        $student = Auth::guard('student')->user();
        session(['active_nav' => 'profile']);
        return view('student.profile', compact('student'));
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $dataToUpdate = $request->except('profile_image', 'email');

        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists (regardless of extension)
            $existingFiles = Storage::disk('public')->files('profile_images');
            foreach ($existingFiles as $file) {
                if (pathinfo($file, PATHINFO_FILENAME) === $student->university_id) {
                    Storage::disk('public')->delete($file);
                }
            }

            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $student->university_id . '.' . $extension;
            $path = $file->storeAs('profile_images', $filename, 'public');

            $dataToUpdate['profile_image'] = $path;
        }


        $student->update($dataToUpdate);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'student' => $student->fresh()->append('profile_image_url')
        ]);
    }
}

@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-5xl">
            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Seat Application</h1>
                        <p class="text-gray-600">Complete your hall seat application form</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Applicant</p>
                            <p class="font-semibold text-gray-900">{{ $student->name }}</p>
                            <p class="text-sm text-gray-600">{{ $student->university_id }}</p>
                        </div>
                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-gray-200 bg-gray-100">
                            @if ($student->profile_image)
                                <img src="{{ $student->profile_image_url }}" alt="Profile"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profile Validation Modal --}}
            @if (!empty($missingFields))
                @include('student.profile_validation_modal')
            @endif

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-medium mb-2">Please correct the following errors:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if ($existingApplication && $existingApplication->canBeEdited())
                <div class="mb-6 p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <strong>Note:</strong> You have already submitted a seat application.
                    </div>
                </div>

                <!-- Summary of Submitted Data -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                    @if ($existingApplication->canBeEdited())
                        <div class="mb-4 p-2 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                            <p class="text-sm">You can edit or delete your application within 3 days of submission.</p>
                        </div>
                    @else
                        <div class="mb-4 p-2 bg-red-100 border border-red-300 text-red-800 rounded-lg">
                            <p class="text-sm">You can no longer edit or delete your application as it has been more than 3
                                days since submission.</p>
                        </div>
                    @endif
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Submitted Application Details</h2>

                        @if ($existingApplication->canBeEdited())
                            <div class="flex space-x-3">
                                <!-- Edit Button -->
                                <a href="{{ route('seat-application.edit', $existingApplication) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                    Edit Application
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('seat-application.destroy', $existingApplication) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete your application? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                        Delete Application
                                    </button>
                                </form>

                                <!-- Download PDF Button -->
                                <a href="{{ route('seat-application.download-pdf', $existingApplication) }}"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Download PDF
                                </a>
                            </div>
                        @else
                            <div class="flex space-x-3">
                                <div class="bg-amber-100 border border-amber-300 text-amber-800 px-4 py-2 rounded-lg">
                                    <p class="text-sm font-medium">The application can no longer be edited or deleted.</p>
                                </div>

                                <!-- Download PDF Button -->
                                <a href="{{ route('seat-application.download-pdf', $existingApplication) }}"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Download PDF
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Name</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->student_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">University ID</p>
                            <p class="font-medium text-gray-900">{{ $student->university_id }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Department</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->department }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Academic Year</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->academic_year }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Family Member</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->family_member }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Father's Name</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->father_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Mother's Name</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->mother_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Father's Profession</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->father_profession }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Mother's Profession</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->mother_profession }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Other Guardian</p>
                            <p class="font-medium text-gray-900">
                                {{ $existingApplication->other_guardian ?: 'Not provided' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Monthly Income (Taka)</p>
                            <p class="font-medium text-gray-900">
                                {{ $existingApplication->guardian_monthly_income ? number_format($existingApplication->guardian_monthly_income, 2) : 'Not provided' }}
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Program</p>
                            <p class="font-medium text-gray-900">{{ ucfirst($existingApplication->program) }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Number of Semester</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->number_of_semester }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">CGPA</p>
                            <p class="font-medium text-gray-900">{{ $existingApplication->cgpa }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Physical Condition</p>
                            <p class="font-medium text-gray-900">{{ ucfirst($existingApplication->physical_condition) }}
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Family Status</p>
                            <p class="font-medium text-gray-900">
                                {{ str_replace('-', ' ', ucfirst($existingApplication->family_status)) }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Permanent Address</p>
                            <p class="font-medium text-gray-900">
                                {{ $existingApplication->permanent_address ?: 'Not provided' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Current Address</p>
                            <p class="font-medium text-gray-900">
                                {{ $existingApplication->current_address ?: 'Not provided' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Co-curricular Activities</p>
                            <p class="font-medium text-gray-900">
                                @php
                                    $activities = json_decode($existingApplication->activities, true) ?? [];
                                    echo !empty($activities)
                                        ? implode(', ', array_map('ucfirst', $activities))
                                        : 'None';
                                @endphp
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Other Information</p>
                            <p class="font-medium text-gray-900">
                                @php
                                    $otherInfo = json_decode($existingApplication->other_info, true) ?? [];
                                    echo !empty($otherInfo) ? implode(', ', array_map('ucfirst', $otherInfo)) : 'None';
                                @endphp
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Application Date</p>
                            <p class="font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($existingApplication->application_date)->format('d M Y') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Submission Date</p>
                            <p class="font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($existingApplication->submission_date)->format('d M Y H:i') }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500 text-xs uppercase tracking-wide">Status</p>
                            <p class="font-medium text-gray-900">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                    {{ ucfirst($existingApplication->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Optional: Download links for uploaded documents -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="font-semibold text-gray-900 mb-4">Uploaded Documents</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @php
                                $documents = [
                                    'Marksheet' => $existingApplication->marksheet_doc,
                                    'Birth Certificate' => $existingApplication->birth_certificate_doc,
                                    'Financial Certificate' => $existingApplication->financial_certificate_doc,
                                    'Death Certificate' => $existingApplication->death_certificate_doc,
                                    'Medical Certificate' => $existingApplication->medical_certificate_doc,
                                    'Activity Certificate' => $existingApplication->activity_certificate_doc,
                                    'Signature' => $existingApplication->signature_doc,
                                    'Other Document 1' => $existingApplication->other_doc_1,
                                    'Other Document 2' => $existingApplication->other_doc_2,
                                    'Other Document 3' => $existingApplication->other_doc_3,
                                ];
                            @endphp

                            @foreach ($documents as $label => $file)
                                @if ($file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <form action="{{ route('seat-application.submit') }}" method="POST" enctype="multipart/form-data"
                    id="applicationForm" class="space-y-8">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                1</div>
                            <h3 class="text-xl font-semibold text-gray-900">Personal Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">Student
                                    Name</label>
                                <input type="text" name="student_name" id="student_name"
                                    value="{{ $student->name }}" readonly
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-gray-600 cursor-not-allowed focus:outline-none">
                            </div>

                            <div>
                                <label for="department"
                                    class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                <input type="text" name="department" id="department"
                                    value="{{ $student->department }}" readonly
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-gray-600 cursor-not-allowed focus:outline-none">
                            </div>

                            <div>
                                <label for="university_id" class="block text-sm font-medium text-gray-700 mb-2">University
                                    ID (Roll Number)</label>
                                <input type="text" name="university_id" id="university_id"
                                    value="{{ $student->university_id }}" readonly
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-gray-600 cursor-not-allowed focus:outline-none">
                            </div>

                            <div>
                                <label for="academic_year"
                                    class="block text-sm font-medium text-gray-700 mb-2">Session</label>
                                <input type="text" name="academic_year" id="academic_year"
                                    value="{{ $student->session_year }}" readonly
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-gray-600 cursor-not-allowed focus:outline-none">
                            </div>

                            <!-- Family Member Information -->
                            <div>
                                <label for="family_member" class="block text-sm font-medium text-gray-700 mb-2">Family
                                    Member <span class="text-red-500">*</span></label>
                                <input type="text" name="family_member" id="family_member"
                                    value="{{ old('family_member') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="father_name" class="block text-sm font-medium text-gray-700 mb-2">Father's
                                    Name <span class="text-red-500">*</span></label>
                                <input type="text" name="father_name" id="father_name"
                                    value="{{ old('father_name') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="mother_name" class="block text-sm font-medium text-gray-700 mb-2">Mother's
                                    Name <span class="text-red-500">*</span></label>
                                <input type="text" name="mother_name" id="mother_name"
                                    value="{{ old('mother_name') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="father_profession"
                                    class="block text-sm font-medium text-gray-700 mb-2">Father's Profession <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="father_profession" id="father_profession"
                                    value="{{ old('father_profession') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="mother_profession"
                                    class="block text-sm font-medium text-gray-700 mb-2">Mother's Profession <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="mother_profession" id="mother_profession"
                                    value="{{ old('mother_profession') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="other_guardian" class="block text-sm font-medium text-gray-700 mb-2">Other
                                    Guardian</label>
                                <input type="text" name="other_guardian" id="other_guardian"
                                    value="{{ old('other_guardian') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="guardian_monthly_income"
                                    class="block text-sm font-medium text-gray-700 mb-2">Guardian's Monthly Income (in
                                    Taka) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.01" min="0" name="guardian_monthly_income"
                                    id="guardian_monthly_income" value="{{ old('guardian_monthly_income') }}" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                2</div>
                            <h3 class="text-xl font-semibold text-gray-900">Academic Information</h3>
                        </div>

                        <!-- Program Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Program <span
                                    class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @php
                                    $programs = [
                                        'bachelor' => 'Bachelor',
                                        'masters' => 'Masters',
                                        'mphil' => 'M.Phil',
                                        'phd' => 'Ph.D',
                                    ];
                                    $oldProgram = old('program');
                                @endphp
                                @foreach ($programs as $value => $label)
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="program" value="{{ $value }}"
                                            {{ $oldProgram === $value ? 'checked' : '' }}
                                            class="mr-3 text-gray-600 focus:ring-gray-500">
                                        <span class="text-sm font-medium">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Current Semester and GPA -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="number_of_semester"
                                    class="block text-sm font-medium text-gray-700 mb-2">Number of Semester <span
                                        class="text-red-500">*</span></label>
                                <input type="number" min="1" max="20" name="number_of_semester"
                                    id="number_of_semester" value="{{ old('number_of_semester') }}" required
                                    placeholder="e.g., 6"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="cgpa" class="block text-sm font-medium text-gray-700 mb-2">cGPA (out of
                                    4.00) <span class="text-red-500">*</span></label>
                                <input type="number" step="0.01" min="0" max="4" name="cgpa"
                                    id="cgpa" value="{{ old('cgpa') }}" required placeholder="e.g., 3.75"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Physical Condition -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Physical Condition <span
                                    class="text-red-500">*</span></label>
                            @php
                                $physicalConditions = ['normal' => 'Normal', 'disabled' => 'Disabled'];
                                $oldPhysical = old('physical_condition');
                            @endphp
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($physicalConditions as $value => $label)
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="physical_condition" value="{{ $value }}"
                                            {{ $oldPhysical === $value ? 'checked' : '' }}
                                            class="mr-3 text-gray-600 focus:ring-gray-500">
                                        <span class="text-sm font-medium">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Family Status -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Family Status <span
                                    class="text-red-500">*</span></label>
                            @php
                                $familyStatuses = [
                                    'both-alive' => 'Both parents alive',
                                    'father-dead' => 'Father deceased, mother alive',
                                    'mother-dead' => 'Father alive, mother deceased',
                                    'both-dead' => 'Both parents deceased',
                                ];
                                $oldFamily = old('family_status');
                            @endphp
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($familyStatuses as $value => $label)
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="family_status" value="{{ $value }}"
                                            {{ $oldFamily === $value ? 'checked' : '' }}
                                            class="mr-3 text-gray-600 focus:ring-gray-500">
                                        <span class="text-sm font-medium">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Addresses -->
                        <div class="mb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Address Information</h4>

                            <!-- Division and District -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="division" class="block text-sm font-medium text-gray-700 mb-2">Division
                                        <span class="text-red-500">*</span></label>
                                    <select name="division" id="division" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                        <option value="" disabled {{ old('division') ? '' : 'selected' }}>Select
                                            Division</option>
                                        <option value="dhaka" {{ old('division') == 'dhaka' ? 'selected' : '' }}>Dhaka
                                        </option>
                                        <option value="chittagong"
                                            {{ old('division') == 'chittagong' ? 'selected' : '' }}>Chittagong</option>
                                        <option value="rajshahi" {{ old('division') == 'rajshahi' ? 'selected' : '' }}>
                                            Rajshahi</option>
                                        <option value="khulna" {{ old('division') == 'khulna' ? 'selected' : '' }}>Khulna
                                        </option>
                                        <option value="barisal" {{ old('division') == 'barisal' ? 'selected' : '' }}>
                                            Barisal</option>
                                        <option value="sylhet" {{ old('division') == 'sylhet' ? 'selected' : '' }}>Sylhet
                                        </option>
                                        <option value="rangpur" {{ old('division') == 'rangpur' ? 'selected' : '' }}>
                                            Rangpur</option>
                                        <option value="mymensingh"
                                            {{ old('division') == 'mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="district" class="block text-sm font-medium text-gray-700 mb-2">District
                                        <span class="text-red-500">*</span></label>
                                    <select name="district" id="district" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                        <option value="" disabled {{ old('district') ? '' : 'selected' }}>Select
                                            District</option>
                                        <!-- Districts will be populated via JavaScript based on selected division -->
                                    </select>
                                </div>
                            </div>

                            <!-- Detailed Addresses -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="permanent_address"
                                        class="block text-sm font-medium text-gray-700 mb-2">Permanent Address</label>
                                    <textarea name="permanent_address" id="permanent_address" rows="3"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">{{ old('permanent_address') }}</textarea>
                                </div>
                                <div>
                                    <label for="current_address"
                                        class="block text-sm font-medium text-gray-700 mb-2">Current
                                        Address</label>
                                    <textarea name="current_address" id="current_address" rows="3"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">{{ old('current_address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Co-curricular Activities -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Co-curricular Activities</label>
                            @php
                                $activitiesList = ['bncc' => 'BNCC', 'rover' => 'Rover Scout'];
                                $oldActivities = old('activities', []);
                            @endphp
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($activitiesList as $value => $label)
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="checkbox" name="activities[]" value="{{ $value }}"
                                            {{ in_array($value, $oldActivities) ? 'checked' : '' }}
                                            class="mr-3 text-gray-600 focus:ring-gray-500 rounded">
                                        <span class="text-sm font-medium">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Other Information -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Other Information</label>
                            @php
                                $otherInfoList = ['ethnic' => 'Ethnic Minority', 'foreign' => 'Foreign Student'];
                                $oldOtherInfo = old('other_info', []);
                            @endphp
                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($otherInfoList as $value => $label)
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="checkbox" name="other_info[]" value="{{ $value }}"
                                            {{ in_array($value, $oldOtherInfo) ? 'checked' : '' }}
                                            class="mr-3 text-gray-600 focus:ring-gray-500 rounded">
                                        <span class="text-sm font-medium">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Document Upload Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                3</div>
                            <h3 class="text-xl font-semibold text-gray-900">Required Documents</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php
                                $fileFields = [
                                    'marksheet' => ['label' => 'Latest Semester Marksheet', 'required' => true],
                                    'birthCertificate' => [
                                        'label' => 'Birth Certificate/National ID',
                                        'required' => true,
                                    ],
                                    'financialCertificate' => [
                                        'label' => 'Financial Status Certificate (if applicable)',
                                        'required' => false,
                                    ],
                                    'deathCertificate' => [
                                        'label' => 'Death Certificate (if parent deceased)',
                                        'required' => false,
                                    ],
                                    'medicalCertificate' => [
                                        'label' => 'Medical Certificate (if applicable)',
                                        'required' => false,
                                    ],
                                    'activityCertificate' => [
                                        'label' => 'BNCC/Scout Certificate (if applicable)',
                                        'required' => false,
                                    ],
                                    'signature' => ['label' => "Student's Signature", 'required' => false],
                                ];
                            @endphp

                            @foreach ($fileFields as $name => $field)
                                <div>
                                    <label for="{{ $name }}"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ $field['label'] }}
                                        @if ($field['required'])
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>
                                    <input type="file" name="{{ $name }}" id="{{ $name }}"
                                        accept=".pdf,.jpg,.jpeg,.png" @if ($field['required']) required @endif
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                </div>
                            @endforeach
                        </div>

                        <!-- Others Document Upload Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Additional Documents (Others)</h4>
                            <p class="text-sm text-gray-600 mb-4">Upload up to 3 additional documents if applicable</p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="other_doc_1" class="block text-sm font-medium text-gray-700 mb-2">Other
                                        Document 1</label>
                                    <input type="file" name="other_doc_1" id="other_doc_1"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                </div>

                                <div>
                                    <label for="other_doc_2" class="block text-sm font-medium text-gray-700 mb-2">Other
                                        Document 2</label>
                                    <input type="file" name="other_doc_2" id="other_doc_2"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                </div>

                                <div>
                                    <label for="other_doc_3" class="block text-sm font-medium text-gray-700 mb-2">Other
                                        Document 3</label>
                                    <input type="file" name="other_doc_3" id="other_doc_3"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Declaration Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                4</div>
                            <h3 class="text-xl font-semibold text-gray-900">Declaration</h3>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start">
                                <input type="checkbox" id="declaration_info_correct" name="declaration_info_correct"
                                    required
                                    class="mr-4 mt-1 h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                                <label for="declaration_info_correct" class="text-sm text-gray-700 leading-relaxed">All
                                    the information provided above is correct and complete to the best of my
                                    knowledge.</label>
                            </div>
                            <div class="flex items-start">
                                <input type="checkbox" id="declaration_will_stay" name="declaration_will_stay" required
                                    class="mr-4 mt-1 h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                                <label for="declaration_will_stay" class="text-sm text-gray-700 leading-relaxed">I will
                                    occupy any type of seat allocated to me in the hall and abide by all hall rules and
                                    regulations.</label>
                            </div>
                            <div class="flex items-start">
                                <input type="checkbox" id="declaration_seven_days" name="declaration_seven_days" required
                                    class="mr-4 mt-1 h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                                <label for="declaration_seven_days" class="text-sm text-gray-700 leading-relaxed">If I do
                                    not occupy the hall within seven days of seat allocation, I understand that my
                                    application will be cancelled.</label>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Application Date</label>
                                    <p class="text-sm text-gray-600">{{ date('d M Y') }}</p>
                                </div>
                                <input type="hidden" name="application_date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-4 px-12 rounded-lg transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Submit Application
                        </button>
                    </div>
                </form>
            @endif
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('profileValidationModal');
                const closeBtn = document.getElementById('closeProfileModal');
                const cancelBtn = document.getElementById('cancelProfileModal');

                // Show modal if there are missing fields
                @if (!empty($missingFields))
                    if (modal) {
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modal.classList.remove('opacity-0');
                            modal.querySelector('.bg-white').classList.remove('scale-95');
                            modal.querySelector('.bg-white').classList.add('scale-100');
                        }, 10);
                    }
                @endif

                // Close modal events
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        closeModal();
                    });
                }

                if (cancelBtn) {
                    cancelBtn.addEventListener('click', function() {
                        closeModal();
                    });
                }

                // Close modal when clicking outside
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeModal();
                        }
                    });
                }

                // Close modal with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                        closeModal();
                    }
                });

                // Function to close modal and redirect to profile page
                function closeModal() {
                    modal.classList.add('opacity-0');
                    modal.querySelector('.bg-white').classList.remove('scale-100');
                    modal.querySelector('.bg-white').classList.add('scale-95');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                        // Redirect to profile page after modal closes
                        window.location.href = "{{ route('student.profile') }}";
                    }, 300);
                }
            });
        </script>

        <!-- Include seat application JavaScript -->
        <script src="{{ asset('js/seat_application.js') }}"></script>
    @endsection

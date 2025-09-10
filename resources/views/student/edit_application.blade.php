@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-5xl">
            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Seat Application</h1>
                        <p class="text-gray-600">Update your hall seat application form</p>
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

            {{-- Error message --}}
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('error') }}
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

            @if (!$application->canBeEdited())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <strong>Error:</strong> The application can no longer be edited or deleted as it was submitted more
                        than 3 days ago.
                    </div>
                </div>
            @endif

            <form action="{{ route('seat-application.update', $application) }}" method="POST" enctype="multipart/form-data"
                id="applicationForm" class="space-y-8">
                @csrf
                @method('PUT')

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
                                value="{{ old('student_name', $application->student_name) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <input type="text" name="department" id="department"
                                value="{{ old('department', $application->department) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="university_id" class="block text-sm font-medium text-gray-700 mb-2">University ID
                                (Roll Number)</label>
                            <input type="text" name="university_id" id="university_id"
                                value="{{ old('university_id', $student->university_id) }}" readonly
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 text-gray-600 cursor-not-allowed focus:outline-none">
                        </div>

                        <div>
                            <label for="academic_year" class="block text-sm font-medium text-gray-700 mb-2">Session</label>
                            <input type="text" name="academic_year" id="academic_year"
                                value="{{ old('academic_year', $application->academic_year) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <!-- Family Member Information -->
                        <div>
                            <label for="family_member" class="block text-sm font-medium text-gray-700 mb-2">Family
                                Member <span class="text-red-500">*</span></label>
                            <input type="text" name="family_member" id="family_member"
                                value="{{ old('family_member', $application->family_member) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="father_name" class="block text-sm font-medium text-gray-700 mb-2">Father's
                                Name <span class="text-red-500">*</span></label>
                            <input type="text" name="father_name" id="father_name"
                                value="{{ old('father_name', $application->father_name) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="mother_name" class="block text-sm font-medium text-gray-700 mb-2">Mother's
                                Name <span class="text-red-500">*</span></label>
                            <input type="text" name="mother_name" id="mother_name"
                                value="{{ old('mother_name', $application->mother_name) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="father_profession" class="block text-sm font-medium text-gray-700 mb-2">Father's
                                Profession <span class="text-red-500">*</span></label>
                            <input type="text" name="father_profession" id="father_profession"
                                value="{{ old('father_profession', $application->father_profession) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="mother_profession" class="block text-sm font-medium text-gray-700 mb-2">Mother's
                                Profession <span class="text-red-500">*</span></label>
                            <input type="text" name="mother_profession" id="mother_profession"
                                value="{{ old('mother_profession', $application->mother_profession) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="other_guardian" class="block text-sm font-medium text-gray-700 mb-2">Other
                                Guardian</label>
                            <input type="text" name="other_guardian" id="other_guardian"
                                value="{{ old('other_guardian', $application->other_guardian) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="guardian_monthly_income"
                                class="block text-sm font-medium text-gray-700 mb-2">Guardian's Monthly Income (in
                                Taka) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" min="0" name="guardian_monthly_income"
                                id="guardian_monthly_income"
                                value="{{ old('guardian_monthly_income', $application->guardian_monthly_income) }}"
                                required
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
                                $oldProgram = old('program', $application->program);
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
                            <label for="number_of_semester" class="block text-sm font-medium text-gray-700 mb-2">Number of
                                Semester <span class="text-red-500">*</span></label>
                            <input type="number" min="1" max="20" name="number_of_semester"
                                id="number_of_semester"
                                value="{{ old('number_of_semester', $application->number_of_semester) }}" required
                                placeholder="e.g., 6"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="cgpa" class="block text-sm font-medium text-gray-700 mb-2">cGPA (out of 4.00)
                                <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" min="0" max="4" name="cgpa"
                                id="cgpa" value="{{ old('cgpa', $application->cgpa) }}" required
                                placeholder="e.g., 3.75"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Physical Condition -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Physical Condition <span
                                class="text-red-500">*</span></label>
                        @php
                            $physicalConditions = ['normal' => 'Normal', 'disabled' => 'Disabled'];
                            $oldPhysical = old('physical_condition', $application->physical_condition);
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
                            $oldFamily = old('family_status', $application->family_status);
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
                                <label for="division" class="block text-sm font-medium text-gray-700 mb-2">Division <span
                                        class="text-red-500">*</span></label>
                                <select name="division" id="division" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="" disabled
                                        {{ old('division', $application->division) ? '' : 'selected' }}>Select Division
                                    </option>
                                    <option value="dhaka"
                                        {{ old('division', $application->division) == 'dhaka' ? 'selected' : '' }}>Dhaka
                                    </option>
                                    <option value="chittagong"
                                        {{ old('division', $application->division) == 'chittagong' ? 'selected' : '' }}>
                                        Chittagong</option>
                                    <option value="rajshahi"
                                        {{ old('division', $application->division) == 'rajshahi' ? 'selected' : '' }}>
                                        Rajshahi</option>
                                    <option value="khulna"
                                        {{ old('division', $application->division) == 'khulna' ? 'selected' : '' }}>Khulna
                                    </option>
                                    <option value="barisal"
                                        {{ old('division', $application->division) == 'barisal' ? 'selected' : '' }}>
                                        Barisal</option>
                                    <option value="sylhet"
                                        {{ old('division', $application->division) == 'sylhet' ? 'selected' : '' }}>Sylhet
                                    </option>
                                    <option value="rangpur"
                                        {{ old('division', $application->division) == 'rangpur' ? 'selected' : '' }}>
                                        Rangpur</option>
                                    <option value="mymensingh"
                                        {{ old('division', $application->division) == 'mymensingh' ? 'selected' : '' }}>
                                        Mymensingh</option>
                                </select>
                            </div>
                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700 mb-2">District <span
                                        class="text-red-500">*</span></label>
                                <select name="district" id="district" required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">
                                    <option value="" disabled
                                        {{ old('district', $application->district) ? '' : 'selected' }}>Select District
                                    </option>
                                    <!-- Districts will be populated via JavaScript based on selected division -->
                                </select>
                            </div>
                        </div>

                        <!-- Detailed Addresses -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="permanent_address"
                                    class="block text-sm font-medium text-gray-700 mb-2">Permanent
                                    Address</label>
                                <textarea name="permanent_address" id="permanent_address" rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">{{ old('permanent_address', $application->permanent_address) }}</textarea>
                            </div>
                            <div>
                                <label for="current_address" class="block text-sm font-medium text-gray-700 mb-2">Current
                                    Address</label>
                                <textarea name="current_address" id="current_address" rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent">{{ old('current_address', $application->current_address) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Co-curricular Activities -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Co-curricular Activities</label>
                        @php
                            $activitiesList = ['bncc' => 'BNCC', 'rover' => 'Rover Scout'];
                            $oldActivities = old('activities', json_decode($application->activities, true) ?? []);
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
                            $oldOtherInfo = old('other_info', json_decode($application->other_info, true) ?? []);
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
                                'birthCertificate' => ['label' => 'Birth Certificate/National ID', 'required' => true],
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
                                <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $field['label'] }}
                                    @if ($field['required'])
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>
                                <input type="file" name="{{ $name }}" id="{{ $name }}"
                                    accept=".pdf,.jpg,.jpeg,.png" @if ($field['required']) required @endif
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                @if ($application->{$name . '_doc'})
                                    <p class="text-sm text-gray-600 mt-1">
                                        Current file: <a href="{{ asset('storage/' . $application->{$name . '_doc'}) }}"
                                            target="_blank" class="text-blue-600 hover:underline">View current file</a>
                                    </p>
                                @endif
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
                                <input type="file" name="other_doc_1" id="other_doc_1" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                @if ($application->other_doc_1)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Current file: <a href="{{ asset('storage/' . $application->other_doc_1) }}"
                                            target="_blank" class="text-blue-600 hover:underline">View current file</a>
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="other_doc_2" class="block text-sm font-medium text-gray-700 mb-2">Other
                                    Document 2</label>
                                <input type="file" name="other_doc_2" id="other_doc_2" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                @if ($application->other_doc_2)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Current file: <a href="{{ asset('storage/' . $application->other_doc_2) }}"
                                            target="_blank" class="text-blue-600 hover:underline">View current file</a>
                                    </p>
                                @endif
                            </div>

                            <div>
                                <label for="other_doc_3" class="block text-sm font-medium text-gray-700 mb-2">Other
                                    Document 3</label>
                                <input type="file" name="other_doc_3" id="other_doc_3" accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                                @if ($application->other_doc_3)
                                    <p class="text-sm text-gray-600 mt-1">
                                        Current file: <a href="{{ asset('storage/' . $application->other_doc_3) }}"
                                            target="_blank" class="text-blue-600 hover:underline">View current file</a>
                                    </p>
                                @endif
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
                            <input type="checkbox" id="declaration_info_correct" name="declaration_info_correct" required
                                class="mr-4 mt-1 h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                            <label for="declaration_info_correct" class="text-sm text-gray-700 leading-relaxed">All the
                                information provided above is correct and complete to the best of my knowledge.</label>
                        </div>
                        <div class="flex items-start">
                            <input type="checkbox" id="declaration_will_stay" name="declaration_will_stay" required
                                class="mr-4 mt-1 h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                            <label for="declaration_will_stay" class="text-sm text-gray-700 leading-relaxed">I will occupy
                                any type of seat allocated to me in the hall and abide by all hall rules and
                                regulations.</label>
                        </div>
                        <div class="flex items-start">
                            <input type="checkbox" id="declaration_seven_days" name="declaration_seven_days" required
                                class="mr-4 mt-1 h-4 w-4 text-gray-600 focus:ring-gray-500 border-gray-300 rounded">
                            <label for="declaration_seven_days" class="text-sm text-gray-700 leading-relaxed">If I do not
                                occupy the hall within seven days of seat allocation, I understand that my application will
                                be cancelled.</label>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Application Date</label>
                                <p class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($application->application_date)->format('d M Y') }}</p>
                            </div>
                            <input type="hidden" name="application_date" value="{{ $application->application_date }}">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" {{ !$application->canBeEdited() ? 'disabled' : '' }}
                        class="bg-gray-900 hover:bg-gray-800 text-white font-semibold py-4 px-12 rounded-lg transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 {{ !$application->canBeEdited() ? 'opacity-50 cursor-not-allowed' : '' }}">
                        Update Application
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include seat application JavaScript -->
    <script src="{{ asset('js/seat_application.js') }}"></script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold mb-6">Seat Application</h1>

        {{-- Profile Validation Modal --}}
        @if (!empty($missingFields))
            @include('student.profile_validation_modal')
        @endif

        {{-- Success message --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($existingApplication)
            <div class="mb-6 p-4 bg-yellow-100 text-yellow-800 rounded">
                <strong>Note:</strong> You have already submitted a seat application.
            </div>

            <!-- Summary of Submitted Data -->
            <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
                <h2 class="text-xl font-bold mb-4">Submitted Application Details</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div><strong>Name:</strong> {{ $existingApplication->student_name }}</div>
                    <div><strong>University ID:</strong> {{ $student->university_id }}</div>
                    <div><strong>Department:</strong> {{ $existingApplication->department }}</div>
                    <div><strong>Academic Year:</strong> {{ $existingApplication->academic_year }}</div>
                    <div><strong>Guardian Name:</strong> {{ $existingApplication->guardian_name }}</div>
                    <div><strong>Guardian Mobile:</strong> {{ $existingApplication->guardian_mobile }}</div>
                    <div><strong>Relationship:</strong> {{ $existingApplication->guardian_relationship }}</div>
                    <div><strong>Program:</strong> {{ ucfirst($existingApplication->program) }}</div>
                    <div><strong>CGPA:</strong> {{ $existingApplication->cgpa }}</div>
                    <div><strong>Physical Condition:</strong> {{ ucfirst($existingApplication->physical_condition) }}</div>
                    <div><strong>Family Status:</strong>
                        {{ str_replace('-', ' ', ucfirst($existingApplication->family_status)) }}</div>
                    <div><strong>Application Date:</strong>
                        {{ \Carbon\Carbon::parse($existingApplication->application_date)->format('d M Y') }}</div>
                </div>

                <!-- Optional: Download links for uploaded documents -->
                <div class="mt-6">
                    <h3 class="font-semibold mb-2">Uploaded Documents:</h3>
                    <ul class="list-disc list-inside text-blue-600">
                        @php
                            $documents = [
                                'University ID' => $existingApplication->university_id_doc,
                                'Marksheet' => $existingApplication->marksheet_doc,
                                'Birth Certificate' => $existingApplication->birth_certificate_doc,
                                'Financial Certificate' => $existingApplication->financial_certificate_doc,
                                'Death Certificate' => $existingApplication->death_certificate_doc,
                                'Medical Certificate' => $existingApplication->medical_certificate_doc,
                                'Activity Certificate' => $existingApplication->activity_certificate_doc,
                                'Signature' => $existingApplication->signature_doc,
                            ];
                        @endphp

                        @foreach ($documents as $label => $file)
                            @if ($file)
                                <li>
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="underline hover:text-blue-800">
                                        {{ $label }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <form action="{{ route('seat-application.submit') }}" method="POST" enctype="multipart/form-data"
                id="applicationForm" class="space-y-8">
                @csrf

                <!-- Personal Information Section -->
                <div class="border border-gray-300 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">1. Personal Information:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="student_name" class="block text-sm font-medium text-gray-700 mb-1">Student
                                Name</label>
                            <input type="text" name="student_name" id="student_name" value="{{ $student->name }}"
                                readonly
                                class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 cursor-not-allowed focus:outline-none">
                        </div>

                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <input type="text" name="department" id="department" value="{{ $student->department }}"
                                readonly
                                class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 cursor-not-allowed focus:outline-none">
                        </div>
                        <div>
                            <label for="university_id" class="block text-sm font-medium text-gray-700 mb-1">University ID
                                (Roll Number)</label>
                            <input type="text" name="university_id" id="university_id"
                                value="{{ $student->university_id }}" readonly
                                class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 cursor-not-allowed focus:outline-none">
                        </div>


                        <div>
                            <label for="academic_year" class="block text-sm font-medium text-gray-700 mb-1">Session</label>
                            <input type="text" name="academic_year" id="academic_year"
                                value="{{ $student->session_year }}" readonly
                                class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2 cursor-not-allowed focus:outline-none">
                        </div>
                        <div>
                            <label for="guardian_name" class="block text-sm font-medium text-gray-700 mb-1">Guardian's
                                Name</label>
                            <input type="text" name="guardian_name" id="guardian_name"
                                value="{{ old('guardian_name') }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="guardian_mobile" class="block text-sm font-medium text-gray-700 mb-1">Guardian's
                                Mobile Number</label>
                            <input type="tel" name="guardian_mobile" id="guardian_mobile"
                                value="{{ old('guardian_mobile') }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="guardian_relationship"
                                class="block text-sm font-medium text-gray-700 mb-1">Relationship with Student</label>
                            <input type="text" name="guardian_relationship" id="guardian_relationship"
                                value="{{ old('guardian_relationship') }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- General Information Section -->
                <div class="border border-gray-300 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">2. General Information:</h3>

                    <!-- Program Selection -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                        <div class="flex flex-wrap gap-4">
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
                                <label class="flex items-center">
                                    <input type="radio" name="program" value="{{ $value }}"
                                        {{ $oldProgram === $value ? 'checked' : '' }} class="mr-2">
                                    <span class="text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Current Semester and GPA -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label for="semester_year" class="block text-sm font-medium text-gray-700 mb-1">Current
                                Year</label>
                            <select name="semester_year" id="semester_year" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled {{ old('semester_year') ? '' : 'selected' }}>Select year
                                </option>
                                <option value="1" {{ old('semester_year') == 1 ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('semester_year') == 2 ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('semester_year') == 3 ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('semester_year') == 4 ? 'selected' : '' }}>4th Year</option>
                                <option value="5" {{ old('semester_year') == 5 ? 'selected' : '' }}>5th Year</option>
                            </select>
                        </div>


                        <div>
                            <label for="semester_term" class="block text-sm font-medium text-gray-700 mb-1">
                                Term <span class="text-red-500">*</span>
                            </label>
                            <select name="semester_term" id="semester_term" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled {{ old('semester_term') ? '' : 'selected' }}>Select term
                                </option>
                                <option value="1" {{ old('semester_term') == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('semester_term') == 2 ? 'selected' : '' }}>2</option>
                            </select>
                        </div>

                        <div>
                            <label for="cgpa" class="block text-sm font-medium text-gray-700 mb-1">cGPA <span
                                    class="text-red-500">*</span></label>
                            <input type="number" step="0.01" min="0" max="4" name="cgpa"
                                id="cgpa" value="{{ old('cgpa') }}" required placeholder="e.g., 3.75"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex items-end">
                            <span class="text-sm text-gray-600 pb-2">out of 4.00</span>
                        </div>
                    </div>

                    <!-- Physical Condition -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Physical Condition</label>
                        @php
                            $physicalConditions = ['normal' => 'Normal', 'disabled' => 'Disabled'];
                            $oldPhysical = old('physical_condition');
                        @endphp
                        <div class="flex gap-4">
                            @foreach ($physicalConditions as $value => $label)
                                <label class="flex items-center">
                                    <input type="radio" name="physical_condition" value="{{ $value }}"
                                        {{ $oldPhysical === $value ? 'checked' : '' }} class="mr-2">
                                    <span class="text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Family Status -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Family Status</label>
                        @php
                            $familyStatuses = [
                                'both-alive' => 'Both parents alive',
                                'father-dead' => 'Father deceased, mother alive',
                                'mother-dead' => 'Father alive, mother deceased',
                                'both-dead' => 'Both parents deceased',
                            ];
                            $oldFamily = old('family_status');
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach ($familyStatuses as $value => $label)
                                <label class="flex items-center">
                                    <input type="radio" name="family_status" value="{{ $value }}"
                                        {{ $oldFamily === $value ? 'checked' : '' }} class="mr-2">
                                    <span class="text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Addresses -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="permanent_address" class="block text-sm font-medium text-gray-700 mb-1">Permanent
                                Address</label>
                            <textarea name="permanent_address" id="permanent_address" rows="3"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('permanent_address') }}</textarea>
                        </div>
                        <div>
                            <label for="current_address" class="block text-sm font-medium text-gray-700 mb-1">Current
                                Address</label>
                            <textarea name="current_address" id="current_address" rows="3"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('current_address') }}</textarea>
                        </div>
                    </div>

                    <!-- Co-curricular Activities -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Co-curricular Activities</label>
                        @php
                            $activitiesList = ['bncc' => 'BNCC', 'rover' => 'Rover Scout'];
                            $oldActivities = old('activities', []);
                        @endphp
                        <div class="flex gap-4">
                            @foreach ($activitiesList as $value => $label)
                                <label class="flex items-center">
                                    <input type="checkbox" name="activities[]" value="{{ $value }}"
                                        {{ in_array($value, $oldActivities) ? 'checked' : '' }} class="mr-2">
                                    <span class="text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Other Information -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Other Information</label>
                        @php
                            $otherInfoList = ['ethnic' => 'Ethnic Minority', 'foreign' => 'Foreign Student'];
                            $oldOtherInfo = old('other_info', []);
                        @endphp
                        <div class="flex gap-4">
                            @foreach ($otherInfoList as $value => $label)
                                <label class="flex items-center">
                                    <input type="checkbox" name="other_info[]" value="{{ $value }}"
                                        {{ in_array($value, $oldOtherInfo) ? 'checked' : '' }} class="mr-2">
                                    <span class="text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Document Upload Section -->
                <div class="border border-gray-300 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Required Documents:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php
                            $fileFields = [
                                'university_id_doc' => 'University ID Card',
                                'marksheet' => 'Latest Semester Marksheet',
                                'birthCertificate' => 'Birth Certificate/National ID',
                                'financialCertificate' => 'Financial Status Certificate (if applicable)',
                                'deathCertificate' => 'Death Certificate (if parent deceased)',
                                'medicalCertificate' => 'Medical Certificate (if applicable)',
                                'activityCertificate' => 'BNCC/Scout Certificate (if applicable)',
                                'signature' => "Student's Signature",
                            ];
                        @endphp

                        @foreach (array_slice($fileFields, 0, 4) as $name => $label)
                            <div>
                                <label for="{{ $name }}"
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
                                <input type="file" name="{{ $name }}" id="{{ $name }}"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        @endforeach

                        <div class="space-y-4">
                            @foreach (array_slice($fileFields, 4) as $name => $label)
                                @if ($name !== 'signature')
                                    {{-- Signature input separate below --}}
                                    <div>
                                        <label for="{{ $name }}"
                                            class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
                                        <input type="file" name="{{ $name }}" id="{{ $name }}"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="border border-gray-300 rounded-lg p-6 mt-4">
                    <label for="signature" class="block text-sm font-medium text-gray-700 mb-1">Student's
                        Signature</label>
                    <input type="file" name="signature" id="signature" accept=".jpg,.jpeg,.png"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Declaration Section -->
                <div class="border border-gray-300 rounded-lg p-6 bg-blue-50 mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">I hereby declare that:</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <input type="checkbox" id="declaration_info_correct" name="declaration_info_correct" required
                                class="mr-3 mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="declaration_info_correct" class="text-sm text-gray-700">All the information
                                provided above is correct</label>
                        </div>
                        <div class="flex items-start">
                            <input type="checkbox" id="declaration_will_stay" name="declaration_will_stay" required
                                class="mr-3 mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="declaration_will_stay" class="text-sm text-gray-700">I will occupy any type of
                                seat allocated to me in the hall</label>
                        </div>
                        <div class="flex items-start">
                            <input type="checkbox" id="declaration_seven_days" name="declaration_seven_days" required
                                class="mr-3 mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="declaration_seven_days" class="text-sm text-gray-700">If I do not occupy the hall
                                within seven days of seat allocation, I will never apply for a seat again</label>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-300 rounded-lg p-6 mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <p class="py-2 px-3 border border-gray-300 rounded-md bg-gray-100 text-gray-700 select-none">
                        {{ old('application_date', date('Y-m-d')) }}
                    </p>
                    <input type="hidden" name="application_date" value="{{ old('application_date', date('Y-m-d')) }}">
                </div>


                <!-- Submit Button -->
                <div class="text-center pt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-200 shadow-md">
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
@endsection

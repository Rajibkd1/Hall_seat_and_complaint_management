@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="bg-green-600 rounded-t-lg px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-semibold text-white mb-1">Approved Application Details</h1>
                            <p class="text-green-100 text-sm">Verified and approved seat application information</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.applications.approved') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-700 border border-green-600 text-white font-medium rounded-md hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200">
                                <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Back to Approved Applications
                            </a>
                            <a href="{{ route('admin.applications.view', $application->application_id) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-blue-500 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Edit Application
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if ($application)
                <!-- Student Profile Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 overflow-hidden">
                    <div class="bg-green-50 px-6 py-4 border-b border-green-200">
                        <div class="flex flex-col md:flex-row items-start md:items-center">
                            <div class="relative mb-4 md:mb-0 md:mr-6">
                                @if ($application->student && $application->student->profile_image)
                                    <img src="{{ asset('storage/' . $application->student->profile_image) }}"
                                        alt="Profile Image"
                                        class="w-20 h-20 rounded-lg object-cover border-2 border-green-300">
                                @else
                                    <div
                                        class="w-20 h-20 rounded-lg bg-green-600 flex items-center justify-center text-white text-xl font-semibold border-2 border-green-300">
                                        {{ substr($application->student->name ?? 'N/A', 0, 1) }}
                                    </div>
                                @endif
                                <div class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full p-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-900 mb-2">
                                    {{ $application->student->name ?? 'Student Name N/A' }}</h2>
                                <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        {{ $application->student->email ?? 'No email provided' }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        ID: {{ $application->student->university_id ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ ucfirst($application->status) }} & Verified
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Information Cards Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Academic Details Card -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    </svg>
                                    Academic & Program Details
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Student Name</span>
                                        <span class="text-sm text-gray-900">{{ $application->student_name }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Department</span>
                                        <span class="text-sm text-gray-900">{{ $application->department }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Academic Year</span>
                                        <span class="text-sm text-gray-900">{{ $application->academic_year }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Program</span>
                                        <span class="text-sm text-gray-900">{{ ucfirst($application->program) }}</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="flex justify-between py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Year</span>
                                            <span class="text-sm text-gray-900">{{ $application->semester_year }}</span>
                                        </div>
                                        <div class="flex justify-between py-2 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Term</span>
                                            <span class="text-sm text-gray-900">{{ $application->semester_term }}</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">CGPA</span>
                                        <span class="text-sm font-semibold text-green-600">{{ $application->cgpa }}</span>
                                    </div>
                                    <div class="flex justify-between py-2">
                                        <span class="text-sm font-medium text-gray-600">Application Date</span>
                                        <span
                                            class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($application->application_date)->format('F j, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information Card -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Personal & Guardian Information
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Guardian Name</span>
                                        <span class="text-sm text-gray-900">{{ $application->guardian_name }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Guardian Mobile</span>
                                        <span class="text-sm text-gray-900">{{ $application->guardian_mobile }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Relationship</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $application->guardian_relationship }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Physical Condition</span>
                                        <span
                                            class="text-sm font-bold text-gray-900">{{ ucfirst($application->physical_condition) }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Division</span>
                                        <span
                                            class="text-sm font-bold text-gray-900">{{ ucfirst($application->division ?? 'N/A') }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">District</span>
                                        <span
                                            class="text-sm font-bold text-gray-900">{{ ucfirst(str_replace('_', ' ', $application->district ?? 'N/A')) }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Family Status</span>
                                        <span
                                            class="text-sm font-bold text-gray-900">{{ str_replace('-', ' ', ucfirst($application->family_status)) }}</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Permanent Address</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $application->permanent_address ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between py-2">
                                        <span class="text-sm font-medium text-gray-600">Current Address</span>
                                        <span
                                            class="text-sm text-gray-900">{{ $application->current_address ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                                Verified Documents
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                @php
                                    $documents = [
                                        'university_id_doc' => 'University ID Document',
                                        'marksheet_doc' => 'Marksheet',
                                        'birth_certificate_doc' => 'Birth Certificate',
                                        'financial_certificate_doc' => 'Financial Certificate',
                                        'death_certificate_doc' => 'Death Certificate',
                                        'medical_certificate_doc' => 'Medical Certificate',
                                        'activity_certificate_doc' => 'Activity Certificate',
                                        'signature_doc' => 'Signature',
                                    ];
                                @endphp

                                @foreach ($documents as $field => $label)
                                    @if (!empty($application->{$field}))
                                        <div
                                            class="bg-green-50 p-4 rounded-lg border border-green-200 hover:shadow-md transition-shadow duration-200">
                                            <h4 class="font-medium text-gray-800 mb-2 text-center">{{ $label }}
                                            </h4>
                                            <a href="{{ asset('storage/' . $application->{$field}) }}" target="_blank"
                                                class="block">
                                                @if (Str::endsWith($application->{$field}, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                                    <img src="{{ asset('storage/' . $application->{$field}) }}"
                                                        alt="{{ $label }}"
                                                        class="w-full h-24 object-cover rounded border border-green-300 mb-2">
                                                @elseif(Str::endsWith($application->{$field}, ['.pdf']))
                                                    <div
                                                        class="w-full h-24 flex items-center justify-center bg-green-100 rounded border border-green-300 mb-2">
                                                        <svg class="w-8 h-8 text-green-600" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-full h-24 flex items-center justify-center bg-green-100 rounded border border-green-300 mb-2">
                                                        <svg class="w-8 h-8 text-green-600" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="text-center">
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Verified
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Application Summary -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Application Summary
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div class="text-center">
                                    <div
                                        class="bg-green-100 rounded-full p-3 w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">Status</h4>
                                    <p class="text-green-600 font-medium">Approved & Verified</p>
                                </div>
                                <div class="text-center">
                                    <div
                                        class="bg-blue-100 rounded-full p-3 w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">Application Date</h4>
                                    <p class="text-gray-600">{{ $application->application_date->format('M d, Y') }}</p>
                                </div>
                                <div class="text-center">
                                    <div
                                        class="bg-purple-100 rounded-full p-3 w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">CGPA</h4>
                                    <p class="text-gray-600 font-semibold">{{ $application->cgpa }}/4.00</p>
                                </div>
                            </div>

                            <!-- Seat Assignment Section -->
                            @php
                                $hasActiveSeat = $application->seatAllotments()->where('status', 'active')->exists();
                                $currentSeat = $application
                                    ->seatAllotments()
                                    ->where('status', 'active')
                                    ->with('seat')
                                    ->first();
                            @endphp

                            @if ($hasActiveSeat && $currentSeat)
                                <!-- Student already has a seat -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-blue-100 rounded-full p-2 mr-4">
                                                <svg class="w-6 h-6 text-blue-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                                    <path
                                                        d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-semibold text-blue-900">Seat Already Assigned</h4>
                                                <p class="text-blue-700">
                                                    Room {{ $currentSeat->seat->room_number }}, Bed
                                                    {{ $currentSeat->seat->bed_number }}
                                                    (Floor {{ $currentSeat->seat->floor }},
                                                    {{ $currentSeat->seat->block }}
                                                    Block)
                                                </p>
                                                <p class="text-sm text-blue-600 mt-1">
                                                    Assigned on: {{ $currentSeat->start_date->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        @if (auth('admin')->user()->role === 'Provost')
                                            <a href="{{ route('provost.seats.index') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                                                <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                                </svg>
                                                Manage Seats
                                            </a>
                                        @else
                                            <a href="{{ route('admin.seats.index') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                                                <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                                </svg>
                                                Manage Seats
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <!-- Student needs seat assignment -->
                                <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-orange-100 rounded-full p-2 mr-4">
                                                <svg class="w-6 h-6 text-orange-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-semibold text-orange-900">Seat Assignment Required
                                                </h4>
                                                <p class="text-orange-700">This approved student needs a seat assignment.
                                                </p>
                                                <p class="text-sm text-orange-600 mt-1">
                                                    Student: {{ $application->student_name }}
                                                    ({{ $application->student->email ?? 'N/A' }})
                                                </p>
                                            </div>
                                        </div>
                                        @if (auth('admin')->user()->role === 'Provost')
                                            <a href="{{ route('provost.seats.index') }}"
                                                class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-medium rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200">
                                                <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                                </svg>
                                                Assign Seat
                                            </a>
                                        @else
                                            <a href="{{ route('admin.seats.index') }}"
                                                class="inline-flex items-center px-4 py-2 bg-orange-600 text-white font-medium rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200">
                                                <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                                </svg>
                                                Assign Seat
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                        <p class="text-xl text-gray-700 font-semibold">Application not found.</p>
                        <a href="{{ route('admin.applications.approved') }}"
                            class="inline-block mt-6 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-150">
                            Back to Approved Applications
                        </a>
                    </div>
            @endif
        </div>
    </div>
@endsection

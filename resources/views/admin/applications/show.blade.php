@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Enhanced Header Section -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-8">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">Seat Application Review</h1>
                            <p class="text-indigo-100 text-lg">Comprehensive application details and status management</p>
                            <div class="flex items-center mt-4 space-x-4">
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                                    <span class="text-white text-sm font-medium">Application ID</span>
                                    <div class="text-white text-xl font-bold">#{{ $application->application_id }}</div>
                                </div>
                                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                                    <span class="text-white text-sm font-medium">Submitted</span>
                                    <div class="text-white text-lg font-semibold">
                                        {{ \Carbon\Carbon::parse($application->application_date)->format('M j, Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('admin.applications.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-lg hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Back to Applications
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if ($application)
                <!-- Enhanced Student Profile Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="relative">
                                    @if ($application->student && $application->student->profile_image)
                                        <img src="{{ asset('storage/' . $application->student->profile_image) }}"
                                            alt="Profile Image"
                                            class="w-24 h-24 rounded-xl object-cover border-4 border-white shadow-lg">
                                    @else
                                        <div
                                            class="w-24 h-24 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold border-4 border-white shadow-lg">
                                            {{ substr($application->student->name ?? ($application->student_name ?? 'N'), 0, 1) }}
                                        </div>
                                    @endif
                                    <div
                                        class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center border-2 border-white">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                        {{ $application->student->name ?? ($application->student_name ?? 'Student Name N/A') }}
                                    </h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                            <span
                                                class="font-medium">{{ $application->student->email ?? 'No email provided' }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zM8 6a2 2 0 114 0v1H8V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span
                                                class="font-bold text-lg text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full font-mono">{{ $application->student->university_id ?? 'N/A' }}</span>
                                            <span
                                                class="text-sm bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full font-semibold">University
                                                ID</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-medium">{{ $application->department }}</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                            </svg>
                                            <span class="font-medium">{{ $application->academic_year }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 lg:mt-0">
                                <div class="text-right">
                                    <div class="text-sm text-gray-500 mb-2">Current Status</div>
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-xl text-lg font-bold shadow-lg
                                        {{ $application->status === 'approved'
                                            ? 'bg-gradient-to-r from-green-400 to-green-600 text-white'
                                            : ($application->status === 'verified'
                                                ? 'bg-gradient-to-r from-emerald-400 to-emerald-600 text-white'
                                                : ($application->status === 'pending'
                                                    ? 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-white'
                                                    : ($application->status === 'rejected'
                                                        ? 'bg-gradient-to-r from-red-400 to-red-600 text-white'
                                                        : ($application->status === 'waitlisted'
                                                            ? 'bg-gradient-to-r from-blue-400 to-blue-600 text-white'
                                                            : 'bg-gradient-to-r from-gray-400 to-gray-600 text-white')))) }}">
                                        @switch($application->status)
                                            @case('approved')
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @break

                                            @case('verified')
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @break

                                            @case('pending')
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @break

                                            @case('rejected')
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @break

                                            @case('waitlisted')
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @break

                                            @default
                                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                        @endswitch
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Information Cards Grid -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">
                    <!-- Academic Details Card -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                                Academic Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Student
                                        Name</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $application->student_name }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">University
                                        ID</span>
                                    <span
                                        class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">{{ $application->student->university_id ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Department</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $application->department }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Academic
                                        Year</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $application->academic_year }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Program</span>
                                    <span
                                        class="text-sm font-bold text-gray-900">{{ ucfirst($application->program) }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center bg-gray-50 rounded-lg p-3">
                                        <div class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Year
                                        </div>
                                        <div class="text-lg font-bold text-gray-900">
                                            {{ $application->semester_year ?? 'N/A' }}</div>
                                    </div>
                                    <div class="text-center bg-gray-50 rounded-lg p-3">
                                        <div class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Term
                                        </div>
                                        <div class="text-lg font-bold text-gray-900">
                                            {{ $application->semester_term ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">CGPA</span>
                                    <span
                                        class="text-lg font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ $application->cgpa }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Application
                                        Date</span>
                                    <span
                                        class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($application->application_date)->format('F j, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information Card -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Personal Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Guardian
                                        Name</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $application->guardian_name }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Guardian
                                        Mobile</span>
                                    <span
                                        class="text-sm font-bold text-gray-900">{{ $application->guardian_mobile }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Relationship</span>
                                    <span
                                        class="text-sm font-bold text-gray-900">{{ $application->guardian_relationship }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Physical
                                        Condition</span>
                                    <span
                                        class="text-sm font-bold text-gray-900">{{ ucfirst($application->physical_condition) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Family
                                        Status</span>
                                    <span
                                        class="text-sm font-bold text-gray-900">{{ str_replace('-', ' ', ucfirst($application->family_status)) }}</span>
                                </div>
                                <div class="py-3 border-b border-gray-100">
                                    <span
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide block mb-2">Permanent
                                        Address</span>
                                    <span
                                        class="text-sm text-gray-900">{{ $application->permanent_address ?? 'N/A' }}</span>
                                </div>
                                <div class="py-3">
                                    <span
                                        class="text-sm font-semibold text-gray-600 uppercase tracking-wide block mb-2">Current
                                        Address</span>
                                    <span
                                        class="text-sm text-gray-900">{{ $application->current_address ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Status Card -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Contact & Status
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div
                                    class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                                    <div class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">Student
                                        Email</div>
                                    <div class="text-sm font-bold text-blue-900">
                                        {{ $application->student->email ?? 'No email provided' }}</div>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 border border-green-200">
                                    <div class="text-sm font-semibold text-green-600 uppercase tracking-wide mb-2">Student
                                        Phone</div>
                                    <div class="text-sm font-bold text-green-900">
                                        {{ $application->student->phone ?? 'No phone provided' }}</div>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-4 border border-purple-200">
                                    <div class="text-sm font-semibold text-purple-600 uppercase tracking-wide mb-2">
                                        Application Status</div>
                                    <div class="text-lg font-bold text-purple-900">{{ ucfirst($application->status) }}
                                    </div>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-4 border border-yellow-200">
                                    <div class="text-sm font-semibold text-yellow-600 uppercase tracking-wide mb-2">
                                        Submission Date</div>
                                    <div class="text-sm font-bold text-yellow-900">
                                        {{ \Carbon\Carbon::parse($application->submission_date ?? $application->application_date)->format('F j, Y g:i A') }}
                                    </div>
                                </div>
                                @if ($application->activities && $application->activities !== '[]')
                                    <div
                                        class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg p-4 border border-teal-200">
                                        <div class="text-sm font-semibold text-teal-600 uppercase tracking-wide mb-2">
                                            Activities</div>
                                        <div class="text-sm font-bold text-teal-900">
                                            @php
                                                $activities = json_decode($application->activities, true) ?? [];
                                            @endphp
                                            {{ implode(', ', array_map('ucfirst', $activities)) ?: 'None' }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Documents Section -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-8 py-6">
                        <h3 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Uploaded Documents
                        </h3>
                        <p class="text-gray-300 mt-2">Review all submitted documents and certificates</p>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @php
                                $documents = [
                                    'university_id_doc' => [
                                        'name' => 'University ID Document',
                                        'icon' =>
                                            'M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zM8 6a2 2 0 114 0v1H8V6z',
                                        'color' => 'blue',
                                    ],
                                    'marksheet_doc' => [
                                        'name' => 'Academic Marksheet',
                                        'icon' =>
                                            'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                                        'color' => 'green',
                                    ],
                                    'birth_certificate_doc' => [
                                        'name' => 'Birth Certificate',
                                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                        'color' => 'purple',
                                    ],
                                    'financial_certificate_doc' => [
                                        'name' => 'Financial Certificate',
                                        'icon' =>
                                            'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                        'color' => 'yellow',
                                    ],
                                    'death_certificate_doc' => [
                                        'name' => 'Death Certificate',
                                        'icon' =>
                                            'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                                        'color' => 'red',
                                    ],
                                    'medical_certificate_doc' => [
                                        'name' => 'Medical Certificate',
                                        'icon' =>
                                            'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                                        'color' => 'pink',
                                    ],
                                    'activity_certificate_doc' => [
                                        'name' => 'Activity Certificate',
                                        'icon' =>
                                            'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                                        'color' => 'indigo',
                                    ],
                                    'signature_doc' => [
                                        'name' => 'Digital Signature',
                                        'icon' =>
                                            'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
                                        'color' => 'teal',
                                    ],
                                ];
                            @endphp

                            @foreach ($documents as $field => $doc)
                                @if (!empty($application->{$field}))
                                    <div
                                        class="group bg-gradient-to-br from-{{ $doc['color'] }}-50 to-{{ $doc['color'] }}-100 rounded-xl border-2 border-{{ $doc['color'] }}-200 hover:border-{{ $doc['color'] }}-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                        <div class="p-6">
                                            <div
                                                class="flex items-center justify-center w-16 h-16 bg-{{ $doc['color'] }}-500 rounded-xl mb-4 mx-auto group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="{{ $doc['icon'] }}" />
                                                </svg>
                                            </div>
                                            <h4 class="font-bold text-{{ $doc['color'] }}-800 text-center mb-3 text-sm">
                                                {{ $doc['name'] }}</h4>
                                            <a href="{{ asset('storage/' . $application->{$field}) }}" target="_blank"
                                                class="block">
                                                @if (Str::endsWith($application->{$field}, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                                    <img src="{{ asset('storage/' . $application->{$field}) }}"
                                                        alt="{{ $doc['name'] }}"
                                                        class="w-full h-32 object-cover rounded-lg border-2 border-{{ $doc['color'] }}-300 mb-3 group-hover:border-{{ $doc['color'] }}-500 transition-colors duration-300">
                                                @elseif(Str::endsWith($application->{$field}, ['.pdf']))
                                                    <div
                                                        class="w-full h-32 flex items-center justify-center bg-{{ $doc['color'] }}-200 rounded-lg border-2 border-{{ $doc['color'] }}-300 mb-3 group-hover:border-{{ $doc['color'] }}-500 transition-colors duration-300">
                                                        <svg class="w-12 h-12 text-{{ $doc['color'] }}-600"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-full h-32 flex items-center justify-center bg-{{ $doc['color'] }}-200 rounded-lg border-2 border-{{ $doc['color'] }}-300 mb-3 group-hover:border-{{ $doc['color'] }}-500 transition-colors duration-300">
                                                        <svg class="w-12 h-12 text-{{ $doc['color'] }}-600"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="text-center">
                                                    <span
                                                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold bg-{{ $doc['color'] }}-500 text-white group-hover:bg-{{ $doc['color'] }}-600 transition-colors duration-300">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View Document
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="bg-gray-100 rounded-xl border-2 border-dashed border-gray-300 p-6 text-center">
                                        <div
                                            class="flex items-center justify-center w-16 h-16 bg-gray-300 rounded-xl mb-4 mx-auto">
                                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ $doc['icon'] }}" />
                                            </svg>
                                        </div>
                                        <h4 class="font-bold text-gray-600 text-center mb-2 text-sm">{{ $doc['name'] }}
                                        </h4>
                                        <span class="text-xs text-gray-500 bg-gray-200 px-3 py-1 rounded-full">Not
                                            Uploaded</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Enhanced Action Forms Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Status Update Form -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 px-6 py-4">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Update Application Status
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.applications.update_status', $application->application_id) }}"
                                method="POST" class="space-y-6">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label for="status" class="block text-sm font-bold text-gray-700 mb-3">Select New
                                        Status</label>
                                    <select name="status" id="status"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 font-medium">
                                        <option value="pending"
                                            {{ $application->status === 'pending' ? 'selected' : '' }}>🕐 Pending Review
                                        </option>
                                        <option value="approved"
                                            {{ $application->status === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                                        <option value="verified"
                                            {{ $application->status === 'verified' ? 'selected' : '' }}>🔒 Verified
                                        </option>
                                        <option value="rejected"
                                            {{ $application->status === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                                        <option value="waitlisted"
                                            {{ $application->status === 'waitlisted' ? 'selected' : '' }}>📋 Waitlisted
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <label for="email_message" class="block text-sm font-bold text-gray-700 mb-3">Message
                                        to Student (Optional)</label>
                                    <textarea name="email_message" id="email_message" rows="4"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 resize-none"
                                        placeholder="Enter a detailed message to explain the status change..."></textarea>
                                    <p class="mt-2 text-xs text-gray-500 bg-gray-50 p-2 rounded">💡 This message will be
                                        sent via email if notification is enabled</p>
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                    <label class="flex items-center cursor-pointer group">
                                        <input type="checkbox" name="send_email" value="1"
                                            class="w-5 h-5 text-indigo-600 border-2 border-gray-300 rounded focus:ring-indigo-500 group-hover:border-indigo-400 transition-colors duration-200">
                                        <span
                                            class="ml-3 text-sm font-semibold text-gray-700 group-hover:text-indigo-600 transition-colors duration-200">📧
                                            Send Email Notification</span>
                                    </label>
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white text-sm font-bold rounded-lg hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Update Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Custom Email Form -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                Send Custom Email
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('admin.applications.send_email', $application->application_id) }}"
                                method="POST" class="space-y-6">
                                @csrf
                                <div>
                                    <label for="subject" class="block text-sm font-bold text-gray-700 mb-3">Email
                                        Subject</label>
                                    <input type="text" name="subject" id="subject"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 font-medium"
                                        placeholder="Enter email subject..." required>
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-bold text-gray-700 mb-3">Email
                                        Message</label>
                                    <textarea name="message" id="message" rows="4"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none"
                                        placeholder="Enter your detailed message..." required></textarea>
                                </div>
                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold rounded-lg hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        Send Email
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Audit Log Section -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-8 py-6">
                        <h3 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Application Audit Log
                        </h3>
                        <p class="text-orange-100 mt-2">Complete history of all status changes and administrative actions
                        </p>
                    </div>
                    <div class="p-8">
                        @if ($application->auditLogs && $application->auditLogs->count() > 0)
                            <div class="space-y-6">
                                @foreach ($application->auditLogs->sortByDesc('created_at') as $log)
                                    <div class="relative pl-8 pb-6 border-l-4 border-blue-500 last:border-l-0 last:pb-0">
                                        <div
                                            class="absolute -left-3 top-0 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-6 ml-4">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-3 mb-3">
                                                        <span class="text-sm font-bold text-gray-900">Status changed
                                                            to:</span>
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold
                                                            {{ $log->new_status === 'approved'
                                                                ? 'bg-green-100 text-green-800'
                                                                : ($log->new_status === 'verified'
                                                                    ? 'bg-emerald-100 text-emerald-800'
                                                                    : ($log->new_status === 'pending'
                                                                        ? 'bg-yellow-100 text-yellow-800'
                                                                        : ($log->new_status === 'rejected'
                                                                            ? 'bg-red-100 text-red-800'
                                                                            : ($log->new_status === 'waitlisted'
                                                                                ? 'bg-blue-100 text-blue-800'
                                                                                : 'bg-gray-100 text-gray-800')))) }}">
                                                            {{ ucfirst($log->new_status) }}
                                                        </span>
                                                    </div>
                                                    @if ($log->admin)
                                                        <p class="text-sm text-gray-600 mb-2">
                                                            <span class="font-semibold">Changed by:</span>
                                                            {{ $log->admin->name }}
                                                            <span class="text-gray-400">•</span>
                                                            <span class="font-semibold">Role:</span>
                                                            {{ ucfirst($log->admin->role ?? 'Admin') }}
                                                        </p>
                                                    @endif
                                                    @if ($log->message)
                                                        <div class="bg-white rounded-lg p-4 border border-gray-200 mt-3">
                                                            <p class="text-sm font-semibold text-gray-700 mb-2">📝 Admin
                                                                Message:</p>
                                                            <p class="text-sm text-gray-900">{{ $log->message }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-right ml-4">
                                                    <p class="text-xs font-semibold text-gray-500 mb-1">
                                                        {{ $log->created_at->format('M j, Y') }}</p>
                                                    <p class="text-xs text-gray-400">
                                                        {{ $log->created_at->format('g:i A') }}</p>
                                                    <p class="text-xs text-gray-400 mt-1">
                                                        {{ $log->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-xl text-gray-500 font-semibold mb-2">No audit logs available</p>
                                <p class="text-gray-400">This application hasn't been reviewed yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-12 text-center">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="text-3xl text-gray-700 font-bold mb-4">Application Not Found</h2>
                    <p class="text-gray-500 mb-8">The requested application could not be located in our system.</p>
                    <a href="{{ route('admin.applications.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-bold rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Applications
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

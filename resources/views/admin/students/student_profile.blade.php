@include('layouts.admin_layout_helper')
@extends($layout)

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-6 py-8">
            <!-- Professional Header with Breadcrumb -->
            <div class="mb-10">
                <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-6">
                    <a href="{{ route('admin.students') }}"
                        class="hover:text-gray-700 transition-colors duration-200 font-medium">Students</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-800 font-semibold">Student Profile</span>
                </nav>
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start space-y-4 lg:space-y-0">
                        <div class="flex-1">
                            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Student Profile Management</h1>
                            <p class="text-gray-600 mt-2 text-lg">Comprehensive student information and verification details
                            </p>
                        </div>
                        @if ($student)
                            <div class="flex-shrink-0">
                                <button
                                    onclick="openEmailModal('{{ $student->student_id }}', '{{ $student->name }}', '{{ $student->email }}')"
                                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 hover:shadow-lg shadow-md w-full lg:w-auto justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Send Email
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if ($student)
                <!-- Professional Profile Header Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-10">
                    <!-- Elegant Header Section -->
                    <div class="relative bg-gradient-to-r from-gray-800 to-gray-900 px-8 py-12">
                        <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                        <div
                            class="relative flex flex-col md:flex-row items-start md:items-center space-y-6 md:space-y-0 md:space-x-8">
                            <!-- Professional Profile Image -->
                            <div class="relative flex-shrink-0">
                                <div
                                    class="w-28 h-28 rounded-lg overflow-hidden bg-white p-1 shadow-xl border-4 border-white/20">
                                    @if ($student->profile_image)
                                        <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Profile Image"
                                            class="w-full h-full object-cover rounded-md">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-gray-600 to-gray-700 rounded-md flex items-center justify-center">
                                            <span
                                                class="text-white text-3xl font-bold">{{ substr($student->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <!-- Status Indicator -->
                                <div
                                    class="absolute -bottom-1 -right-1 w-7 h-7 bg-green-500 rounded-full border-3 border-white flex items-center justify-center shadow-lg">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Student Information -->
                            <div class="flex-1 min-w-0">
                                <div class="mb-4">
                                    <h2 class="text-3xl font-bold text-white mb-2 tracking-tight">{{ $student->name }}</h2>
                                    <p class="text-gray-300 text-lg font-medium">Student ID: {{ $student->university_id }}
                                    </p>
                                </div>

                                <!-- Professional Tags -->
                                <div class="flex flex-wrap items-center gap-3">
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-white/10 text-white border border-white/20 backdrop-blur-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                        @php
                                            $departmentMap = [
                                                'CSE' => 'Computer Science & Engineering',
                                                'EEE' => 'Electrical & Electronic Engineering',
                                                'ME' => 'Mechanical Engineering',
                                                'CE' => 'Civil Engineering',
                                                'BBA' => 'Bachelor of Business Administration',
                                                'ARCH' => 'Architecture',
                                                'ENG' => 'English',
                                                'MATH' => 'Mathematics',
                                                'PHY' => 'Physics',
                                                'CHEM' => 'Chemistry',
                                                'BIO' => 'Biology',
                                                'ECO' => 'Economics',
                                                'LAW' => 'Law',
                                                'MED' => 'Medicine',
                                                'PHARM' => 'Pharmacy',
                                            ];
                                            $fullDepartmentName =
                                                $departmentMap[$student->department] ??
                                                ($student->department ?? 'Not Specified');
                                        @endphp
                                        {{ $fullDepartmentName }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-white/10 text-white border border-white/20 backdrop-blur-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Session {{ $student->session_year }}
                                    </span>
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-green-500/20 text-green-100 border border-green-400/30">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                        Active Student
                                    </span>

                                    <!-- Hall Stay Duration Badge -->
                                    @if ($currentSeatAllotment && $currentSeatAllotment->start_date)
                                        @php
                                            $startDate = \Carbon\Carbon::parse($currentSeatAllotment->start_date);
                                            $now = \Carbon\Carbon::now();
                                            $duration = $startDate->diffInDays($now);
                                            $months = floor($duration / 30);
                                            $days = $duration % 30;
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-blue-500/20 text-blue-100 border border-blue-400/30">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            @if ($months > 0)
                                                {{ $months }}m {{ $days }}d in Hall
                                            @else
                                                {{ $days }}d in Hall
                                            @endif
                                        </span>
                                    @endif

                                    <!-- Renewal Status Badge -->
                                    @if ($currentSeatAllotment)
                                        @if ($currentSeatAllotment->renewal_required)
                                            @if ($currentSeatAllotment->canApplyForRenewal())
                                                <span
                                                    class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-orange-500/20 text-orange-100 border border-orange-400/30">
                                                    <div class="w-2 h-2 bg-orange-400 rounded-full mr-2"></div>
                                                    Can Renew
                                                </span>
                                            @elseif($currentSeatAllotment->hasPendingRenewalApplication())
                                                <span
                                                    class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-blue-500/20 text-blue-100 border border-blue-400/30">
                                                    <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                                    Renewal Pending
                                                </span>
                                            @elseif($currentSeatAllotment->remaining_days !== null && $currentSeatAllotment->remaining_days <= 30)
                                                <span
                                                    class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-yellow-500/20 text-yellow-100 border border-yellow-400/30">
                                                    <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                                                    Renewal Required
                                                </span>
                                            @endif
                                        @else
                                            <span
                                                class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold bg-green-500/20 text-green-100 border border-green-400/30">
                                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                                No Renewal Needed
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Professional Information Cards Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Contact & Academic Information -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Contact Information Card -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">Contact Information
                                    </h3>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-5">
                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    Email Address</p>
                                            </div>
                                            <p class="text-gray-900 font-medium">{{ $student->email }}</p>
                                        </div>

                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    Phone Number</p>
                                            </div>
                                            <p class="text-gray-900 font-medium">{{ $student->phone ?? 'Not Provided' }}
                                            </p>
                                        </div>

                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    Current Address</p>
                                            </div>
                                            <p class="text-gray-900 font-medium">
                                                {{ $student->current_address ?? 'Not Provided' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="space-y-5">
                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                    </path>
                                                </svg>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    University ID</p>
                                            </div>
                                            <p class="text-gray-900 font-bold text-lg font-mono">
                                                {{ $student->university_id }}</p>
                                        </div>

                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    System ID</p>
                                            </div>
                                            <p class="text-gray-900 font-medium font-mono">{{ $student->student_id }}</p>
                                        </div>

                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    Profile Completed</p>
                                            </div>
                                            <p class="text-gray-900 font-medium">
                                                {{ $student->profile_completed_at ? \Carbon\Carbon::parse($student->profile_completed_at)->format('M d, Y') : 'Not Completed' }}
                                            </p>
                                        </div>

                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                                    Account Activated</p>
                                            </div>
                                            <p class="text-gray-900 font-medium">
                                                {{ $student->activated_at ? \Carbon\Carbon::parse($student->activated_at)->format('M d, Y') : 'Not Activated' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional University ID Card Section -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">University ID
                                            Card Verification</h3>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if ($student->id_card_front && $student->id_card_back)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                COMPLETE
                                            </span>
                                        @elseif($student->id_card_front || $student->id_card_back)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                PARTIAL
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                MISSING
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <!-- Front Side -->
                                    <div class="space-y-4">
                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span
                                                        class="text-sm font-bold text-gray-700 uppercase tracking-wider">Front
                                                        Side</span>
                                                </div>
                                                @if ($student->id_card_front)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                                                        VERIFIED
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></div>
                                                        PENDING
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($student->id_card_front)
                                            <div class="border-2 border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer"
                                                onclick="openImageModal('{{ asset('storage/' . $student->id_card_front) }}', 'University ID Card - Front Side')">
                                                <img src="{{ asset('storage/' . $student->id_card_front) }}"
                                                    alt="University ID Card - Front Side"
                                                    class="w-full h-56 object-contain bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                            </div>
                                        @else
                                            <div
                                                class="border-2 border-dashed border-gray-300 rounded-lg p-12 text-center bg-gray-50">
                                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="text-sm font-semibold text-gray-600 mb-1">Front Side Not
                                                    Available</p>
                                                <p class="text-xs text-gray-500">ID card front image has not been uploaded
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Back Side -->
                                    <div class="space-y-4">
                                        <div class="border-l-4 border-gray-600 pl-4 py-2">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-500 mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span
                                                        class="text-sm font-bold text-gray-700 uppercase tracking-wider">Back
                                                        Side</span>
                                                </div>
                                                @if ($student->id_card_back)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></div>
                                                        VERIFIED
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                                        <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></div>
                                                        PENDING
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($student->id_card_back)
                                            <div class="border-2 border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer"
                                                onclick="openImageModal('{{ asset('storage/' . $student->id_card_back) }}', 'University ID Card - Back Side')">
                                                <img src="{{ asset('storage/' . $student->id_card_back) }}"
                                                    alt="University ID Card - Back Side"
                                                    class="w-full h-56 object-contain bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                            </div>
                                        @else
                                            <div
                                                class="border-2 border-dashed border-gray-300 rounded-lg p-12 text-center bg-gray-50">
                                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="text-sm font-semibold text-gray-600 mb-1">Back Side Not Available
                                                </p>
                                                <p class="text-xs text-gray-500">ID card back image has not been uploaded
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Professional Verification Notice -->
                                <div class="mt-8 p-5 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-900 mb-2 uppercase tracking-wide">
                                                Verification Requirements</h4>
                                            <p class="text-sm text-gray-700 leading-relaxed">
                                                University ID cards serve as official identification documents for student
                                                verification and access control.
                                                Both front and back sides must be clearly visible, readable, and contain all
                                                required institutional markings
                                                for proper authentication and security compliance.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Sidebar -->
                    <div class="space-y-6">
                        <!-- Status Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 info-card">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Account Status</span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $student->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <div
                                            class="w-2 h-2 {{ $student->is_active ? 'bg-green-500' : 'bg-red-500' }} rounded-full mr-1">
                                        </div>
                                        {{ $student->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Profile Status</span>
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $student->profile_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        <div
                                            class="w-2 h-2 {{ $student->profile_completed ? 'bg-green-500' : 'bg-yellow-500' }} rounded-full mr-1">
                                        </div>
                                        {{ $student->profile_completed ? 'Complete' : 'Incomplete' }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Last Updated</span>
                                    <span
                                        class="text-sm text-gray-900">{{ $student->updated_at ? $student->updated_at->format('M d, Y') : 'Never' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Seat Information Card -->
                        @if ($currentSeatAllotment)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Seat</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Floor</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $currentSeatAllotment->seat->floor ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Room</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $currentSeatAllotment->seat->room_number ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Bed</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $currentSeatAllotment->seat->bed_number ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Allocated</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $currentSeatAllotment->start_date ? \Carbon\Carbon::parse($currentSeatAllotment->start_date)->format('M d, Y') : 'N/A' }}</span>
                                    </div>

                                    <!-- Hall Stay Duration -->
                                    @if ($currentSeatAllotment->start_date)
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Duration in Hall</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                @php
                                                    $startDate = \Carbon\Carbon::parse(
                                                        $currentSeatAllotment->start_date,
                                                    );
                                                    $now = \Carbon\Carbon::now();
                                                    $duration = $startDate->diffInDays($now);
                                                    $months = floor($duration / 30);
                                                    $days = $duration % 30;
                                                @endphp
                                                @if ($months > 0)
                                                    {{ $months }} month{{ $months > 1 ? 's' : '' }}
                                                    {{ $days }} day{{ $days > 1 ? 's' : '' }}
                                                @else
                                                    {{ $days }} day{{ $days > 1 ? 's' : '' }}
                                                @endif
                                            </span>
                                        </div>
                                    @endif

                                    @if ($currentSeatAllotment->allocation_expiry_date)
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Expires</span>
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($currentSeatAllotment->allocation_expiry_date)->format('M d, Y') }}</span>
                                        </div>

                                        <!-- Remaining Days -->
                                        @if ($currentSeatAllotment->remaining_days !== null)
                                            <div class="flex items-center justify-between">
                                                <span class="text-gray-600">Remaining Days</span>
                                                <span
                                                    class="text-sm font-medium {{ $currentSeatAllotment->remaining_days <= 10 ? 'text-red-600' : ($currentSeatAllotment->remaining_days <= 30 ? 'text-orange-600' : 'text-green-600') }}">
                                                    {{ $currentSeatAllotment->remaining_days }}
                                                    day{{ $currentSeatAllotment->remaining_days != 1 ? 's' : '' }}
                                                </span>
                                            </div>
                                        @endif
                                    @endif

                                    <!-- Renewal Status -->
                                    <div class="border-t border-gray-200 pt-3 mt-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-gray-600 font-medium">Renewal Status</span>
                                            @if ($currentSeatAllotment->renewal_required)
                                                @if ($currentSeatAllotment->canApplyForRenewal())
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                        <div class="w-2 h-2 bg-orange-500 rounded-full mr-1"></div>
                                                        Can Renew
                                                    </span>
                                                @elseif($currentSeatAllotment->hasPendingRenewalApplication())
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-1"></div>
                                                        Pending
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-1"></div>
                                                        Required Soon
                                                    </span>
                                                @endif
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                                                    Not Required
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Renewal Reminder Status -->
                                        @if (
                                            $currentSeatAllotment->renewal_required &&
                                                $currentSeatAllotment->remaining_days !== null &&
                                                $currentSeatAllotment->remaining_days <= 30)
                                            <div class="text-xs text-gray-500">
                                                <div class="flex items-center justify-between">
                                                    <span>Reminder Status:</span>
                                                    <div class="flex space-x-1">
                                                        @if ($currentSeatAllotment->reminder_29_days_sent)
                                                            <span
                                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-xs bg-green-100 text-green-700">✓
                                                                29d</span>
                                                        @endif
                                                        @if ($currentSeatAllotment->reminder_20_days_sent)
                                                            <span
                                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-xs bg-green-100 text-green-700">✓
                                                                20d</span>
                                                        @endif
                                                        @if ($currentSeatAllotment->reminder_10_days_sent)
                                                            <span
                                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-xs bg-green-100 text-green-700">✓
                                                                10d</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Application Information Card -->
                        @if ($latestApplication)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Latest Application</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Status</span>
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $latestApplication->status === 'approved'
                                            ? 'bg-green-100 text-green-800'
                                            : ($latestApplication->status === 'rejected'
                                                ? 'bg-red-100 text-red-800'
                                                : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($latestApplication->status) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Submitted</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $latestApplication->submission_date ? \Carbon\Carbon::parse($latestApplication->submission_date)->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Type</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ ucfirst($latestApplication->type ?? 'Regular') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Complaint Information Card -->
                        @if ($latestComplaint)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Latest Complaint</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Category</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ ucfirst($latestComplaint->category ?? 'General') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Status</span>
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $latestComplaint->status === 'resolved'
                                            ? 'bg-green-100 text-green-800'
                                            : ($latestComplaint->status === 'rejected'
                                                ? 'bg-red-100 text-red-800'
                                                : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($latestComplaint->status ?? 'Pending') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Submitted</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $latestComplaint->submission_date ? \Carbon\Carbon::parse($latestComplaint->submission_date)->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <!-- Error State -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Student Not Found</h3>
                    <p class="text-gray-600 mb-6">The student profile you're looking for doesn't exist or has been removed.
                    </p>
                    <a href="{{ route('admin.students') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Students
                    </a>
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('admin.students') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Student List
                </a>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl max-h-full p-4">
            <div class="relative bg-white rounded-lg shadow-2xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900"></h3>
                    <button type="button" onclick="closeImageModal()"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-4">
                    <img id="modalImage" src="" alt=""
                        class="max-w-full max-h-96 mx-auto rounded-lg shadow-sm">
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end p-4 border-t border-gray-200">
                    <button type="button" onclick="closeImageModal()"
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Modal -->
    <div id="emailModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-2xl w-full mx-4">
            <div class="relative bg-white rounded-lg shadow-2xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Send Email to Student
                    </h3>
                    <button type="button" onclick="closeEmailModal()"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form id="emailForm" method="POST">
                        @csrf
                        <input type="hidden" id="student_id" name="student_id">

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Recipient</label>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div id="studentName" class="font-medium text-gray-900"></div>
                                        <div id="studentEmail" class="text-sm text-gray-600"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="emailSubject" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="emailSubject" name="subject" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter email subject">
                        </div>

                        <div class="mb-6">
                            <label for="emailMessage" class="block text-sm font-medium text-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea id="emailMessage" name="message" rows="6" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter your message here..."></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeEmailModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Send Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc, title) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');

            modalImage.src = imageSrc;
            modalImage.alt = title;
            modalTitle.textContent = title;
            modal.classList.remove('hidden');

            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');

            // Restore body scroll
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the modal content
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
                closeEmailModal();
            }
        });

        // Email Modal Functions
        function openEmailModal(studentId, studentName, studentEmail) {
            const modal = document.getElementById('emailModal');
            const form = document.getElementById('emailForm');
            const studentIdInput = document.getElementById('student_id');
            const studentNameDiv = document.getElementById('studentName');
            const studentEmailDiv = document.getElementById('studentEmail');
            const subjectInput = document.getElementById('emailSubject');
            const messageInput = document.getElementById('emailMessage');

            // Set form action based on current route
            const currentPath = window.location.pathname;
            if (currentPath.includes('/provost/')) {
                form.action = '{{ route('provost.email.send-individual') }}';
            } else if (currentPath.includes('/co-provost/')) {
                form.action = '{{ route('co-provost.email.send-individual') }}';
            } else {
                form.action = '{{ route('admin.email.send-individual') }}';
            }

            // Populate form data
            studentIdInput.value = studentId;
            studentNameDiv.textContent = studentName;
            studentEmailDiv.textContent = studentEmail;
            subjectInput.value = '';
            messageInput.value = '';

            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEmailModal() {
            const modal = document.getElementById('emailModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close email modal when clicking outside
        document.getElementById('emailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEmailModal();
            }
        });

        // Handle form submission
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML =
                '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>Sending...';
            submitBtn.disabled = true;

            // Submit form
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showNotification('Email sent successfully!', 'success');
                        closeEmailModal();
                    } else {
                        // Show error message
                        showNotification(data.message || 'Failed to send email. Please try again.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                })
                .finally(() => {
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });

        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    ${message}
                </div>
            `;

            document.body.appendChild(notification);

            // Remove notification after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
    </script>

@endsection

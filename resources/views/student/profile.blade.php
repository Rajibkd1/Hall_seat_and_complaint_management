@extends('layouts.app')

@section('title', 'Student Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/student_profile_professional.css') }}">
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Professional Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-1">Student Profile</h1>
                                <p class="text-gray-600">Manage your personal information and academic details</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <!-- Upload ID Card Button -->
                            <button id="uploadIdCardBtn"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                Upload ID Card
                            </button>

                            <!-- Edit Profile Button -->
                            <a href="{{ route('student.profile.edit') }}"
                                class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile Completion Status -->
                @if (!$student->is_active || !$student->profile_completed)
                    <div class="px-8 py-4 bg-yellow-50 border-b border-yellow-200">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-yellow-800">
                                    @if (!$student->profile_completed)
                                        Profile Incomplete
                                    @elseif(!$student->is_active)
                                        Account Pending Activation
                                    @endif
                                </h3>
                                <p class="text-sm text-yellow-700 mt-1">
                                    @if (!$student->profile_completed)
                                        Please complete your profile by uploading your profile image, mobile number, and ID
                                        card images to activate your account.
                                    @elseif(!$student->is_active)
                                        Your profile is complete! Your account activation request has been sent to the
                                        administration. You will receive an email notification once your account is
                                        activated.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Profile Information - Main Content -->
                <div class="lg:col-span-3">
                    <!-- Personal Information Section -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Student Name -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-900 font-medium">{{ $student->name }}</span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- University ID -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        University ID <span class="text-red-500">*</span>
                                    </label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-900 font-medium">{{ $student->university_id }}</span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Email Address
                                    </label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-700">{{ $student->email }}</span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-900 font-medium">{{ $student->phone }}</span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Department -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Department <span class="text-red-500">*</span>
                                    </label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-900 font-medium">{{ $student->department }}</span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Session Year -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 uppercase tracking-wide">
                                        Session Year <span class="text-red-500">*</span>
                                    </label>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-900 font-medium">{{ $student->session_year }}</span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hall Seat and Profile Status Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Hall Seat Information -->
                        @if ($seatAllotment)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900">Hall Seat</h3>
                                        </div>
                                        @if ($seatAllotment->canApplyForRenewal())
                                            <a href="{{ route('student.seat_application') }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                                Renew Seat
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        <!-- Seat Details -->
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-700">Room:</span>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ $seatAllotment->seat->room_number }}</span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-700">Bed:</span>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ $seatAllotment->seat->bed_number }}</span>
                                                </div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-700">Floor:</span>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ $seatAllotment->seat->floor }}</span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-700">Block:</span>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ $seatAllotment->seat->block }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Allocation Period -->
                                        <div class="border-t pt-4">
                                            <div class="space-y-2">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-700">Allocated:</span>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($seatAllotment->start_date)->format('M d, Y') }}</span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm font-medium text-gray-700">Expires:</span>
                                                    <span
                                                        class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($seatAllotment->allocation_expiry_date)->format('M d, Y') }}</span>
                                                </div>
                                                @if ($seatAllotment->remaining_days !== null)
                                                    <div class="flex justify-between items-center">
                                                        <span class="text-sm font-medium text-gray-700">Remaining:</span>
                                                        @if ($seatAllotment->remaining_days > 0)
                                                            <span id="countdown-timer"
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                                @if ($seatAllotment->remaining_days <= 30) bg-red-100 text-red-800
                                                                @elseif($seatAllotment->remaining_days <= 60) bg-yellow-100 text-yellow-800
                                                                @else bg-green-100 text-green-800 @endif">
                                                                @if ($seatAllotment->remaining_days >= 30)
                                                                    {{ floor($seatAllotment->remaining_days / 30) }}
                                                                    month{{ floor($seatAllotment->remaining_days / 30) > 1 ? 's' : '' }}
                                                                    {{ $seatAllotment->remaining_days % 30 }}
                                                                    day{{ $seatAllotment->remaining_days % 30 !== 1 ? 's' : '' }}
                                                                    left
                                                                @else
                                                                    {{ $seatAllotment->remaining_days }}
                                                                    day{{ $seatAllotment->remaining_days !== 1 ? 's' : '' }}
                                                                    left
                                                                @endif
                                                            </span>
                                                        @else
                                                            <span id="countdown-timer"
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                Expired
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Renewal Status -->
                                        @if ($seatAllotment->renewal_required)
                                            <div class="border-t pt-4">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm font-medium text-gray-700">Renewal Status:</span>
                                                    @if ($seatAllotment->canApplyForRenewal())
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Renewal Required
                                                        </span>
                                                        @if (
                                                            $seatAllotment->reminder_29_days_sent ||
                                                                $seatAllotment->reminder_20_days_sent ||
                                                                $seatAllotment->reminder_10_days_sent)
                                                            <div
                                                                class="mt-2 p-2 bg-blue-50 border border-blue-200 rounded-md">
                                                                <p class="text-xs text-blue-700 mb-1">
                                                                    <i class="fas fa-envelope mr-1"></i>
                                                                    Renewal reminder emails sent:
                                                                </p>
                                                                <div class="text-xs text-blue-600">
                                                                    @if ($seatAllotment->reminder_29_days_sent)
                                                                        <span class="inline-block mr-2">✓ 29 days</span>
                                                                    @endif
                                                                    @if ($seatAllotment->reminder_20_days_sent)
                                                                        <span class="inline-block mr-2">✓ 20 days</span>
                                                                    @endif
                                                                    @if ($seatAllotment->reminder_10_days_sent)
                                                                        <span class="inline-block mr-2">✓ 10 days</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @elseif($seatAllotment->isExpired())
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Expired
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            Active
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900">Hall Seat</h3>
                                    </div>
                                </div>
                                <div class="p-8 text-center">
                                    <div
                                        class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">No seat assigned</p>
                                    <p class="text-xs text-gray-500">Apply for a seat</p>
                                </div>
                            </div>
                        @endif

                        <!-- Profile Stats -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Profile Status</h3>
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Completion</span>
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-gray-600 rounded-full"
                                                style="width: {{ $profileCompletion ?? 75 }}%"></div>
                                        </div>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $profileCompletion ?? 75 }}%</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-3">
                                    <div class="text-center p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $student->created_at->format('M Y') }}</div>
                                        <div class="text-xs text-gray-600">Member Since</div>
                                    </div>
                                    <div class="text-center p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $student->updated_at->diffForHumans() }}</div>
                                        <div class="text-xs text-gray-600">Last Updated</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professional Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Picture -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Profile Picture</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <img src="{{ $student->profile_image_url }}" alt="Profile Picture"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 mx-auto">
                                <p class="mt-4 text-sm text-gray-600 font-medium">{{ $student->name }}</p>
                                <p class="text-xs text-gray-500">{{ $student->university_id }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- University ID Cards -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">ID Card</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- ID Card Images -->
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Front ID Card -->
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-700">Front Side</span>
                                        @if ($student->id_card_front)
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Uploaded
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Missing
                                            </span>
                                        @endif
                                    </div>
                                    @if ($student->id_card_front)
                                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/' . $student->id_card_front) }}"
                                                alt="ID Card Front"
                                                class="w-full h-32 object-contain bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors"
                                                onclick="openImageModal('{{ asset('storage/' . $student->id_card_front) }}', 'ID Card Front')">
                                        </div>
                                    @else
                                        <div
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50">
                                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-sm text-gray-500">No front image uploaded</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Back ID Card -->
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-700">Back Side</span>
                                        @if ($student->id_card_back)
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Uploaded
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Missing
                                            </span>
                                        @endif
                                    </div>
                                    @if ($student->id_card_back)
                                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/' . $student->id_card_back) }}"
                                                alt="ID Card Back"
                                                class="w-full h-32 object-contain bg-gray-50 cursor-pointer hover:bg-gray-100 transition-colors"
                                                onclick="openImageModal('{{ asset('storage/' . $student->id_card_back) }}', 'ID Card Back')">
                                        </div>
                                    @else
                                        <div
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50">
                                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-sm text-gray-500">No back image uploaded</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 hidden">
        <div class="relative max-w-4xl max-h-full p-4">
            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white hover:text-gray-300 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <img id="modalImage" class="max-w-full max-h-full object-contain" alt="ID Card">
            <p id="modalTitle" class="text-white text-center mt-4 text-lg font-medium"></p>
        </div>
    </div>

    <!-- Upload Modal -->
    @include('student.dual_upload_modal')

    <div id="notificationContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <script>
        // Image modal functions
        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Upload ID Card button handler
        document.getElementById('uploadIdCardBtn').addEventListener('click', function() {
            showUploadModal();
        });

        // Real-time countdown timer for seat allocation
        @if ($seatAllotment && $seatAllotment->allocation_expiry_date)
            function updateCountdown() {
                const expiryDate = new Date('{{ $seatAllotment->allocation_expiry_date }}');
                const now = new Date();
                const timeLeft = expiryDate - now;

                if (timeLeft > 0) {
                    const totalDays = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const months = Math.floor(totalDays / 30);
                    const days = totalDays % 30;

                    // Update the countdown display
                    const countdownElement = document.getElementById('countdown-timer');
                    if (countdownElement) {
                        if (months > 0) {
                            countdownElement.innerHTML =
                                `${months} month${months > 1 ? 's' : ''} ${days} day${days !== 1 ? 's' : ''} left`;
                        } else {
                            countdownElement.innerHTML = `${days} day${days !== 1 ? 's' : ''} left`;
                        }

                        // Update color based on urgency
                        countdownElement.className =
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' +
                            (totalDays <= 30 ? 'bg-red-100 text-red-800' :
                                totalDays <= 60 ? 'bg-yellow-100 text-yellow-800' :
                                'bg-green-100 text-green-800');
                    }
                } else {
                    // Expired
                    const countdownElement = document.getElementById('countdown-timer');
                    if (countdownElement) {
                        countdownElement.innerHTML = 'Expired';
                        countdownElement.className =
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';
                    }
                }
            }

            // Update countdown every day
            updateCountdown();
            setInterval(updateCountdown, 86400000); // 24 hours
        @endif
    </script>
    </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/student_profile.js') }}"></script>
@endpush

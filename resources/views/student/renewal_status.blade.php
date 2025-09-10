@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Header Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Seat Renewal Status</h1>
                        <p class="text-gray-600">Track your seat renewal applications</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('student.seat_renewal') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            New Renewal Application
                        </a>
                        <a href="{{ route('student.dashboard') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            @if ($renewalApplications->count() > 0)
                <!-- Applications List -->
                <div class="space-y-6">
                    @foreach ($renewalApplications as $application)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <!-- Application Header -->
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Renewal Application #{{ $application->renewal_id }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            Submitted on {{ $application->submission_date->format('F d, Y \a\t g:i A') }}
                                        </p>
                                    </div>
                                    <div>
                                        @if ($application->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Pending Review
                                            </span>
                                        @elseif($application->status === 'approved')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Approved
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Rejected
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Application Details -->
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Seat Information -->
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Seat Information</h4>
                                        <div class="space-y-2 text-sm text-gray-600">
                                            <p><span class="font-medium">Location:</span>
                                                {{ $application->allotment->seat->floor }} Floor,
                                                {{ $application->allotment->seat->block }} Block</p>
                                            <p><span class="font-medium">Room:</span>
                                                {{ $application->allotment->seat->room_number }}, Bed
                                                {{ $application->allotment->seat->bed_number }}</p>
                                            <p><span class="font-medium">Allocation Period:</span>
                                                {{ \Carbon\Carbon::parse($application->allotment->start_date)->format('M d, Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($application->allotment->allocation_expiry_date)->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Application Details -->
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Application Details</h4>
                                        <div class="space-y-2 text-sm text-gray-600">
                                            <p><span class="font-medium">Current Semesters:</span>
                                                {{ $application->current_semesters }}</p>
                                            <p><span class="font-medium">Last Semester CGPA:</span>
                                                {{ $application->last_semester_cgpa }}</p>
                                            @if ($application->result_file_path)
                                                <p><span class="font-medium">Result File:</span>
                                                    <a href="{{ Storage::url($application->result_file_path) }}"
                                                        target="_blank"
                                                        class="text-blue-600 hover:text-blue-800 underline">View File</a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($application->additional_comments)
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-900 mb-2">Additional Comments</h4>
                                        <p class="text-sm text-gray-600">{{ $application->additional_comments }}</p>
                                    </div>
                                @endif

                                @if ($application->status !== 'pending' && $application->reviewed_at)
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-900 mb-2">Review Information</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                            <p><span class="font-medium">Reviewed By:</span>
                                                {{ $application->reviewer->name ?? 'Hall Administration' }}</p>
                                            <p><span class="font-medium">Reviewed On:</span>
                                                {{ $application->reviewed_at->format('F d, Y \a\t g:i A') }}</p>
                                        </div>
                                        @if ($application->admin_notes)
                                            <div class="mt-3">
                                                <p class="font-medium text-gray-900">Admin Notes:</p>
                                                <p class="text-sm text-gray-600 mt-1">{{ $application->admin_notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Applications -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Renewal Applications</h3>
                    <p class="text-gray-600 mb-6">You haven't submitted any seat renewal applications yet.</p>
                    <a href="{{ route('student.seat_renewal') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Submit New Application
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

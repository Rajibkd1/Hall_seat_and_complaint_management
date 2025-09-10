@include('layouts.admin_layout_helper')
@extends($layout)

@section('title', 'Account Requests')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_students.css') }}">
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-1">Account Requests</h1>
                                <p class="text-gray-600">Review and activate student accounts with completed profiles</p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            @if (auth()->guard('admin')->user()->role === 'Provost')
                                <a href="{{ route('provost.students') }}"
                                    class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Back to Students
                                </a>
                            @elseif(auth()->guard('admin')->user()->role === 'Co-Provost')
                                <a href="{{ route('co-provost.students') }}"
                                    class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Back to Students
                                </a>
                            @else
                                <a href="{{ route('admin.students') }}"
                                    class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Back to Students
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Requests List -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Pending Account Activations</h2>
                            <p class="text-sm text-gray-600 mt-1">{{ $students->count() }} students waiting for account
                                activation</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button id="listViewBtn"
                                class="px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16"></path>
                                </svg>
                                List View
                            </button>
                            <button id="detailViewBtn"
                                class="px-3 py-2 text-sm font-medium text-gray-600 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                Detail View
                            </button>
                        </div>
                    </div>
                </div>

                @if ($students->count() > 0)
                    <!-- List View -->
                    <div id="listView" class="p-8">
                        <div class="space-y-4">
                            @foreach ($students as $student)
                                <div
                                    class="bg-gray-50 rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                @if ($student->profile_image)
                                                    <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200"
                                                        src="{{ $student->profile_image_url }}" alt="{{ $student->name }}">
                                                @else
                                                    <div
                                                        class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center border-2 border-gray-200">
                                                        <svg class="h-6 w-6 text-gray-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-4">
                                                    <div>
                                                        <h3 class="text-lg font-semibold text-gray-900">{{ $student->name }}
                                                        </h3>
                                                        <p class="text-sm text-gray-600">{{ $student->email }}</p>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <span class="font-medium">ID:</span> {{ $student->university_id }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <span class="font-medium">Dept:</span> {{ $student->department }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <span class="font-medium">Session:</span>
                                                        {{ $student->session_year }}
                                                    </div>
                                                </div>
                                                <div class="flex items-center mt-2">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Profile Completed
                                                    </span>
                                                    <span class="ml-3 text-xs text-gray-500">
                                                        @if ($student->profile_completed_at && is_object($student->profile_completed_at))
                                                            {{ $student->profile_completed_at->format('M d, Y H:i') }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            @if (auth()->guard('admin')->user()->role === 'Provost')
                                                <a href="{{ route('provost.account.request.detail', $student->student_id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View
                                                </a>
                                            @elseif(auth()->guard('admin')->user()->role === 'Co-Provost')
                                                <a href="{{ route('co-provost.account.request.detail', $student->student_id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View
                                                </a>
                                            @else
                                                <a href="{{ route('admin.account.request.detail', $student->student_id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View
                                                </a>
                                            @endif
                                            @if (auth()->guard('admin')->user()->role === 'Provost')
                                                <form method="POST"
                                                    action="{{ route('provost.activate.account', $student->student_id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Activate
                                                    </button>
                                                </form>
                                            @elseif(auth()->guard('admin')->user()->role === 'Co-Provost')
                                                <form method="POST"
                                                    action="{{ route('co-provost.activate.account', $student->student_id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Activate
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST"
                                                    action="{{ route('admin.activate.account', $student->student_id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Activate
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                                    <!-- Student Header -->
                                    <div class="flex items-start justify-between mb-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                @if ($student->profile_image)
                                                    <img class="h-16 w-16 rounded-full object-cover border-2 border-gray-200"
                                                        src="{{ $student->profile_image_url }}"
                                                        alt="{{ $student->name }}">
                                                @else
                                                    <div
                                                        class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center border-2 border-gray-200">
                                                        <svg class="h-8 w-8 text-gray-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-semibold text-gray-900">{{ $student->name }}</h3>
                                                <p class="text-sm text-gray-600">{{ $student->email }}</p>
                                                <div class="flex items-center mt-2">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Profile Completed
                                                    </span>
                                                    <span class="ml-3 text-xs text-gray-500">
                                                        @if ($student->profile_completed_at && is_object($student->profile_completed_at))
                                                            {{ $student->profile_completed_at->format('M d, Y H:i') }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex space-x-3">
                                            @if (auth()->guard('admin')->user()->role === 'Provost')
                                                <a href="{{ route('provost.student.profile', $student->student_id) }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View Full Profile
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('provost.activate.account', $student->student_id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Activate Account
                                                    </button>
                                                </form>
                                            @elseif(auth()->guard('admin')->user()->role === 'Co-Provost')
                                                <a href="{{ route('co-provost.student.profile', $student->student_id) }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View Full Profile
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('co-provost.activate.account', $student->student_id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Activate Account
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('admin.student.profile', $student->student_id) }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View Full Profile
                                                </a>
                                                <form method="POST"
                                                    action="{{ route('admin.activate.account', $student->student_id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to activate this account?')">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Activate Account
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Student Information Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <!-- Basic Information -->
                                        <div class="space-y-4">
                                            <h4
                                                class="text-sm font-semibold text-gray-900 uppercase tracking-wide border-b border-gray-200 pb-2">
                                                Basic Information</h4>
                                            <div class="space-y-3">
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">University
                                                        ID</label>
                                                    <p class="text-sm text-gray-900 font-medium">
                                                        {{ $student->university_id }}</p>
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Phone
                                                        Number</label>
                                                    <p class="text-sm text-gray-900">{{ $student->phone }}</p>
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Department</label>
                                                    <p class="text-sm text-gray-900">{{ $student->department }}</p>
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Session
                                                        Year</label>
                                                    <p class="text-sm text-gray-900">{{ $student->session_year }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Address Information -->
                                        <div class="space-y-4">
                                            <h4
                                                class="text-sm font-semibold text-gray-900 uppercase tracking-wide border-b border-gray-200 pb-2">
                                                Address Information</h4>
                                            <div class="space-y-3">
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Current
                                                        Address</label>
                                                    <p class="text-sm text-gray-900">
                                                        {{ $student->current_address ?? 'Not provided' }}</p>
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Permanent
                                                        Address</label>
                                                    <p class="text-sm text-gray-900">
                                                        {{ $student->permanent_address ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Guardian Information -->
                                        <div class="space-y-4">
                                            <h4
                                                class="text-sm font-semibold text-gray-900 uppercase tracking-wide border-b border-gray-200 pb-2">
                                                Guardian Information</h4>
                                            <div class="space-y-3">
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Father's
                                                        Name</label>
                                                    <p class="text-sm text-gray-900">
                                                        {{ $student->father_name ?? 'Not provided' }}</p>
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Mother's
                                                        Name</label>
                                                    <p class="text-sm text-gray-900">
                                                        {{ $student->mother_name ?? 'Not provided' }}</p>
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-xs font-medium text-gray-500 uppercase tracking-wide">Guardian
                                                        Contact</label>
                                                    <p class="text-sm text-gray-900">
                                                        {{ $student->guardian_contact ?? 'Not provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ID Card Images -->
                                    <div class="mt-8">
                                        <h4
                                            class="text-sm font-semibold text-gray-900 uppercase tracking-wide border-b border-gray-200 pb-2 mb-4">
                                            ID Card Images</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Front ID Card -->
                                            <div>
                                                <label
                                                    class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2 block">Front
                                                    Side</label>
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
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                        <p class="text-sm text-gray-500">No front image uploaded</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Back ID Card -->
                                            <div>
                                                <label
                                                    class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2 block">Back
                                                    Side</label>
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
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
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
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Account Requests</h3>
                        <p class="text-gray-500">There are no students waiting for account activation at the moment.</p>
                    </div>
                @endif
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
@endsection

@push('scripts')
    <script>
        // View toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const listViewBtn = document.getElementById('listViewBtn');
            const detailViewBtn = document.getElementById('detailViewBtn');
            const listView = document.getElementById('listView');
            const detailView = document.getElementById('detailView');

            listViewBtn.addEventListener('click', function() {
                listView.classList.remove('hidden');
                detailView.classList.add('hidden');
                listViewBtn.classList.add('text-blue-600', 'bg-blue-50');
                listViewBtn.classList.remove('text-gray-600', 'bg-gray-50');
                detailViewBtn.classList.add('text-gray-600', 'bg-gray-50');
                detailViewBtn.classList.remove('text-blue-600', 'bg-blue-50');
            });

            detailViewBtn.addEventListener('click', function() {
                detailView.classList.remove('hidden');
                listView.classList.add('hidden');
                detailViewBtn.classList.add('text-blue-600', 'bg-blue-50');
                detailViewBtn.classList.remove('text-gray-600', 'bg-gray-50');
                listViewBtn.classList.add('text-gray-600', 'bg-gray-50');
                listViewBtn.classList.remove('text-blue-600', 'bg-blue-50');
            });
            // Toggle individual student details
            window.toggleStudentDetails = function(studentId) {
                console.log('toggleStudentDetails called with ID:', studentId);

                // Hide list view
                const listView = document.getElementById('listView');
                if (listView) {
                    listView.classList.add('hidden');
                }

                // Show detail view
                const detailView = document.getElementById('detailView');
                if (detailView) {
                    detailView.classList.remove('hidden');
                }

                // Hide all student details first
                const allStudentDetails = document.querySelectorAll('[id^="student-"]');
                console.log('Found student details:', allStudentDetails.length);
                allStudentDetails.forEach(function(element) {
                    element.classList.add('hidden');
                });

                // Show the selected student detail
                const studentDetail = document.getElementById('student-' + studentId);
                console.log('Student detail element:', studentDetail);
                if (studentDetail) {
                    studentDetail.classList.remove('hidden');
                    console.log('Showing student detail for ID:', studentId);
                } else {
                    console.error('Student detail not found for ID:', studentId);
                }

                // Update button states
                const detailViewBtn = document.getElementById('detailViewBtn');
                const listViewBtn = document.getElementById('listViewBtn');

                if (detailViewBtn) {
                    detailViewBtn.classList.add('text-blue-600', 'bg-blue-50');
                    detailViewBtn.classList.remove('text-gray-600', 'bg-gray-50');
                }
                if (listViewBtn) {
                    listViewBtn.classList.add('text-gray-600', 'bg-gray-50');
                    listViewBtn.classList.remove('text-blue-600', 'bg-blue-50');
                }
            };
        });

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
    </script>
@endpush

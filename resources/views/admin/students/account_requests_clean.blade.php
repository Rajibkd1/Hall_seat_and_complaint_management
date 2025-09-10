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
                    <h2 class="text-lg font-semibold text-gray-900">Pending Account Activations</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ $students->count() }} students waiting for account activation
                    </p>
                </div>

                @if ($students->count() > 0)
                    <div class="p-8">
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
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
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
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View
                                                </a>
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
                                                <a href="{{ route('co-provost.account.request.detail', $student->student_id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View
                                                </a>
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
                                                <a href="{{ route('admin.account.request.detail', $student->student_id) }}"
                                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    View
                                                </a>
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
@endsection

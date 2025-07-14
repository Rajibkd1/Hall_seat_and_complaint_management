@extends('layouts.admin_app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header with Breadcrumb -->
        <div class="mb-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
                <a href="{{ route('admin.complaints') }}" class="hover:text-blue-600 transition-colors duration-200">Complaints</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium">Complaint Details</span>
            </nav>
            <h1 class="text-4xl font-bold text-gray-800">Complaint Management</h1>
        </div>

        @if($complaint)
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Complaint Details Card -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden complaint-card">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-700 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-white">Complaint #{{ $complaint->complaint_id }}</h2>
                                <p class="text-blue-100 text-sm">{{ $complaint->complaint_type }}</p>
                            </div>
                            @php
                                $statusConfig = [
                                    'pending' => ['bg' => 'bg-orange-500', 'text' => 'text-white', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    'in_progress' => ['bg' => 'bg-blue-500', 'text' => 'text-white', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                    'resolved' => ['bg' => 'bg-green-500', 'text' => 'text-white', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                                ];
                                $config = $statusConfig[$complaint->status] ?? $statusConfig['pending'];
                            @endphp
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $config['bg'] }} {{ $config['text'] }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
                                    </svg>
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Student Information -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Student Information
                            </h3>
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
                                    @if($complaint->student && $complaint->student->profile_image)
                                        <img src="{{ asset('storage/' . $complaint->student->profile_image) }}" alt="{{ $complaint->student->name }}'s profile image" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-600 font-medium text-lg">{{ $complaint->student ? substr($complaint->student->name, 0, 1) : 'N' }}</span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <p class="text-lg font-medium text-gray-900">{{ $complaint->student->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">{{ $complaint->student->student_id ?? 'Unknown ID' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Complaint Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-4">
                                <div class="detail-item">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-600">Complaint ID</span>
                                    </div>
                                    <p class="text-gray-900 font-medium">{{ $complaint->complaint_id }}</p>
                                </div>

                                <div class="detail-item">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-600">Complaint Type</span>
                                    </div>
                                    <span class="inline-flex px-3 py-1 text-sm font-medium bg-gray-100 text-gray-800 rounded-full">
                                        {{ $complaint->complaint_type }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="detail-item">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-600">Submission Date</span>
                                    </div>
                                    <div>
                                        <p class="text-gray-900 font-medium">{{ $complaint->submission_date->format('M d, Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ $complaint->submission_date->format('h:i A') }}</p>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-600">Time Elapsed</span>
                                    </div>
                                    <p class="text-gray-900 font-medium">{{ $complaint->submission_date->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Description
                            </h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed">{{ $complaint->description }}</p>
                            </div>
                        </div>

                        <!-- Admin Comment (if exists) -->
                        @if($complaint->admin_comment)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Admin Response
                            </h3>
                            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed">{{ $complaint->admin_comment }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status Update Sidebar -->
            <div class="space-y-6">
                <!-- Status Update Form -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 update-form">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Update Status
                    </h3>
                    
                    <form action="{{ route('admin.complaint.update_status', $complaint->complaint_id) }}" method="POST" id="statusForm">
                        @csrf
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">New Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </div>
                        
                        <div class="mb-6">
                            <label for="admin_comment" class="block text-sm font-medium text-gray-700 mb-2">Admin Comment</label>
                            <textarea name="admin_comment" id="admin_comment" rows="4" 
                                      placeholder="Add your response or comment here..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none">{{ $complaint->admin_comment }}</textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @else
        <!-- Error State -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Complaint Not Found</h3>
            <p class="text-gray-600 mb-6">The complaint you're looking for doesn't exist or has been removed.</p>
            <a href="{{ route('admin.complaints') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Complaints
            </a>
        </div>
        @endif

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('admin.complaints') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Complaint List
            </a>
        </div>
    </div>
</div>




@endsection

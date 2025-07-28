@extends('layouts.admin_app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section with Admin Info -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 border border-gray-100">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between">
                    <div class="flex items-center space-x-4 mb-4 lg:mb-0">
                        <!-- Profile Picture Placeholder -->
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-shield text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Welcome back, {{ $admin->name }}!</h1>
                            <p class="text-gray-600 flex items-center mt-1">
                                <i class="fas fa-envelope text-blue-500 mr-2"></i>
                                {{ $admin->email }}
                            </p>
                            {{-- <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-clock text-green-500 mr-2"></i>
                                Last login: {{ $admin->updated_at->format('M d, Y - h:i A') }}
                            </p> --}}
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <button
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                            <i class="fas fa-cog mr-2"></i>
                            Settings
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 flex items-center">
                            <i class="fas fa-bell mr-2"></i>
                            Notifications
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Students Card -->
                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Total Students</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalStudents) }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +{{ $recentStudents }} this week
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Applications Card -->
                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Applications</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalApplications) }}</p>
                            <p class="text-sm text-orange-600 mt-1">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $pendingApplications }} pending
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Complaints Card -->
                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Complaints</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalComplaints) }}</p>
                            <p class="text-sm text-red-600 mt-1">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $pendingComplaints }} pending
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Notices Card -->
                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-gray-600 uppercase tracking-wider">Notices</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalNotices) }}</p>
                            <p class="text-sm text-purple-600 mt-1">
                                <i class="fas fa-eye mr-1"></i>
                                {{ $activeNotices }} active
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bullhorn text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-bolt text-yellow-600 mr-3"></i>
                    Quick Actions
                </h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.notices.create') }}"
                        class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 text-center">
                        <i class="fas fa-plus mr-2"></i>
                        Create Notice
                    </a>
                    <a href="{{ route('admin.students') }}"
                        class="flex items-center justify-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 text-center">
                        <i class="fas fa-users mr-2"></i>
                        Manage Students
                    </a>
                    <a href="{{ route('admin.complaints') }}"
                        class="flex items-center justify-center p-4 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 transform hover:scale-105 text-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Review Complaints
                    </a>
                    <a href="{{ route('admin.applications.index') }}"
                        class="flex items-center justify-center p-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105 text-center">
                        <i class="fas fa-file-alt mr-2"></i>
                        Review Applications
                    </a>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8 mb-8">
                <!-- Recent Notices -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-bullhorn text-purple-600 mr-3"></i>
                            Recent Notices
                        </h2>
                        <a href="{{ route('admin.notices') }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div class="space-y-4 max-h-[300px] overflow-y-auto">
                        @forelse($recentNotices as $notice)
                            <div
                                class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $notice->title }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $notice->date_posted->format('M d, Y') }} •
                                        <span class="capitalize">{{ $notice->notice_type }}</span>
                                    </p>
                                </div>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                {{ $notice->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($notice->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No recent notices</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Complaints -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                            Recent Complaints
                        </h2>
                        <a href="{{ route('admin.complaints') }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div class="space-y-4 max-h-[300px] overflow-y-auto">
                        @forelse($recentComplaints as $complaint)
                            <div
                                class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                <div class="w-2 h-2 bg-red-500 rounded-full mt-2 flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $complaint->subject }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        By {{ $complaint->student->name ?? 'Unknown' }} •
                                        {{ $complaint->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                {{ $complaint->status === 'pending'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : ($complaint->status === 'resolved'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-blue-100 text-blue-800') }}">
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No recent complaints</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Applications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-alt text-green-600 mr-3"></i>
                        Recent Applications
                    </h2>
                    <a href="{{ route('admin.applications.index') }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="overflow-x-auto max-h-[300px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="hidden lg:table-header-group bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Student</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Application Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentApplications as $application)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <!-- Desktop/Tablet View -->
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                                                <img src="{{ $application->student->profile_image_url }}" alt="{{ $application->student->name ?? 'Unknown' }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $application->student->name ?? 'Unknown' }}</p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $application->student->student_id ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4 text-sm text-gray-500">
                                        {{ $application->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $application->status === 'pending'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : ($application->status === 'approved'
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4 text-sm font-medium text-right lg:text-left">
                                        <a href="{{ route('admin.applications.view', $application->application_id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            View Details
                                        </a>
                                    </td>

                                    <!-- Mobile View -->
                                    <td class="block lg:hidden p-4">
                                        <div class="flex items-center justify-between text-sm flex-nowrap">
                                            <!-- Student Name/Icon -->
                                            <div class="flex items-center space-x-1 flex-shrink-0 min-w-0">
                                                <div class="w-7 h-7 rounded-full overflow-hidden flex-shrink-0">
                                                    <img src="{{ $application->student->profile_image_url }}" alt="{{ $application->student->name ?? 'Unknown' }}" class="w-full h-full object-cover">
                                                </div>
                                                <span class="font-medium text-gray-900 text-xs truncate">{{ $application->student->name ?? 'Unknown' }}</span>
                                            </div>

                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <!-- Date Icon -->
                                                <i class="fas fa-calendar-alt text-gray-500 text-sm" title="{{ $application->created_at->format('M d, Y') }}"></i>

                                                <!-- Status Icon -->
                                                @php
                                                    $statusIcon = '';
                                                    $statusColor = '';
                                                    if ($application->status === 'pending') {
                                                        $statusIcon = 'fas fa-clock';
                                                        $statusColor = 'text-yellow-600';
                                                    } elseif ($application->status === 'approved') {
                                                        $statusIcon = 'fas fa-check-circle';
                                                        $statusColor = 'text-green-600';
                                                    } else {
                                                        $statusIcon = 'fas fa-times-circle';
                                                        $statusColor = 'text-red-600';
                                                    }
                                                @endphp
                                                <i class="{{ $statusIcon }} {{ $statusColor }} text-sm" title="{{ ucfirst($application->status) }}"></i>

                                                <!-- View Details Icon -->
                                                <a href="{{ route('admin.applications.view', $application->application_id) }}" class="text-blue-600 text-sm">
                                                    <i class="fas fa-arrow-right" title="View Details"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="hidden lg:table-cell px-6 py-4 text-center text-gray-500">No recent applications
                                    </td>
                                    <td class="block lg:hidden px-6 py-4 text-center text-gray-500">No recent applications
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

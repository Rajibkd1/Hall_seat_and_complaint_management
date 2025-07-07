@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <!-- Welcome Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 text-white">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative container mx-auto px-4 sm:px-6 py-8 sm:py-12">
            <div class="flex flex-col items-center text-center lg:flex-row lg:text-left lg:items-center lg:justify-between">
                <div class="flex-1 mb-6 lg:mb-0 lg:pr-8">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold mb-3 sm:mb-4 animate-fade-in leading-tight">
                        Welcome back,<br class="sm:hidden"> <span class="text-yellow-300">{{ $student->name }}</span>!
                    </h1>
                    <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 sm:gap-6 text-sm sm:text-base lg:text-lg opacity-90">
                        <div class="flex items-center justify-center lg:justify-start">
                            <i class="fas fa-id-card mr-2 text-yellow-300 flex-shrink-0"></i>
                            <span class="truncate">{{ $student->university_id }}</span>
                        </div>
                        <div class="flex items-center justify-center lg:justify-start">
                            <i class="fas fa-graduation-cap mr-2 text-yellow-300 flex-shrink-0"></i>
                            <span class="truncate">{{ $student->department }}</span>
                        </div>
                        <div class="flex items-center justify-center lg:justify-start">
                            <i class="fas fa-calendar mr-2 text-yellow-300 flex-shrink-0"></i>
                            <span>Session {{ $student->session_year }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div class="relative">
                        @if($student->profile_image)
                            <img src="{{ asset('storage/' . $student->profile_image) }}" 
                                 alt="Profile" class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 rounded-full border-4 border-white shadow-xl hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center border-4 border-white shadow-xl hover:scale-105 transition-transform duration-300">
                                <i class="fas fa-user text-2xl sm:text-3xl lg:text-4xl text-white"></i>
                            </div>
                        @endif
                        <div class="absolute -bottom-1 -right-1 sm:-bottom-2 sm:-right-2 w-6 h-6 sm:w-8 sm:h-8 bg-green-400 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-8 sm:h-16 bg-gradient-to-t from-white to-transparent"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 -mt-4 sm:-mt-8 relative z-10">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-8 sm:mb-12">
            <div class="stat-card bg-white rounded-xl sm:rounded-2xl shadow-xl p-3 sm:p-6 border-l-4 border-blue-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-2 sm:mb-0">
                        <p class="text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">Total</p>
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mt-1 sm:mt-2">{{ $stats['total_complaints'] }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-2 sm:p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-clipboard-list text-lg sm:text-xl lg:text-2xl text-blue-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-xl sm:rounded-2xl shadow-xl p-3 sm:p-6 border-l-4 border-yellow-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-2 sm:mb-0">
                        <p class="text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">Pending</p>
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mt-1 sm:mt-2">{{ $stats['pending_complaints'] }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-2 sm:p-3 bg-yellow-100 rounded-full">
                            <i class="fas fa-clock text-lg sm:text-xl lg:text-2xl text-yellow-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-xl sm:rounded-2xl shadow-xl p-3 sm:p-6 border-l-4 border-green-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-2 sm:mb-0">
                        <p class="text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">Resolved</p>
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mt-1 sm:mt-2">{{ $stats['resolved_complaints'] }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-2 sm:p-3 bg-green-100 rounded-full">
                            <i class="fas fa-check-circle text-lg sm:text-xl lg:text-2xl text-green-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white rounded-xl sm:rounded-2xl shadow-xl p-3 sm:p-6 border-l-4 border-purple-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-2 sm:mb-0">
                        <p class="text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">Notices</p>
                        <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mt-1 sm:mt-2">{{ $stats['recent_notices']->count() }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-2 sm:p-3 bg-purple-100 rounded-full">
                            <i class="fas fa-bell text-lg sm:text-xl lg:text-2xl text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl p-4 sm:p-6 lg:p-8 mb-8 sm:mb-12">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-2 sm:mr-3"></i>
                Quick Actions
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
                <a href="{{ route('student.create_complaint') }}" class="action-btn bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus-circle text-lg sm:text-xl lg:text-2xl mb-1 sm:mb-2"></i>
                    <p class="font-semibold text-xs sm:text-sm">Submit<br class="sm:hidden"> Complaint</p>
                </a>
                
                <a href="{{ route('student.complaint_list') }}" class="action-btn bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:from-indigo-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-list text-lg sm:text-xl lg:text-2xl mb-1 sm:mb-2"></i>
                    <p class="font-semibold text-xs sm:text-sm">View<br class="sm:hidden"> Complaints</p>
                </a>
                
                <a href="{{ route('student.track_complaint') }}" class="action-btn bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-search text-lg sm:text-xl lg:text-2xl mb-1 sm:mb-2"></i>
                    <p class="font-semibold text-xs sm:text-sm">Track<br class="sm:hidden"> Complaint</p>
                </a>
                
                <a href="{{ route('student.profile') }}" class="action-btn bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-user-edit text-lg sm:text-xl lg:text-2xl mb-1 sm:mb-2"></i>
                    <p class="font-semibold text-xs sm:text-sm">Update<br class="sm:hidden"> Profile</p>
                </a>
                
                <a href="{{ route('student.hall-notice') }}" class="action-btn bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-bullhorn text-lg sm:text-xl lg:text-2xl mb-1 sm:mb-2"></i>
                    <p class="font-semibold text-xs sm:text-sm">Hall<br class="sm:hidden"> Notices</p>
                </a>
                
                <form action="{{ route('student.logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="action-btn bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-4 text-center hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 shadow-lg w-full" onclick="return confirm('Are you sure you want to logout?')">
                        <i class="fas fa-sign-out-alt text-lg sm:text-xl lg:text-2xl mb-1 sm:mb-2"></i>
                        <p class="font-semibold text-xs sm:text-sm">Logout</p>
                    </button>
                </form>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="flex flex-col xl:grid xl:grid-cols-3 gap-6 sm:gap-8 mb-8 sm:mb-12">
            <!-- Recent Complaints -->
            <div class="xl:col-span-2 order-2 xl:order-1">
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-4 sm:p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg sm:text-xl font-bold flex items-center">
                                <i class="fas fa-history mr-2 sm:mr-3"></i>
                                <span class="hidden sm:inline">Recent Complaints</span>
                                <span class="sm:hidden">Complaints</span>
                            </h3>
                            <a href="{{ route('student.complaint_list') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-3 sm:px-4 py-1 sm:py-2 rounded-md sm:rounded-lg transition-all duration-300 text-sm">
                                View All
                            </a>
                        </div>
                    </div>
                    <div class="p-4 sm:p-6">
                        @if($recentComplaints->count() > 0)
                            <div class="space-y-3 sm:space-y-4">
                                @foreach($recentComplaints as $complaint)
                                    <div class="complaint-item bg-gray-50 rounded-lg sm:rounded-xl p-3 sm:p-4 hover:bg-gray-100 transition-all duration-300">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                            <div class="flex-1 mb-3 sm:mb-0 sm:pr-4">
                                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-3 mb-2">
                                                    <span class="font-mono text-xs sm:text-sm bg-blue-100 text-blue-800 px-2 sm:px-3 py-1 rounded-full mb-1 sm:mb-0 inline-block">
                                                        CM-{{ date('Y') }}-{{ str_pad($complaint->complaint_id, 3, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                    <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-semibold inline-block
                                                        @if($complaint->category == 'electrical') bg-yellow-100 text-yellow-800
                                                        @elseif($complaint->category == 'water') bg-blue-100 text-blue-800
                                                        @elseif($complaint->category == 'medical') bg-red-100 text-red-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        {{ ucfirst($complaint->category) }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ Str::limit($complaint->description, 60) }}</p>
                                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 text-xs text-gray-500 space-y-1 sm:space-y-0">
                                                    <span>{{ $complaint->submission_date->format('M d, Y') }}</span>
                                                    <span class="flex items-center">
                                                        @if($complaint->status == 'pending')
                                                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-1"></div>
                                                            Pending
                                                        @elseif($complaint->status == 'in_progress')
                                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-1"></div>
                                                            In Progress
                                                        @else
                                                            <div class="w-2 h-2 bg-green-400 rounded-full mr-1"></div>
                                                            Resolved
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-end sm:justify-center">
                                                <form action="{{ route('student.delete_complaint', $complaint) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all duration-300" onclick="return confirm('Are you sure you want to delete this complaint?')">
                                                        <i class="fas fa-trash text-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 sm:py-12">
                                <i class="fas fa-inbox text-4xl sm:text-6xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 text-base sm:text-lg mb-4">No complaints submitted yet</p>
                                <a href="{{ route('student.create_complaint') }}" class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 text-sm sm:text-base">
                                    <i class="fas fa-plus mr-2"></i>
                                    Submit Your First Complaint
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Notices -->
            <div class="xl:col-span-1 order-1 xl:order-2">
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl overflow-hidden h-full">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white p-4 sm:p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg sm:text-xl font-bold flex items-center">
                                <i class="fas fa-bell mr-2 sm:mr-3"></i>
                                <span class="hidden sm:inline">Recent Notices</span>
                                <span class="sm:hidden">Notices</span>
                            </h3>
                            <a href="{{ route('student.hall-notice') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-3 sm:px-4 py-1 sm:py-2 rounded-md sm:rounded-lg transition-all duration-300 text-sm">
                                View All
                            </a>
                        </div>
                    </div>
                    <div class="p-4 sm:p-6">
                        @if($stats['recent_notices']->count() > 0)
                            <div class="space-y-3 sm:space-y-4">
                                @foreach($stats['recent_notices'] as $notice)
                                    <div class="notice-item border-l-4 
                                        @if($notice->notice_type == 'announcement') border-blue-500 bg-blue-50
                                        @elseif($notice->notice_type == 'event') border-green-500 bg-green-50
                                        @else border-yellow-500 bg-yellow-50
                                        @endif
                                        p-3 sm:p-4 rounded-r-lg hover:shadow-md transition-all duration-300">
                                        <h4 class="font-semibold text-gray-900 mb-2 text-sm sm:text-base">
                                            <a href="{{ route('student.hall-notice.show', $notice->notice_id) }}" class="hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                                                {{ $notice->title }}
                                            </a>
                                        </h4>
                                        <p class="text-gray-600 text-xs sm:text-sm mb-2 line-clamp-3">{{ Str::limit($notice->description, 80) }}</p>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $notice->date_posted->format('M d, Y') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 sm:py-8">
                                <i class="fas fa-bell-slash text-3xl sm:text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 mb-4 text-sm sm:text-base">No recent notices</p>
                                <a href="{{ route('student.hall-notice') }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-300 text-sm">
                                    Check All Notices
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

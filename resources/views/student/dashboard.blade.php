@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30 relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400/10 to-indigo-400/10 rounded-full blur-3xl">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-emerald-400/10 to-teal-400/10 rounded-full blur-3xl">
            </div>
        </div>

        <!-- Welcome Section with Mobile-Optimized Student Details -->
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-800 via-slate-900 to-indigo-900">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 via-indigo-600/20 to-purple-600/20"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
                xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff"
                fill-opacity="0.03"%3E%3Cpath
                d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

            <div class="relative container mx-auto px-4 sm:px-6 py-12 sm:py-16">
                <div
                    class="flex flex-col items-center text-center lg:flex-row lg:text-left lg:items-center lg:justify-between">
                    <div class="flex-1 mb-8 lg:mb-0 lg:pr-8">
                        <div
                            class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm text-blue-200 mb-4 border border-white/20">
                            <i class="fas fa-sparkles mr-2"></i>
                            Student Dashboard
                        </div>
                        <h1
                            class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-light mb-4 sm:mb-6 animate-fade-in leading-tight">
                            Welcome back,<br class="sm:hidden">
                            <span
                                class="bg-gradient-to-r from-blue-200 to-indigo-200 bg-clip-text text-transparent font-medium">{{ $student->name }}</span>
                        </h1>

                        <!-- Student Details - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                        <div
                            class="hidden sm:flex flex-col sm:flex-row sm:flex-wrap gap-4 sm:gap-6 text-sm sm:text-base lg:text-lg">
                            <div
                                class="flex items-center justify-center lg:justify-start group bg-slate-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-slate-600/30 hover:bg-slate-700/50 transition-all duration-300">
                                <div
                                    class="p-2 bg-blue-500/20 rounded-lg mr-3 group-hover:bg-blue-500/30 transition-all duration-300">
                                    <i class="fas fa-id-card text-blue-200 flex-shrink-0"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-blue-200 uppercase tracking-wider mb-1">Student ID</p>
                                    <span class="text-white font-medium truncate">{{ $student->university_id }}</span>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-center lg:justify-start group bg-slate-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-slate-600/30 hover:bg-slate-700/50 transition-all duration-300">
                                <div
                                    class="p-2 bg-emerald-500/20 rounded-lg mr-3 group-hover:bg-emerald-500/30 transition-all duration-300">
                                    <i class="fas fa-graduation-cap text-emerald-200 flex-shrink-0"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-emerald-200 uppercase tracking-wider mb-1">Department</p>
                                    <span class="text-white font-medium truncate">{{ $student->department }}</span>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-center lg:justify-start group bg-slate-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-slate-600/30 hover:bg-slate-700/50 transition-all duration-300">
                                <div
                                    class="p-2 bg-indigo-500/20 rounded-lg mr-3 group-hover:bg-indigo-500/30 transition-all duration-300">
                                    <i class="fas fa-calendar text-indigo-200 flex-shrink-0"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-indigo-200 uppercase tracking-wider mb-1">Session</p>
                                    <span class="text-white font-medium">{{ $student->session_year }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Picture - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                    <div class="hidden sm:block flex-shrink-0">
                        <div class="relative group">
                            @if ($student->profile_image)
                                <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Profile"
                                    class="w-24 h-24 sm:w-28 sm:h-28 lg:w-36 lg:h-36 rounded-full border-4 border-white/30 shadow-2xl group-hover:scale-105 transition-all duration-500 backdrop-blur-sm">
                            @else
                                <div
                                    class="w-24 h-24 sm:w-28 sm:h-28 lg:w-36 lg:h-36 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30 shadow-2xl group-hover:scale-105 transition-all duration-500">
                                    <i class="fas fa-user text-3xl sm:text-4xl lg:text-5xl text-white/80"></i>
                                </div>
                            @endif
                            <div
                                class="absolute -bottom-2 -right-2 w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full border-4 border-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-all duration-300">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div
                                class="absolute inset-0 rounded-full bg-gradient-to-r from-blue-400/20 to-indigo-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-slate-50 to-transparent"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 -mt-8 relative z-10">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-12">
                <div
                    class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-blue-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total
                                Complaints</p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $stats['total_complaints'] }}</p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl group-hover:from-blue-500 group-hover:to-blue-600 transition-all duration-300">
                                <i
                                    class="fas fa-clipboard-list text-xl sm:text-2xl text-blue-600 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-amber-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-orange-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Pending
                            </p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-amber-600 transition-colors duration-300">
                                {{ $stats['pending_complaints'] }}</p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-amber-100 to-amber-50 rounded-xl group-hover:from-amber-500 group-hover:to-amber-600 transition-all duration-300">
                                <i
                                    class="fas fa-clock text-xl sm:text-2xl text-amber-600 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-emerald-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">
                                Resolved</p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors duration-300">
                                {{ $stats['resolved_complaints'] }}</p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl group-hover:from-emerald-500 group-hover:to-emerald-600 transition-all duration-300">
                                <i
                                    class="fas fa-check-circle text-xl sm:text-2xl text-emerald-600 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-indigo-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">New
                                Notices</p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300">
                                {{ $stats['recent_notices']->count() }}</p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-xl group-hover:from-indigo-500 group-hover:to-indigo-600 transition-all duration-300">
                                <i
                                    class="fas fa-bell text-xl sm:text-2xl text-indigo-600 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div
                class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8 mb-12 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 via-indigo-500/5 to-purple-500/5"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 flex items-center">
                            <div class="p-2 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg mr-3">
                                <i class="fas fa-bolt text-white"></i>
                            </div>
                            Quick Actions
                        </h2>
                        <div class="hidden sm:flex items-center text-sm text-slate-500">
                            <i class="fas fa-info-circle mr-2"></i>
                            Click any action to get started
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                        <a href="{{ route('student.create_complaint') }}"
                            class="action-btn group bg-gradient-to-br from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-indigo-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-plus-circle text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Submit Complaint</p>
                            </div>
                        </a>

                        <a href="{{ route('student.complaint_list') }}"
                            class="action-btn group bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-list text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">View Complaints</p>
                            </div>
                        </a>

                        <a href="{{ route('student.track_complaint') }}"
                            class="action-btn group bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-search text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Track Complaint</p>
                            </div>
                        </a>

                        <a href="{{ route('student.profile') }}"
                            class="action-btn group bg-gradient-to-br from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-teal-500/20 to-cyan-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-user-edit text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Update Profile</p>
                            </div>
                        </a>

                        <a href="{{ route('student.hall-notice') }}"
                            class="action-btn group bg-gradient-to-br from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-pink-500/20 to-rose-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-bullhorn text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Hall Notices</p>
                            </div>
                        </a>

                        <form action="{{ route('student.logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="action-btn group bg-gradient-to-br from-rose-600 to-rose-700 hover:from-rose-700 hover:to-rose-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl w-full relative overflow-hidden"
                                onclick="return confirm('Are you sure you want to logout?')">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-red-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div class="relative">
                                    <div
                                        class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                        <i class="fas fa-sign-out-alt text-2xl"></i>
                                    </div>
                                    <p class="font-semibold text-sm">Logout</p>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Seat Allocation Section -->
            @if ($seatAllotment)
                <div class="mb-12">
                    <div
                        class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                        <div
                            class="bg-gradient-to-r from-emerald-700 to-emerald-800 text-white p-6 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-green-600/20 to-teal-600/20"></div>
                            <div class="relative flex items-center justify-between">
                                <h3 class="text-xl font-bold flex items-center">
                                    <div class="p-2 bg-white/10 rounded-lg mr-3">
                                        <i class="fas fa-bed"></i>
                                    </div>
                                    Current Seat Allocation
                                </h3>
                                <div class="flex space-x-3">
                                    @if ($seatAllotment->canApplyForRenewal() && !$renewalApplication)
                                        <a href="{{ route('student.seat_application') }}"
                                            class="bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg transition-all duration-300 text-sm border border-white/20 hover:border-white/40 flex items-center">
                                            <i class="fas fa-sync-alt mr-2"></i>
                                            Renew Seat
                                        </a>
                                    @endif
                                    @if ($renewalApplication)
                                        <a href="{{ route('student.renewal_status') }}"
                                            class="bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg transition-all duration-300 text-sm border border-white/20 hover:border-white/40 flex items-center">
                                            <i class="fas fa-clock mr-2"></i>
                                            Renewal Status
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Seat Details -->
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Seat Information</h4>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <p><span class="font-medium">Location:</span> {{ $seatAllotment->seat->floor }}
                                            Floor, {{ $seatAllotment->seat->block }} Block</p>
                                        <p><span class="font-medium">Room:</span> {{ $seatAllotment->seat->room_number }},
                                            Bed {{ $seatAllotment->seat->bed_number }}</p>
                                        <p><span class="font-medium">Allocated:</span>
                                            {{ \Carbon\Carbon::parse($seatAllotment->start_date)->format('M d, Y') }}</p>
                                    </div>
                                </div>

                                <!-- Allocation Period -->
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Allocation Period</h4>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <p><span class="font-medium">Start Date:</span>
                                            {{ \Carbon\Carbon::parse($seatAllotment->start_date)->format('M d, Y') }}</p>
                                        <p><span class="font-medium">Expiry Date:</span>
                                            {{ \Carbon\Carbon::parse($seatAllotment->allocation_expiry_date)->format('M d, Y') }}
                                        </p>
                                        @if ($seatAllotment->remaining_days !== null)
                                            <p><span class="font-medium">Remaining:</span>
                                                @if ($seatAllotment->remaining_days > 0)
                                                    <span id="dashboard-countdown-timer"
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if ($seatAllotment->remaining_days <= 30) bg-red-100 text-red-800
                                                @elseif($seatAllotment->remaining_days <= 60) bg-yellow-100 text-yellow-800
                                                @else bg-green-100 text-green-800 @endif">
                                                        @if ($seatAllotment->remaining_days >= 30)
                                                            {{ floor($seatAllotment->remaining_days / 30) }}
                                                            month{{ floor($seatAllotment->remaining_days / 30) > 1 ? 's' : '' }}
                                                            {{ $seatAllotment->remaining_days % 30 }}
                                                            day{{ $seatAllotment->remaining_days % 30 !== 1 ? 's' : '' }}
                                                        @else
                                                            {{ $seatAllotment->remaining_days }}
                                                            day{{ $seatAllotment->remaining_days !== 1 ? 's' : '' }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span id="dashboard-countdown-timer"
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Expired
                                                    </span>
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Renewal Status -->
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Renewal Status</h4>
                                    <div class="space-y-2">
                                        @if ($renewalApplication)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                Renewal Pending
                                            </span>
                                            <p class="text-xs text-gray-500">Submitted on
                                                {{ $renewalApplication->submission_date->format('M d, Y') }}</p>
                                        @elseif($seatAllotment->canApplyForRenewal())
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                Renewal Required
                                            </span>
                                            <p class="text-xs text-gray-500">Apply for renewal to extend your stay</p>
                                            @if (
                                                $seatAllotment->reminder_29_days_sent ||
                                                    $seatAllotment->reminder_20_days_sent ||
                                                    $seatAllotment->reminder_10_days_sent)
                                                <div class="mt-2 p-2 bg-blue-50 border border-blue-200 rounded-md">
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
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                Allocation Expired
                                            </span>
                                            <p class="text-xs text-gray-500">Contact hall administration</p>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Active
                                            </span>
                                            <p class="text-xs text-gray-500">No action required</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Activity -->
            <div class="flex flex-col xl:grid xl:grid-cols-3 gap-8 mb-12">
                <!-- Recent Complaints -->
                <div class="xl:col-span-2 order-2 xl:order-1">
                    <div
                        class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-800 to-slate-900 text-white p-6 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20"></div>
                            <div class="relative flex items-center justify-between">
                                <h3 class="text-xl font-bold flex items-center">
                                    <div class="p-2 bg-white/10 rounded-lg mr-3">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    Recent Complaints
                                </h3>
                                <a href="{{ route('student.complaint_list') }}"
                                    class="bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg transition-all duration-300 text-sm border border-white/20 hover:border-white/40 flex items-center">
                                    <span>View All</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            @if ($recentComplaints->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($recentComplaints as $complaint)
                                        <div
                                            class="complaint-item group bg-gradient-to-r from-slate-50/80 to-white/80 backdrop-blur-sm rounded-xl p-4 hover:from-slate-100/80 hover:to-white/90 transition-all duration-300 border border-slate-200/50 hover:border-slate-300/50 hover:shadow-md">
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                                <div class="flex-1 mb-3 sm:mb-0 sm:pr-4">
                                                    <div
                                                        class="flex flex-col sm:flex-row sm:items-center sm:space-x-3 mb-3">
                                                        <span
                                                            class="font-mono text-sm bg-slate-800 text-white px-3 py-1 rounded-full mb-2 sm:mb-0 inline-block">
                                                            CM-{{ date('Y') }}-{{ str_pad($complaint->complaint_id, 3, '0', STR_PAD_LEFT) }}
                                                        </span>
                                                        <span
                                                            class="px-3 py-1 rounded-full text-xs font-semibold inline-block
                                                        @if ($complaint->category == 'electrical') bg-gradient-to-r from-amber-100 to-amber-50 text-amber-700 border border-amber-200
                                                        @elseif($complaint->category == 'water') bg-gradient-to-r from-blue-100 to-blue-50 text-blue-700 border border-blue-200
                                                        @elseif($complaint->category == 'medical') bg-gradient-to-r from-rose-100 to-rose-50 text-rose-700 border border-rose-200
                                                        @else bg-gradient-to-r from-slate-100 to-slate-50 text-slate-700 border border-slate-200 @endif">
                                                            {{ ucfirst($complaint->category) }}
                                                        </span>
                                                    </div>
                                                    <p class="text-slate-600 text-sm mb-3 line-clamp-2">
                                                        {{ Str::limit($complaint->description, 80) }}</p>
                                                    <div
                                                        class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 text-xs text-slate-500 space-y-1 sm:space-y-0">
                                                        <span class="flex items-center">
                                                            <i class="fas fa-calendar mr-1"></i>
                                                            {{ $complaint->submission_date->format('M d, Y') }}
                                                        </span>
                                                        <span class="flex items-center">
                                                            @if ($complaint->status == 'pending')
                                                                <div
                                                                    class="w-2 h-2 bg-amber-400 rounded-full mr-2 animate-pulse">
                                                                </div>
                                                                <span class="text-amber-600 font-medium">Pending</span>
                                                            @elseif($complaint->status == 'in_progress')
                                                                <div
                                                                    class="w-2 h-2 bg-blue-400 rounded-full mr-2 animate-pulse">
                                                                </div>
                                                                <span class="text-blue-600 font-medium">In Progress</span>
                                                            @else
                                                                <div class="w-2 h-2 bg-emerald-400 rounded-full mr-2">
                                                                </div>
                                                                <span class="text-emerald-600 font-medium">Resolved</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-end sm:justify-center">
                                                    <form action="{{ route('student.delete_complaint', $complaint) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-all duration-300 hover:scale-110"
                                                            onclick="return confirm('Are you sure you want to delete this complaint?')">
                                                            <i class="fas fa-trash text-sm"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div
                                        class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-inbox text-3xl text-slate-400"></i>
                                    </div>
                                    <p class="text-slate-500 text-lg mb-4">No complaints submitted yet</p>
                                    <a href="{{ route('student.create_complaint') }}"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-slate-700 to-slate-800 text-white rounded-lg hover:from-slate-800 hover:to-slate-900 transition-all duration-300 transform hover:scale-105">
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
                    <div
                        class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden h-full">
                        <div
                            class="bg-gradient-to-r from-indigo-700 to-indigo-800 text-white p-6 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-pink-600/20"></div>
                            <div class="relative flex items-center justify-between">
                                <h3 class="text-xl font-bold flex items-center">
                                    <div class="p-2 bg-white/10 rounded-lg mr-3">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    Recent Notices
                                </h3>
                                <a href="{{ route('student.hall-notice') }}"
                                    class="bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg transition-all duration-300 text-sm border border-white/20 hover:border-white/40 flex items-center">
                                    <span>View All</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            @if ($stats['recent_notices']->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($stats['recent_notices'] as $notice)
                                        <div
                                            class="notice-item group border-l-4 
                                        @if ($notice->notice_type == 'announcement') border-blue-400 bg-gradient-to-r from-blue-50/80 to-blue-25/50
                                        @elseif($notice->notice_type == 'event') border-emerald-400 bg-gradient-to-r from-emerald-50/80 to-emerald-25/50
                                        @else border-amber-400 bg-gradient-to-r from-amber-50/80 to-amber-25/50 @endif
                                        p-4 rounded-r-xl hover:shadow-md transition-all duration-300 backdrop-blur-sm border-t border-r border-b border-slate-200/30 group-hover:border-slate-300/50">
                                            <h4
                                                class="font-semibold text-slate-800 mb-2 text-sm group-hover:text-indigo-600 transition-colors duration-300">
                                                <a href="{{ route('student.hall-notice.show', $notice->notice_id) }}"
                                                    class="line-clamp-2">
                                                    {{ $notice->title }}
                                                </a>
                                            </h4>
                                            <p class="text-slate-600 text-xs mb-3 line-clamp-3">
                                                {{ Str::limit($notice->description, 100) }}</p>
                                            <div class="flex items-center justify-between text-xs text-slate-500">
                                                <span class="flex items-center">
                                                    <i class="fas fa-calendar mr-1"></i>
                                                    {{ $notice->date_posted->format('M d, Y') }}
                                                </span>
                                                <span class="px-2 py-1 bg-white/50 rounded-full text-xs font-medium">
                                                    {{ ucfirst($notice->notice_type) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-slate-100 to-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-bell-slash text-2xl text-slate-400"></i>
                                    </div>
                                    <p class="text-slate-500 mb-4 text-sm">No recent notices</p>
                                    <a href="{{ route('student.hall-notice') }}"
                                        class="text-indigo-600 hover:text-indigo-800 transition-colors duration-300 text-sm font-medium">
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

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script>
        // Real-time countdown timer for seat allocation
        @if ($seatAllotment && $seatAllotment->allocation_expiry_date)
            function updateDashboardCountdown() {
                const expiryDate = new Date('{{ $seatAllotment->allocation_expiry_date }}');
                const now = new Date();
                const timeLeft = expiryDate - now;

                if (timeLeft > 0) {
                    const totalDays = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const months = Math.floor(totalDays / 30);
                    const days = totalDays % 30;

                    // Update the countdown display
                    const countdownElement = document.getElementById('dashboard-countdown-timer');
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
                    const countdownElement = document.getElementById('dashboard-countdown-timer');
                    if (countdownElement) {
                        countdownElement.innerHTML = 'Expired';
                        countdownElement.className =
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';
                    }
                }
            }

            // Update countdown every day
            updateDashboardCountdown();
            setInterval(updateDashboardCountdown, 86400000); // 24 hours
        @endif
    </script>

@endsection

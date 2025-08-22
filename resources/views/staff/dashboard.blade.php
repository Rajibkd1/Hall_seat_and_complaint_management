@extends('layouts.staff_app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-purple-50/30 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-purple-400/10 to-indigo-400/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-indigo-400/10 to-purple-400/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Welcome Section with Staff Details -->
    <div class="relative overflow-hidden bg-gradient-to-br from-purple-800 via-purple-900 to-indigo-900">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 via-indigo-600/20 to-violet-600/20"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        
        <div class="relative container mx-auto px-4 sm:px-6 py-12 sm:py-16">
            <div class="flex flex-col items-center text-center lg:flex-row lg:text-left lg:items-center lg:justify-between">
                <div class="flex-1 mb-8 lg:mb-0 lg:pr-8">
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm text-purple-200 mb-4 border border-white/20">
                        <i class="fas fa-users-cog mr-2"></i>
                        Staff Dashboard
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-light mb-4 sm:mb-6 animate-fade-in leading-tight">
                        Welcome back,<br class="sm:hidden"> 
                        <span class="bg-gradient-to-r from-purple-200 to-indigo-200 bg-clip-text text-transparent font-medium">{{ $admin->name }}</span>
                    </h1>
                    
                    <!-- Staff Details - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                    <div class="hidden sm:flex flex-col sm:flex-row sm:flex-wrap gap-4 sm:gap-6 text-sm sm:text-base lg:text-lg">
                        <div class="flex items-center justify-center lg:justify-start group bg-purple-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-purple-600/30 hover:bg-purple-700/50 transition-all duration-300">
                            <div class="p-2 bg-purple-500/20 rounded-lg mr-3 group-hover:bg-purple-500/30 transition-all duration-300">
                                <i class="fas fa-envelope text-purple-200 flex-shrink-0"></i>
                            </div>
                            <div>
                                <p class="text-xs text-purple-200 uppercase tracking-wider mb-1">Email</p>
                                <span class="text-white font-medium truncate">{{ $admin->email }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-center lg:justify-start group bg-purple-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-purple-600/30 hover:bg-purple-700/50 transition-all duration-300">
                            <div class="p-2 bg-indigo-500/20 rounded-lg mr-3 group-hover:bg-indigo-500/30 transition-all duration-300">
                                <i class="fas fa-user-tag text-indigo-200 flex-shrink-0"></i>
                            </div>
                            <div>
                                <p class="text-xs text-indigo-200 uppercase tracking-wider mb-1">Role</p>
                                <span class="text-white font-medium truncate">Staff</span>
                            </div>
                        </div>
                        
                        @if($admin->designation)
                        <div class="flex items-center justify-center lg:justify-start group bg-purple-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-purple-600/30 hover:bg-purple-700/50 transition-all duration-300">
                            <div class="p-2 bg-violet-500/20 rounded-lg mr-3 group-hover:bg-violet-500/30 transition-all duration-300">
                                <i class="fas fa-briefcase text-violet-200 flex-shrink-0"></i>
                            </div>
                            <div>
                                <p class="text-xs text-violet-200 uppercase tracking-wider mb-1">Position</p>
                                <span class="text-white font-medium">{{ $admin->designation }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Profile Picture - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                <div class="hidden sm:block flex-shrink-0">
                    <div class="relative group">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 lg:w-36 lg:h-36 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30 shadow-2xl group-hover:scale-105 transition-all duration-500">
                            <i class="fas fa-users-cog text-3xl sm:text-4xl lg:text-5xl text-white/80"></i>
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-purple-400 to-purple-500 rounded-full border-4 border-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-all duration-300">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-purple-400/20 to-indigo-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-slate-50 to-transparent"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 -mt-8 relative z-10">
        <!-- Statistics Cards - Staff Role Specific (Only Complaints & Notices) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-12">
            <div class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-red-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-rose-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Pending Complaints</p>
                        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-red-600 transition-colors duration-300">{{ $stats['pending_complaints'] ?? 0 }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-3 sm:p-4 bg-gradient-to-br from-red-100 to-red-50 rounded-xl group-hover:from-red-500 group-hover:to-red-600 transition-all duration-300">
                            <i class="fas fa-exclamation-triangle text-xl sm:text-2xl text-red-600 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-green-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Resolved Complaints</p>
                        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-green-600 transition-colors duration-300">{{ $stats['resolved_complaints'] ?? 0 }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-3 sm:p-4 bg-gradient-to-br from-green-100 to-green-50 rounded-xl group-hover:from-green-500 group-hover:to-green-600 transition-all duration-300">
                            <i class="fas fa-check-circle text-xl sm:text-2xl text-green-600 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-purple-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Active Notices</p>
                        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-purple-600 transition-colors duration-300">{{ $stats['active_notices'] ?? 0 }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-3 sm:p-4 bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl group-hover:from-purple-500 group-hover:to-purple-600 transition-all duration-300">
                            <i class="fas fa-bullhorn text-xl sm:text-2xl text-purple-600 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Information -->
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8 mb-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/5 via-indigo-500/5 to-violet-500/5"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800 flex items-center">
                        <div class="p-2 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-lg mr-3">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        Staff Permissions
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center space-x-3 p-4 bg-purple-50/50 rounded-lg border border-purple-200/50">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-purple-600"></i>
                        </div>
                        <span class="text-slate-700 font-medium">View dashboard and notices</span>
                    </div>
                    <div class="flex items-center space-x-3 p-4 bg-purple-50/50 rounded-lg border border-purple-200/50">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-purple-600"></i>
                        </div>
                        <span class="text-slate-700 font-medium">Handle student complaints</span>
                    </div>
                    <div class="flex items-center space-x-3 p-4 bg-red-50/50 rounded-lg border border-red-200/50">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-times text-red-600"></i>
                        </div>
                        <span class="text-slate-700 font-medium">Cannot access applications</span>
                    </div>
                    <div class="flex items-center space-x-3 p-4 bg-red-50/50 rounded-lg border border-red-200/50">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-times text-red-600"></i>
                        </div>
                        <span class="text-slate-700 font-medium">Cannot allocate seats</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Work Information -->
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8 mb-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-violet-500/5"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800 flex items-center">
                        <div class="p-2 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg mr-3">
                            <i class="fas fa-briefcase text-white"></i>
                        </div>
                        Work Information
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-gradient-to-br from-blue-50/80 to-blue-25/50 rounded-xl border border-blue-200/50 hover:shadow-md transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-blue-600 text-2xl"></i>
                        </div>
                        <p class="font-semibold text-slate-800 mb-2">Hall</p>
                        <p class="text-slate-600">{{ $admin->hall_name ?? 'Not Assigned' }}</p>
                    </div>
                    <div class="text-center p-6 bg-gradient-to-br from-green-50/80 to-green-25/50 rounded-xl border border-green-200/50 hover:shadow-md transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-briefcase text-green-600 text-2xl"></i>
                        </div>
                        <p class="font-semibold text-slate-800 mb-2">Position</p>
                        <p class="text-slate-600">{{ $admin->designation ?? 'Staff' }}</p>
                    </div>
                    <div class="text-center p-6 bg-gradient-to-br from-purple-50/80 to-purple-25/50 rounded-xl border border-purple-200/50 hover:shadow-md transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-purple-600 text-2xl"></i>
                        </div>
                        <p class="font-semibold text-slate-800 mb-2">Status</p>
                        <p class="text-green-600 font-semibold">Active</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8 mb-12 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/5 via-indigo-500/5 to-violet-500/5"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800 flex items-center">
                        <div class="p-2 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-lg mr-3">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        Quick Actions
                    </h2>
                    <div class="hidden sm:flex items-center text-sm text-slate-500">
                        <i class="fas fa-info-circle mr-2"></i>
                        Click any action to get started
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('admin.complaints') }}" class="action-btn group bg-gradient-to-br from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-rose-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="p-4 bg-white/10 rounded-lg mb-4 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                <i class="fas fa-exclamation-triangle text-3xl"></i>
                            </div>
                            <h4 class="font-bold text-lg mb-2">Handle Complaints</h4>
                            <p class="text-white/80 text-sm">Respond to student complaints and issues</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.notices') }}" class="action-btn group bg-gradient-to-br from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-xl p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 to-violet-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="p-4 bg-white/10 rounded-lg mb-4 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                <i class="fas fa-bullhorn text-3xl"></i>
                            </div>
                            <h4 class="font-bold text-lg mb-2">View Notices</h4>
                            <p class="text-white/80 text-sm">Check active notices and announcements</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

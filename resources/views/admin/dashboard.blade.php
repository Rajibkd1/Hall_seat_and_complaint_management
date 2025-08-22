@extends($layout)

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

        <!-- Welcome Section with Admin Details -->
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
                            <i class="fas fa-crown mr-2"></i>
                            {{ auth('admin')->user()->role ?? 'Admin' }} Dashboard
                        </div>
                        <h1
                            class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-light mb-4 sm:mb-6 animate-fade-in leading-tight">
                            Welcome back,<br class="sm:hidden">
                            <span
                                class="bg-gradient-to-r from-blue-200 to-indigo-200 bg-clip-text text-transparent font-medium">{{ auth('admin')->user()->name }}</span>
                        </h1>

                        <!-- Admin Details - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                        <div
                            class="hidden sm:flex flex-col sm:flex-row sm:flex-wrap gap-4 sm:gap-6 text-sm sm:text-base lg:text-lg">
                            <div
                                class="flex items-center justify-center lg:justify-start group bg-slate-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-slate-600/30 hover:bg-slate-700/50 transition-all duration-300">
                                <div
                                    class="p-2 bg-blue-500/20 rounded-lg mr-3 group-hover:bg-blue-500/30 transition-all duration-300">
                                    <i class="fas fa-envelope text-blue-200 flex-shrink-0"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-blue-200 uppercase tracking-wider mb-1">Email</p>
                                    <span class="text-white font-medium truncate">{{ auth('admin')->user()->email }}</span>
                                </div>
                            </div>

                            @if (auth('admin')->user()->role)
                                <div
                                    class="flex items-center justify-center lg:justify-start group bg-slate-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-slate-600/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <div
                                        class="p-2 bg-emerald-500/20 rounded-lg mr-3 group-hover:bg-emerald-500/30 transition-all duration-300">
                                        <i class="fas fa-user-tag text-emerald-200 flex-shrink-0"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-emerald-200 uppercase tracking-wider mb-1">Role</p>
                                        <span class="text-white font-medium truncate">{{ auth('admin')->user()->role }}</span>
                                    </div>
                                </div>
                            @endif

                            @if (auth('admin')->user()->department)
                                <div
                                    class="flex items-center justify-center lg:justify-start group bg-slate-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-slate-600/30 hover:bg-slate-700/50 transition-all duration-300">
                                    <div
                                        class="p-2 bg-indigo-500/20 rounded-lg mr-3 group-hover:bg-indigo-500/30 transition-all duration-300">
                                        <i class="fas fa-building text-indigo-200 flex-shrink-0"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-indigo-200 uppercase tracking-wider mb-1">Department</p>
                                        <span class="text-white font-medium">{{ auth('admin')->user()->department }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profile Picture - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                    <div class="hidden sm:block flex-shrink-0">
                        <div class="relative group">
                            <div
                                class="w-24 h-24 sm:w-28 sm:h-28 lg:w-36 lg:h-36 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30 shadow-2xl group-hover:scale-105 transition-all duration-500">
                                <i class="fas fa-crown text-3xl sm:text-4xl lg:text-5xl text-white/80"></i>
                            </div>
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
                                Students</p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">
                                {{ number_format($totalStudents ?? 0) }}</p>
                            <p class="text-xs sm:text-sm text-emerald-600 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +{{ $recentStudents ?? 0 }} this week
                            </p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl group-hover:from-blue-500 group-hover:to-blue-600 transition-all duration-300">
                                <i
                                    class="fas fa-users text-xl sm:text-2xl text-blue-600 group-hover:text-white transition-colors duration-300"></i>
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
                                Applications</p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors duration-300">
                                {{ number_format($totalApplications ?? 0) }}</p>
                            <p class="text-xs sm:text-sm text-amber-600 mt-1">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $pendingApplications ?? 0 }} pending
                            </p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl group-hover:from-emerald-500 group-hover:to-emerald-600 transition-all duration-300">
                                <i
                                    class="fas fa-file-alt text-xl sm:text-2xl text-emerald-600 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-red-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-rose-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">
                                Complaints</p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-red-600 transition-colors duration-300">
                                {{ number_format($totalComplaints ?? 0) }}</p>
                            <p class="text-xs sm:text-sm text-red-600 mt-1">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $pendingComplaints ?? 0 }} pending
                            </p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-red-100 to-red-50 rounded-xl group-hover:from-red-500 group-hover:to-red-600 transition-all duration-300">
                                <i
                                    class="fas fa-exclamation-circle text-xl sm:text-2xl text-red-600 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-purple-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-3 sm:mb-0">
                            <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Notices
                            </p>
                            <p
                                class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-purple-600 transition-colors duration-300">
                                {{ number_format($totalNotices ?? 0) }}</p>
                            <p class="text-xs sm:text-sm text-purple-600 mt-1">
                                <i class="fas fa-eye mr-1"></i>
                                {{ $activeNotices ?? 0 }} active
                            </p>
                        </div>
                        <div class="self-end sm:self-auto">
                            <div
                                class="p-3 sm:p-4 bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl group-hover:from-purple-500 group-hover:to-purple-600 transition-all duration-300">
                                <i
                                    class="fas fa-bullhorn text-xl sm:text-2xl text-purple-600 group-hover:text-white transition-colors duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role Information -->
            <div
                class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 p-6 sm:p-8 mb-12 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 via-indigo-500/5 to-slate-500/5"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 flex items-center">
                            <div class="p-2 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg mr-3">
                                <i class="fas fa-crown text-white"></i>
                            </div>
                            {{ auth('admin')->user()->role ?? 'Admin' }} Permissions
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(auth('admin')->user()->canApproveNotices())
                        <div class="flex items-center space-x-3 p-4 bg-blue-50/50 rounded-lg border border-blue-200/50">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-blue-600"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Create and approve notices</span>
                        </div>
                        @endif
                        @if(auth('admin')->user()->canAllocateSeats())
                        <div class="flex items-center space-x-3 p-4 bg-blue-50/50 rounded-lg border border-blue-200/50">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-blue-600"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Allocate seats to students</span>
                        </div>
                        @endif
                        @if(auth('admin')->user()->canCreateAdmins())
                        <div class="flex items-center space-x-3 p-4 bg-blue-50/50 rounded-lg border border-blue-200/50">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-blue-600"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Create admin accounts</span>
                        </div>
                        @endif
                        @if(auth('admin')->user()->canManageComplaints())
                        <div class="flex items-center space-x-3 p-4 bg-blue-50/50 rounded-lg border border-blue-200/50">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-blue-600"></i>
                            </div>
                            <span class="text-slate-700 font-medium">Manage complaints</span>
                        </div>
                        @endif
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
                        @if(auth('admin')->user()->canViewStudents())
                        <a href="{{ \App\Helpers\RouteHelper::getRoleBasedRoute('students') }}"
                            class="action-btn group bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-users text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Students</p>
                            </div>
                        </a>
                        @endif

                        @if(auth('admin')->user()->canManageComplaints())
                        <a href="{{ \App\Helpers\RouteHelper::getRoleBasedRoute('complaints') }}"
                            class="action-btn group bg-gradient-to-br from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-rose-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Complaints</p>
                            </div>
                        </a>
                        @endif

                        @if(auth('admin')->user()->canApproveNotices())
                        <a href="{{ \App\Helpers\RouteHelper::getRoleBasedRoute('notices.create') }}"
                            class="action-btn group bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-plus-circle text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Create Notice</p>
                            </div>
                        </a>
                        @endif

                        @if(auth('admin')->user()->canVerifyApplications())
                        <a href="{{ \App\Helpers\RouteHelper::getRoleBasedRoute('applications.index') }}"
                            class="action-btn group bg-gradient-to-br from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-orange-500/20 to-yellow-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-file-alt text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Applications</p>
                            </div>
                        </a>
                        @endif

                        @if(auth('admin')->user()->canAllocateSeats())
                        <a href="{{ \App\Helpers\RouteHelper::getRoleBasedRoute('seats.index') }}"
                            class="action-btn group bg-gradient-to-br from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-violet-500/20 to-indigo-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-bed text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Seat Allocation</p>
                            </div>
                        </a>
                        @endif

                        @if(auth('admin')->user()->canCreateAdmins())
                        <a href="{{ \App\Helpers\RouteHelper::getRoleBasedRoute('create_admin') }}"
                            class="action-btn group bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white rounded-xl p-4 sm:p-6 text-center transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl relative overflow-hidden">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <div
                                    class="p-3 bg-white/10 rounded-lg mb-3 mx-auto w-fit group-hover:bg-white/20 transition-all duration-300">
                                    <i class="fas fa-user-plus text-2xl"></i>
                                </div>
                                <p class="font-semibold text-sm">Create People</p>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

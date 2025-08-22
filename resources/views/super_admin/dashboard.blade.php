<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - Hall Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-indigo-50/30 relative overflow-hidden min-h-screen">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-400/10 to-purple-400/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-purple-400/10 to-indigo-400/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Welcome Section with Super Admin Details -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-800 via-indigo-900 to-purple-900">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/20 via-purple-600/20 to-violet-600/20"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        
        <div class="relative container mx-auto px-4 sm:px-6 py-12 sm:py-16">
            <div class="flex flex-col items-center text-center lg:flex-row lg:text-left lg:items-center lg:justify-between">
                <div class="flex-1 mb-8 lg:mb-0 lg:pr-8">
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm text-indigo-200 mb-4 border border-white/20">
                        <i class="fas fa-crown mr-2"></i>
                        Super Admin Dashboard
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-light mb-4 sm:mb-6 animate-fade-in leading-tight">
                        Welcome back,<br class="sm:hidden"> 
                        <span class="bg-gradient-to-r from-indigo-200 to-purple-200 bg-clip-text text-transparent font-medium">{{ $superAdmin->name }}</span>
                    </h1>
                    
                    <!-- Super Admin Details - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                    <div class="hidden sm:flex flex-col sm:flex-row sm:flex-wrap gap-4 sm:gap-6 text-sm sm:text-base lg:text-lg">
                        <div class="flex items-center justify-center lg:justify-start group bg-indigo-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-indigo-600/30 hover:bg-indigo-700/50 transition-all duration-300">
                            <div class="p-2 bg-indigo-500/20 rounded-lg mr-3 group-hover:bg-indigo-500/30 transition-all duration-300">
                                <i class="fas fa-envelope text-indigo-200 flex-shrink-0"></i>
                            </div>
                            <div>
                                <p class="text-xs text-indigo-200 uppercase tracking-wider mb-1">Email</p>
                                <span class="text-white font-medium truncate">{{ $superAdmin->email }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-center lg:justify-start group bg-indigo-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-indigo-600/30 hover:bg-indigo-700/50 transition-all duration-300">
                            <div class="p-2 bg-purple-500/20 rounded-lg mr-3 group-hover:bg-purple-500/30 transition-all duration-300">
                                <i class="fas fa-crown text-purple-200 flex-shrink-0"></i>
                            </div>
                            <div>
                                <p class="text-xs text-purple-200 uppercase tracking-wider mb-1">Role</p>
                                <span class="text-white font-medium truncate">Super Administrator</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-center lg:justify-start group bg-indigo-700/40 backdrop-blur-sm rounded-lg px-4 py-3 border border-indigo-600/30 hover:bg-indigo-700/50 transition-all duration-300">
                            <div class="p-2 bg-violet-500/20 rounded-lg mr-3 group-hover:bg-violet-500/30 transition-all duration-300">
                                <i class="fas fa-shield-alt text-violet-200 flex-shrink-0"></i>
                            </div>
                            <div>
                                <p class="text-xs text-violet-200 uppercase tracking-wider mb-1">Access Level</p>
                                <span class="text-white font-medium">Full Control</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Picture - Hidden on Mobile (<640px), Visible on Tablet+ (≥640px) -->
                <div class="hidden sm:block flex-shrink-0">
                    <div class="relative group">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 lg:w-36 lg:h-36 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30 shadow-2xl group-hover:scale-105 transition-all duration-500">
                            <i class="fas fa-crown text-3xl sm:text-4xl lg:text-5xl text-white/80"></i>
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full border-4 border-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-all duration-300">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-indigo-400/20 to-purple-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-slate-50 to-transparent"></div>
        
        <!-- Logout Button -->
        <div class="absolute top-6 right-6">
            <form action="{{ route('super_admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg transition-all duration-300 text-white border border-white/20 hover:border-white/40 flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 -mt-8 relative z-10">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-emerald-100/90 backdrop-blur-xl border border-emerald-400/50 text-emerald-700 px-6 py-4 rounded-2xl mb-8 shadow-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-emerald-600"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100/90 backdrop-blur-xl border border-red-400/50 text-red-700 px-6 py-4 rounded-2xl mb-8 shadow-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-red-600"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-12">
            <div class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-blue-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Provosts</p>
                        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300">{{ $totalProvosts }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-3 sm:p-4 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl group-hover:from-blue-500 group-hover:to-blue-600 transition-all duration-300">
                            <i class="fas fa-user-tie text-xl sm:text-2xl text-blue-600 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-emerald-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Co-Provosts</p>
                        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors duration-300">{{ $totalCoProvosts }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-3 sm:p-4 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl group-hover:from-emerald-500 group-hover:to-emerald-600 transition-all duration-300">
                            <i class="fas fa-user-friends text-xl sm:text-2xl text-emerald-600 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-purple-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Staff Members</p>
                        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-purple-600 transition-colors duration-300">{{ $totalStaff }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-3 sm:p-4 bg-gradient-to-br from-purple-100 to-purple-50 rounded-xl group-hover:from-purple-500 group-hover:to-purple-600 transition-all duration-300">
                            <i class="fas fa-users text-xl sm:text-2xl text-purple-600 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card group bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl p-4 sm:p-6 border border-slate-200/50 hover:border-indigo-300/50 transition-all duration-500 transform hover:-translate-y-2 hover:scale-105 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-violet-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Admins</p>
                        <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors duration-300">{{ $totalProvosts + $totalCoProvosts + $totalStaff }}</p>
                    </div>
                    <div class="self-end sm:self-auto">
                        <div class="p-3 sm:p-4 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-xl group-hover:from-indigo-500 group-hover:to-indigo-600 transition-all duration-300">
                            <i class="fas fa-user-shield text-xl sm:text-2xl text-indigo-600 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Register Provost Card -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 p-8 relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">Register New Provost</h3>
                    <p class="text-slate-600 mb-8 leading-relaxed">Create a new Provost account with OTP verification and full administrative privileges</p>
                    <a href="{{ route('super_admin.register_provost') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus mr-3"></i>
                        Register Provost
                    </a>
                </div>
            </div>

            <!-- View Provosts Card -->
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 p-8 relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-300 shadow-lg">
                        <i class="fas fa-list text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">Manage Provosts</h3>
                    <p class="text-slate-600 mb-8 leading-relaxed">View, edit, and manage all registered Provosts and their administrative settings</p>
                    <a href="{{ route('super_admin.provosts') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="fas fa-eye mr-3"></i>
                        View Provosts
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Provosts -->
        @if($recentProvosts->count() > 0)
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-indigo-700 to-purple-800 text-white p-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 to-violet-600/20"></div>
                <div class="relative flex items-center justify-between">
                    <h3 class="text-xl font-bold flex items-center">
                        <div class="p-2 bg-white/10 rounded-lg mr-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        Recently Registered Provosts
                    </h3>
                    <a href="{{ route('super_admin.provosts') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg transition-all duration-300 text-sm border border-white/20 hover:border-white/40 flex items-center">
                        <span>View All</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Hall</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Registered</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentProvosts as $provost)
                            <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-slate-900">{{ $provost->name }}</div>
                                            <div class="text-sm text-slate-500">{{ $provost->designation }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $provost->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $provost->hall_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $provost->department }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $provost->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>

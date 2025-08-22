<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Demo - Responsive Admin Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .provost-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #3b82f6 100%);
        }
        .co-provost-gradient {
            background: linear-gradient(135deg, #065f46 0%, #047857 50%, #10b981 100%);
        }
        .staff-gradient {
            background: linear-gradient(135deg, #581c87 0%, #7c3aed 50%, #a855f7 100%);
        }
        
        /* Responsive navigation improvements */
        @media (min-width: 1024px) {
            .nav-link {
                white-space: nowrap;
            }
        }
        
        @media (min-width: 1280px) {
            .nav-link {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }
        
        @media (min-width: 1536px) {
            .nav-link {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Demo Header -->
        <div class="bg-white shadow-sm border-b p-4 mb-8">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Responsive Admin Navigation Demo</h1>
                <p class="text-gray-600">Beautiful, responsive navigation bars for different admin roles with proper overflow handling and alignment.</p>
            </div>
        </div>

        <!-- Provost Navigation Demo -->
        <div class="mb-12">
            <div class="max-w-7xl mx-auto px-4 mb-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Provost Navigation</h2>
                <p class="text-gray-600">Full access navigation with all administrative features</p>
            </div>
            
            <nav class="provost-gradient shadow-lg backdrop-blur-md border-b border-blue-500/20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo/Brand -->
                        <div class="flex items-center space-x-3 flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-crown text-white text-lg"></i>
                            </div>
                            <div class="hidden sm:block">
                                <h1 class="text-white font-bold text-lg">Hall Management</h1>
                                <p class="text-blue-200 text-xs">Provost Portal</p>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden lg:flex items-center justify-center flex-1 max-w-4xl mx-8">
                            <div class="flex items-center space-x-1 xl:space-x-2">
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white bg-white/20 shadow-md">
                                    <i class="fas fa-tachometer-alt mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Dashboard</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-users mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Students</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-exclamation-triangle mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Complaints</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-bullhorn mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Notices</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-file-alt mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Applications</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-bed mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Seats</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-user-plus mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Create People</span>
                                </a>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-2 xl:space-x-4 flex-shrink-0">
                            <div class="hidden sm:flex items-center space-x-2 xl:space-x-3">
                                <div class="text-right">
                                    <p class="text-white font-medium text-sm">Dr. Mohammad Ali</p>
                                    <p class="text-blue-200 text-xs">Provost</p>
                                </div>
                                <div class="w-8 h-8 xl:w-10 xl:h-10 bg-gradient-to-br from-white/20 to-white/10 rounded-full flex items-center justify-center border-2 border-white/30">
                                    <i class="fas fa-crown text-white text-sm xl:text-base"></i>
                                </div>
                            </div>
                            <button class="flex items-center px-3 xl:px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-all duration-300 border border-red-400/30 hover:border-red-400/50">
                                <i class="fas fa-sign-out-alt mr-1 xl:mr-2 text-sm"></i>
                                <span class="font-medium text-sm xl:text-base hidden sm:inline">Sign Out</span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Co-Provost Navigation Demo -->
        <div class="mb-12">
            <div class="max-w-7xl mx-auto px-4 mb-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Co-Provost Navigation</h2>
                <p class="text-gray-600">Limited administrative access with emerald/teal theme</p>
            </div>
            
            <nav class="co-provost-gradient shadow-lg backdrop-blur-md border-b border-emerald-500/20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo/Brand -->
                        <div class="flex items-center space-x-3 flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-teal-600 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-user-tie text-white text-lg"></i>
                            </div>
                            <div class="hidden sm:block">
                                <h1 class="text-white font-bold text-lg">Hall Management</h1>
                                <p class="text-emerald-200 text-xs">Co-Provost Portal</p>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden lg:flex items-center justify-center flex-1 max-w-3xl mx-8">
                            <div class="flex items-center space-x-1 xl:space-x-2">
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white bg-white/20 shadow-md">
                                    <i class="fas fa-tachometer-alt mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Dashboard</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-users mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Students</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-exclamation-triangle mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Complaints</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-bullhorn mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Notices</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-3 xl:px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-file-alt mr-1 xl:mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Applications</span>
                                </a>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-2 xl:space-x-4 flex-shrink-0">
                            <div class="hidden sm:flex items-center space-x-2 xl:space-x-3">
                                <div class="text-right">
                                    <p class="text-white font-medium text-sm">Dr. Sarah Ahmed</p>
                                    <p class="text-emerald-200 text-xs">Co-Provost</p>
                                </div>
                                <div class="w-8 h-8 xl:w-10 xl:h-10 bg-gradient-to-br from-white/20 to-white/10 rounded-full flex items-center justify-center border-2 border-white/30">
                                    <i class="fas fa-user-tie text-white text-sm xl:text-base"></i>
                                </div>
                            </div>
                            <button class="flex items-center px-3 xl:px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-all duration-300 border border-red-400/30 hover:border-red-400/50">
                                <i class="fas fa-sign-out-alt mr-1 xl:mr-2 text-sm"></i>
                                <span class="font-medium text-sm xl:text-base hidden sm:inline">Sign Out</span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Staff Navigation Demo -->
        <div class="mb-12">
            <div class="max-w-7xl mx-auto px-4 mb-4">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Staff Navigation</h2>
                <p class="text-gray-600">Basic access navigation with purple/indigo theme</p>
            </div>
            
            <nav class="staff-gradient shadow-lg backdrop-blur-md border-b border-purple-500/20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo/Brand -->
                        <div class="flex items-center space-x-3 flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-tools text-white text-lg"></i>
                            </div>
                            <div class="hidden sm:block">
                                <h1 class="text-white font-bold text-lg">Hall Management</h1>
                                <p class="text-purple-200 text-xs">Staff Portal</p>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden lg:flex items-center justify-center flex-1 max-w-2xl mx-8">
                            <div class="flex items-center space-x-2 xl:space-x-4">
                                <a href="#" class="nav-link flex items-center px-4 xl:px-6 py-2 rounded-lg text-white bg-white/20 shadow-md">
                                    <i class="fas fa-tachometer-alt mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Dashboard</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-4 xl:px-6 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-exclamation-triangle mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Complaints</span>
                                </a>
                                <a href="#" class="nav-link flex items-center px-4 xl:px-6 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-bullhorn mr-2 text-sm"></i>
                                    <span class="font-medium text-sm xl:text-base">Notices</span>
                                </a>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center space-x-2 xl:space-x-4 flex-shrink-0">
                            <div class="hidden sm:flex items-center space-x-2 xl:space-x-3">
                                <div class="text-right">
                                    <p class="text-white font-medium text-sm">Mr. Karim Hassan</p>
                                    <p class="text-purple-200 text-xs">Staff</p>
                                </div>
                                <div class="w-8 h-8 xl:w-10 xl:h-10 bg-gradient-to-br from-white/20 to-white/10 rounded-full flex items-center justify-center border-2 border-white/30">
                                    <i class="fas fa-tools text-white text-sm xl:text-base"></i>
                                </div>
                            </div>
                            <button class="flex items-center px-3 xl:px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-all duration-300 border border-red-400/30 hover:border-red-400/50">
                                <i class="fas fa-sign-out-alt mr-1 xl:mr-2 text-sm"></i>
                                <span class="font-medium text-sm xl:text-base hidden sm:inline">Sign Out</span>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Features Section -->
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Navigation Improvements</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Responsive Design</h3>
                        <p class="text-gray-600 text-sm">Adapts perfectly to all screen sizes from mobile to ultra-wide displays</p>
                    </div>
                    
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-palette text-green-600 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Role-Based Themes</h3>
                        <p class="text-gray-600 text-sm">Unique color schemes and icons for each admin role</p>
                    </div>
                    
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-shield-alt text-purple-600 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Permission-Based Access</h3>
                        <p class="text-gray-600 text-sm">Navigation items shown based on user role permissions</p>
                    </div>
                    
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-expand-arrows-alt text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">No Overflow Issues</h3>
                        <p class="text-gray-600 text-sm">Smart spacing and layout prevents navigation overflow on large screens</p>
                    </div>
                    
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-align-center text-red-600 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Perfect Alignment</h3>
                        <p class="text-gray-600 text-sm">Centered navigation with proper spacing and alignment</p>
                    </div>
                    
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-magic text-indigo-600 text-xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Smooth Animations</h3>
                        <p class="text-gray-600 text-sm">Beautiful hover effects and smooth transitions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

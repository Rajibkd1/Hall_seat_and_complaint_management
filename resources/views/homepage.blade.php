<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Seat and Complaint Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/lenis@1.3.4/dist/lenis.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <script src="https://unpkg.com/lenis@1.3.4/dist/lenis.min.js"></script>
</head>

<body class="min-h-screen animated-bg">
    <!-- Mobile-Optimized Header -->
    <header class="bg-white/95 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <nav class="max-w-6xl mx-auto px-4 py-3 sm:px-6">
            <div class="header-container">
                <!-- Logo -->
                <div class="logo-section">
                    <div class="text-2xl floating-animation">🏠</div>
                    <span class="logo-text">Hall Management System</span>
                </div>

                <!-- Mobile-Optimized Auth Buttons -->
                <div class="auth-buttons">
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}"
                        class="header-btn header-login magnetic-effect">
                        <span>🔐</span>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}"
                        class="header-btn header-signup glow-effect magnetic-effect">
                        <span>✨</span>
                        <span>Sign Up</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-6 sm:px-6 sm:py-8">
        <section class="py-12 sm:py-16">
            <div class="text-center mb-8 sm:mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Hall Notices</h1>
                <p class="text-gray-600 text-sm md:text-base">Stay updated with the latest announcements and events</p>
            </div>

            <!-- Enhanced Search Section -->
            <div class="max-w-2xl mx-auto mb-8">
                <div class="relative group">
                    <input type="text" 
                           id="searchInput" 
                           placeholder="Search notices, events, announcements..." 
                           class="w-full px-6 py-4 bg-white/90 backdrop-blur-md border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 shadow-lg hover:shadow-xl text-base md:text-lg">
                    
                    <!-- Search Icon -->
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-all duration-300">
                        <svg class="w-6 h-6 text-gray-400 group-focus-within:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    
                    <!-- Search Loading Indicator -->
                    <div id="searchLoader" class="absolute right-4 top-1/2 transform -translate-y-1/2 hidden">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500"></div>
                    </div>
                    
                    <!-- Search Results Count -->
                    <div id="searchResults" class="absolute left-6 -bottom-8 text-sm text-gray-500 hidden">
                        <span id="resultsCount">0</span> results found
                    </div>
                </div>
            </div>

            <!-- Filter Tags -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button class="filter-tag active px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 border border-blue-500 rounded-full text-white text-sm font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105" data-filter="all">
                    <span class="mr-2">📋</span>All Notices
                </button>
                <button class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105" data-filter="announcement">
                    <span class="mr-2">📢</span>Announcements
                </button>
                <button class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105" data-filter="event">
                    <span class="mr-2">🎉</span>Events
                </button>
                <button class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105" data-filter="deadline">
                    <span class="mr-2">⏰</span>Deadlines
                </button>
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-12 hidden">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No notices found</h3>
                <p class="text-gray-500">Try adjusting your search or filter criteria</p>
            </div>

            <div class="max-w-4xl mx-auto">
                @if ($notices->isNotEmpty())
                    <div id="noticesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($notices as $index => $notice)
                            <div class="notice-card bg-white/90 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 cursor-pointer transition-all duration-300 hover:shadow-2xl shadow-lg animate-notice-appear relative group"
                                style="animation-delay: {{ $index * 0.1 }}s" data-notice-id="{{ $notice->notice_id }}"
                                data-notice-type="{{ $notice->notice_type }}"
                                data-notice-title="{{ strtolower($notice->title) }}"
                                data-notice-description="{{ strtolower($notice->description) }}">

                                <div class="priority-badge">
                                    <div
                                        class="w-10 h-10 notice-priority-{{ $notice->notice_type === 'deadline' ? 'high' : ($notice->notice_type === 'event' ? 'medium' : 'low') }} rounded-full flex items-center justify-center text-white text-lg font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        {{ $notice->notice_type === 'deadline' ? '⏰' : ($notice->notice_type === 'event' ? '🎉' : '📢') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h3
                                        class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                                        {{ $notice->title }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed">
                                        {{ Str::limit($notice->description, 150) }}</p>
                                </div>

                                <div class="flex items-center justify-between text-gray-500 text-sm">
                                    <div class="flex items-center space-x-3">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ $notice->date_posted->format('M d, Y') }}
                                        </span>
                                        <span
                                            class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full text-xs font-semibold">
                                            {{ ucfirst($notice->notice_type) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if ($notice->attachment)
                                            <span class="text-green-600" title="Has attachment">📎</span>
                                        @endif
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-12">
                        <a href="{{ route('student.hall-notice') }}"
                            class="inline-block px-8 py-4 btn-gradient text-white rounded-full font-semibold text-lg shadow-lg">
                            <span class="relative z-10">View All Notices</span>
                        </a>
                    </div>
                @else
                    <div class="text-center text-gray-500 py-10">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No notices found</h3>
                        <p class="text-gray-500">Please check back later for updates.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- Notice Modal -->
        <div id="noticeModal"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
            <div
                class="bg-white/95 backdrop-blur-lg rounded-3xl max-w-3xl w-full max-h-[90vh] overflow-y-auto border border-gray-200 shadow-2xl animate-bounce-in">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex-1 pr-4">
                            <h2 id="modalTitle" class="text-3xl font-bold text-gray-800 mb-3"></h2>
                            <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                                <span id="modalDate" class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </span>
                                <span id="modalCategory"
                                    class="px-3 py-1 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 rounded-full font-semibold"></span>
                            </div>
                        </div>
                        <button id="closeModal"
                            class="w-12 h-12 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div id="modalContent" class="text-gray-700 text-lg leading-relaxed mb-8 whitespace-pre-wrap">
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-6 border-t border-gray-200 gap-4">
                        <div class="flex flex-wrap items-center gap-4 text-gray-500 text-sm">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span id="modalAuthor"></span>
                            </span>
                            <span id="modalValidUntil" class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="flex space-x-3">
                            <button id="downloadBtn"
                                class="px-4 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition-all duration-300 font-semibold hover:scale-105"
                                style="display: none;">
                                <span class="mr-1">📥</span>Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Enhanced Quick Access Section -->
        <section class="py-8 sm:py-12 scroll-fade">
            <div class="text-center mb-2 sm:mb-4">
                <h2 class="text-3xl sm:text-4xl font-bold text-gradient mb-1 sm:mb-2">Quick Access</h2>
                <p class="text-lg sm:text-xl text-gray-600">Get started with these essential features</p>
            </div>

            <div class="quick-access-container">
                <div class="quick-access-card scroll-scale stagger-animation" style="--i: 0;">
                    <div class="quick-access-icon">📝</div>
                    <h4 class="font-semibold text-lg sm:text-xl mb-3 text-gray-800 relative z-10">Apply for Seat</h4>
                    <p class="text-gray-600 text-sm sm:text-base relative z-10">Submit your seat application with all
                        required documents and track your progress</p>
                    <div class="mt-4 relative z-10">
                        <a href="{{ route('student.auth', ['form_type' => 'login']) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-300">
                            Get Started <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="quick-access-card scroll-rotate stagger-animation" style="--i: 1;">
                    <div class="quick-access-icon">📊</div>
                    <h4 class="font-semibold text-lg sm:text-xl mb-3 text-gray-800 relative z-10">Track Status</h4>
                    <p class="text-gray-600 text-sm sm:text-base relative z-10">Monitor your application and complaint
                        status in real-time with detailed updates</p>
                    <div class="mt-4 relative z-10">
                        <a href="{{ route('student.auth', ['form_type' => 'login']) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-300">
                            Track Now <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="quick-access-card scroll-scale stagger-animation" style="--i: 2;">
                    <div class="quick-access-icon">🚨</div>
                    <h4 class="font-semibold text-lg sm:text-xl mb-3 text-gray-800 relative z-10">Emergency Support
                    </h4>
                    <p class="text-gray-600 text-sm sm:text-base relative z-10">Get immediate assistance for urgent
                        issues with 24/7 emergency response</p>
                    <div class="mt-4 relative z-10">
                        <a href="{{ route('student.auth', ['form_type' => 'login']) }}"
                            class="inline-flex items-center text-red-600 hover:text-red-800 font-medium text-sm transition-colors duration-300">
                            Contact Support <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white/90 backdrop-blur-md border-t border-gray-200 mt-16 sm:mt-20">
        <div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 sm:py-12">
            <div class="text-center text-gray-600">
                <p class="text-base sm:text-lg">&copy; 2025 Hall Seat and Complaint Management System. All rights
                    reserved.</p>
                <p class="mt-2 sm:mt-3 text-sm text-gray-500">Designed for students, by students.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/homepage.js') }}"></script>
</body>

</html>

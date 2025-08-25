<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTU Hall Management - Official Student Housing Administration</title>
    <meta name="description"
        content="Official NSTU platform for hall seat allocation and complaint management. Secure, reliable, and compliant student housing administration system for Noakhali Science and Technology University.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/homepage_professional.css') }}">
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Enhanced Professional Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50 border-b-2 border-gradient-to-r from-nstu-blue to-nstu-green">
        <nav class="max-w-7xl mx-auto px-4 py-3 sm:px-6">
            <div class="flex items-center justify-between">
                <!-- Enhanced Logo Section -->
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div
                            class="w-14 h-14 bg-white rounded-xl flex items-center justify-center p-2 shadow-lg transform hover:scale-105 transition-all duration-300 border-2 border-nstu-blue">
                            <img src="{{ asset('images/nstu_logo.png') }}" alt="NSTU Logo"
                                class="w-10 h-10 object-contain">
                        </div>
                        <div
                            class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full animate-pulse">
                        </div>
                    </div>
                    <div class="hidden sm:block">
                        <div class="text-xl font-bold text-nstu-blue">
                            NSTU Hall Management
                        </div>
                        <div class="text-xs text-gray-600 uppercase tracking-wider font-semibold">
                            Noakhali Science & Technology University
                        </div>
                    </div>
                </div>

                <!-- Enhanced Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="#services"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-nstu-blue font-medium transition-all duration-300 rounded-lg hover:bg-blue-50 relative group">
                        <span>Services</span>
                        <div
                            class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-gradient-to-r from-nstu-blue to-nstu-green transition-all duration-300 group-hover:w-full group-hover:left-0">
                        </div>
                    </a>
                    <a href="#process"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-nstu-blue font-medium transition-all duration-300 rounded-lg hover:bg-blue-50 relative group">
                        <span>Process</span>
                        <div
                            class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-gradient-to-r from-nstu-blue to-nstu-green transition-all duration-300 group-hover:w-full group-hover:left-0">
                        </div>
                    </a>
                    <a href="#support"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-nstu-blue font-medium transition-all duration-300 rounded-lg hover:bg-blue-50 relative group">
                        <span>Support</span>
                        <div
                            class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-gradient-to-r from-nstu-blue to-nstu-green transition-all duration-300 group-hover:w-full group-hover:left-0">
                        </div>
                    </a>
                    <a href="#contact"
                        class="nav-link px-4 py-2 text-gray-700 hover:text-nstu-blue font-medium transition-all duration-300 rounded-lg hover:bg-blue-50 relative group">
                        <span>Contact</span>
                        <div
                            class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-gradient-to-r from-nstu-blue to-nstu-green transition-all duration-300 group-hover:w-full group-hover:left-0">
                        </div>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100"
                    id="mobileMenuBtn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Enhanced Auth Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}"
                        class="px-5 py-2.5 text-gray-700 hover:text-nstu-blue font-semibold transition-all duration-300 rounded-lg hover:bg-gray-50 border border-transparent hover:border-gray-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}"
                        class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-green-600 text-white font-semibold transition-all duration-300 rounded-lg hover:from-blue-700 hover:to-green-700 transform hover:scale-105 hover:shadow-lg shadow-md">
                        <i class="fas fa-user-plus mr-2"></i>Sign Up
                    </a>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="mobileMenuOverlay">
            <div class="fixed inset-y-0 right-0 max-w-xs w-full bg-white shadow-xl">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-white rounded-lg flex items-center justify-center p-1.5 border border-nstu-blue">
                            <img src="{{ asset('images/nstu_logo.png') }}" alt="NSTU Logo"
                                class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">NSTU Hall Management</div>
                            <div class="text-xs text-gray-600">NSTU</div>
                        </div>
                    </div>
                    <button class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100"
                        id="mobileMenuClose">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <nav class="p-4 space-y-4">
                    <a href="#services" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Services</a>
                    <a href="#process" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Process</a>
                    <a href="#support" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Support</a>
                    <a href="#contact" class="block py-2 text-gray-700 hover:text-gray-900 font-medium">Contact</a>
                </nav>
                <div class="p-4 border-t border-gray-200 space-y-3">
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}"
                        class="block w-full py-2 px-4 text-center text-gray-700 hover:text-gray-900 font-medium border border-gray-300 rounded-md hover:bg-gray-50">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}"
                        class="block w-full py-2 px-4 text-center bg-gradient-to-r from-blue-600 to-green-600 text-white font-semibold rounded-md hover:from-blue-700 hover:to-green-700 transition-all duration-300 shadow-md">
                        <i class="fas fa-user-plus mr-2"></i>Sign Up
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hall Notices Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-nstu-blue mb-4">
                    Official NSTU Hall Announcements
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Stay informed with official notices, policy updates, and important communications from the
                    NSTU Hall Management Administration
                </p>
            </div>

            <!-- Search Section -->
            <div class="max-w-2xl mx-auto mb-8">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search notices, events, announcements..."
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <div id="searchLoader" class="absolute right-3 top-1/2 transform -translate-y-1/2 hidden">
                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-gray-900"></div>
                    </div>
                    <div id="searchResults" class="absolute left-4 -bottom-6 text-sm text-gray-500 hidden">
                        <span id="resultsCount">0</span> results found
                    </div>
                </div>
            </div>

            <!-- Filter Tags -->
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                <button
                    class="filter-tag active px-4 py-2 bg-gray-900 text-white rounded-md text-sm font-medium hover:bg-gray-800 transition-colors"
                    data-filter="all">
                    All Notices
                </button>
                <button
                    class="filter-tag px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors"
                    data-filter="announcement">
                    Announcements
                </button>
                <button
                    class="filter-tag px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors"
                    data-filter="event">
                    Events
                </button>
                <button
                    class="filter-tag px-4 py-2 bg-gray-100 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-200 transition-colors"
                    data-filter="deadline">
                    Deadlines
                </button>
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-12 hidden">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No notices found</h3>
                <p class="text-gray-500">Try adjusting your search or filter criteria</p>
            </div>

            <div class="max-w-6xl mx-auto">
                @if ($notices->isNotEmpty())
                    <div id="noticesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($notices as $index => $notice)
                            <div class="notice-card bg-white rounded-lg p-6 border border-gray-200 cursor-pointer transition-all duration-200 hover:shadow-lg hover:border-gray-300"
                                data-notice-id="{{ $notice->notice_id }}"
                                data-notice-type="{{ $notice->notice_type }}"
                                data-notice-title="{{ strtolower($notice->title) }}"
                                data-notice-description="{{ strtolower($notice->description) }}">

                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                        @if ($notice->notice_type === 'deadline')
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @elseif($notice->notice_type === 'event')
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    @if ($notice->attachment)
                                        <div class="w-5 h-5 text-gray-400" title="Has attachment">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                        {{ $notice->title }}
                                    </h3>
                                    <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed">
                                        {{ Str::limit($notice->description, 150) }}
                                    </p>
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
                                        <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-medium">
                                            {{ ucfirst($notice->notice_type) }}
                                        </span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-12">
                        <a href="{{ route('student.hall-notice') }}"
                            class="inline-block px-8 py-3 bg-gray-900 text-white rounded-md font-medium hover:bg-gray-800 transition-colors">
                            View All Notices
                        </a>
                    </div>
                @else
                    <div class="text-center text-gray-500 py-16">
                        <div class="text-8xl mb-6">📋</div>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-4">No notices available</h3>
                        <p class="text-lg text-gray-500 mb-8">Check back later for important updates and announcements.
                        </p>
                        <a href="{{ route('student.auth', ['form_type' => 'register']) }}"
                            class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors duration-300">
                            Get Started to Stay Updated
                        </a>
                    </div>
                @endif
            </div>
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

    <!-- Hero Section -->
    <section class="bg-gray-50 py-20 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center">
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <div
                            class="w-28 h-28 bg-white rounded-full flex items-center justify-center p-4 shadow-2xl transform hover:scale-105 transition-all duration-300 border-4 border-nstu-blue">
                            <img src="{{ asset('images/nstu_logo.png') }}" alt="NSTU Logo"
                                class="w-20 h-20 object-contain">
                        </div>
                        <div
                            class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full animate-pulse">
                        </div>
                    </div>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-nstu-blue mb-6">
                    NSTU Hall Management System
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10 leading-relaxed">
                    Official platform for Noakhali Science and Technology University student housing administration.
                    Secure, compliant, and efficient hall seat allocation and complaint management system.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}"
                        class="px-8 py-4 bg-gray-900 text-white rounded-md font-semibold hover:bg-gray-800 transition-colors">
                        Student Portal Access
                    </a>
                    <a href="#process"
                        class="px-8 py-4 border border-gray-300 text-gray-700 rounded-md font-semibold hover:bg-gray-50 transition-colors">
                        Learn More
                    </a>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">{{ $statistics['total_students'] ?? 0 }}
                        </div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">Registered Students</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">
                            {{ $statistics['satisfaction_rate'] ?? 0 }}%</div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">Satisfaction Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">{{ $statistics['occupancy_rate'] ?? 0 }}%
                        </div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">Occupancy Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">
                            {{ $statistics['resolved_complaints'] ?? 0 }}</div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">Issues Resolved</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-nstu-blue mb-4">
                    NSTU Hall Management Services
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Comprehensive student accommodation management with NSTU standards and institutional compliance
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="feature-title">Accommodation Management</h3>
                    <p class="feature-description">
                        Official NSTU hall allocation system with standardized procedures, fair distribution
                        policies, and compliance with university regulations.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check-circle"></i> NSTU policy-compliant allocation</li>
                        <li><i class="fas fa-check-circle"></i> Fair distribution system</li>
                        <li><i class="fas fa-check-circle"></i> University standards</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="feature-title">Application Processing</h3>
                    <p class="feature-description">
                        Transparent application review process with NSTU oversight, documented procedures, and
                        regular status updates for all applicants.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check-circle"></i> Transparent process</li>
                        <li><i class="fas fa-check-circle"></i> NSTU oversight</li>
                        <li><i class="fas fa-check-circle"></i> Regular updates</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 class="feature-title">Grievance Resolution</h3>
                    <p class="feature-description">
                        Formal complaint handling system with NSTU protocols, escalation procedures, and
                        documented resolution processes for student concerns.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check-circle"></i> NSTU formal procedures</li>
                        <li><i class="fas fa-check-circle"></i> University escalation protocols</li>
                        <li><i class="fas fa-check-circle"></i> Documented outcomes</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="feature-title">Compliance & Security</h3>
                    <p class="feature-description">
                        University-grade security protocols, data protection compliance, and adherence to NSTU
                        standards and educational regulations.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check-circle"></i> NSTU regulatory compliance</li>
                        <li><i class="fas fa-check-circle"></i> Data protection</li>
                        <li><i class="fas fa-check-circle"></i> University standards</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-nstu-blue mb-4">
                    NSTU Hall Application Process
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Official procedures for NSTU student hall application and management
                </p>
            </div>

            <div class="space-y-8">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3 class="step-title">NSTU Student Registration</h3>
                        <p class="step-description">Complete official registration using NSTU student credentials and
                            provide required academic documentation for verification.</p>
                        <div class="step-features">
                            <span class="step-tag">NSTU Registration</span>
                            <span class="step-tag">Document Verification</span>
                        </div>
                    </div>
                </div>

                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3 class="step-title">Hall Application Submission</h3>
                        <p class="step-description">Submit official hall application with required documentation,
                            following NSTU guidelines and procedures.</p>
                        <div class="step-features">
                            <span class="step-tag">Official Documentation</span>
                            <span class="step-tag">NSTU Guidelines</span>
                        </div>
                    </div>
                </div>

                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3 class="step-title">NSTU Review Process</h3>
                        <p class="step-description">Application undergoes NSTU hall administration review with
                            transparent
                            evaluation criteria and regular status communications.</p>
                        <div class="step-features">
                            <span class="step-tag">NSTU Review</span>
                            <span class="step-tag">Status Updates</span>
                        </div>
                    </div>
                </div>

                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3 class="step-title">Hall Seat Allocation</h3>
                        <p class="step-description">Receive official hall seat allocation notification with detailed
                            accommodation information and NSTU procedures.</p>
                        <div class="step-features">
                            <span class="step-tag">Official Notification</span>
                            <span class="step-tag">Detailed Information</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Support Section -->
    <section id="support" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-nstu-blue mb-4">
                    NSTU Student Support & Information
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Essential information and answers to common inquiries about NSTU hall management services
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-4">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>What are the eligibility requirements for NSTU hall accommodation?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Students must be officially enrolled at NSTU with valid student credentials.
                            Complete your official registration, provide required academic documentation, and follow
                            NSTU hall application procedures.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>What official documentation is required for NSTU hall applications?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Required documents include official NSTU student ID, academic transcripts, medical
                            certificates
                            (if applicable), and any special accommodation documentation. All documents must be
                            officially verified and comply with NSTU standards.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>What is the official processing timeline for NSTU hall applications?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Applications undergo NSTU hall administration review within 5-7 business days following
                            official
                            submission. Status updates are provided through official channels including email
                            notifications and the student portal dashboard.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>How does the NSTU hall grievance process work?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Our formal grievance system follows NSTU protocols with documented procedures,
                            assigned case officers, and transparent resolution timelines. All complaints are handled
                            according to NSTU standards and policies.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>How is student data protected and secured?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>We maintain university-grade security protocols with encrypted data storage, secure
                            authentication systems, and full compliance with educational privacy regulations. Student
                            information is protected according to NSTU data governance policies.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>What support is available for students with special accommodation needs?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>NSTU provides comprehensive support for students with medical, accessibility, or
                            dietary requirements. Special accommodation requests are processed through official channels
                            with appropriate documentation and NSTU approval procedures.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-nstu-blue mb-4">
                    Official NSTU Contact Information
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Connect with NSTU Hall Management Administration for official inquiries and support
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="contact-info">
                    <h3 class="contact-title">NSTU Hall Management Office</h3>
                    <p class="contact-description">Official contact channels for NSTU hall management services,
                        applications, and student support inquiries.
                    </p>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <i class="fas fa-envelope text-gray-600"></i>
                            <div>
                                <div class="method-label">Official Email</div>
                                <div class="method-value">hallmanagement@nstu.edu.bd</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-phone text-gray-600"></i>
                            <div>
                                <div class="method-label">Administrative Office</div>
                                <div class="method-value">+880-321-61051</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-clock text-gray-600"></i>
                            <div>
                                <div class="method-label">Office Hours</div>
                                <div class="method-value">Mon-Fri: 8:00 AM - 5:00 PM</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-map-marker-alt text-gray-600"></i>
                            <div>
                                <div class="method-label">Physical Address</div>
                                <div class="method-value">NSTU Hall Management Office, Administrative Building,
                                    Noakhali-3814</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h3 class="contact-title">Official Inquiry Form</h3>
                    <form class="contact-form-container">
                        <div class="form-group">
                            <label for="name">Full Name (as per NSTU records)</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">NSTU Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Inquiry Category</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select inquiry type</option>
                                <option value="hall-application">Hall Application</option>
                                <option value="grievance">Formal Grievance</option>
                                <option value="accommodation">Special Accommodation</option>
                                <option value="administrative">Administrative Inquiry</option>
                                <option value="policy">NSTU Policy Information</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Detailed Inquiry</label>
                            <textarea id="message" name="message" rows="4" required
                                placeholder="Please provide detailed information about your inquiry..."></textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Submit Official Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Quick Access Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-nstu-blue mb-4">
                    Access NSTU Hall Services
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Official NSTU hall management services and administrative support
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-university text-gray-600"></i>
                    </div>
                    <h4 class="quick-access-title">Hall Application</h4>
                    <p class="quick-access-description">Submit official hall application with required NSTU
                        documentation and track review progress.</p>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}" class="btn-primary">
                        Begin Application
                    </a>
                </div>

                <div class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-clipboard-check text-gray-600"></i>
                    </div>
                    <h4 class="quick-access-title">Application Status</h4>
                    <p class="quick-access-description">Monitor official application status and receive NSTU
                        updates through the student portal.</p>
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}" class="btn-primary">
                        Check Status
                    </a>
                </div>

                <div class="quick-access-card">
                    <div class="quick-access-icon">
                        <i class="fas fa-info-circle text-gray-600"></i>
                    </div>
                    <h4 class="quick-access-title">Administrative Support</h4>
                    <p class="quick-access-description">Access NSTU hall administration for official
                        inquiries and support services.</p>
                    <a href="#contact" class="btn-primary">
                        Contact Administration
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div
                            class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-2 mr-3 border border-nstu-blue">
                            <img src="{{ asset('images/nstu_logo.png') }}" alt="NSTU Logo"
                                class="w-8 h-8 object-contain">
                        </div>
                        <div>
                            <div class="footer-logo-text">NSTU Hall Management</div>
                            <div class="footer-logo-subtitle">Noakhali Science & Technology University</div>
                        </div>
                    </div>
                    <p class="footer-description">
                        Official NSTU platform for student hall administration, providing secure, compliant,
                        and transparent accommodation management services.
                    </p>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">Services</h4>
                    <a href="#services" class="footer-link">Hall Management Services</a>
                    <a href="#process" class="footer-link">Application Process</a>
                    <a href="#support" class="footer-link">Student Support</a>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">Administration</h4>
                    <a href="#contact" class="footer-link">Contact Administration</a>
                    <a href="#" class="footer-link">NSTU Policies & Procedures</a>
                    <a href="#" class="footer-link">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                </div>

                <div class="footer-column">
                    <h4 class="footer-heading">NSTU</h4>
                    <a href="https://www.nstu.edu.bd" class="footer-link">About NSTU</a>
                    <a href="#" class="footer-link">Academic Calendar</a>
                    <a href="#" class="footer-link">Student Resources</a>
                    <a href="#" class="footer-link">Campus Directory</a>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 NSTU Hall Management Administration. All rights reserved.</p>
                    <p>Official platform for secure, compliant, and transparent student hall management at Noakhali
                        Science & Technology University.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/homepage.js') }}"></script>
</body>

</html>

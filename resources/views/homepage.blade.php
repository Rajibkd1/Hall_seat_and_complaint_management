<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutional Hall Management System - Professional Student Housing Administration</title>
    <meta name="description"
        content="Official institutional platform for hall seat allocation and complaint management. Secure, reliable, and compliant student housing administration system.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/lenis@1.3.4/dist/lenis.css">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <script src="https://unpkg.com/lenis@1.3.4/dist/lenis.min.js"></script>
</head>

<body class="min-h-screen animated-bg">
    <!-- Professional Header -->
    <header class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-200">
        <nav class="max-w-7xl mx-auto px-4 py-4 sm:px-6">
            <div class="header-container">
                <!-- Enhanced Logo -->
                <div class="logo-section">
                    <div class="logo-icon">
                        <i class="fas fa-university text-2xl text-blue-600"></i>
                    </div>
                    <div class="logo-content">
                        <span class="logo-text">Institutional Housing</span>
                        <span class="logo-subtitle">Management System</span>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="nav-menu hidden lg:flex">
                    <a href="#services" class="nav-link">Services</a>
                    <a href="#process" class="nav-link">Process</a>
                    <a href="#support" class="nav-link">Support</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="mobile-menu-btn lg:hidden" id="mobileMenuBtn">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>

                <!-- Auth Buttons -->
                <div class="auth-buttons">
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}" class="header-btn header-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}" class="header-btn header-signup">
                        <i class="fas fa-user-plus"></i>
                        <span>Signup</span>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay hidden" id="mobileMenuOverlay">
            <div class="mobile-menu-content">
                <div class="mobile-menu-header">
                    <div class="mobile-logo">
                        <i class="fas fa-university text-xl text-blue-600"></i>
                        <span class="mobile-logo-text">Hall Management</span>
                    </div>
                    <button class="mobile-menu-close" id="mobileMenuClose">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="mobile-nav">
                    <a href="#services" class="mobile-nav-link">Services</a>
                    <a href="#process" class="mobile-nav-link">Process</a>
                    <a href="#support" class="mobile-nav-link">Support</a>
                    <a href="#contact" class="mobile-nav-link">Contact</a>
                </nav>
                <div class="mobile-auth-buttons">
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}"
                        class="mobile-auth-btn mobile-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}"
                        class="mobile-auth-btn mobile-signup">
                        <i class="fas fa-user-plus"></i>
                        <span>Signup</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hall Notices Section - First View -->
    <section class="notices-section scroll-fade bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6">
            <div class="text-center mb-12">
                <h2 class="section-title">
                    <span class="text-gradient">Official Announcements</span>
                </h2>
                <p class="section-subtitle">
                    Stay informed with official notices, policy updates, and important communications from the
                    institutional housing administration
                </p>
            </div>

            <!-- Enhanced Search Section -->
            <div class="max-w-2xl mx-auto mb-8">
                <div class="relative group">
                    <input type="text" id="searchInput" placeholder="Search notices, events, announcements..."
                        class="w-full px-6 py-4 bg-white/90 backdrop-blur-md border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 shadow-lg hover:shadow-xl text-base md:text-lg">

                    <!-- Search Icon -->
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-all duration-300">
                        <svg class="w-6 h-6 text-gray-400 group-focus-within:text-blue-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
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
                <button
                    class="filter-tag active px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 border border-blue-500 rounded-full text-white text-sm font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                    data-filter="all">
                    <span class="mr-2">📋</span>All Notices
                </button>
                <button
                    class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                    data-filter="announcement">
                    <span class="mr-2">📢</span>Announcements
                </button>
                <button
                    class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                    data-filter="event">
                    <span class="mr-2">🎉</span>Events
                </button>
                <button
                    class="filter-tag px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 rounded-full text-gray-700 text-sm font-semibold hover:bg-white hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                    data-filter="deadline">
                    <span class="mr-2">⏰</span>Deadlines
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
                            <div class="notice-card bg-white/90 backdrop-blur-lg rounded-2xl p-6 border border-gray-200/50 cursor-pointer transition-all duration-300 hover:shadow-2xl shadow-lg animate-notice-appear relative group"
                                style="animation-delay: {{ $index * 0.1 }}s"
                                data-notice-id="{{ $notice->notice_id }}"
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
                            class="inline-block px-8 py-4 btn-gradient text-white rounded-full font-semibold text-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                            <span class="relative z-10">📋 View All Notices</span>
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
    <section class="hero-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:py-32">
            <div class="text-center">
                <h1 class="hero-title">
                    Official <span class="text-gradient">Institutional Housing</span> Platform
                </h1>
                <p class="hero-subtitle">
                    Secure, compliant, and efficient student housing administration system.
                    Manage accommodations, track applications, and resolve concerns through our official institutional
                    platform.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}" class="btn-primary">
                        <i class="fas fa-user-graduate mr-2"></i>
                        Student Portal Access
                    </a>
                    <a href="#process" class="btn-secondary">
                        <i class="fas fa-info-circle mr-2"></i>
                        Learn More
                    </a>
                </div>

                <!-- Add institutional statistics -->
                <div class="hero-stats mt-12">
                    <div class="stat-item">
                        <div class="stat-number">{{ $statistics['total_students'] ?? 0 }}</div>
                        <div class="stat-label">Registered Students</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $statistics['satisfaction_rate'] ?? 0 }}%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $statistics['occupancy_rate'] ?? 0 }}%</div>
                        <div class="stat-label">Occupancy Rate</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $statistics['resolved_complaints'] ?? 0 }}</div>
                        <div class="stat-label">Issues Resolved</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="features-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Institutional Housing Services</h2>
                <p class="section-subtitle">Comprehensive student accommodation management with institutional standards
                    and compliance</p>
            </div>

            <div class="features-grid">
                <div class="feature-card scroll-scale" style="--delay: 0.1s">
                    <div class="feature-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="feature-title">Accommodation Management</h3>
                    <p class="feature-description">
                        Official institutional housing allocation system with standardized procedures, fair distribution
                        policies, and compliance with institutional regulations.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Policy-compliant allocation</li>
                        <li><i class="fas fa-check"></i> Fair distribution system</li>
                        <li><i class="fas fa-check"></i> Institutional standards</li>
                    </ul>
                </div>

                <div class="feature-card scroll-scale" style="--delay: 0.2s">
                    <div class="feature-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="feature-title">Application Processing</h3>
                    <p class="feature-description">
                        Transparent application review process with institutional oversight, documented procedures, and
                        regular status updates for all applicants.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Transparent process</li>
                        <li><i class="fas fa-check"></i> Institutional oversight</li>
                        <li><i class="fas fa-check"></i> Regular updates</li>
                    </ul>
                </div>

                <div class="feature-card scroll-scale" style="--delay: 0.3s">
                    <div class="feature-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h3 class="feature-title">Grievance Resolution</h3>
                    <p class="feature-description">
                        Formal complaint handling system with institutional protocols, escalation procedures, and
                        documented resolution processes for student concerns.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Formal procedures</li>
                        <li><i class="fas fa-check"></i> Escalation protocols</li>
                        <li><i class="fas fa-check"></i> Documented outcomes</li>
                    </ul>
                </div>

                <div class="feature-card scroll-scale" style="--delay: 0.4s">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="feature-title">Compliance & Security</h3>
                    <p class="feature-description">
                        Institutional-grade security protocols, data protection compliance, and adherence to educational
                        institution standards and regulations.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Regulatory compliance</li>
                        <li><i class="fas fa-check"></i> Data protection</li>
                        <li><i class="fas fa-check"></i> Institutional standards</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="how-it-works-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Institutional Process</h2>
                <p class="section-subtitle">Official procedures for student housing application and management</p>
            </div>

            <div class="process-timeline">
                <div class="process-step scroll-slide-left" style="--delay: 0.1s">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3 class="step-title">Student Registration</h3>
                        <p class="step-description">Complete official registration using institutional credentials and
                            provide required academic documentation for verification.</p>
                        <div class="step-features">
                            <span class="step-tag">Official Registration</span>
                            <span class="step-tag">Document Verification</span>
                        </div>
                    </div>
                </div>

                <div class="process-step scroll-slide-right" style="--delay: 0.2s">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3 class="step-title">Formal Application</h3>
                        <p class="step-description">Submit official housing application with required documentation,
                            following institutional guidelines and procedures.</p>
                        <div class="step-features">
                            <span class="step-tag">Official Documentation</span>
                            <span class="step-tag">Institutional Guidelines</span>
                        </div>
                    </div>
                </div>

                <div class="process-step scroll-slide-left" style="--delay: 0.3s">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3 class="step-title">Review Process</h3>
                        <p class="step-description">Application undergoes institutional review with transparent
                            evaluation criteria and regular status communications.</p>
                        <div class="step-features">
                            <span class="step-tag">Institutional Review</span>
                            <span class="step-tag">Status Updates</span>
                        </div>
                    </div>
                </div>

                <div class="process-step scroll-slide-right" style="--delay: 0.4s">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3 class="step-title">Official Allocation</h3>
                        <p class="step-description">Receive official housing allocation notification with detailed
                            accommodation information and institutional procedures.</p>
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
    <section id="support" class="faq-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Student Support & Information</h2>
                <p class="section-subtitle">Essential information and answers to common inquiries about institutional
                    housing services</p>
            </div>

            <div class="faq-container">
                <div class="faq-item scroll-scale" style="--delay: 0.1s">
                    <button class="faq-question">
                        <span>What are the eligibility requirements for institutional housing?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Students must be officially enrolled at the institution with valid student credentials.
                            Complete your official registration, provide required academic documentation, and follow
                            institutional housing application procedures.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.2s">
                    <button class="faq-question">
                        <span>What official documentation is required for housing applications?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Required documents include official student ID, academic transcripts, medical certificates
                            (if applicable), and any special accommodation documentation. All documents must be
                            officially verified and comply with institutional standards.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.3s">
                    <button class="faq-question">
                        <span>What is the official processing timeline for housing applications?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Applications undergo institutional review within 5-7 business days following official
                            submission. Status updates are provided through official channels including email
                            notifications and the student portal dashboard.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.4s">
                    <button class="faq-question">
                        <span>How does the institutional grievance process work?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Our formal grievance system follows institutional protocols with documented procedures,
                            assigned case officers, and transparent resolution timelines. All complaints are handled
                            according to institutional standards and policies.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.5s">
                    <button class="faq-question">
                        <span>How is student data protected and secured?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>We maintain institutional-grade security protocols with encrypted data storage, secure
                            authentication systems, and full compliance with educational privacy regulations. Student
                            information is protected according to institutional data governance policies.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.6s">
                    <button class="faq-question">
                        <span>What support is available for students with special accommodation needs?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>The institution provides comprehensive support for students with medical, accessibility, or
                            dietary requirements. Special accommodation requests are processed through official channels
                            with appropriate documentation and institutional approval procedures.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Official Contact Information</h2>
                <p class="section-subtitle">Connect with institutional housing administration for official inquiries
                    and support</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info scroll-slide-left" style="--delay: 0.1s">
                    <h3 class="contact-title">Institutional Housing Office</h3>
                    <p class="contact-description">Official contact channels for institutional housing services,
                        applications, and student support inquiries.
                    </p>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <i class="fas fa-envelope text-blue-600"></i>
                            <div>
                                <div class="method-label">Official Email</div>
                                <div class="method-value">housing@institution.edu</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-phone text-green-600"></i>
                            <div>
                                <div class="method-label">Administrative Office</div>
                                <div class="method-value">+1 (555) 123-4567</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-clock text-purple-600"></i>
                            <div>
                                <div class="method-label">Office Hours</div>
                                <div class="method-value">Mon-Fri: 8:00 AM - 5:00 PM</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-map-marker-alt text-orange-600"></i>
                            <div>
                                <div class="method-label">Physical Address</div>
                                <div class="method-value">Student Housing Administration, Building A, Room 205</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form scroll-slide-right" style="--delay: 0.2s">
                    <h3 class="contact-title">Official Inquiry Form</h3>
                    <form class="contact-form-container">
                        <div class="form-group">
                            <label for="name">Full Name (as per institutional records)</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Institutional Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Inquiry Category</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select inquiry type</option>
                                <option value="housing-application">Housing Application</option>
                                <option value="grievance">Formal Grievance</option>
                                <option value="accommodation">Special Accommodation</option>
                                <option value="administrative">Administrative Inquiry</option>
                                <option value="policy">Policy Information</option>
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
    <section class="quick-access-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Access Institutional Services</h2>
                <p class="section-subtitle">Official student housing services and administrative support</p>
            </div>

            <div class="quick-access-container">
                <div class="quick-access-card scroll-scale" style="--delay: 0.1s">
                    <div class="quick-access-icon">
                        <i class="fas fa-university text-blue-600"></i>
                    </div>
                    <h4 class="quick-access-title">Housing Application</h4>
                    <p class="quick-access-description">Submit official housing application with required institutional
                        documentation and track review progress.</p>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}" class="btn-primary">
                        Begin Application
                    </a>
                </div>

                <div class="quick-access-card scroll-scale" style="--delay: 0.2s">
                    <div class="quick-access-icon">
                        <i class="fas fa-clipboard-check text-green-600"></i>
                    </div>
                    <h4 class="quick-access-title">Application Status</h4>
                    <p class="quick-access-description">Monitor official application status and receive institutional
                        updates through the student portal.</p>
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}" class="btn-primary">
                        Check Status
                    </a>
                </div>

                <div class="quick-access-card scroll-scale" style="--delay: 0.3s">
                    <div class="quick-access-icon">
                        <i class="fas fa-info-circle text-purple-600"></i>
                    </div>
                    <h4 class="quick-access-title">Administrative Support</h4>
                    <p class="quick-access-description">Access institutional housing administration for official
                        inquiries and support services.</p>
                    <a href="#contact" class="btn-primary">
                        Contact Administration
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Footer -->
    <footer class="footer-section">
        <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <i class="fas fa-university text-2xl text-blue-600"></i>
                        <div>
                            <div class="footer-logo-text">Institutional Housing</div>
                            <div class="footer-logo-subtitle">Official Student Administration</div>
                        </div>
                    </div>
                    <p class="footer-description">
                        Official institutional platform for student housing administration, providing secure, compliant,
                        and transparent accommodation management services.
                    </p>
                </div>

                <div class="footer-links">
                    <div class="footer-column">
                        <h4 class="footer-heading">Services</h4>
                        <a href="#services" class="footer-link">Housing Services</a>
                        <a href="#process" class="footer-link">Application Process</a>
                        <a href="#support" class="footer-link">Student Support</a>
                    </div>

                    <div class="footer-column">
                        <h4 class="footer-heading">Administration</h4>
                        <a href="#contact" class="footer-link">Contact Administration</a>
                        <a href="#" class="footer-link">Policies & Procedures</a>
                        <a href="#" class="footer-link">Privacy Policy</a>
                        <a href="#" class="footer-link">Terms of Service</a>
                    </div>

                    <div class="footer-column">
                        <h4 class="footer-heading">Institution</h4>
                        <a href="#" class="footer-link">About Institution</a>
                        <a href="#" class="footer-link">Academic Calendar</a>
                        <a href="#" class="footer-link">Student Resources</a>
                        <a href="#" class="footer-link">Campus Directory</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 Institutional Housing Administration. All rights reserved.</p>
                    <p>Official platform for secure, compliant, and transparent student housing management.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/homepage.js') }}"></script>
</body>

</html>

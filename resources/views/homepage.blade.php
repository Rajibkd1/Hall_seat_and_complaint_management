<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Seat and Complaint Management System - Professional Student Housing Solutions</title>
    <meta name="description"
        content="Streamline your hall accommodation experience with our comprehensive seat allocation and complaint management system. Apply for seats, track applications, and resolve issues efficiently.">
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
                        <span class="logo-text">Hall Management</span>
                        <span class="logo-subtitle">Seat and Complaint Solutions</span>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="nav-menu hidden lg:flex">
                    <a href="#features" class="nav-link">Features</a>
                    <a href="#how-it-works" class="nav-link">How It Works</a>
                    <a href="#faq" class="nav-link">FAQ</a>
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
                    <a href="#features" class="mobile-nav-link">Features</a>
                    <a href="#how-it-works" class="mobile-nav-link">How It Works</a>
                    <a href="#faq" class="mobile-nav-link">FAQ</a>
                    <a href="#contact" class="mobile-nav-link">Contact</a>
                </nav>
                <div class="mobile-auth-buttons">
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}" class="mobile-auth-btn mobile-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}" class="mobile-auth-btn mobile-signup">
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
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    📢 <span class="text-gradient">Latest Hall Notices</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Stay updated with important announcements, events, and deadlines from hall administration
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
                    Streamline Your <span class="text-gradient">Hall Experience</span>
                </h1>
                <p class="hero-subtitle">
                    Professional seat allocation and complaint management system designed for modern student housing.
                    Apply for accommodations, track your applications, and resolve issues with ease.
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}" class="btn-primary">
                        <i class="fas fa-rocket mr-2"></i>
                        Start Your Application
                    </a>
                    <a href="#how-it-works" class="btn-secondary">
                        <i class="fas fa-play-circle mr-2"></i>
                        See How It Works
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Seat and Complaint Solutions</h2>
                <p class="section-subtitle">Complete management system for hall seat allocation and complaint resolution</p>
            </div>

            <div class="features-grid">
                <div class="feature-card scroll-scale" style="--delay: 0.1s">
                    <div class="feature-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h3 class="feature-title">Smart Seat Allocation</h3>
                    <p class="feature-description">
                        Intelligent room assignment system that considers your preferences, academic requirements, and
                        compatibility factors for optimal accommodation.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Preference-based matching</li>
                        <li><i class="fas fa-check"></i> Real-time availability</li>
                        <li><i class="fas fa-check"></i> Automated processing</li>
                    </ul>
                </div>

                <div class="feature-card scroll-scale" style="--delay: 0.2s">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Application Tracking</h3>
                    <p class="feature-description">
                        Monitor your seat application status in real-time with detailed progress updates and transparent
                        communication throughout the process.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Real-time updates</li>
                        <li><i class="fas fa-check"></i> Email notifications</li>
                        <li><i class="fas fa-check"></i> Status dashboard</li>
                    </ul>
                </div>

                <div class="feature-card scroll-scale" style="--delay: 0.3s">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="feature-title">Complaint Management</h3>
                    <p class="feature-description">
                        Comprehensive complaint resolution system with priority handling, escalation procedures, and
                        satisfaction tracking for quick issue resolution.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Priority support</li>
                        <li><i class="fas fa-check"></i> Issue escalation</li>
                        <li><i class="fas fa-check"></i> Resolution tracking</li>
                    </ul>
                </div>

                <div class="feature-card scroll-scale" style="--delay: 0.4s">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Secure & Reliable</h3>
                    <p class="feature-description">
                        Enterprise-grade security with encrypted data storage, secure authentication, and reliable
                        system performance for peace of mind.
                    </p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Data encryption</li>
                        <li><i class="fas fa-check"></i> Secure access</li>
                        <li><i class="fas fa-check"></i> 24/7 availability</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="how-it-works-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">How It Works</h2>
                <p class="section-subtitle">Simple steps to secure your ideal accommodation</p>
            </div>

            <div class="process-timeline">
                <div class="process-step scroll-slide-left" style="--delay: 0.1s">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3 class="step-title">Create Account</h3>
                        <p class="step-description">Register with your student credentials and complete your profile
                            with academic and personal information.</p>
                        <div class="step-features">
                            <span class="step-tag">Quick Setup</span>
                            <span class="step-tag">Secure Verification</span>
                        </div>
                    </div>
                </div>

                <div class="process-step scroll-slide-right" style="--delay: 0.2s">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3 class="step-title">Submit Application</h3>
                        <p class="step-description">Fill out your accommodation preferences, upload required documents,
                            and submit your application.</p>
                        <div class="step-features">
                            <span class="step-tag">Smart Matching</span>
                            <span class="step-tag">Document Upload</span>
                        </div>
                    </div>
                </div>

                <div class="process-step scroll-slide-left" style="--delay: 0.3s">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3 class="step-title">Track Progress</h3>
                        <p class="step-description">Monitor your application status in real-time and receive updates
                            via email and dashboard notifications.</p>
                        <div class="step-features">
                            <span class="step-tag">Real-time Updates</span>
                            <span class="step-tag">Email Alerts</span>
                        </div>
                    </div>
                </div>

                <div class="process-step scroll-slide-right" style="--delay: 0.4s">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3 class="step-title">Get Approved</h3>
                        <p class="step-description">Receive your seat allocation confirmation and access your
                            accommodation details and move-in information.</p>
                        <div class="step-features">
                            <span class="step-tag">Instant Confirmation</span>
                            <span class="step-tag">Move-in Guide</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- FAQ Section -->
    <section id="faq" class="faq-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Find answers to common questions about our platform</p>
            </div>

            <div class="faq-container">
                <div class="faq-item scroll-scale" style="--delay: 0.1s">
                    <button class="faq-question">
                        <span>How do I apply for a hall seat?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Simply create an account with your student credentials, complete your profile, and submit
                            your accommodation preferences. Our system will guide you through each step with clear
                            instructions.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.2s">
                    <button class="faq-question">
                        <span>What documents do I need to upload?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>You'll need your student ID, academic transcripts, and any relevant medical or special
                            accommodation requirements. All documents are securely stored and encrypted.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.3s">
                    <button class="faq-question">
                        <span>How long does the application process take?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Most applications are processed within 3-5 business days. You'll receive real-time updates
                            via email and your dashboard as your application progresses through each stage.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.4s">
                    <button class="faq-question">
                        <span>Can I track my complaint status?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Yes! Our complaint tracking system provides real-time updates on your issue status, assigned
                            staff, estimated resolution time, and detailed progress notes.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.5s">
                    <button class="faq-question">
                        <span>Is my personal information secure?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Absolutely. We use enterprise-grade encryption, secure authentication, and comply with all
                            privacy regulations. Your data is never shared with third parties.</p>
                    </div>
                </div>

                <div class="faq-item scroll-scale" style="--delay: 0.6s">
                    <button class="faq-question">
                        <span>What if I have special accommodation needs?</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Our system accommodates special requirements including medical needs, accessibility features,
                            and dietary restrictions. Simply indicate your needs during the application process.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section scroll-fade">
        <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6">
            <div class="text-center mb-16">
                <h2 class="section-title">Get In Touch</h2>
                <p class="section-subtitle">We're here to help with any questions or concerns</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info scroll-slide-left" style="--delay: 0.1s">
                    <h3 class="contact-title">Contact Information</h3>
                    <p class="contact-description">Reach out to us through any of these channels for prompt assistance.
                    </p>

                    <div class="contact-methods">
                        <div class="contact-method">
                            <i class="fas fa-envelope text-blue-600"></i>
                            <div>
                                <div class="method-label">Email Support</div>
                                <div class="method-value">support@hallmanagement.edu</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-phone text-green-600"></i>
                            <div>
                                <div class="method-label">Phone Support</div>
                                <div class="method-value">+880 1234-567890</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-clock text-purple-600"></i>
                            <div>
                                <div class="method-label">Support Hours</div>
                                <div class="method-value">24/7 Emergency Support</div>
                            </div>
                        </div>

                        <div class="contact-method">
                            <i class="fas fa-map-marker-alt text-orange-600"></i>
                            <div>
                                <div class="method-label">Office Location</div>
                                <div class="method-value">Student Services Building, Room 101</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form scroll-slide-right" style="--delay: 0.2s">
                    <h3 class="contact-title">Send Us a Message</h3>
                    <form class="contact-form-container">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a topic</option>
                                <option value="application">Application Support</option>
                                <option value="complaint">Complaint Issue</option>
                                <option value="technical">Technical Support</option>
                                <option value="general">General Inquiry</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Send Message
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
                <h2 class="section-title">Ready to Get Started?</h2>
                <p class="section-subtitle">Join thousands of students who trust our platform</p>
            </div>

            <div class="quick-access-container">
                <div class="quick-access-card scroll-scale" style="--delay: 0.1s">
                    <div class="quick-access-icon">
                        <i class="fas fa-bed text-blue-600"></i>
                    </div>
                    <h4 class="quick-access-title">Apply for Seat</h4>
                    <p class="quick-access-description">Submit your application with required documents and track
                        progress in real-time.</p>
                    <a href="{{ route('student.auth', ['form_type' => 'register']) }}" class="btn-primary">
                        Start Application
                    </a>
                </div>

                <div class="quick-access-card scroll-scale" style="--delay: 0.2s">
                    <div class="quick-access-icon">
                        <i class="fas fa-chart-line text-green-600"></i>
                    </div>
                    <h4 class="quick-access-title">Track Status</h4>
                    <p class="quick-access-description">Monitor your applications and complaints with detailed progress
                        updates.</p>
                    <a href="{{ route('student.auth', ['form_type' => 'login']) }}" class="btn-primary">
                        Track Now
                    </a>
                </div>

                <div class="quick-access-card scroll-scale" style="--delay: 0.3s">
                    <div class="quick-access-icon">
                        <i class="fas fa-headset text-purple-600"></i>
                    </div>
                    <h4 class="quick-access-title">Get Support</h4>
                    <p class="quick-access-description">24/7 assistance for urgent issues and general inquiries.</p>
                    <a href="#contact" class="btn-primary">
                        Contact Support
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
                            <div class="footer-logo-text">Hall Management</div>
                            <div class="footer-logo-subtitle">Professional Housing Solutions</div>
                        </div>
                    </div>
                    <p class="footer-description">
                        Streamlining student accommodation with intelligent seat allocation and comprehensive complaint
                        management.
                    </p>
                </div>

                <div class="footer-links">
                    <div class="footer-column">
                        <h4 class="footer-heading">Quick Links</h4>
                        <a href="#features" class="footer-link">Features</a>
                        <a href="#how-it-works" class="footer-link">How It Works</a>
                        <a href="#faq" class="footer-link">FAQ</a>
                    </div>

                    <div class="footer-column">
                        <h4 class="footer-heading">Support</h4>
                        <a href="#contact" class="footer-link">Contact Us</a>
                        <a href="#" class="footer-link">Help Center</a>
                        <a href="#" class="footer-link">Privacy Policy</a>
                        <a href="#" class="footer-link">Terms of Service</a>
                    </div>

                    <div class="footer-column">
                        <h4 class="footer-heading">Connect</h4>
                        <a href="#" class="footer-link">Facebook</a>
                        <a href="#" class="footer-link">Twitter</a>
                        <a href="#" class="footer-link">LinkedIn</a>
                        <a href="#" class="footer-link">Instagram</a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; 2025 Hall Seat and Complaint Management System. All rights reserved.</p>
                    <p>Designed for students, by students. Built with ❤️ for better accommodation experiences.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/homepage.js') }}"></script>
</body>

</html>

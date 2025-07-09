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
    <!-- Enhanced Particle Background -->
    <div class="particle-container" id="particles"></div>

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
                    <a href="{{ route('student.login') }}" class="header-btn header-login magnetic-effect">
                        <span>🔐</span>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('student.register.page') }}" class="header-btn header-signup glow-effect magnetic-effect">
                        <span>✨</span>
                        <span>Sign Up</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-6 sm:px-6 sm:py-8">
        <!-- Enhanced Hero Section with Smaller Mobile Text -->
        <section class="hero-section text-center scroll-fade">
            <div class="relative z-10">
                <div class="floating-animation">
                    <div class="text-4xl mb-6 opacity-90 filter drop-shadow-lg">🎓</div>
                </div>
                <h1 class="hero-title parallax-element">
                    Hall Seat & Complaint<br>
                    <span class="opacity-90">Management System</span>
                </h1>
                <p class="hero-subtitle parallax-element">
                    Streamline your hall experience with our comprehensive platform for seat allocation and complaint management. 
                    Transparent, efficient, and designed for students.
                </p>
            </div>
        </section>

        <div class="section-divider"></div>

        <!-- Enhanced Services Section -->
        <section class="py-12 sm:py-16 scroll-fade">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gradient mb-4 sm:mb-6 parallax-element">Our Services</h2>
                <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto parallax-element">
                    Everything you need to manage your hall experience efficiently and transparently.
                </p>
            </div>
            
            <div class="feature-grid">
                <div class="feature-card scroll-slide-left stagger-animation" style="--i: 0;">
                    <div class="text-4xl sm:text-5xl mb-4 sm:mb-6 text-center floating-animation">🎯</div>
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 sm:mb-6 text-center">Seat Allocation</h3>
                    <ul class="text-gray-600 space-y-2 sm:space-y-3 text-base sm:text-lg">
                        <li class="flex items-center"><span class="text-green-500 mr-3">✓</span>Merit-based transparent allocation</li>
                        <li class="flex items-center"><span class="text-green-500 mr-3">✓</span>Real-time application tracking</li>
                        <li class="flex items-center"><span class="text-green-500 mr-3">✓</span>Seat transfer and change requests</li>
                        <li class="flex items-center"><span class="text-green-500 mr-3">✓</span>Priority system for final year students</li>
                    </ul>
                </div>
                
                <div class="feature-card scroll-slide-right stagger-animation" style="--i: 1;">
                    <div class="text-4xl sm:text-5xl mb-4 sm:mb-6 text-center floating-animation">📋</div>
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 sm:mb-6 text-center">Complaint Management</h3>
                    <ul class="text-gray-600 space-y-2 sm:space-y-3 text-base sm:text-lg">
                        <li class="flex items-center"><span class="text-blue-500 mr-3">✓</span>Easy complaint submission</li>
                        <li class="flex items-center"><span class="text-blue-500 mr-3">✓</span>Photo/video evidence upload</li>
                        <li class="flex items-center"><span class="text-blue-500 mr-3">✓</span>Real-time status tracking</li>
                        <li class="flex items-center"><span class="text-blue-500 mr-3">✓</span>Emergency complaint handling</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="section-divider"></div>

        <!-- Enhanced Quick Access Section -->
        <section class="py-12 sm:py-16 scroll-fade">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gradient mb-4 sm:mb-6 parallax-element">Quick Access</h2>
                <p class="text-lg sm:text-xl text-gray-600 parallax-element">Get started with these essential features</p>
            </div>
            
            <div class="quick-access-container">
                <div class="quick-access-card scroll-scale stagger-animation" style="--i: 0;">
                    <div class="quick-access-icon">📝</div>
                    <h4 class="font-semibold text-lg sm:text-xl mb-3 text-gray-800">Apply for Seat</h4>
                    <p class="text-gray-600 text-sm sm:text-base">Submit your seat application with all required documents and track your progress</p>
                </div>
                
                <div class="quick-access-card scroll-rotate stagger-animation" style="--i: 1;">
                    <div class="quick-access-icon">📊</div>
                    <h4 class="font-semibold text-lg sm:text-xl mb-3 text-gray-800">Track Status</h4>
                    <p class="text-gray-600 text-sm sm:text-base">Monitor your application and complaint status in real-time with detailed updates</p>
                </div>
                
                <div class="quick-access-card scroll-scale stagger-animation" style="--i: 2;">
                    <div class="quick-access-icon">🚨</div>
                    <h4 class="font-semibold text-lg sm:text-xl mb-3 text-gray-800">Emergency Support</h4>
                    <p class="text-gray-600 text-sm sm:text-base">Get immediate assistance for urgent issues with 24/7 emergency response</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white/90 backdrop-blur-md border-t border-gray-200 mt-16 sm:mt-20">
        <div class="max-w-6xl mx-auto px-4 py-8 sm:px-6 sm:py-12">
            <div class="text-center text-gray-600">
                <p class="text-base sm:text-lg">&copy; 2025 Hall Seat and Complaint Management System. All rights reserved.</p>
                <p class="mt-2 sm:mt-3 text-sm text-gray-500">Designed for students, by students.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/homepage.js') }}"></script>
</body>
</html>

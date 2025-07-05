<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTU Hall Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .input-focus:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        /* Password Strength Indicator */
        .strength-bar {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
            background: #e5e7eb;
        }
        
        .strength-very-weak { 
            background: linear-gradient(90deg, #ef4444, #dc2626);
            box-shadow: 0 0 8px rgba(239, 68, 68, 0.3);
        }
        
        .strength-weak { 
            background: linear-gradient(90deg, #f97316, #ea580c);
            box-shadow: 0 0 8px rgba(249, 115, 22, 0.3);
        }
        
        .strength-medium { 
            background: linear-gradient(90deg, #f59e0b, #d97706);
            box-shadow: 0 0 8px rgba(245, 158, 11, 0.3);
        }
        
        .strength-strong { 
            background: linear-gradient(90deg, #10b981, #059669);
            box-shadow: 0 0 8px rgba(16, 185, 129, 0.3);
        }
        
        .strength-very-strong { 
            background: linear-gradient(90deg, #059669, #047857);
            box-shadow: 0 0 8px rgba(5, 150, 105, 0.3);
        }
        
        /* Animations */
        .animate-slide-down {
            animation: slideDown 0.5s ease-out;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Dropdown Styles */
        .dropdown-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #d1d5db;
            border-top: none;
            background: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .dropdown-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f3f4f6;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: #f8fafc;
            color: #667eea;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        /* Success checkmark animation */
        .success-checkmark {
            animation: checkmark 0.5s ease-in-out;
        }
        
        @keyframes checkmark {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        /* Loading spinner */
        .spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Custom scrollbar */
        .dropdown-list::-webkit-scrollbar {
            width: 6px;
        }
        
        .dropdown-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .dropdown-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        
        .dropdown-list::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-2xl glass-effect p-8 rounded-3xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-graduation-cap text-white text-3xl"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Student Registration</h2>
            <p class="text-gray-600 text-lg">Join NSTU Hall Management System</p>
        </div>

        <!-- Error Message -->
        @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg animate-fade-in">
            <div class="flex">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3 mt-1"></i>
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <form id="registration-form" method="POST" action="{{ url('/student/register') }}">
            @csrf

            <!-- Email Verification Section -->
            <div id="email-section" class="space-y-6">
                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>Email Address
                    </label>
                    <div class="flex">
                        <input type="email" id="email" name="email" 
                               class="flex-1 p-4 border border-gray-300 rounded-l-xl input-focus transition-all duration-200 text-lg" 
                               placeholder="Enter your university email" required>
                        <button type="button" onclick="sendCode()" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-8 rounded-r-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                            <i class="fas fa-paper-plane mr-2"></i>Send Code
                        </button>
                    </div>
                </div>

                <!-- Verification Code Field (Initially Hidden) -->
                <div id="verification-section" class="space-y-3 hidden animate-slide-down">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-shield-alt mr-2 text-green-500"></i>Verification Code
                    </label>
                    <div class="flex">
                        <input type="text" id="code" name="code" 
                               class="flex-1 p-4 border border-gray-300 rounded-l-xl input-focus transition-all duration-200 text-lg text-center font-mono tracking-widest" 
                               placeholder="Enter 6-digit code" maxlength="6">
                        <button type="button" onclick="verifyCode()" 
                                class="btn-secondary text-white px-8 rounded-r-xl transition-all duration-200 font-semibold">
                            <i class="fas fa-check mr-2"></i>Verify
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 text-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Check your email for the verification code
                    </p>
                </div>
            </div>

            <!-- Main Registration Form -->
            <div id="rest-of-form" class="hidden animate-slide-down space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-user mr-2 text-purple-500"></i>Full Name
                        </label>
                        <input type="text" name="name" 
                               class="w-full p-4 border border-gray-300 rounded-xl input-focus transition-all duration-200 text-lg" 
                               placeholder="Enter your full name" required>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-id-card mr-2 text-indigo-500"></i>University ID
                        </label>
                        <input type="text" name="university_id" 
                               class="w-full p-4 border border-gray-300 rounded-xl input-focus transition-all duration-200 text-lg" 
                               placeholder="e.g., 2021331001" required>
                    </div>

                    <div class="space-y-3 relative">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-building mr-2 text-orange-500"></i>Department
                        </label>
                        <input type="text" id="department" name="department" 
                               class="w-full p-4 border border-gray-300 rounded-xl input-focus transition-all duration-200 text-lg" 
                               placeholder="Start typing your department..." 
                               autocomplete="off" required
                               onkeyup="filterDepartments()"
                               onfocus="showDepartments()"
                               onblur="hideDepartments()">
                        <div id="department-dropdown" class="absolute z-10 w-full hidden dropdown-list"></div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-calendar mr-2 text-teal-500"></i>Session Year
                        </label>
                        <input type="number" name="session_year" min="2000" max="2030"
                               class="w-full p-4 border border-gray-300 rounded-xl input-focus transition-all duration-200 text-lg" 
                               placeholder="e.g., 2021" required>
                    </div>

                    <div class="space-y-3 md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-phone mr-2 text-pink-500"></i>Phone Number
                        </label>
                        <input type="text" name="phone" 
                               class="w-full p-4 border border-gray-300 rounded-xl input-focus transition-all duration-200 text-lg" 
                               placeholder="e.g., +8801XXXXXXXXX" required>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-red-500"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" 
                                   class="w-full p-4 border border-gray-300 rounded-xl input-focus transition-all duration-200 pr-12 text-lg" 
                                   placeholder="Create a strong password" required
                                   onkeyup="checkPasswordStrength()">
                            <button type="button" onclick="togglePassword('password')" 
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                <i id="password-toggle" class="fas fa-eye text-xl"></i>
                            </button>
                        </div>
                        
                        <!-- Enhanced Password Strength Indicator -->
                        <div class="mt-4 space-y-2">
                            <div class="flex space-x-2">
                                <div id="strength-1" class="strength-bar flex-1"></div>
                                <div id="strength-2" class="strength-bar flex-1"></div>
                                <div id="strength-3" class="strength-bar flex-1"></div>
                                <div id="strength-4" class="strength-bar flex-1"></div>
                                <div id="strength-5" class="strength-bar flex-1"></div>
                            </div>
                            <div class="flex justify-between items-center">
                                <p id="strength-text" class="text-sm font-medium">Password strength</p>
                                <div id="strength-percentage" class="text-sm font-bold"></div>
                            </div>
                            <div id="password-requirements" class="text-xs space-y-1">
                                <div id="req-length" class="flex items-center text-gray-500">
                                    <i class="fas fa-circle mr-2 text-xs"></i>At least 8 characters
                                </div>
                                <div id="req-uppercase" class="flex items-center text-gray-500">
                                    <i class="fas fa-circle mr-2 text-xs"></i>One uppercase letter
                                </div>
                                <div id="req-lowercase" class="flex items-center text-gray-500">
                                    <i class="fas fa-circle mr-2 text-xs"></i>One lowercase letter
                                </div>
                                <div id="req-number" class="flex items-center text-gray-500">
                                    <i class="fas fa-circle mr-2 text-xs"></i>One number
                                </div>
                                <div id="req-special" class="flex items-center text-gray-500">
                                    <i class="fas fa-circle mr-2 text-xs"></i>One special character
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-red-500"></i>Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" id="confirm_password" name="confirm_password" 
                                   class="w-full p-4 border border-gray-300 rounded-xl input-focus transition-all duration-200 pr-12 text-lg" 
                                   placeholder="Confirm your password" required
                                   onkeyup="checkPasswordMatch()">
                            <button type="button" onclick="togglePassword('confirm_password')" 
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                <i id="confirm_password-toggle" class="fas fa-eye text-xl"></i>
                            </button>
                        </div>
                        <div id="password-match" class="text-sm mt-2 font-medium"></div>
                    </div>
                </div>

                <button type="submit" id="submit-btn" disabled
                        class="w-full py-4 btn-gradient text-white font-bold text-lg rounded-xl transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none">
                    <i class="fas fa-user-plus mr-2"></i>Create Account
                </button>
            </div>
        </form>

        <div class="text-center mt-8 pt-6 border-t border-gray-200">
            <p class="text-gray-600 text-lg">
                Already have an account? 
                <a href="{{ url('/student/login') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200 hover:underline">
                    Sign in here
                </a>
            </p>
        </div>
    </div>

    <script>
        let emailVerified = false;
        let codeSent = false;
        
        const departments = [
            "Computer Science and Telecommunication Engineering (CSTE)",
            "Applied Chemistry and Chemical Engineering (ACCE)",
            "Information and Communication Engineering (ICE)",
            "Electrical and Electronics Engineering (EEE)",
            "Software Engineering (Institute of Information Technology)",
            "Applied Mathematics",
            "Statistics",
            "Oceanography",
            "Chemistry",
            "Physics",
            "Environmental Science and Disaster Management (ESDM)",
            "Fisheries and Marine Science (FIMS)",
            "Pharmacy",
            "Microbiology",
            "Biochemistry and Molecular Biology (BMB)",
            "Food Technology and Nutrition Science (FTNS)",
            "Biotechnology and Genetic Engineering (BGE)",
            "Agriculture",
            "Soil, Water & Environmental Sciences (SWES)",
            "Zoology",
            "English",
            "Economics",
            "Political Science",
            "Bangla",
            "Sociology",
            "Social Work",
            "Business Administration (DBA)",
            "Tourism and Hospitality Management (THM)",
            "Management Information Systems (MIS)",
            "Education",
            "Educational Administration",
            "Law",
            "Information Sciences and Library Management (ISLM)"
        ];

        function sendCode() {
            const email = document.getElementById('email').value;
            if (!email) {
                showAlert("Please enter an email address.", "warning");
                return;
            }

            if (!isValidEmail(email)) {
                showAlert("Please enter a valid email address.", "warning");
                return;
            }

            // Show loading state
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner spinner mr-2"></i>Sending...';
            button.disabled = true;

            fetch("{{ url('/student/send-code') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'exists') {
                    if (confirm(data.message + "\nDo you want to go to login page?")) {
                        window.location.href = "{{ url('/student/login') }}";
                    }
                } else if (data.status === 'success') {
                    codeSent = true;
                    showAlert(data.message, 'success');
                    // Show verification code field with animation
                    document.getElementById('verification-section').classList.remove('hidden');
                    document.getElementById('code').focus();
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .catch(err => {
                console.error(err);
                showAlert("Error sending verification code. Please try again.", "error");
            })
            .finally(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }

        function verifyCode() {
            const email = document.getElementById('email').value;
            const code = document.getElementById('code').value;

            if (!email || !code) {
                showAlert("Please enter both email and verification code.", "warning");
                return;
            }

            if (code.length !== 6) {
                showAlert("Verification code must be 6 digits.", "warning");
                return;
            }

            // Show loading state
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner spinner mr-2"></i>Verifying...';
            button.disabled = true;

            fetch("{{ url('/student/verify-code') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email, code: code })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    emailVerified = true;
                    showAlert(data.message, 'success');
                    
                    // Add success checkmark animation
                    button.innerHTML = '<i class="fas fa-check success-checkmark mr-2"></i>Verified!';
                    button.classList.add('bg-green-500');
                    
                    setTimeout(() => {
                        document.getElementById('rest-of-form').classList.remove('hidden');
                        document.getElementById('email-section').classList.add('hidden');
                        document.querySelector('input[name="name"]').focus();
                    }, 1000);
                } else {
                    showAlert(data.message, 'error');
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                showAlert("Verification failed. Please try again.", "error");
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = document.getElementById(fieldId + '-toggle');
            
            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4'),
                document.getElementById('strength-5')
            ];
            const strengthText = document.getElementById('strength-text');
            const strengthPercentage = document.getElementById('strength-percentage');

            // Reset bars
            strengthBars.forEach(bar => {
                bar.className = 'strength-bar flex-1';
            });

            if (password.length === 0) {
                strengthText.textContent = 'Password strength';
                strengthText.className = 'text-sm font-medium text-gray-500';
                strengthPercentage.textContent = '';
                resetRequirements();
                return;
            }

            let strength = 0;
            let requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };

            // Update requirement indicators
            updateRequirement('req-length', requirements.length);
            updateRequirement('req-uppercase', requirements.uppercase);
            updateRequirement('req-lowercase', requirements.lowercase);
            updateRequirement('req-number', requirements.number);
            updateRequirement('req-special', requirements.special);

            // Calculate strength
            Object.values(requirements).forEach(met => {
                if (met) strength++;
            });

            // Bonus points for length
            if (password.length >= 12) strength += 0.5;
            if (password.length >= 16) strength += 0.5;

            strength = Math.min(strength, 5);
            const percentage = Math.round((strength / 5) * 100);

            // Update visual indicators
            for (let i = 0; i < Math.floor(strength); i++) {
                if (strength <= 1) {
                    strengthBars[i].classList.add('strength-very-weak');
                } else if (strength <= 2) {
                    strengthBars[i].classList.add('strength-weak');
                } else if (strength <= 3) {
                    strengthBars[i].classList.add('strength-medium');
                } else if (strength <= 4) {
                    strengthBars[i].classList.add('strength-strong');
                } else {
                    strengthBars[i].classList.add('strength-very-strong');
                }
            }

            // Update text and percentage
            if (strength <= 1) {
                strengthText.textContent = 'Very Weak';
                strengthText.className = 'text-sm font-medium text-red-500';
            } else if (strength <= 2) {
                strengthText.textContent = 'Weak';
                strengthText.className = 'text-sm font-medium text-orange-500';
            } else if (strength <= 3) {
                strengthText.textContent = 'Medium';
                strengthText.className = 'text-sm font-medium text-yellow-500';
            } else if (strength <= 4) {
                strengthText.textContent = 'Strong';
                strengthText.className = 'text-sm font-medium text-green-500';
            } else {
                strengthText.textContent = 'Very Strong';
                strengthText.className = 'text-sm font-medium text-green-600';
            }

            strengthPercentage.textContent = percentage + '%';
            strengthPercentage.className = strengthText.className;

            checkPasswordMatch();
        }

        function updateRequirement(id, met) {
            const element = document.getElementById(id);
            const icon = element.querySelector('i');
            
            if (met) {
                element.classList.remove('text-gray-500');
                element.classList.add('text-green-500');
                icon.classList.remove('fa-circle');
                icon.classList.add('fa-check-circle');
            } else {
                element.classList.remove('text-green-500');
                element.classList.add('text-gray-500');
                icon.classList.remove('fa-check-circle');
                icon.classList.add('fa-circle');
            }
        }

        function resetRequirements() {
            const requirements = ['req-length', 'req-uppercase', 'req-lowercase', 'req-number', 'req-special'];
            requirements.forEach(id => {
                const element = document.getElementById(id);
                const icon = element.querySelector('i');
                element.classList.remove('text-green-500');
                element.classList.add('text-gray-500');
                icon.classList.remove('fa-check-circle');
                icon.classList.add('fa-circle');
            });
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const matchDiv = document.getElementById('password-match');
            const submitBtn = document.getElementById('submit-btn');

            if (confirmPassword.length === 0) {
                matchDiv.innerHTML = '';
                submitBtn.disabled = true;
                return;
            }

            if (password === confirmPassword) {
                matchDiv.innerHTML = '<i class="fas fa-check-circle text-green-500 mr-2"></i>Passwords match';
                matchDiv.className = 'text-sm mt-2 font-medium text-green-500';
                submitBtn.disabled = !emailVerified;
            } else {
                matchDiv.innerHTML = '<i class="fas fa-times-circle text-red-500 mr-2"></i>Passwords do not match';
                matchDiv.className = 'text-sm mt-2 font-medium text-red-500';
                submitBtn.disabled = true;
            }
        }

        // Department dropdown functions
        function filterDepartments() {
            const input = document.getElementById('department');
            const dropdown = document.getElementById('department-dropdown');
            const filter = input.value.toLowerCase();
            
            if (filter.length === 0) {
                dropdown.classList.add('hidden');
                return;
            }
            
            const filtered = departments.filter(dept => 
                dept.toLowerCase().includes(filter)
            );
            
            displayDepartments(filtered);
        }

        function showDepartments() {
            const input = document.getElementById('department');
            if (input.value.length === 0) {
                displayDepartments(departments);
            }
        }

        function hideDepartments() {
            setTimeout(() => {
                document.getElementById('department-dropdown').classList.add('hidden');
            }, 200);
        }

        function displayDepartments(depts) {
            const dropdown = document.getElementById('department-dropdown');
            
            if (depts.length === 0) {
                dropdown.classList.add('hidden');
                return;
            }
            
            dropdown.innerHTML = depts.map(dept => 
                `<div class="dropdown-item" onclick="selectDepartment('${dept}')">${dept}</div>`
            ).join('');
            
            dropdown.classList.remove('hidden');
        }

        function selectDepartment(dept) {
            document.getElementById('department').value = dept;
            document.getElementById('department-dropdown').classList.add('hidden');
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showAlert(message, type) {
            // Create alert element
            const alertDiv = document.createElement('div');
            alertDiv.className = `fixed top-4 right-4 p-4 rounded-xl shadow-2xl z-50 max-w-sm animate-fade-in ${
                type === 'success' ? 'bg-green-50 border-l-4 border-green-500 text-green-700' :
                type === 'warning' ? 'bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700' :
                'bg-red-50 border-l-4 border-red-500 text-red-700'
            }`;
            
            alertDiv.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${
                        type === 'success' ? 'fa-check-circle' :
                        type === 'warning' ? 'fa-exclamation-triangle' :
                        'fa-times-circle'
                    } mr-3 text-lg"></i>
                    <span class="font-medium">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-xl hover:opacity-70 transition-opacity">&times;</button>
                </div>
            `;
            
            document.body.appendChild(alertDiv);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.remove();
                }
            }, 5000);
        }

        // Form submission validation
        document.getElementById('registration-form').addEventListener('submit', function(e) {
            if (!emailVerified) {
                e.preventDefault();
                showAlert('Please verify your email first.', 'warning');
                return;
            }

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                showAlert('Passwords do not match.', 'error');
                return;
            }

            if (password.length < 8) {
                e.preventDefault();
                showAlert('Password must be at least 8 characters long.', 'error');
                return;
            }

            // Show loading state on submit
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.innerHTML = '<i class="fas fa-spinner spinner mr-2"></i>Creating Account...';
            submitBtn.disabled = true;
        });

        // Auto-format phone number
        document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('88')) {
                value = '+' + value;
            } else if (value.startsWith('01')) {
                value = '+880' + value.substring(1);
            }
            e.target.value = value;
        });

        // Auto-format university ID
        document.querySelector('input[name="university_id"]').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</body>

</html>

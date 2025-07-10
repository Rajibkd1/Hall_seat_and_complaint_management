<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NSTU Hall Management - Login/Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="container {{ $form_type == 'register' ? 'active' : '' }}">
        <!-- Login Form -->
        <div class="form-box login">
            <form action="{{ route('student.login.submit') }}" method="POST">
                @csrf
                <h1>Sign in to your account</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email Address" required>
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box">
                    <input type="password" id="login-password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt password-toggle' onclick="togglePassword('login-password', this)"></i>
                </div>

                <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="form-box register">
            <form id="registration-form" method="POST" action="{{ route('student.register.submit') }}">
                @csrf
                <h1>Create Account</h1>
                <p>Join NSTU Hall Management</p>

                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step active" id="step-1"></div>
                    <div class="step" id="step-2"></div>
                    <div class="step" id="step-3"></div>
                </div>

                <!-- Email Verification Section -->
                <div id="email-section">
                    <div class="input-box">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <button type="button" onclick="sendCode()" class="btn">
                        <i class="fas fa-paper-plane"></i>
                        Send Verification Code
                    </button>

                    <!-- Verification Code Field -->
                    <div id="verification-section" class="verification-section">
                        <div class="input-box">
                            <input type="text" id="code" name="code" placeholder="Enter 6-digit code"
                                maxlength="6" class="code-input">
                            <i class='fas fa-shield-alt'></i>
                        </div>
                        <button type="button" onclick="verifyCode()" class="btn btn-secondary">
                            <i class="fas fa-check"></i>
                            Verify Code
                        </button>
                    </div>
                </div>

                <!-- Main Registration Form -->
                <div id="rest-of-form" style="display: none;">
                    <div class="form-grid">
                        <div class="input-box">
                            <input type="text" name="name" placeholder="Full Name" required>
                            <i class='bx bxs-user'></i>
                        </div>
                        <div class="input-box">
                            <input type="text" name="university_id" placeholder="University ID" required>
                            <i class='fas fa-id-card'></i>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="input-box" style="position: relative;">
                            <input type="text" id="department" name="department" placeholder="Department" required
                                autocomplete="off" onkeyup="filterDepartments()" onfocus="showDepartments()"
                                onblur="hideDepartments()">
                            <i class='fas fa-building'></i>
                            <div id="department-dropdown" class="department-dropdown"></div>
                        </div>
                        <div class="input-box">
                            <input type="text" name="session_year" placeholder="Session Year (e.g., 2021-2022)"
                                required>
                            <i class='fas fa-calendar'></i>
                        </div>
                    </div>

                    <div class="input-box full-width">
                        <input type="text" name="phone" placeholder="Phone Number" required>
                        <i class='fas fa-phone'></i>
                    </div>

                    <div class="form-grid">
                        <div class="input-box">
                            <input type="password" id="password" name="password" placeholder="Password" required
                                onkeyup="checkPasswordStrength()">
                            <i class='bx bxs-lock-alt password-toggle' onclick="togglePassword('password', this)"></i>
                        </div>
                        <div class="input-box">
                            <input type="password" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Password" required onkeyup="checkPasswordMatch()">
                            <i class='bx bxs-lock-alt password-toggle'
                                onclick="togglePassword('confirm_password', this)"></i>
                        </div>
                    </div>

                    <!-- Password Strength Indicator -->
                    <div class="password-strength">
                        <div class="strength-bars">
                            <div id="strength-1" class="strength-bar"></div>
                            <div id="strength-2" class="strength-bar"></div>
                            <div id="strength-3" class="strength-bar"></div>
                            <div id="strength-4" class="strength-bar"></div>
                            <div id="strength-5" class="strength-bar"></div>
                        </div>
                        <div id="strength-text" style="font-size: 12px; color: #64748b; font-weight: 500;">Password
                            strength</div>

                        <div class="requirements">
                            <div id="req-length" class="req">
                                <i class="fas fa-circle"></i>At least 8 characters
                            </div>
                            <div id="req-uppercase" class="req">
                                <i class="fas fa-circle"></i>One uppercase letter
                            </div>
                            <div id="req-number" class="req">
                                <i class="fas fa-circle"></i>One number
                            </div>
                        </div>
                    </div>

                    <div id="password-match" style="font-size: 12px; margin: 10px 0; font-weight: 500;"></div>

                    <button type="submit" id="submit-btn" class="btn" disabled>
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </button>
                </div>
            </form>
        </div>

        <!-- Toggle Panels -->
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Enter your personal details and start your journey with us</p>
                <button class="btn register-btn">Create Account</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="btn login-btn">Sign In</button>
            </div>
        </div>
    </div>

    <script>
        // Global variables
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

        // Toggle between login and register
        const container = document.querySelector('.container');
        const registerBtn = document.querySelector('.register-btn');
        const loginBtn = document.querySelector('.login-btn');

        if (registerBtn) {
            registerBtn.addEventListener('click', () => {
                container.classList.add('active');
                updateStepIndicator(1);
                resetFormAnimations();
            });
        }

        if (loginBtn) {
            loginBtn.addEventListener('click', () => {
                container.classList.remove('active');
                resetFormAnimations();
            });
        }

        // Reset form animations when switching
        function resetFormAnimations() {
            const inputBoxes = document.querySelectorAll('.input-box');
            inputBoxes.forEach((box, index) => {
                box.style.animation = 'none';
                setTimeout(() => {
                    box.style.animation = `slideInRight 0.6s ease-out ${(index + 1) * 0.1}s forwards`;
                }, 50);
            });
        }

        // Mobile toggle functions
        function switchToRegister() {
            container.classList.add('active');
            updateStepIndicator(1);
            resetFormAnimations();
        }

        function switchToLogin() {
            container.classList.remove('active');
            resetFormAnimations();
        }

        // Step indicator with enhanced animation
        function updateStepIndicator(step) {
            const steps = document.querySelectorAll('.step');
            steps.forEach((stepEl, index) => {
                stepEl.classList.remove('active', 'completed');
                if (index < step - 1) {
                    stepEl.classList.add('completed');
                } else if (index === step - 1) {
                    stepEl.classList.add('active');
                }
            });
        }

        // Enhanced password toggle with smooth animation
        function togglePassword(fieldId, iconElement) {
            const field = document.getElementById(fieldId);

            // Add smooth transition
            iconElement.style.transform = 'translateY(-50%) scale(0.8)';

            setTimeout(() => {
                if (field.type === 'password') {
                    field.type = 'text';
                    iconElement.classList.remove('bxs-lock-alt');
                    iconElement.classList.add('bxs-lock-open-alt');
                    iconElement.style.color = '#3b82f6';
                } else {
                    field.type = 'password';
                    iconElement.classList.remove('bxs-lock-open-alt');
                    iconElement.classList.add('bxs-lock-alt');
                    iconElement.style.color = '#64748b';
                }

                iconElement.style.transform = 'translateY(-50%) scale(1)';
            }, 100);
        }

        // Email verification functions (preserved exactly)
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

            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner spinner"></i> Sending...';
            button.disabled = true;

            fetch('{{ route('student.send-code') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector(
                            'meta[name="csrf-token"]').getAttribute('content') : ''
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        codeSent = true;
                        showAlert(data.message, 'success');
                        document.getElementById('verification-section').classList.add('show');
                        document.getElementById('code').focus();
                    } else if (data.status === 'exists') {
                        showAlert(data.message, 'warning');
                    } else {
                        showAlert(data.message || 'Failed to send verification code.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred while sending the code.', 'error');
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

            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner spinner"></i> Verifying...';
            button.disabled = true;

            fetch('{{ route('student.verify-code') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector(
                            'meta[name="csrf-token"]').getAttribute('content') : ''
                    },
                    body: JSON.stringify({
                        email: email,
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        emailVerified = true;
                        showAlert(data.message, 'success');
                        button.innerHTML = '<i class="fas fa-check"></i> Verified!';
                        button.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';

                        updateStepIndicator(2);

                        setTimeout(() => {
                            document.getElementById('rest-of-form').style.display = 'block';
                            document.getElementById('email-section').style.display = 'none';

                            // Add mobile compact class for better mobile experience
                            if (window.innerWidth <= 650) {
                                document.querySelector('.form-box.register').classList.add('mobile-compact');
                            }

                            updateStepIndicator(3);
                            document.querySelector('input[name="name"]').focus();
                            resetFormAnimations();
                        }, 1000);
                    } else {
                        showAlert(data.message || 'Failed to verify code.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('An error occurred during verification.', 'error');
                })
                .finally(() => {
                    if (!emailVerified) {
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                });
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBars = document.querySelectorAll('.strength-bar');
            const strengthText = document.getElementById('strength-text');

            // Reset bars
            strengthBars.forEach(bar => {
                bar.classList.remove('active', 'weak', 'medium', 'strong');
            });

            if (password.length === 0) {
                strengthText.textContent = 'Password strength';
                strengthText.style.color = '#64748b';
                resetRequirements();
                return;
            }

            let strength = 0;
            let requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                number: /\d/.test(password)
            };

            // Update requirement indicators
            updateRequirement('req-length', requirements.length);
            updateRequirement('req-uppercase', requirements.uppercase);
            updateRequirement('req-number', requirements.number);

            // Calculate strength
            Object.values(requirements).forEach(met => {
                if (met) strength++;
            });

            // Update visual indicators with staggered animation
            for (let i = 0; i < strength; i++) {
                setTimeout(() => {
                    if (strength === 1) {
                        strengthBars[i].classList.add('active', 'weak');
                    } else if (strength === 2) {
                        strengthBars[i].classList.add('active', 'medium');
                    } else if (strength === 3) {
                        strengthBars[i].classList.add('active', 'strong');
                    }
                }, i * 100);
            }

            // Update text
            if (strength === 1) {
                strengthText.textContent = 'Weak';
                strengthText.style.color = '#ef4444';
            } else if (strength === 2) {
                strengthText.textContent = 'Medium';
                strengthText.style.color = '#f59e0b';
            } else if (strength === 3) {
                strengthText.textContent = 'Strong';
                strengthText.style.color = '#10b981';
            }

            checkPasswordMatch();
        }

        function updateRequirement(id, met) {
            const element = document.getElementById(id);
            const icon = element.querySelector('i');

            if (met) {
                element.classList.add('met');
                icon.classList.remove('fa-circle');
                icon.classList.add('fa-check-circle');
            } else {
                element.classList.remove('met');
                icon.classList.remove('fa-check-circle');
                icon.classList.add('fa-circle');
            }
        }

        function resetRequirements() {
            const requirements = ['req-length', 'req-uppercase', 'req-number'];
            requirements.forEach(id => {
                const element = document.getElementById(id);
                const icon = element.querySelector('i');
                element.classList.remove('met');
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
                matchDiv.innerHTML = '<i class="fas fa-check-circle" style="color: #10b981;"></i> Passwords match';
                matchDiv.style.color = '#10b981';
                submitBtn.disabled = !emailVerified;
            } else {
                matchDiv.innerHTML = '<i class="fas fa-times-circle" style="color: #ef4444;"></i> Passwords do not match';
                matchDiv.style.color = '#ef4444';
                submitBtn.disabled = true;
            }
        }

        // FIXED: Enhanced Department dropdown functions with proper z-index handling
        function filterDepartments() {
            const input = document.getElementById('department');
            const dropdown = document.getElementById('department-dropdown');
            const filter = input.value.toLowerCase();

            if (filter.length === 0) {
                dropdown.classList.remove('show');
                input.parentElement.style.zIndex = '1';
                return;
            }

            const filtered = departments.filter(dept =>
                dept.toLowerCase().includes(filter)
            );

            displayDepartments(filtered);
        }

        function showDepartments() {
            const input = document.getElementById('department');
            const dropdown = document.getElementById('department-dropdown');

            // Ensure proper z-index when showing dropdown
            input.parentElement.style.zIndex = '10000';

            if (input.value.length === 0) {
                displayDepartments(departments);
            }
        }

        function hideDepartments() {
            setTimeout(() => {
                const dropdown = document.getElementById('department-dropdown');
                const input = document.getElementById('department');
                dropdown.classList.remove('show');
                // Reset z-index after hiding
                input.parentElement.style.zIndex = '1';
            }, 200);
        }

        function displayDepartments(depts) {
            const dropdown = document.getElementById('department-dropdown');

            if (depts.length === 0) {
                dropdown.classList.remove('show');
                return;
            }

            dropdown.innerHTML = depts.map(dept =>
                `<div class="department-item" onclick="selectDepartment('${dept}')">${dept}</div>`
            ).join('');

            dropdown.classList.add('show');
        }

        function selectDepartment(dept) {
            const input = document.getElementById('department');
            const dropdown = document.getElementById('department-dropdown');

            input.value = dept;
            dropdown.classList.remove('show');
            // Reset z-index after selection
            input.parentElement.style.zIndex = '1';
        }

        // Utility functions
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${type}`;
            alertDiv.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center;">
                        <i class="fas ${
                            type === 'success' ? 'fa-check-circle' :
                            type === 'warning' ? 'fa-exclamation-triangle' :
                            'fa-times-circle'
                        }" style="margin-right: 8px;"></i>
                        <span>${message}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; font-size: 16px; cursor: pointer; color: inherit; opacity: 0.7; margin-left: 12px;">&times;</button>
                </div>
            `;

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.remove();
                }
            }, 5000);
        }

        // Auto-format phone number (preserved exactly)
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.querySelector('input[name="phone"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.startsWith('88')) {
                        value = '+' + value;
                    } else if (value.startsWith('01')) {
                        value = '+880' + value.substring(1);
                    }
                    e.target.value = value;
                });
            }
        });

        // Form submission validation (preserved exactly)
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

            const submitBtn = document.getElementById('submit-btn');
            submitBtn.innerHTML = '<i class="fas fa-spinner spinner"></i> Creating Account...';
            submitBtn.disabled = true;
        });

        // Handle window resize for mobile responsiveness
        window.addEventListener('resize', function() {
            if (window.innerWidth > 650) {
                document.querySelector('.form-box.register').classList.remove('mobile-compact');
            } else if (emailVerified) {
                document.querySelector('.form-box.register').classList.add('mobile-compact');
            }
        });

        // Initialize animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            resetFormAnimations();
        });
    </script>
</body>

</html>

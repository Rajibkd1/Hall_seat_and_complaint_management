<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTU Hall Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-focus:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        .floating-label {
            transition: all 0.3s ease;
        }
        .input-group:focus-within .floating-label {
            transform: translateY(-20px) scale(0.85);
            color: #667eea;
        }
        .input-group input:not(:placeholder-shown) + .floating-label {
            transform: translateY(-20px) scale(0.85);
            color: #667eea;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-2000"></div>
    </div>

    <div class="relative w-full max-w-md">
        <!-- Main Card -->
        <div class="glass-effect p-8 rounded-2xl shadow-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h2>
                <p class="text-gray-600">Sign in to your NSTU Hall account</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ url('/student/login') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div class="input-group relative">
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        placeholder=" "
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg input-focus outline-none transition-all duration-300 peer"
                        required
                    >
                    <label for="email" class="floating-label absolute left-4 top-3 text-gray-500 pointer-events-none">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                </div>

                <!-- Password Field -->
                <div class="input-group relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder=" "
                        class="w-full px-4 py-3 pr-12 bg-white border-2 border-gray-200 rounded-lg input-focus outline-none transition-all duration-300 peer"
                        required
                    >
                    <label for="password" class="floating-label absolute left-4 top-3 text-gray-500 pointer-events-none">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <button 
                        type="button" 
                        id="togglePassword"
                        class="absolute right-4 top-3 text-gray-500 hover:text-gray-700 focus:outline-none transition-colors duration-200"
                    >
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">
                        Forgot password?
                    </a>
                </div>

                <!-- Login Button -->
                <button 
                    type="submit" 
                    class="w-full btn-gradient text-white py-3 px-6 rounded-lg font-semibold text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign In
                </button>
            </form>

            <!-- Register Link -->
            <p class="text-center text-gray-600 mt-6">
                Don't have an account? 
                <a href="{{ url('/student/register') }}" class="text-blue-600 hover:text-blue-800 font-semibold hover:underline transition-colors duration-200">
                    Create Account
                </a>
            </p>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6 text-white text-sm opacity-75">
            <p>&copy; 2025 NSTU Hall Management System. All rights reserved.</p>
        </div>
    </div>

    <!-- JavaScript for Password Toggle -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Floating label animation
        document.querySelectorAll('.input-group input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>

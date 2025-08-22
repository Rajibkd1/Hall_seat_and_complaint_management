<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Provost - Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('super_admin.dashboard') }}" class="text-white hover:text-indigo-200">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold">Register New Provost</h1>
                        <p class="text-indigo-200">Create a new Provost account with OTP verification</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-8">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-tie text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Provost Registration</h2>
                <p class="text-gray-600">Fill in the details to create a new Provost account</p>
            </div>

            <form id="provostForm" method="POST" action="{{ route('super_admin.register_provost.submit') }}"
                class="space-y-6">
                @csrf

                <!-- Personal Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name
                                *</label>
                            <input type="text" name="name" id="name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter full name">
                        </div>

                        <div>
                            <label for="designation" class="block text-sm font-medium text-gray-700 mb-2">Designation
                                *</label>
                            <input type="text" name="designation" id="designation" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="e.g., Professor, Associate Professor">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address
                                *</label>
                            <div class="flex">
                                <input type="email" name="email" id="email" required
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="Enter email address">
                                <button type="button" id="sendOtpBtn"
                                    class="px-6 py-3 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                                    Send OTP
                                </button>
                            </div>
                            <div id="otpStatus" class="mt-2 text-sm"></div>
                        </div>

                        <div id="otpField" class="hidden">
                            <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">OTP Code
                                *</label>
                            <input type="text" name="otp" id="otp" maxlength="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter 6-digit OTP">
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number
                                *</label>
                            <input type="tel" name="phone" id="phone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter phone number">
                        </div>

                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Alternative
                                Contact *</label>
                            <input type="tel" name="contact_number" id="contact_number" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter alternative contact">
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Professional Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="hall_name" class="block text-sm font-medium text-gray-700 mb-2">Hall Name
                                *</label>
                            <input type="text" name="hall_name" id="hall_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter hall name">
                        </div>

                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Department
                                *</label>
                            <input type="text" name="department" id="department" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter department">
                        </div>
                    </div>
                </div>

                <!-- Password Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Security Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                *</label>
                            <input type="password" name="password" id="password" required minlength="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Enter password (min 6 characters)">
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                minlength="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Confirm password">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('super_admin.dashboard') }}"
                        class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" id="submitBtn" disabled
                        class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                        <i class="fas fa-user-plus mr-2"></i>
                        Register Provost
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let otpSent = false;
        let otpVerified = false;

        document.getElementById('sendOtpBtn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            const otpBtn = this;
            const otpStatus = document.getElementById('otpStatus');

            if (!email) {
                otpStatus.innerHTML = '<span class="text-red-600">Please enter email address first</span>';
                return;
            }

            otpBtn.disabled = true;
            otpBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';

            fetch('{{ route('super_admin.send_otp') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        otpStatus.innerHTML = '<span class="text-green-600"><i class="fas fa-check mr-1"></i>' +
                            data.message + '</span>';
                        document.getElementById('otpField').classList.remove('hidden');
                        otpSent = true;
                        checkFormValidity();

                        // Start countdown
                        let countdown = 60;
                        const countdownInterval = setInterval(() => {
                            otpBtn.innerHTML = `Resend OTP (${countdown}s)`;
                            countdown--;
                            if (countdown < 0) {
                                clearInterval(countdownInterval);
                                otpBtn.disabled = false;
                                otpBtn.innerHTML = 'Resend OTP';
                            }
                        }, 1000);
                    } else {
                        otpStatus.innerHTML = '<span class="text-red-600"><i class="fas fa-times mr-1"></i>' +
                            data.message + '</span>';
                        otpBtn.disabled = false;
                        otpBtn.innerHTML = 'Send OTP';
                    }
                })
                .catch(error => {
                    otpStatus.innerHTML =
                        '<span class="text-red-600"><i class="fas fa-times mr-1"></i>Failed to send OTP</span>';
                    otpBtn.disabled = false;
                    otpBtn.innerHTML = 'Send OTP';
                });
        });

        document.getElementById('otp').addEventListener('input', function() {
            if (this.value.length === 6) {
                verifyOTP();
            }
        });

        function verifyOTP() {
            const email = document.getElementById('email').value;
            const otp = document.getElementById('otp').value;
            const otpStatus = document.getElementById('otpStatus');

            fetch('{{ route('super_admin.verify_otp') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                            '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        otpStatus.innerHTML =
                            '<span class="text-green-600"><i class="fas fa-check-circle mr-1"></i>OTP verified successfully!</span>';
                        document.getElementById('otp').classList.add('border-green-500');
                        otpVerified = true;
                        checkFormValidity();
                    } else {
                        otpStatus.innerHTML = '<span class="text-red-600"><i class="fas fa-times-circle mr-1"></i>' +
                            data.message + '</span>';
                        document.getElementById('otp').classList.add('border-red-500');
                        otpVerified = false;
                        checkFormValidity();
                    }
                });
        }

        function checkFormValidity() {
            const submitBtn = document.getElementById('submitBtn');
            if (otpSent && otpVerified) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

        // Form validation
        document.getElementById('provostForm').addEventListener('submit', function(e) {
            if (!otpVerified) {
                e.preventDefault();
                alert('Please verify your email with OTP first');
            }
        });
    </script>
</body>

</html>

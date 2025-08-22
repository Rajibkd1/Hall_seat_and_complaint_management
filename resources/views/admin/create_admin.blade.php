@include('layouts.admin_layout_helper')
@extends($layout)

@section('title', 'Create Admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="hover:text-blue-600 transition-colors duration-200">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 font-medium">Create Admin</span>
            </nav>

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

            <div class="bg-white rounded-xl shadow-lg">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-t-xl">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-plus text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">Create New Admin</h1>
                            <p class="text-blue-100">Add Co-Provost or Staff member with OTP verification</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <form id="adminForm" method="POST" action="{{ route('admin.create_admin.submit') }}" class="space-y-6">
                        @csrf

                        <!-- Role Selection -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Role Selection</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="relative">
                                    <input type="radio" name="role_type" value="co_provost" class="sr-only peer" required>
                                    <div
                                        class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-300 transition-all duration-200">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-user-tie text-blue-600"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">Co-Provost</h4>
                                                <p class="text-sm text-gray-600">Limited permissions, notices need approval
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative">
                                    <input type="radio" name="role_type" value="staff" class="sr-only peer" required>
                                    <div
                                        class="p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-green-300 transition-all duration-200">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-users text-green-600"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900">Staff</h4>
                                                <p class="text-sm text-gray-600">Access to complaints and notices only</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name
                                        *</label>
                                    <input type="text" name="name" id="name" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Enter full name">
                                </div>

                                <div id="designationField">
                                    <label for="designation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Designation</label>
                                    <input type="text" name="designation" id="designation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="e.g., Assistant Professor (for Co-Provost)">
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address
                                        *</label>
                                    <div class="flex">
                                        <input type="email" name="email" id="email" required
                                            class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Enter email address">
                                        <button type="button" id="sendOtpBtn"
                                            class="px-6 py-3 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                                            Send OTP
                                        </button>
                                    </div>
                                    <div id="otpStatus" class="mt-2 text-sm"></div>
                                </div>

                                <div id="otpField" class="hidden">
                                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">OTP Code
                                        *</label>
                                    <input type="text" name="otp" id="otp" maxlength="6"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Enter 6-digit OTP">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone
                                        Number *</label>
                                    <input type="tel" name="phone" id="phone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Enter phone number">
                                </div>

                                <div>
                                    <label for="contact_number"
                                        class="block text-sm font-medium text-gray-700 mb-2">Alternative Contact *</label>
                                    <input type="tel" name="contact_number" id="contact_number" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Enter alternative contact">
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Professional Information</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="department"
                                        class="block text-sm font-medium text-gray-700 mb-2">Department *</label>
                                    <input type="text" name="department" id="department" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Enter password (min 6 characters)">
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        required minlength="6"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Confirm password">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" id="submitBtn" disabled
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                                <i class="fas fa-user-plus mr-2"></i>
                                Create Admin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let otpSent = false;
        let otpVerified = false;

        // Handle role type change
        document.querySelectorAll('input[name="role_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const designationField = document.getElementById('designationField');
                const designationInput = document.getElementById('designation');

                if (this.value === 'staff') {
                    designationField.style.display = 'none';
                    designationInput.required = false;
                } else {
                    designationField.style.display = 'block';
                    designationInput.required = true;
                }
            });
        });

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

            fetch('{{ route('admin.send_admin_otp') }}', {
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
        document.getElementById('adminForm').addEventListener('submit', function(e) {
            if (!otpVerified) {
                e.preventDefault();
                alert('Please verify your email with OTP first');
            }
        });
    </script>
@endsection

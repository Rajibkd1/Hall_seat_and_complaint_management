<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Co-Provost - Hall Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('provost.dashboard') }}" class="text-white hover:text-blue-200">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold">Create Co-Provost</h1>
                        <p class="text-blue-100">Add a new Co-Provost with OTP verification</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-friends text-white text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Co-Provost Registration</h2>
                    <p class="text-blue-100">Fill in the details to create a new Co-Provost account</p>
                </div>

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 m-6 rounded-lg">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-6 rounded-lg">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('provost.store-co-provost') }}" class="p-6 space-y-6">
                    @csrf
                    <input type="hidden" name="role" value="Co-Provost">

                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Personal Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Enter full name">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Designation *</label>
                                <input type="text" name="designation" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="e.g., Assistant Professor, Associate Professor">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <div class="flex space-x-2">
                                <input type="email" name="email" id="email" required
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Enter email address">
                                <button type="button" id="send-otp-btn"
                                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    Send OTP
                                </button>
                            </div>
                        </div>

                        <div id="otp-section" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Enter OTP *</label>
                            <input type="text" name="otp" id="otp"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                placeholder="Enter 6-digit OTP">
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Contact Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" name="phone" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Enter phone number">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alternative Contact</label>
                                <input type="tel" name="alternative_contact"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Enter alternative contact">
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Professional Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hall Name *</label>
                                <input type="text" name="hall_name" value="{{ $admin->hall_name }}" readonly
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Department *</label>
                                <input type="text" name="department" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Enter department">
                            </div>
                        </div>
                    </div>

                    <!-- Security Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Security Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                <input type="password" name="password" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Enter password (min 6 characters)">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Confirm password">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4 pt-6">
                        <a href="{{ route('provost.dashboard') }}"
                            class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-lg font-medium text-center hover:bg-gray-200 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" id="register-btn" disabled
                            class="flex-1 bg-blue-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors duration-200">
                            <i class="fas fa-user-plus mr-2"></i>
                            Create Co-Provost
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let otpSent = false;

        document.getElementById('send-otp-btn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            if (!email) {
                alert('Please enter email address first');
                return;
            }

            // Send OTP request
            fetch('{{ route('admin.send-otp') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('otp-section').classList.remove('hidden');
                        this.textContent = 'OTP Sent';
                        this.disabled = true;
                        otpSent = true;
                        checkFormValidity();
                    } else {
                        alert(data.message || 'Failed to send OTP');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to send OTP');
                });
        });

        document.getElementById('otp').addEventListener('input', checkFormValidity);

        function checkFormValidity() {
            const registerBtn = document.getElementById('register-btn');
            const otp = document.getElementById('otp').value;

            if (otpSent && otp.length === 6) {
                registerBtn.disabled = false;
            } else {
                registerBtn.disabled = true;
            }
        }
    </script>
</body>

</html>

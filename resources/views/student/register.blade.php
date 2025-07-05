<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTU Hall Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Student Registration</h2>

            @if(session('error'))
            <p class="text-red-500 mb-4">{{ session('error') }}</p>
            @endif

            <form id="registration-form" method="POST" action="{{ url('/student/register') }}">
                @csrf

                <!-- Email + Send Code + Verify -->
                <div id="email-section">
                    <label class="block mb-1 font-medium">Email</label>
                    <div class="flex mb-2">
                        <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-l" required>
                        <button type="button" onclick="sendCode()" class="bg-blue-500 text-white px-3 rounded-r">Send Code</button>
                    </div>

                    <label class="block mb-1 font-medium">Verification Code</label>
                    <div class="flex mb-2">
                        <input type="text" id="code" name="code" class="w-full p-2 border border-gray-300 rounded-l">
                        <button type="button" onclick="verifyCode()" class="bg-green-600 text-white px-3 rounded-r">Verify</button>
                    </div>
                </div>

                <!-- Hidden Form Fields -->
                <div id="rest-of-form" class="hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-medium">Name</label>
                            <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">University ID</label>
                            <input type="text" name="university_id" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Department</label>
                            <input type="text" name="department" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Session Year</label>
                            <input type="number" name="session_year" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-medium">Phone</label>
                            <input type="text" name="phone" class="w-full p-2 border border-gray-300 rounded" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block mb-1 font-medium">Password</label>
                        <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>

                    <button type="submit" class="w-full mt-6 bg-green-600 text-white py-2 rounded hover:bg-green-700">Register</button>
                </div>
            </form>

            <p class="text-center text-sm mt-4">
                Already have an account? <a href="{{ url('/student/login') }}" class="text-blue-600 hover:underline">Login here</a>
            </p>
        </div>
    </div>

    <script>
        function sendCode() {
            const email = document.getElementById('email').value;
            if (!email) {
                alert("Please enter an email.");
                return;
            }

            fetch("{{ url('/student/send-code') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'exists') {
                        if (confirm(data.message + "\nDo you want to go to login page?")) {
                            window.location.href = "{{ url('/student/login') }}";
                        }
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Error sending code.");
                });
        }



        function verifyCode() {
            const email = document.getElementById('email').value;
            const code = document.getElementById('code').value;

            if (!email || !code) {
                alert("Please enter both email and code.");
                return;
            }

            fetch("{{ url('/student/verify-code') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email,
                        code: code
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        document.getElementById('rest-of-form').classList.remove('hidden');
                        document.getElementById('email-section').classList.add('hidden');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => alert("Verification failed."));
        }
    </script>
</body>

</html>
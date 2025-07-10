<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTU Hall Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Login
                </button>
            </form>

            <p class="text-center text-sm mt-4">
                Don’t have an account? <a href="{{ url('/admin/register') }}"
                    class="text-blue-600 hover:underline">Register here</a>
            </p>
        </div>
    </div>
</body>

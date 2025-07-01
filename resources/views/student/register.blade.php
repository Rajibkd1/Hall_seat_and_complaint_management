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
        <div class="w-full max-w-lg bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Student Registration</h2>
            <form method="POST" action="{{ url('/student/register') }}">
                @csrf
    
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
                        <label class="block mb-1 font-medium">Email</label>
                        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
    
                    <div>
                        <label class="block mb-1 font-medium">Phone</label>
                        <input type="text" name="phone" class="w-full p-2 border border-gray-300 rounded" required>
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
                        <label class="block mb-1 font-medium">Current Address</label>
                        <input type="text" name="current_address" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
    
                    <div>
                        <label class="block mb-1 font-medium">Permanent Address</label>
                        <input type="text" name="permanent_address" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
    
                    <div>
                        <label class="block mb-1 font-medium">Father Name</label>
                        <input type="text" name="father_name" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
    
                    <div>
                        <label class="block mb-1 font-medium">Mother Name</label>
                        <input type="text" name="mother_name" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
    
                    <div>
                        <label class="block mb-1 font-medium">Guardian Alive Status</label>
                        <select name="guardian_alive_status" class="w-full p-2 border border-gray-300 rounded" required>
                            <option value="" disabled selected>Select status</option>
                            <option value="1">Alive</option>
                            <option value="0">Not Alive</option>
                        </select>
                    </div>
    
    
                    <div>
                        <label class="block mb-1 font-medium">Guardian Contact</label>
                        <input type="text" name="guardian_contact" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                </div>
    
                <div class="mt-4">
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
    
                <button type="submit" class="w-full mt-6 bg-green-600 text-white py-2 rounded hover:bg-green-700">
                    Register
                </button>
    
                <p class="text-center text-sm mt-4">
                    Already have an account? <a href="{{ url('/student/login') }}" class="text-blue-600 hover:underline">Login here</a>
                </p>
            </form>
        </div>
    </div>
</body>
    

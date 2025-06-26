@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Registration</h2>
        <form method="POST" action="{{ url('/admin/register') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium">Name</label>
                <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Phone</label>
                <input type="text" name="phone" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Role</label>
                <input type="text" name="role" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Department</label>
                <input type="text" name="department" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Teacher ID (Optional)</label>
                <input type="text" name="teacher_id" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Register
            </button>

            <p class="text-center text-sm mt-4">
                Already have an account? <a href="{{ url('/admin/login') }}" class="text-blue-600 hover:underline">Login here</a>
            </p>
        </form>
    </div>
</div>
@endsection

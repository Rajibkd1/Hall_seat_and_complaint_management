@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
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
            Don’t have an account? <a href="{{ url('/admin/register') }}" class="text-blue-600 hover:underline">Register here</a>
        </p>
    </div>
</div>
@endsection

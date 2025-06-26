@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full text-center">
        <h1 class="text-3xl font-bold mb-4">Welcome, {{ $student->name }}!</h1>
        <p class="text-gray-700">You have successfully logged in to your student dashboard.</p>
    </div>
</div>
@endsection

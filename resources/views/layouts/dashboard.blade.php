@extends('layouts.base')

@section('body-class', 'bg-gray-100 min-h-screen')

@section('content')
    <!-- Header -->
    <header class="@yield('header-class', 'bg-gradient-to-r from-blue-600 to-indigo-700') text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="@yield('header-icon', 'fas fa-user-shield') text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">@yield('dashboard-title', 'Dashboard')</h1>
                        <p class="@yield('subtitle-class', 'text-blue-100')">@yield('dashboard-subtitle', 'Welcome back!')</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="@yield('email-class', 'text-blue-100')">@yield('user-email')</span>
                    <form action="@yield('logout-route')" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        @yield('dashboard-content')
    </div>
@endsection

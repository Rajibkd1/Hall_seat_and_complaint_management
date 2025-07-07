<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NSTU Hall Management</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for better icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('head-scripts')
</head>

<body class="font-sans bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Header Section -->
    @section('header')
        @include('layouts.header')
    @show

    <!-- Tab Bar Section -->
    @section('tabbar')
        @include('layouts.tabbar')
    @show

    <!-- Sidebar Section -->
    @section('sidebar')
        @include('layouts.sidebar')
    @show

    <!-- Main Content Section -->
    <div class="w-full">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    if (sidebar && sidebarOverlay) {
                        sidebar.classList.toggle('-translate-x-full');
                        sidebarOverlay.classList.toggle('hidden');
                    }
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    if (sidebar && sidebarOverlay) {
                        sidebar.classList.add('-translate-x-full');
                        sidebarOverlay.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    @stack('scripts') <!-- Push custom scripts -->
</body>

</html>

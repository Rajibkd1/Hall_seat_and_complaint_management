<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/admin_student_profile.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin_student_profile.js') }}"></script>
    <link href="{{ asset('css/admin_students.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin_students.js') }}"></script>
    <script src="{{ asset('js/admin_view_complaint.js') }}"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styles for active tab indicator */
        .active-tab-indicator {
            border-bottom-width: 4px;
            border-color: #6366f1; /* A shade of indigo, adjust as needed */
            background-color: #f3f4f6; /* Light gray background */
        }
        /* Styles for dimming/blurring main content when sidebar is open */
        body.sidebar-open #mainContent {
            filter: blur(3px) brightness(0.7);
            pointer-events: none; /* Disable clicks on dimmed content */
            transition: filter 0.3s ease-in-out;
        }
        body:not(.sidebar-open) #mainContent {
            filter: none;
            pointer-events: auto;
            transition: filter 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    @include('layouts.admin_header')
    @include('layouts.admin_tabbar')
    @include('layouts.admin_sidebar')

    <div id="mainContent">
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const menuButton = document.getElementById('menuButton');

            if (menuButton) {
                menuButton.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarOverlay.classList.toggle('hidden');
                    document.body.classList.toggle('sidebar-open'); // Toggle body class
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                    document.body.classList.remove('sidebar-open'); // Remove body class
                });
            }
        });
    </script>
</body>
</html>
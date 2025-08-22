<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <style>
        .staff-gradient {
            background: linear-gradient(135deg, #581c87 0%, #7c3aed 50%, #a855f7 100%);
        }

        .staff-card {
            background: rgba(168, 85, 247, 0.1);
            border: 1px solid rgba(168, 85, 247, 0.2);
        }
        
        /* Responsive navigation improvements */
        @media (min-width: 1024px) {
            .nav-link {
                white-space: nowrap;
            }
        }
        
        @media (min-width: 1280px) {
            .nav-link {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
        
        /* Staff has fewer navigation items, so more spacing on large screens */
        @media (min-width: 1536px) {
            .nav-link {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
    </style>
</head>

<body class="bg-slate-50">
    <!-- Desktop Navigation (≥1024px) -->
    <div class="hidden lg:block">
        @include('layouts.staff_tabbar')
    </div>

    <!-- Mobile Navigation (<1024px) -->
    <div class="lg:hidden">
        @include('layouts.staff_sidebar')
    </div>

    <!-- Main Content -->
    <main class="lg:pt-16">
        @yield('content')
    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>

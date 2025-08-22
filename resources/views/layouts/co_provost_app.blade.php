<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Co-Provost Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <style>
        .co-provost-gradient {
            background: linear-gradient(135deg, #065f46 0%, #047857 50%, #10b981 100%);
        }

        .co-provost-card {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        
        /* Responsive navigation improvements */
        @media (min-width: 1024px) {
            .nav-link {
                white-space: nowrap;
            }
        }
        
        @media (min-width: 1280px) {
            .nav-link {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
        
        /* Prevent overflow on large screens */
        @media (min-width: 1536px) {
            .nav-link {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
    </style>
</head>

<body class="bg-slate-50">
    <!-- Desktop Navigation (≥1024px) -->
    <div class="hidden lg:block">
        @include('layouts.co_provost_tabbar')
    </div>

    <!-- Mobile Navigation (<1024px) -->
    <div class="lg:hidden">
        @include('layouts.co_provost_sidebar')
    </div>

    <!-- Main Content -->
    <main class="lg:pt-16">
        @yield('content')
    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>

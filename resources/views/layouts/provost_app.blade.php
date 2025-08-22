<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Provost Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <style>
        .provost-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #3b82f6 100%);
        }

        .provost-card {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        /* Responsive navigation improvements */
        @media (min-width: 1024px) {
            .nav-link {
                white-space: nowrap;
            }
        }

        @media (min-width: 1280px) {
            .nav-link {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }

        /* Provost has most navigation items, so tighter spacing on very large screens */
        @media (min-width: 1536px) {
            .nav-link {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>

<body class="bg-slate-50">
    <!-- Desktop Navigation (≥1024px) -->
    <div class="hidden lg:block">
        @include('layouts.provost_tabbar')
    </div>

    <!-- Mobile Navigation (<1024px) -->
    <div class="lg:hidden">
        @include('layouts.provost_sidebar')
    </div>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>

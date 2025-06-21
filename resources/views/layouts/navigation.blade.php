@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('tabbar')
    @include('layouts.tabbar')
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('scripts').
<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const tabBar = document.getElementById('tabBar');
    const sidebarToggle = document.getElementById('sidebarToggle');

    // Toggle sidebar visibility on mobile
    sidebarToggle.addEventListener('click', function () {
        if (window.innerWidth < 1024) {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }
    });

    // Close sidebar when clicking overlay
    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    });

    // Handle window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            tabBar.classList.remove('hidden');
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        } else {
            tabBar.classList.add('hidden');
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }
    });

    // Initialize based on window size on load
    function initializeLayout() {
        if (window.innerWidth >= 1024) {
            tabBar.classList.remove('hidden');
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        } else {
            tabBar.classList.add('hidden');
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }
    }
    // Update active navigation styling
    function updateActiveNavigation(activeId) {
        // Reset all nav links (sidebar)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('bg-gradient-to-r', 'from-slate-100', 'to-slate-200', 'text-slate-900', 'border-slate-600', 'from-red-100', 'to-red-200', 'text-red-700', 'border-red-600');
            link.classList.add('border-transparent');
            
            if (link.textContent.trim().includes('Sign Out')) {
                link.classList.add('text-red-600');
                link.classList.remove('text-slate-700');
            } else {
                link.classList.add('text-slate-700');
                link.classList.remove('text-red-600');
            }
        });
        
        // Reset all tab links (desktop)
        document.querySelectorAll('.tab-link').forEach(link => {
            link.classList.remove('text-slate-700', 'border-slate-600', 'bg-gradient-to-b', 'from-slate-100', 'to-slate-200', 'text-red-700', 'border-red-600', 'from-red-100', 'to-red-200');
            link.classList.add('border-transparent');
            
            if (link.textContent.trim().includes('Sign Out')) {
                link.classList.add('text-red-600');
                link.classList.remove('text-slate-600');
            } else {
                link.classList.add('text-slate-600');
                link.classList.remove('text-red-600');
            }
        });

        // Set active styling for sidebar
        const activeNavLink = document.querySelector(`[onclick="showContent('${activeId}')"].nav-link`);
        if (activeNavLink) {
            if (activeId === 'logout') {
                activeNavLink.classList.remove('border-transparent', 'text-red-600');
                activeNavLink.classList.add('bg-gradient-to-r', 'from-red-100', 'to-red-200', 'text-red-700', 'border-red-600');
            } else {
                activeNavLink.classList.remove('border-transparent', 'text-slate-700');
                activeNavLink.classList.add('bg-gradient-to-r', 'from-slate-100', 'to-slate-200', 'text-slate-900', 'border-slate-600');
            }
        }
        
        // Set active styling for tab bar
        const activeTabLink = document.querySelector(`[onclick="showContent('${activeId}')"].tab-link`);
        if (activeTabLink) {
            if (activeId === 'logout') {
                activeTabLink.classList.remove('border-transparent', 'text-red-600');
                activeTabLink.classList.add('text-red-700', 'border-red-600', 'bg-gradient-to-b', 'from-red-100', 'to-red-200');
            } else {
                activeTabLink.classList.remove('border-transparent', 'text-slate-600');
                activeTabLink.classList.add('text-slate-700', 'border-slate-600', 'bg-gradient-to-b', 'from-slate-100', 'to-slate-200');
            }
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initializeLayout();
        showContent('home'); // Show home content by default
    });

    // Add custom styles and animations
    document.addEventListener('DOMContentLoaded', function() {
        const style = document.createElement('style');
        style.textContent = `
            /* Custom animations */
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
            
            .content-section {
                animation: slideInUp 0.4s ease-out;
            }
            
            /* Smooth transitions */
            .nav-link, .tab-link {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            /* Enhanced hover effects */
            .nav-link:hover, .tab-link:hover {
                transform: translateY(-1px);
            }
            
            /* Focus states for accessibility */
            .nav-link:focus, .tab-link:focus {
                outline: 2px solid #64748b;
                outline-offset: 2px;
                border-radius: 12px;
            }
            
            /* Subtle shadow animations */
            .nav-link:hover .bg-slate-100,
            .tab-link:hover .bg-slate-100 {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
            
            /* Glass morphism effect */
            .backdrop-blur-sm {
                backdrop-filter: blur(8px);
            }
            
            .backdrop-blur-md {
                backdrop-filter: blur(12px);
            }
            
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }
            
            ::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.1);
                border-radius: 3px;
            }
            
            ::-webkit-scrollbar-thumb {
                background: rgba(0, 0, 0, 0.2);
                border-radius: 3px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: rgba(0, 0, 0, 0.3);
            }
            
            /* Enhanced card hover effects */
            .hover\\:shadow-xl:hover {
                transform: translateY(-2px);
            }
            
            /* Gradient text effect */
            .gradient-text {
                background: linear-gradient(135deg, #64748b, #475569);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            /* Smooth border transitions */
            .border-b-3 {
                border-bottom-width: 3px;
            }
            
            /* Enhanced button effects */
            button:hover {
                transform: translateY(-1px);
            }
            
            /* Improved mobile responsiveness */
            @media (max-width: 768px) {
                .content-section {
                    padding: 1rem;
                }
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endpush
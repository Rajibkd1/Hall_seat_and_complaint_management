document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const tabBar = document.getElementById('tabBar');
    const menuToggle = document.getElementById('sidebarToggle');

    // Function to initialize layout based on window size
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

    // Toggle sidebar visibility on mobile
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            if (window.innerWidth < 1024) {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }
        });
    }

    // Close sidebar when clicking overlay
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    }

    // Handle window resize
    window.addEventListener('resize', function () {
        initializeLayout();
    });

    // Helper to normalize paths (remove trailing slash, handle root)
    function normalizePath(path) {
        if (path === '/') {
            return '/';
        }
        return path.endsWith('/') ? path.slice(0, -1) : path;
    }

    const currentPath = normalizePath(window.location.pathname);

    // Tabbar active state logic
    const tabLinks = document.querySelectorAll('#tabBar .tab-link');

    tabLinks.forEach(link => {
        const linkPath = normalizePath(new URL(link.href).pathname);

        // Remove existing active classes
        link.classList.remove('text-slate-700', 'border-slate-600');
        link.classList.add('text-slate-600', 'border-transparent', 'hover:border-slate-300');

        // Check if the link's normalized href matches the current normalized path
        if (linkPath === currentPath) {
            link.classList.add('text-slate-700', 'border-slate-600');
            link.classList.remove('text-slate-600', 'border-transparent', 'hover:border-slate-300');
        }
    });

    // Sidebar active state logic (similar to tabbar)
    const sidebarLinks = document.querySelectorAll('#sidebar .nav-link');
    sidebarLinks.forEach(link => {
        const linkPath = normalizePath(new URL(link.href).pathname);

        link.classList.remove('border-slate-400', 'bg-gradient-to-r', 'from-slate-50', 'to-slate-100');
        link.classList.add('border-transparent', 'hover:border-slate-400', 'hover:bg-gradient-to-r', 'hover:from-slate-50', 'hover:to-slate-100');

        if (linkPath === currentPath) {
            link.classList.add('border-slate-400', 'bg-gradient-to-r', 'from-slate-50', 'to-slate-100');
            link.classList.remove('border-transparent');
        }
    });

    // Initialize layout on page load
    initializeLayout();
});
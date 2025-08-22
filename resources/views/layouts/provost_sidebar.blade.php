<!-- Beautiful Provost Mobile Sidebar Navigation -->
<div class="lg:hidden">
    <!-- Mobile Menu Button -->
    <div class="fixed top-0 left-0 right-0 z-50 provost-gradient shadow-lg">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shimmer-effect">
                    <i class="fas fa-crown text-white text-sm nav-icon"></i>
                </div>
                <div>
                    <h1 class="text-white font-bold text-sm gradient-text">Hall Management</h1>
                    <p class="text-blue-200 text-xs">Provost Portal</p>
                </div>
            </div>
            <button id="mobile-menu-button" class="text-white p-2 rounded-lg hover:bg-white/10 transition-all duration-300 hover:scale-110">
                <i class="fas fa-bars text-lg nav-icon"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

    <!-- Mobile Sidebar -->
    <div id="mobile-sidebar" class="fixed top-0 left-0 h-full w-80 provost-gradient transform -translate-x-full transition-transform duration-300 z-50 shadow-2xl">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shimmer-effect hover:scale-110 transition-all duration-300">
                        <i class="fas fa-crown text-white nav-icon"></i>
                    </div>
                    <div>
                        <h2 class="text-white font-bold gradient-text">Provost Portal</h2>
                        <p class="text-blue-200 text-sm">{{ auth('admin')->user()->name }}</p>
                    </div>
                </div>
                <button id="close-sidebar" class="text-white p-2 rounded-lg hover:bg-white/10 transition-all duration-300 hover:scale-110">
                    <i class="fas fa-times nav-icon"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-2">
                <a href="{{ route('provost.dashboard') }}" 
                   class="nav-link flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.dashboard') ? 'bg-white/20 shadow-md active' : '' }} glass-effect">
                    <i class="fas fa-tachometer-alt mr-3 w-5 nav-icon {{ request()->routeIs('provost.dashboard') ? 'text-blue-300' : '' }}"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('provost.students') }}" 
                   class="nav-link flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.students*') ? 'bg-white/20 shadow-md active' : '' }} glass-effect">
                    <i class="fas fa-users mr-3 w-5 nav-icon {{ request()->routeIs('provost.students*') ? 'text-blue-300' : '' }}"></i>
                    <span class="font-medium">Students</span>
                </a>
                
                <a href="{{ route('provost.complaints') }}" 
                   class="nav-link flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.complaints*') ? 'bg-white/20 shadow-md active' : '' }} glass-effect">
                    <i class="fas fa-exclamation-triangle mr-3 w-5 nav-icon {{ request()->routeIs('provost.complaints*') ? 'text-blue-300' : '' }}"></i>
                    <span class="font-medium">Complaints</span>
                </a>
                
                <a href="{{ route('provost.notices') }}" 
                   class="nav-link flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.notices*') ? 'bg-white/20 shadow-md active' : '' }} glass-effect">
                    <i class="fas fa-bullhorn mr-3 w-5 nav-icon {{ request()->routeIs('provost.notices*') ? 'text-blue-300' : '' }}"></i>
                    <span class="font-medium">Notices</span>
                </a>
                
                <a href="{{ route('provost.applications.index') }}" 
                   class="nav-link flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.applications*') ? 'bg-white/20 shadow-md active' : '' }} glass-effect">
                    <i class="fas fa-file-alt mr-3 w-5 nav-icon {{ request()->routeIs('provost.applications*') ? 'text-blue-300' : '' }}"></i>
                    <span class="font-medium">Applications</span>
                </a>
                
                <a href="{{ route('provost.seats.index') }}" 
                   class="nav-link flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.seats*') ? 'bg-white/20 shadow-md active' : '' }} glass-effect">
                    <i class="fas fa-bed mr-3 w-5 nav-icon {{ request()->routeIs('provost.seats*') ? 'text-blue-300' : '' }}"></i>
                    <span class="font-medium">Seats</span>
                </a>
                
                <a href="{{ route('provost.create_admin') }}" 
                   class="nav-link flex items-center px-4 py-3 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.create_admin*') ? 'bg-white/20 shadow-md active' : '' }} glass-effect">
                    <i class="fas fa-user-plus mr-3 w-5 nav-icon {{ request()->routeIs('provost.create_admin*') ? 'text-blue-300' : '' }}"></i>
                    <span class="font-medium">Create People</span>
                </a>
            </nav>

            <!-- Sign Out -->
            <div class="absolute bottom-6 left-6 right-6">
                <form method="POST" action="{{ route('provost.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-all duration-300 border border-red-400/30 hover:border-red-400/50 hover:scale-105 glass-effect">
                        <i class="fas fa-sign-out-alt mr-2 nav-icon"></i>
                        <span class="font-medium">Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('mobile-sidebar-overlay');
    const closeButton = document.getElementById('close-sidebar');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    menuButton?.addEventListener('click', openSidebar);
    closeButton?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);
});
</script>

<!-- Staff Desktop Navigation Bar -->
<nav class="fixed top-0 left-0 right-0 z-50 staff-gradient shadow-lg backdrop-blur-md border-b border-purple-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo/Brand -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-tools text-white text-lg"></i>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-white font-bold text-lg">Hall Management</h1>
                    <p class="text-purple-200 text-xs">Staff Portal</p>
                </div>
            </div>

            <!-- Navigation Links - Responsive Design (Limited for Staff) -->
            <div class="hidden lg:flex items-center justify-center flex-1 max-w-2xl mx-8">
                <div class="flex items-center space-x-2 xl:space-x-4">
                    <a href="{{ route('staff.dashboard') }}" 
                       class="nav-link flex items-center px-4 xl:px-6 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.dashboard') ? 'bg-white/20 shadow-md' : '' }}">
                        <i class="fas fa-tachometer-alt mr-2 text-sm"></i>
                        <span class="font-medium text-sm xl:text-base">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('staff.complaints') }}" 
                       class="nav-link flex items-center px-4 xl:px-6 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.complaints*') ? 'bg-white/20 shadow-md' : '' }}">
                        <i class="fas fa-exclamation-triangle mr-2 text-sm"></i>
                        <span class="font-medium text-sm xl:text-base">Complaints</span>
                    </a>
                    
                    <a href="{{ route('staff.notices') }}" 
                       class="nav-link flex items-center px-4 xl:px-6 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.notices*') ? 'bg-white/20 shadow-md' : '' }}">
                        <i class="fas fa-bullhorn mr-2 text-sm"></i>
                        <span class="font-medium text-sm xl:text-base">Notices</span>
                    </a>
                </div>
            </div>

            <!-- Compact Navigation for Medium Screens -->
            <div class="hidden md:flex lg:hidden items-center space-x-2 flex-1 justify-center mx-4">
                <a href="{{ route('staff.dashboard') }}" 
                   class="nav-link flex items-center px-3 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.dashboard') ? 'bg-white/20 shadow-md' : '' }}"
                   title="Dashboard">
                    <i class="fas fa-tachometer-alt text-sm"></i>
                </a>
                
                <a href="{{ route('staff.complaints') }}" 
                   class="nav-link flex items-center px-3 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.complaints*') ? 'bg-white/20 shadow-md' : '' }}"
                   title="Complaints">
                    <i class="fas fa-exclamation-triangle text-sm"></i>
                </a>
                
                <a href="{{ route('staff.notices') }}" 
                   class="nav-link flex items-center px-3 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.notices*') ? 'bg-white/20 shadow-md' : '' }}"
                   title="Notices">
                    <i class="fas fa-bullhorn text-sm"></i>
                </a>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-2 xl:space-x-4 flex-shrink-0">
                <div class="hidden sm:flex items-center space-x-2 xl:space-x-3">
                    <div class="text-right">
                        <p class="text-white font-medium text-sm">{{ auth('admin')->user()->name }}</p>
                        <p class="text-purple-200 text-xs">Staff</p>
                    </div>
                    <div class="w-8 h-8 xl:w-10 xl:h-10 bg-gradient-to-br from-white/20 to-white/10 rounded-full flex items-center justify-center border-2 border-white/30">
                        <i class="fas fa-tools text-white text-sm xl:text-base"></i>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('staff.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center px-3 xl:px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-all duration-300 border border-red-400/30 hover:border-red-400/50">
                        <i class="fas fa-sign-out-alt mr-1 xl:mr-2 text-sm"></i>
                        <span class="font-medium text-sm xl:text-base hidden sm:inline">Sign Out</span>
                    </button>
                </form>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-gradient-to-r from-purple-800/95 to-indigo-900/95 backdrop-blur-md border-t border-purple-500/20">
            <a href="{{ route('staff.dashboard') }}" 
               class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.dashboard') ? 'bg-white/20' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
            </a>
            
            <a href="{{ route('staff.complaints') }}" 
               class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.complaints*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-exclamation-triangle mr-3"></i>Complaints
            </a>
            
            <a href="{{ route('staff.notices') }}" 
               class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('staff.notices*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-bullhorn mr-3"></i>Notices
            </a>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>

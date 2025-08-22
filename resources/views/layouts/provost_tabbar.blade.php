<!-- Beautiful Provost Navigation Bar -->
<nav class="fixed top-0 left-0 right-0 z-50 provost-gradient shadow-lg backdrop-blur-md border-b border-blue-500/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo/Brand -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <div class="relative shimmer-effect">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shadow-lg transform hover:scale-110 transition-all duration-300">
                        <i class="fas fa-crown text-white text-lg nav-icon"></i>
                    </div>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-white font-bold text-lg gradient-text">Hall Management</h1>
                    <p class="text-blue-200 text-xs">Provost Portal</p>
                </div>
            </div>

            <!-- Navigation Links - Compact and Beautiful -->
            <div class="hidden lg:flex items-center justify-center flex-1 mx-4">
                <div class="flex items-center space-x-1 glass-effect rounded-2xl p-1">
                    <a href="{{ route('provost.dashboard') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-xl text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.dashboard') ? 'bg-white/20 shadow-md active' : '' }}">
                        <i
                            class="fas fa-tachometer-alt mr-1 text-sm nav-icon {{ request()->routeIs('provost.dashboard') ? 'text-blue-300' : '' }}"></i>
                        <span class="font-medium text-xs">Dashboard</span>
                    </a>

                    <a href="{{ route('provost.students') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-xl text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.students*') ? 'bg-white/20 shadow-md active' : '' }}">
                        <i
                            class="fas fa-users mr-1 text-sm nav-icon {{ request()->routeIs('provost.students*') ? 'text-blue-300' : '' }}"></i>
                        <span class="font-medium text-xs">Students</span>
                    </a>

                    <a href="{{ route('provost.complaints') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-xl text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.complaints*') ? 'bg-white/20 shadow-md active' : '' }}">
                        <i
                            class="fas fa-exclamation-triangle mr-1 text-sm nav-icon {{ request()->routeIs('provost.complaints*') ? 'text-blue-300' : '' }}"></i>
                        <span class="font-medium text-xs">Complaints</span>
                    </a>

                    <a href="{{ route('provost.notices') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-xl text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.notices*') ? 'bg-white/20 shadow-md active' : '' }}">
                        <i
                            class="fas fa-bullhorn mr-1 text-sm nav-icon {{ request()->routeIs('provost.notices*') ? 'text-blue-300' : '' }}"></i>
                        <span class="font-medium text-xs">Notices</span>
                    </a>

                    <a href="{{ route('provost.applications.index') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-xl text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.applications*') ? 'bg-white/20 shadow-md active' : '' }}">
                        <i
                            class="fas fa-file-alt mr-1 text-sm nav-icon {{ request()->routeIs('provost.applications*') ? 'text-blue-300' : '' }}"></i>
                        <span class="font-medium text-xs">Apps</span>
                    </a>

                    <a href="{{ route('provost.seats.index') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-xl text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.seats*') ? 'bg-white/20 shadow-md active' : '' }}">
                        <i
                            class="fas fa-bed mr-1 text-sm nav-icon {{ request()->routeIs('provost.seats*') ? 'text-blue-300' : '' }}"></i>
                        <span class="font-medium text-xs">Seats</span>
                    </a>

                    <a href="{{ route('provost.create_admin') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-xl text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.create_admin*') ? 'bg-white/20 shadow-md active' : '' }}">
                        <i
                            class="fas fa-user-plus mr-1 text-sm nav-icon {{ request()->routeIs('provost.create_admin*') ? 'text-blue-300' : '' }}"></i>
                        <span class="font-medium text-xs">Create</span>
                    </a>
                </div>
            </div>

            <!-- Compact Navigation for Medium Screens -->
            <div class="hidden md:flex lg:hidden items-center space-x-1 flex-1 justify-center mx-4">
                <div class="flex items-center space-x-1 glass-effect rounded-2xl p-1">
                    <a href="{{ route('provost.dashboard') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.dashboard') ? 'bg-white/20 shadow-md active' : '' }}"
                        title="Dashboard">
                        <i class="fas fa-tachometer-alt text-sm nav-icon"></i>
                    </a>

                    <a href="{{ route('provost.students') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.students*') ? 'bg-white/20 shadow-md active' : '' }}"
                        title="Students">
                        <i class="fas fa-users text-sm nav-icon"></i>
                    </a>

                    <a href="{{ route('provost.complaints') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.complaints*') ? 'bg-white/20 shadow-md active' : '' }}"
                        title="Complaints">
                        <i class="fas fa-exclamation-triangle text-sm nav-icon"></i>
                    </a>

                    <a href="{{ route('provost.notices') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.notices*') ? 'bg-white/20 shadow-md active' : '' }}"
                        title="Notices">
                        <i class="fas fa-bullhorn text-sm nav-icon"></i>
                    </a>

                    <a href="{{ route('provost.applications.index') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.applications*') ? 'bg-white/20 shadow-md active' : '' }}"
                        title="Applications">
                        <i class="fas fa-file-alt text-sm nav-icon"></i>
                    </a>

                    <a href="{{ route('provost.seats.index') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.seats*') ? 'bg-white/20 shadow-md active' : '' }}"
                        title="Seats">
                        <i class="fas fa-bed text-sm nav-icon"></i>
                    </a>

                    <a href="{{ route('provost.create_admin') }}"
                        class="nav-link flex items-center px-2 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.create_admin*') ? 'bg-white/20 shadow-md active' : '' }}"
                        title="Create People">
                        <i class="fas fa-user-plus text-sm nav-icon"></i>
                    </a>
                </div>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-2 xl:space-x-4 flex-shrink-0">
                <div class="hidden sm:flex items-center space-x-2 xl:space-x-3">
                    <div class="text-right">
                        <p class="text-white font-medium text-sm">{{ auth('admin')->user()->name }}</p>
                        <p class="text-blue-200 text-xs">Provost</p>
                    </div>
                    <div
                        class="relative w-8 h-8 xl:w-10 xl:h-10 bg-gradient-to-br from-white/20 to-white/10 rounded-full flex items-center justify-center border-2 border-white/30 hover:scale-110 transition-all duration-300">
                        <i class="fas fa-crown text-white text-sm xl:text-base"></i>
                        <div
                            class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full border-2 border-white shadow-sm status-badge">
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('provost.logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="flex items-center px-3 xl:px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-white rounded-lg transition-all duration-300 border border-red-400/30 hover:border-red-400/50 hover:scale-105">
                        <i class="fas fa-sign-out-alt mr-1 xl:mr-2 text-sm"></i>
                        <span class="font-medium text-sm xl:text-base hidden sm:inline">Sign Out</span>
                    </button>
                </form>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button"
                    class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white transition-all duration-300">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu hidden md:hidden">
        <div
            class="px-2 pt-2 pb-3 space-y-1 bg-gradient-to-r from-slate-800/95 to-blue-900/95 backdrop-blur-md border-t border-blue-500/20">
            <a href="{{ route('provost.dashboard') }}"
                class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.dashboard') ? 'bg-white/20' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
            </a>

            <a href="{{ route('provost.students') }}"
                class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.students*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-users mr-3"></i>Students
            </a>

            <a href="{{ route('provost.complaints') }}"
                class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.complaints*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-exclamation-triangle mr-3"></i>Complaints
            </a>

            <a href="{{ route('provost.notices') }}"
                class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.notices*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-bullhorn mr-3"></i>Notices
            </a>

            <a href="{{ route('provost.applications.index') }}"
                class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.applications*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-file-alt mr-3"></i>Applications
            </a>

            <a href="{{ route('provost.seats.index') }}"
                class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.seats*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-bed mr-3"></i>Seats
            </a>

            <a href="{{ route('provost.create_admin') }}"
                class="block px-3 py-2 rounded-md text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('provost.create_admin*') ? 'bg-white/20' : '' }}">
                <i class="fas fa-user-plus mr-3"></i>Create People
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

        // Add loading animation to navigation links
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                this.classList.add('loading');
            });
        });
    });
</script>

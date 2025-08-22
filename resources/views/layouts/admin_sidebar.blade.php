<!-- Sidebar Overlay for mobile -->
<div id="sidebarOverlay"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden hidden transition-all duration-300"></div>

<!-- Sidebar (hidden on large devices, shown on small devices) -->
<div id="sidebar"
    class="fixed transform -translate-x-full transition-all duration-300 ease-in-out w-72 bg-gray-900 h-screen shadow-2xl z-50 lg:hidden">
    <div class="p-6 border-b border-gray-700 bg-gray-900">
        <h2 class="text-lg font-semibold text-white flex items-center">
            <div class="bg-gray-800 p-2 rounded-lg mr-3">
                <i class="fas fa-bars text-gray-300"></i>
            </div>
            Admin Navigation
        </h2>
    </div>
    <div class="overflow-y-auto h-full pb-20">
        <ul class="py-4 space-y-1">
            <!-- Dashboard - Always visible -->
            <li><a href="{{ route('admin.dashboard') }}"
                    class="nav-link group flex items-center py-4 px-6 text-white transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ (session('active_admin_menu') ?? 'dashboard') === 'dashboard' ? 'active bg-gray-700 border-blue-500' : 'hover:bg-gray-800 border-transparent' }}">
                    <div class="bg-gray-800 p-2 rounded-lg mr-4 group-hover:bg-gray-700 transition-colors duration-300">
                        <i class="fas fa-home text-gray-300 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a></li>

            @php
                $admin = auth('admin')->user();
                $isProvost = $admin && $admin->isProvost();
                $isCoProvost = $admin && $admin->isCoProvost();
                $isStaff = $admin && $admin->isStaff();
            @endphp

            <!-- Students - Only for Provost and Co-Provost -->
            @if($isProvost || $isCoProvost)
            <li><a href="{{ route('admin.students') }}"
                    class="nav-link group flex items-center py-4 px-6 text-white transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_admin_menu') === 'students' ? 'active bg-gray-700 border-blue-500' : 'hover:bg-gray-800 border-transparent' }}">
                    <div class="bg-gray-800 p-2 rounded-lg mr-4 group-hover:bg-gray-700 transition-colors duration-300">
                        <i class="fas fa-users text-gray-300 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium">View Students</span>
                </a></li>
            @endif

            <!-- Complaints - All roles can access -->
            <li><a href="{{ route('admin.complaints') }}"
                    class="nav-link group flex items-center py-4 px-6 text-white transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_admin_menu') === 'complaints' ? 'active bg-gray-700 border-blue-500' : 'hover:bg-gray-800 border-transparent' }}">
                    <div class="bg-gray-800 p-2 rounded-lg mr-4 group-hover:bg-gray-700 transition-colors duration-300">
                        <i class="fas fa-comment-dots text-gray-300 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium">Complaints</span>
                </a></li>

            <!-- Notices - All roles can access -->
            <li><a href="{{ route('admin.notices') }}"
                    class="nav-link group flex items-center py-4 px-6 text-white transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_admin_menu') === 'notices' ? 'active bg-gray-700 border-blue-500' : 'hover:bg-gray-800 border-transparent' }}">
                    <div class="bg-gray-800 p-2 rounded-lg mr-4 group-hover:bg-gray-700 transition-colors duration-300">
                        <i class="fas fa-bullhorn text-gray-300 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium">Notices</span>
                </a></li>

            <!-- Applications - Only for Provost and Co-Provost -->
            @if($isProvost || $isCoProvost)
            <li><a href="{{ route('admin.applications.index') }}"
                    class="nav-link group flex items-center py-4 px-6 text-white transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_admin_menu') === 'applications' ? 'active bg-gray-700 border-blue-500' : 'hover:bg-gray-800 border-transparent' }}">
                    <div class="bg-gray-800 p-2 rounded-lg mr-4 group-hover:bg-gray-700 transition-colors duration-300">
                        <i class="fas fa-file-alt text-gray-300 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium">Applications</span>
                </a></li>
            @endif

            <!-- Seats - Only for Provost -->
            @if($isProvost)
            <li><a href="{{ route('admin.seats.index') }}"
                    class="nav-link group flex items-center py-4 px-6 text-white transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_admin_menu') === 'seats' ? 'active bg-gray-700 border-blue-500' : 'hover:bg-gray-800 border-transparent' }}">
                    <div class="bg-gray-800 p-2 rounded-lg mr-4 group-hover:bg-gray-700 transition-colors duration-300">
                        <i class="fas fa-chair text-gray-300 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium">Seats</span>
                </a></li>
            @endif

            <!-- Sign Out -->
            <li class="mt-6 pt-4 border-t border-gray-700">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="nav-link group flex items-center py-4 px-6 text-red-400 hover:bg-gray-800 transition-all duration-300 border-l-4 border-transparent hover:border-red-600 rounded-r-xl mx-2 w-full text-left">
                        <div
                            class="bg-gray-800 p-2 rounded-lg mr-4 group-hover:bg-gray-700 transition-colors duration-300">
                            <i class="fas fa-sign-out-alt text-red-400 group-hover:text-red-300"></i>
                        </div>
                        <span class="font-medium">Sign Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

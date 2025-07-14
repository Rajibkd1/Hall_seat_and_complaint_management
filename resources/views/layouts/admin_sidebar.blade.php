<!-- Sidebar Overlay for mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden hidden transition-all duration-300"></div>

<!-- Sidebar (hidden on large devices, shown on small devices) -->
<div id="sidebar" class="fixed transform -translate-x-full transition-all duration-300 ease-in-out w-72 bg-white/95 backdrop-blur-md border-r border-gray-200/50 h-screen shadow-2xl z-50 lg:hidden">
    <div class="p-6 border-b border-gray-200/50 bg-gradient-to-r from-slate-50 to-gray-50">
        <h2 class="text-lg font-semibold text-slate-700 flex items-center">
            <div class="bg-slate-100 p-2 rounded-lg mr-3">
                <i class="fas fa-bars text-slate-600"></i>
            </div>
            Admin Navigation
        </h2>
    </div>
    <div class="overflow-y-auto h-full pb-20">
        <ul class="py-4 space-y-1">
            <li><a href="{{ route('admin.dashboard') }}" class="nav-link group flex items-center py-4 px-6 text-slate-700 transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_nav') === 'dashboard' ? 'active bg-gradient-to-r from-slate-100 to-slate-200 border-slate-400' : 'hover:from-slate-50 hover:to-slate-100 border-transparent' }}">
                <div class="bg-slate-100 p-2 rounded-lg mr-4 group-hover:bg-slate-200 transition-colors duration-300">
                    <i class="fas fa-home text-slate-600 group-hover:text-slate-700"></i>
                </div>
                <span class="font-medium">Dashboard</span>
            </a></li>
            <li><a href="{{ route('admin.students') }}" class="nav-link group flex items-center py-4 px-6 text-slate-700 transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_nav') === 'view_students' ? 'active bg-gradient-to-r from-slate-100 to-slate-200 border-slate-400' : 'hover:from-slate-50 hover:to-slate-100 border-transparent' }}">
                <div class="bg-slate-100 p-2 rounded-lg mr-4 group-hover:bg-slate-200 transition-colors duration-300">
                    <i class="fas fa-users text-slate-600 group-hover:text-slate-700"></i>
                </div>
                <span class="font-medium">View Students</span>
            </a></li>
            <li><a href="{{ route('admin.complaints') }}" class="nav-link group flex items-center py-4 px-6 text-slate-700 transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_nav') === 'complaints' ? 'active bg-gradient-to-r from-slate-100 to-slate-200 border-slate-400' : 'hover:from-slate-50 hover:to-slate-100 border-transparent' }}">
                <div class="bg-slate-100 p-2 rounded-lg mr-4 group-hover:bg-slate-200 transition-colors duration-300">
                    <i class="fas fa-comment-dots text-slate-600 group-hover:text-slate-700"></i>
                </div>
                <span class="font-medium">Complaints</span>
            </a></li>
            <li><a href="{{ route('admin.notices') }}" class="nav-link group flex items-center py-4 px-6 text-slate-700 transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_nav') === 'notices' ? 'active bg-gradient-to-r from-slate-100 to-slate-200 border-slate-400' : 'hover:from-slate-50 hover:to-slate-100 border-transparent' }}">
                <div class="bg-slate-100 p-2 rounded-lg mr-4 group-hover:bg-slate-200 transition-colors duration-300">
                    <i class="fas fa-bullhorn text-slate-600 group-hover:text-slate-700"></i>
                </div>
                <span class="font-medium">Notices</span>
            </a></li>
            <li><a href="{{ route('admin.applications') }}" class="nav-link group flex items-center py-4 px-6 text-slate-700 transition-all duration-300 border-l-4 rounded-r-xl mx-2 {{ session('active_nav') === 'applications' ? 'active bg-gradient-to-r from-slate-100 to-slate-200 border-slate-400' : 'hover:from-slate-50 hover:to-slate-100 border-transparent' }}">
                <div class="bg-slate-100 p-2 rounded-lg mr-4 group-hover:bg-slate-200 transition-colors duration-300">
                    <i class="fas fa-file-alt text-slate-600 group-hover:text-slate-700"></i>
                </div>
                <span class="font-medium">Applications</span>
            </a></li>
            <li class="mt-6 pt-4 border-t border-gray-200">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link group flex items-center py-4 px-6 text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 transition-all duration-300 border-l-4 border-transparent hover:border-red-400 rounded-r-xl mx-2 w-full text-left">
                        <div class="bg-red-100 p-2 rounded-lg mr-4 group-hover:bg-red-200 transition-colors duration-300">
                            <i class="fas fa-sign-out-alt text-red-600 group-hover:text-red-700"></i>
                        </div>
                        <span class="font-medium">Sign Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
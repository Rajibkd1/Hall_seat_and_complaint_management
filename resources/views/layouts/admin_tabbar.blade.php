<div id="tabBar" class="hidden lg:block bg-gradient-to-r from-white/90 via-white/95 to-white/90 backdrop-blur-xl shadow-lg border-b border-gray-200/60 relative overflow-hidden">
    <!-- Subtle animated background -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(148,163,184,0.03),transparent_70%)]"></div>
    <div class="absolute inset-0 bg-[linear-gradient(90deg,transparent_0%,rgba(148,163,184,0.01)_50%,transparent_100%)] animate-pulse"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <ul class="flex justify-evenly overflow-x-auto">
            <!-- Dashboard Tab -->
            <li class="relative">
                <a href="{{ route('admin.dashboard') }}" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-3 px-6 font-medium transition-all duration-500 border-b-4 min-w-[100px] rounded-t-md relative overflow-hidden {{ (session('active_admin_menu') ?? 'dashboard') === 'dashboard' ? 'active-tab-indicator' : 'border-transparent' }}">
                    <!-- Shimmer effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="bg-gradient-to-br from-slate-100 to-slate-50 px-4 py-2 rounded-md mb-2 group-hover:bg-gradient-to-br group-hover:from-slate-200 group-hover:to-slate-100 transition-all duration-500 shadow-md group-hover:shadow-xl relative z-10">
                        <i class="fas fa-home text-lg text-slate-600 group-hover:text-slate-800 transition-colors duration-300 drop-shadow-sm"></i>
                    </div>
                    <span class="text-xs font-semibold group-hover:text-slate-800 transition-all duration-300 relative z-10">Dashboard</span>
                </a>
            </li>

            <!-- View Students Tab -->
            <li class="relative">
                <a href="{{ route('admin.students') }}" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-3 px-6 font-medium transition-all duration-500 border-b-4 min-w-[100px] rounded-t-md relative overflow-hidden {{ session('active_admin_menu') === 'students' ? 'active-tab-indicator' : 'border-transparent' }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-200/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 px-4 py-2 rounded-md mb-2 group-hover:bg-gradient-to-br group-hover:from-blue-200 group-hover:to-blue-100 transition-all duration-500 shadow-md group-hover:shadow-xl relative z-10">
                        <i class="fas fa-users text-lg text-blue-600 group-hover:text-blue-800 transition-colors duration-300 drop-shadow-sm"></i>
                    </div>
                    <span class="text-xs font-semibold group-hover:text-slate-800 transition-all duration-300 relative z-10">Students</span>
                </a>
            </li>

            <!-- Complaints Tab -->
            <li class="relative">
                <a href="{{ route('admin.complaints') }}" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-3 px-6 font-medium transition-all duration-500 border-b-4 min-w-[100px] rounded-t-md relative overflow-hidden {{ session('active_admin_menu') === 'complaints' ? 'active-tab-indicator' : 'border-transparent' }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-orange-200/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="bg-gradient-to-br from-orange-100 to-orange-50 px-4 py-2 rounded-md mb-2 group-hover:bg-gradient-to-br group-hover:from-orange-200 group-hover:to-orange-100 transition-all duration-500 shadow-md group-hover:shadow-xl relative z-10">
                        <i class="fas fa-comment-dots text-lg text-orange-600 group-hover:text-orange-800 transition-colors duration-300 drop-shadow-sm"></i>
                    </div>
                    <span class="text-xs font-semibold group-hover:text-slate-800 transition-all duration-300 relative z-10">Complaints</span>
                </a>
            </li>

            <!-- Notices Tab -->
            <li class="relative">
                <a href="{{ route('admin.notices') }}" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-3 px-6 font-medium transition-all duration-500 border-b-4 min-w-[100px] rounded-t-md relative overflow-hidden {{ session('active_admin_menu') === 'notices' ? 'active-tab-indicator' : 'border-transparent' }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-green-200/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="bg-gradient-to-br from-green-100 to-green-50 px-4 py-2 rounded-md mb-2 group-hover:bg-gradient-to-br group-hover:from-green-200 group-hover:to-green-100 transition-all duration-500 shadow-md group-hover:shadow-xl relative z-10">
                        <i class="fas fa-bullhorn text-lg text-green-600 group-hover:text-green-800 transition-colors duration-300 drop-shadow-sm"></i>
                    </div>
                    <span class="text-xs font-semibold group-hover:text-slate-800 transition-all duration-300 relative z-10">Notices</span>
                </a>
            </li>

            <!-- Applications Tab -->
            <li class="relative">
                <a href="{{ route('admin.applications.index') }}" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-3 px-6 font-medium transition-all duration-500 border-b-4 min-w-[100px] rounded-t-md relative overflow-hidden {{ session('active_admin_menu') === 'applications' ? 'active-tab-indicator' : 'border-transparent' }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-purple-200/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <div class="bg-gradient-to-br from-purple-100 to-purple-50 px-4 py-2 rounded-md mb-2 group-hover:bg-gradient-to-br group-hover:from-purple-200 group-hover:to-purple-100 transition-all duration-500 shadow-md group-hover:shadow-xl relative z-10">
                        <i class="fas fa-file-alt text-lg text-purple-600 group-hover:text-purple-800 transition-colors duration-300 drop-shadow-sm"></i>
                    </div>
                    <span class="text-xs font-semibold group-hover:text-slate-800 transition-all duration-300 relative z-10">Applications</span>
                </a>
            </li>

            <!-- Sign Out Tab -->
            <li class="relative">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="tab-link group flex flex-col items-center justify-center text-red-600 py-3 px-6 font-medium hover:text-red-800 hover:bg-gradient-to-b hover:from-red-50/80 hover:to-red-100/80 transition-all duration-500 border-b-4 border-transparent hover:border-red-400 min-w-[100px] rounded-t-md w-full hover:shadow-lg relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-red-200/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <div class="bg-gradient-to-br from-red-100 to-red-50 px-4 py-2 rounded-md mb-2 group-hover:bg-gradient-to-br group-hover:from-red-200 group-hover:to-red-100 transition-all duration-500 shadow-md group-hover:shadow-xl relative z-10">
                            <i class="fas fa-sign-out-alt text-lg text-red-600 group-hover:text-red-800 transition-colors duration-300 drop-shadow-sm"></i>
                        </div>
                        <span class="text-xs font-semibold group-hover:text-red-800 transition-all duration-300 relative z-10">Sign Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
<style>
    .active-tab-indicator {
        border-bottom-width: 4px;
        border-color: #6366f1;
        background-color: #f3f4f6;
    }
</style>
<div id="tabBar" class="hidden lg:block bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200/50">
    <div class="container mx-auto px-6">
        <ul class="flex justify-evenly overflow-x-auto">
            <li><a href="#" onclick="showContent('home')" class="tab-link group flex flex-col items-center justify-center text-slate-700 py-6 px-8 font-medium transition-all duration-300 hover:bg-gradient-to-b hover:from-slate-50 hover:to-slate-100 border-b-3 border-slate-600 min-w-[120px] rounded-t-xl">
                <div class="bg-slate-100 p-3 rounded-xl mb-2 group-hover:bg-slate-200 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-home text-xl text-slate-600 group-hover:text-slate-700"></i>
                </div>
                <span class="text-sm font-medium">Dashboard</span>
            </a></li>
            <li><a href="{{ route('student.profile') }}" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-6 px-8 font-medium hover:text-slate-700 hover:bg-gradient-to-b hover:from-slate-50 hover:to-slate-100 transition-all duration-300 border-b-3 border-transparent hover:border-slate-300 min-w-[120px] rounded-t-xl">
                <div class="bg-slate-100 p-3 rounded-xl mb-2 group-hover:bg-slate-200 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-user text-xl text-slate-500 group-hover:text-slate-600"></i>
                </div>
                <span class="text-sm font-medium">Profile</span>
            </a></li>
            <li><a href="#" onclick="showContent('notice')" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-6 px-8 font-medium hover:text-slate-700 hover:bg-gradient-to-b hover:from-slate-50 hover:to-slate-100 transition-all duration-300 border-b-3 border-transparent hover:border-slate-300 min-w-[120px] rounded-t-xl">
                <div class="bg-slate-100 p-3 rounded-xl mb-2 group-hover:bg-slate-200 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-bullhorn text-xl text-slate-500 group-hover:text-slate-600"></i>
                </div>
                <span class="text-sm font-medium">Notices</span>
            </a></li>
            <li><a href="#" onclick="showContent('seat-apply')" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-6 px-8 font-medium hover:text-slate-700 hover:bg-gradient-to-b hover:from-slate-50 hover:to-slate-100 transition-all duration-300 border-b-3 border-transparent hover:border-slate-300 min-w-[120px] rounded-t-xl">
                <div class="bg-slate-100 p-3 rounded-xl mb-2 group-hover:bg-slate-200 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-chair text-xl text-slate-500 group-hover:text-slate-600"></i>
                </div>
                <span class="text-sm font-medium">Seat Apply</span>
            </a></li>
            <li><a href="#" onclick="showContent('complain')" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-6 px-8 font-medium hover:text-slate-700 hover:bg-gradient-to-b hover:from-slate-50 hover:to-slate-100 transition-all duration-300 border-b-3 border-transparent hover:border-slate-300 min-w-[120px] rounded-t-xl">
                <div class="bg-slate-100 p-3 rounded-xl mb-2 group-hover:bg-slate-200 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-comment-dots text-xl text-slate-500 group-hover:text-slate-600"></i>
                </div>
                <span class="text-sm font-medium">Complaints</span>
            </a></li>
            <li><a href="#" onclick="showContent('contact')" class="tab-link group flex flex-col items-center justify-center text-slate-600 py-6 px-8 font-medium hover:text-slate-700 hover:bg-gradient-to-b hover:from-slate-50 hover:to-slate-100 transition-all duration-300 border-b-3 border-transparent hover:border-slate-300 min-w-[120px] rounded-t-xl">
                <div class="bg-slate-100 p-3 rounded-xl mb-2 group-hover:bg-slate-200 transition-all duration-300 group-hover:scale-110">
                    <i class="fas fa-phone text-xl text-slate-500 group-hover:text-slate-600"></i>
                </div>
                <span class="text-sm font-medium">Contact</span>
            </a></li>
            <li>
                <form action="{{ route('student.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="tab-link group flex flex-col items-center justify-center text-red-600 py-6 px-8 font-medium hover:text-red-700 hover:bg-gradient-to-b hover:from-red-50 hover:to-red-100 transition-all duration-300 border-b-3 border-transparent hover:border-red-300 min-w-[120px] rounded-t-xl w-full">
                        <div class="bg-red-100 p-3 rounded-xl mb-2 group-hover:bg-red-200 transition-all duration-300 group-hover:scale-110">
                            <i class="fas fa-sign-out-alt text-xl text-red-500 group-hover:text-red-600"></i>
                        </div>
                        <span class="text-sm font-medium">Sign Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

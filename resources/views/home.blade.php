@extends('layouts.app')

@section('content')
    <!-- Main Home Content -->
    <div class="p-8 lg:p-12">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl shadow-lg mb-6">
                    <i class="fas fa-home text-3xl text-slate-600"></i>
                </div>
                <h2 class="text-4xl font-bold text-slate-800 mb-4 tracking-tight">Welcome to NSTU Hall Management</h2>
                <p class="text-xl text-slate-600 leading-relaxed">Your central hub for hall management and student services</p>
            </div>

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Students</p>
                            <p class="text-3xl font-bold text-slate-800 mt-1">1,247</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Available Rooms</p>
                            <p class="text-3xl font-bold text-slate-800 mt-1">23</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-xl">
                            <i class="fas fa-bed text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Pending Applications</p>
                            <p class="text-3xl font-bold text-slate-800 mt-1">47</p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-xl">
                            <i class="fas fa-clock text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation Buttons -->
            <div class="flex flex-col md:flex-row justify-center items-center gap-6">
                <a href="{{ url('/student/login') }}" class="bg-blue-600 text-white px-6 py-3 rounded-xl text-lg font-medium hover:bg-blue-700 transition-all duration-300">
                    Student Login
                </a>
                <a href="{{ url('/admin/login') }}" class="bg-green-600 text-white px-6 py-3 rounded-xl text-lg font-medium hover:bg-green-700 transition-all duration-300">
                    Admin Login
                </a>
                <a href="{{ url('/student/register') }}" class="bg-orange-500 text-white px-6 py-3 rounded-xl text-lg font-medium hover:bg-orange-600 transition-all duration-300">
                    Student Register
                </a>
            </div>
        </div>
    </div>
@endsection

@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

{{-- MAIN TITLE --}}
<div class="mb-6" data-aos="fade-down">
    <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Dashboard</h1>
    <p class="text-sm text-slate-500 mt-0.5">Welcome back, {{ Auth::user()->name }}</p>
</div>

{{-- BANNER SLIDER --}}
<div class="relative w-full h-64 md:h-96 overflow-hidden rounded-2xl mb-6 shadow-sm border border-slate-100" data-aos="fade-up" data-aos-delay="100">
    
    <div id="slider" class="flex transition-transform duration-700 w-full h-full">
        <img src="{{ asset('img/foto_bangunan_1.png') }}" class="w-full flex-shrink-0 h-full object-cover object-center">
        <img src="{{ asset('img/foto_bangunan_2.png') }}" class="w-full flex-shrink-0 h-full object-cover object-center">
        <img src="{{ asset('img/foto_bangunan_3.png') }}" class="w-full flex-shrink-0 h-full object-cover object-center">
    </div>

</div>

{{-- WELCOME CARD --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 mb-6" data-aos="fade-up" data-aos-delay="150">
    <h2 class="text-xl font-bold mb-2 text-slate-900">
        Selamat Datang di Portal Mahasiswa!
    </h2>
    <p class="text-sm text-slate-500 leading-relaxed">
        Ini adalah halaman utama akademik Anda. Monitor seluruh kegiatan perkuliahan, isi kartu rencana studi (KRS), dan pantau perkembangan indeks prestasi Anda secara berkala.
    </p>
</div>

{{-- STAT CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

    {{-- Card 1: Total Students --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-start justify-between mb-2">
            <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <span class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                Active
            </span>
        </div>
        <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalMahasiswa) }}</p>
        <p class="text-xs text-slate-400 font-medium mt-0.5">Total Students</p>
        <p class="text-[11px] text-emerald-600 font-medium mt-2 flex items-center gap-1">
            <span>↑ 12%</span> <span class="text-slate-400 font-normal">vs last semester</span>
        </p>
    </div>

    {{-- Card 2: Total Lecturers --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200" data-aos="fade-up" data-aos-delay="250">
        <div class="flex items-start justify-between mb-2">
            <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
            </div>
            <span class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                Active
            </span>
        </div>
        <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalDosen) }}</p>
        <p class="text-xs text-slate-400 font-medium mt-0.5">Total Lecturers</p>
        <p class="text-[11px] text-emerald-600 font-medium mt-2 flex items-center gap-1">
            <span>↑ 5%</span> <span class="text-slate-400 font-normal">vs last semester</span>
        </p>
    </div>

    {{-- Card 3: Total Courses --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-start justify-between mb-2">
            <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <span class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                Available
            </span>
        </div>
        <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalMataKuliah) }}</p>
        <p class="text-xs text-slate-400 font-medium mt-0.5">Total Courses</p>
        <p class="text-[11px] text-emerald-600 font-medium mt-2 flex items-center gap-1">
            <span>↑ 8%</span> <span class="text-slate-400 font-normal">vs last semester</span>
        </p>
    </div>

    {{-- Card 4: Study Program --}}
    <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200" data-aos="fade-up" data-aos-delay="350">
        <div class="flex items-start justify-between mb-2">
            <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <span class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-indigo-50 text-indigo-600 border border-indigo-100">
                Current
            </span>
        </div>
        <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalEroll ?? 12) }}</p>
        <p class="text-xs text-slate-400 font-medium mt-0.5">Active Enrollments</p>
        <p class="text-[11px] text-emerald-600 font-medium mt-2 flex items-center gap-1">
            <span>↑ 15%</span> <span class="text-slate-400 font-normal">vs last semester</span>
        </p>
    </div>

</div>

{{-- ===== QUICK ACCESS ===== --}}
<div class="bg-white rounded-xl border border-slate-100 p-6 mb-6 shadow-sm shadow-slate-100/50" data-aos="fade-up" data-aos-delay="400">
    <div class="mb-4">
        <h2 class="text-lg font-bold text-slate-800">Quick Access</h2>
        <p class="text-xs text-slate-400">Frequently used administrative actions</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        {{-- KRS Menu --}}
        <a href="/krsmahasiswa" class="group flex items-center gap-3 p-4 rounded-xl border border-slate-100 bg-white hover:border-[#f9b17a] hover:shadow-sm transition-all duration-300">
            <div class="w-10 h-10 flex-shrink-0 bg-slate-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a]/10 transition-all duration-300">
                <svg class="w-5 h-5 text-slate-600 group-hover:text-[#f9b17a] transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-bold text-slate-800 group-hover:text-[#f9b17a] transition-colors">KRS Online</p>
                <p class="text-xs text-slate-400 truncate leading-relaxed">Organize curriculum and semester plan.</p>
            </div>
            <svg class="w-4 h-4 text-slate-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>

        {{-- KHS Menu --}}
        <a href="/khsmahasiswa" class="group flex items-center gap-3 p-4 rounded-xl border border-slate-100 bg-white hover:border-[#f9b17a] hover:shadow-sm transition-all duration-300">
            <div class="w-10 h-10 flex-shrink-0 bg-slate-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a]/10 transition-all duration-300">
                <svg class="w-5 h-5 text-slate-600 group-hover:text-[#f9b17a] transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-bold text-slate-800 group-hover:text-[#f9b17a] transition-colors">KHS & Transkrip</p>
                <p class="text-xs text-slate-400 truncate leading-relaxed">Track academic progress and grades.</p>
            </div>
            <svg class="w-4 h-4 text-slate-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>

        {{-- Menu--}}
        <a href="#" class="group flex items-center gap-3 p-4 rounded-xl border border-slate-100 bg-white hover:border-[#f9b17a] hover:shadow-sm transition-all duration-300">
            <div class="w-10 h-10 flex-shrink-0 bg-slate-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a]/10 transition-all duration-300">
                <svg class="w-5 h-5 text-slate-600 group-hover:text-[#f9b17a] transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-bold text-slate-800 group-hover:text-[#f9b17a] transition-colors">Profil Saya</p>
                <p class="text-xs text-slate-400 truncate leading-relaxed">Update personal information and status.</p>
            </div>
            <svg class="w-4 h-4 text-slate-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>

    </div>
</div>

@endsection
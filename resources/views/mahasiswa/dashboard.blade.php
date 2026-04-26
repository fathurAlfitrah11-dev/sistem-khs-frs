@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<h1 class="text-3xl font-bold mb-6">Dashboard</h1>
<div class="relative w-full h-48 md:h-64 overflow-hidden rounded-2xl mb-6">
    
    <div id="slider" class="flex transition-transform duration-700" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ asset('img/foto_bangunan_1.png') }}" class="w-full flex-shrink-0 object-cover">
        <img src="{{ asset('img/foto_bangunan_2.png') }}" class="w-full flex-shrink-0 object-cover">
        <img src="{{ asset('img/foto_bangunan_3.png') }}" class="w-full flex-shrink-0 object-cover">
    </div>

</div>

<!-- Welcome + Profile -->
<div class="grid grid-cols-3 gap-6 mb-6 card-animate" >

    <div class="col-span-full bg-[#3c4167] text-white p-6 rounded-2xl bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200" data-aos="fade-up" data-aos-delay="100">
        <h2 class="text-xl font-bold mb-2 text-black">
            Selamat Datang Mahasiswa!
        </h2>
        <p class="text-sm opacity-80 text-black">
            Ini adalah dashboard mahasiswa.
        </p>
    </div>


</div>

<!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200 card-animate" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span
                    class="text-xs px-2.5 py-1 rounded-full font-semibold bg-green-500/20 text-green-400 border border-green-400/30">
                    Active
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMahasiswa ?? 1247) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Total Students</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200 card-animate" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <span
                    class="text-xs px-2.5 py-1 rounded-full font-semibold bg-green-500/20 text-green-400 border border-green-400/30">
                    Active
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalDosen ?? 89) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Total Lecturers</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200 card-animate" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span
                    class="text-xs px-2.5 py-1 rounded-full font-semibold bg-green-500/20 text-green-400 border border-green-400/30">
                    Available
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMataKuliah ?? 156) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Total Courses</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200 card-animate" data-aos="fade-up" data-aos-delay="500">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span
                    class="text-xs px-2.5 py-1 rounded-full font-semibold bg-green-500/20 text-green-400 border border-green-400/30">
                    Current
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalEnrollment ?? 4892) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Study Program</p>
        </div>

    </div>

    {{-- ===== QUICK ACCESS ===== --}}
    <div class="bg-white rounded-xl border border-gray-100 p-6 mb-6 card-animate">
        <div class="mb-4" data-aos="fade-up" data-aos-delay="500">
            <h2 class="text-lg font-bold text-gray-900">Quick Access</h2>
            <p class="text-xs text-gray-400">Frequently used actions</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            {{-- Manage Courses --}}
            <a href="/krsmahasiswa" style="text-decoration: none !important;"
                class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-white hover:border-[#f9b17a] transition-all duration-300 card-animate" data-aos="fade-up" data-aos-delay="600">
                <div
                    class="w-10 h-10 flex-shrink-0 bg-gray-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a] transition-all duration-300">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-300" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-gray-900 group-hover:text-[#f9b17a] transition-colors"
                        style="text-decoration: none !important;">KRS</p>
                    <p class="text-xs text-gray-500 leading-relaxed" style="text-decoration: none !important;">Organize curriculum and lecturer assignments.</p>
                </div>
                <svg class="w-5 h-5 text-gray-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- KHS --}}
            <a href="/khsmahasiswa" style="text-decoration: none !important;"
                class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-white hover:border-[#f9b17a] transition-all duration-300 card-animate" data-aos="fade-up" data-aos-delay="650">
                <div
                    class="w-10 h-10 flex-shrink-0 bg-gray-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a] transition-all duration-300">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-300" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-gray-900 group-hover:text-[#f9b17a] transition-colors"
                        style="text-decoration: none !important;">KHS</p>
                    <p class="text-xs text-gray-500 leading-relaxed" style="text-decoration: none !important;">Track academic progress and enrollment data.</p>
                </div>
                <svg class="w-5 h-5 text-gray-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
    </div>


@endsection
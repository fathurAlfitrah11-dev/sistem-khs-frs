@extends('layout.dosen_app')

@section('title','Dashboard Dosen')

@section('content')

<div class="p-6">

    {{-- TITLE --}}
    <h1 class="text-xl font-semibold text-gray-800 mb-4" data-aos="fade-up" data-aos-delay="100">Dashboard Dosen</h1>
<div class="relative w-full h-48 md:h-64 overflow-hidden rounded-2xl mb-6">
    
    <div id="slider" class="flex transition-transform duration-700" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ asset('img/foto_bangunan_1.png') }}" class="w-full flex-shrink-0 object-cover">
        <img src="{{ asset('img/foto_bangunan_2.png') }}" class="w-full flex-shrink-0 object-cover">
        <img src="{{ asset('img/foto_bangunan_3.png') }}" class="w-full flex-shrink-0 object-cover">
    </div>

</div>


    {{-- WELCOME CARD --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200 mb-6" data-aos="fade-up" data-aos-delay="100">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">
            Selamat Datang {{ Auth::user()->name }}!
        </h2>
        <p class=" text-gray-500 mt-0.5 mb-3">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
        </p>
    </div>

    {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6" >

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">1247</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Total Mahasiswa</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">89</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Dosen</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMataKuliah ?? 156) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Matakuliah</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow duration-200" data-aos="fade-up" data-aos-delay="500">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalEnrollment ?? 48) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Program Studi</p>

        </div>

    </div>

    {{-- AKSES CEPAT --}}
    <div>
        <h2 class="text-3xl font-bold text-gray-900 mb-3 pt-6" data-aos="fade-up" data-aos-delay="400">Akses Cepat</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

            <a href="/penilaian">
        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:bg-[#f9b17a] transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMataKuliah ?? 156) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Penilaian</p>
        </div>
            </a>

            <a href="/matakuliahdosen">
            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:bg-[#f9b17a] transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ number_format($totalMataKuliah ?? 156) }}</p>
            <p class="text-sm text-gray-500 mt-0.5 mb-3">Matakuliah</p>
        </div>
            </a>

        </div>
    </div>

</div>

@endsection
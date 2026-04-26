@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap');

.khs-wrap * {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.khs-wrap .mono {
    font-family: 'DM Mono', monospace;
}

/* Animated gradient background card */
.card-glass {
    background: linear-gradient(135deg, #2e3257 0%, #3b3f63 50%, #2a2e52 100%);
    border: 1px solid rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(12px);
}

/* Subtle shimmer on stat cards */
.stat-card {
    background: rgba(255, 255, 255, 0.96);
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

/* Grade badge */
.grade-pill {
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.18);
    transition: background 0.2s;
}

.grade-pill:hover {
    background: rgba(255, 255, 255, 0.22);
}

/* Table row hover */
.khs-table tbody tr {
    transition: background 0.15s ease;
}

.khs-table tbody tr:hover {
    background: #f0f2ff;
}

/* Nilai badge color */
.nilai-badge {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 999px;
    font-weight: 600;
    font-size: 0.78rem;
}

.nilai-a {
    background: #dcfce7;
    color: #16a34a;
}

.nilai-b {
    background: #dbeafe;
    color: #1d4ed8;
}

.nilai-c {
    background: #fef9c3;
    color: #b45309;
}

.nilai-d {
    background: #fee2e2;
    color: #dc2626;
}

.nilai-e {
    background: #fce7f3;
    color: #be185d;
}

/* Divider accent */
.accent-bar {
    width: 36px;
    height: 3px;
    background: linear-gradient(90deg, #f97316, #fb923c);
    border-radius: 999px;
    margin-bottom: 6px;
}

/* Progress bar */
.progress-track {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 999px;
    height: 5px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, #f97316, #fbbf24);
}

/* select custom */
.sem-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 24 24'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    padding-right: 28px;
}
</style>

<div class="khs-wrap p-5 md:p-7 bg-gray-50 min-h-screen">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 leading-tight">Transkrip Akademik</h1>
        </div>
    </div>

    {{-- ===== TRANSKRIP STAT CARDS ===== --}}
    <div class="card-glass rounded-2xl p-6 mb-5" data-aos="fade-up" data-aos-delay="100">

        <div class="flex items-center gap-3 mb-5">
            <div class="sec-icon bg-orange-500/20">
                <svg class="w-4.5 h-4.5 text-orange-400" style="width:18px;height:18px;" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <h2 class="text-white text-base font-bold">Ringkasan Akademik</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            {{-- IPK --}}
            <div class="stat-card rounded-xl p-5">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Sangat
                        Baik</span>
                </div>
                <p class="text-xs text-gray-400 font-medium mb-0.5">Akumulatif Nilai (IPK)</p>
                <p class="text-4xl font-extrabold text-gray-900 mono">3.99</p>
                <div class="mt-3 progress-track">
                    <div class="progress-fill" style="width: 99.75%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">dari skala 4.00</p>
            </div>

            {{-- Total SKS --}}
            <div class="stat-card rounded-xl p-5">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">Kumulatif</span>
                </div>
                <p class="text-xs text-gray-400 font-medium mb-0.5">Total SKS Ditempuh</p>
                <p class="text-4xl font-extrabold text-gray-900 mono">90</p>
                <div class="mt-3 progress-track">
                    <div class="progress-fill" style="width: 75%; background: linear-gradient(90deg,#3b82f6,#60a5fa);">
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">dari ~144 SKS target</p>
            </div>

            {{-- Semester --}}
            <div class="stat-card rounded-xl p-5">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-9 h-9 rounded-lg bg-violet-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span
                        class="text-xs font-semibold text-violet-600 bg-violet-50 px-2 py-0.5 rounded-full">Aktif</span>
                </div>
                <p class="text-xs text-gray-400 font-medium mb-0.5">Semester Saat Ini</p>
                <p class="text-4xl font-extrabold text-gray-900 mono">5</p>
                <div class="mt-3 flex gap-1">
                    @for ($i = 1; $i <= 8; $i++) <div
                        class="h-1.5 flex-1 rounded-full {{ $i <= 5 ? 'bg-violet-400' : 'bg-gray-200' }}">
                </div>
                @endfor
            </div>
            <p class="text-xs text-gray-400 mt-1.5">dari 8 semester</p>
        </div>

    </div>
</div>

{{-- ===== PILIH SEMESTER + GRADE INFO ===== --}}
<div class="grid md:grid-cols-3 gap-5 mb-5" data-aos="fade-up" data-aos-delay="200">

    {{-- Pilih Semester --}}
    <div class="card-glass rounded-2xl p-6 col-span-2">

        <div class="flex items-center gap-3 mb-5">
            <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="text-blue-400" style="width:18px;height:18px;" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h2 class="text-white text-base font-bold">Detail Per Semester</h2>
        </div>

        <div class="flex flex-wrap items-center gap-3 mb-5">
            <select
                class="sem-select text-sm text-gray-700 bg-white rounded-lg px-3 py-2 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option>Semester 6</option>
                <option>Semester 5</option>
                <option>Semester 4</option>
                <option>Semester 3</option>
                <option>Semester 2</option>
                <option>Semester 1</option>
            </select>

            <button
                class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Ekspor PDF
            </button>
        </div>

        <div class="grid grid-cols-2 gap-4">

            <div class="stat-card rounded-xl p-4">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                    <p class="text-xs text-gray-400 font-medium">IPS Semester Ini</p>
                </div>
                <p class="text-3xl font-extrabold text-gray-900 mono">3.99</p>
                <p class="text-xs text-gray-400 mt-1">dari 4.00</p>
            </div>

            <div class="stat-card rounded-xl p-4">
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                    <p class="text-xs text-gray-400 font-medium">SKS Diambil</p>
                </div>
                <p class="text-3xl font-extrabold text-gray-900 mono">90</p>
                <p class="text-xs text-gray-400 mt-1">SKS semester ini</p>
            </div>

        </div>
    </div>

    {{-- Grade Info --}}
    <div class="card-glass rounded-2xl p-6" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center gap-3 mb-4">
            <div class="sec-icon bg-violet-500/20">
                <svg class="text-violet-400" style="width:18px;height:18px;" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
            </div>
            <h2 class="text-white text-base font-bold">Skala Nilai</h2>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                A <span class="text-xs font-normal opacity-70">85–100</span>
            </div>
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                B+ <span class="text-xs font-normal opacity-70">80–84</span>
            </div>
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                B <span class="text-xs font-normal opacity-70">75–79</span>
            </div>
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                C+ <span class="text-xs font-normal opacity-70">70–74</span>
            </div>
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                C <span class="text-xs font-normal opacity-70">65–69</span>
            </div>
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                D+ <span class="text-xs font-normal opacity-70">60–64</span>
            </div>
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                D <span class="text-xs font-normal opacity-70">55–59</span>
            </div>
            <div class="grade-pill rounded-lg py-2 px-3 text-center text-sm font-semibold text-white">
                E <span class="text-xs font-normal opacity-70">0–54</span>
            </div>
        </div>
    </div>

</div>
<!-- Table Section -->
<div class="bg-[#3b3f63] rounded-2xl p-6" data-aos="fade-up" data-aos-delay="500">

    <div class="overflow-x-auto bg-white rounded-xl">
        <table class="min-w-full text-left">

            <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                <tr>
                    <th class="px-4 text-black py-3">Kode</th>
                    <th class="px-4 text-black py-3">Mata kuliah</th>
                    <th class="px-4 text-black py-3">Dosen Pengajar</th>
                    <th class="px-4 text-black py-3">SKS</th>
                    <th class="px-4 text-black py-3">Nilai</th>
                    <th class="px-4 text-black py-3">Rata-rata</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-b">
                    <td class="px-4 text-black py-2">IF202</td>
                    <td class="px-4 text-black py-2">Pemrograman Web</td>
                    <td class="px-4 text-black py-2">Ir. Zaid Hasbiya</td>
                    <td class="px-4 text-black py-2">2</td>
                    <td class="px-4 text-black py-2">100</td>
                    <td class="px-4 text-black py-2">3.99</td>
                </tr>

                <tr class="border-b">
                    <td class="px-4 py-2 text-black">IF202</td>
                    <td class="px-4 py-2 text-black">Pemrograman Web</td>
                    <td class="px-4 py-2 text-black">Ir. Zaid Hasbiya</td>
                    <td class="px-4 py-2 text-black">4</td>
                    <td class="px-4 py-2 text-black">100</td>
                    <td class="px-4 py-2 text-black">3.99</td>
                </tr>

                <tr class="border-b">
                    <td class="px-4 py-2 text-black">IF202</td>
                    <td class="px-4 py-2 text-black">Pemrograman Web</td>
                    <td class="px-4 py-2 text-black">Ir. Zaid Hasbiya</td>
                    <td class="px-4 py-2 text-black">2</td>
                    <td class="px-4 py-2 text-black">100</td>
                    <td class="px-4 py-2 text-black">3.99</td>
                </tr>

                <tr>
                    <td class="px-4 py-2 text-black">IF202</td>
                    <td class="px-4 py-2 text-black">Pemrograman Web</td>
                    <td class="px-4 py-2 text-black">Ir. Zaid Hasbiya</td>
                    <td class="px-4 py-2 text-black">2</td>
                    <td class="px-4 py-2 text-black">100</td>
                    <td class="px-4 py-2 text-black">3.00</td>
                </tr>

            </tbody>

        </table>
    </div>

</div>

</div>

@endsection
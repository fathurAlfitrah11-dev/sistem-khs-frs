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

/* Custom select drop-down arrow */
.sem-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 24 24'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 32px;
}
</style>

<div class="khs-wrap p-4 md:p-6 bg-slate-50/50 min-h-screen">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Kartu Hasil Studi (KHS)</h1>
        <p class="text-xs text-slate-400 mt-1">Pantau perkembangan indeks prestasi dan seluruh nilai mata kuliah Anda</p>
    </div>

    {{-- ===== RINGKASAN AKADEMIK CONTAINER ===== --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6 mb-6 shadow-sm">
        
        <div class="flex items-center gap-2.5 mb-5">
            <div class="w-8 h-8 rounded-lg bg-[#f9b17a]/10 flex items-center justify-center">
                <svg class="w-4 h-4 text-[#f9b17a]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <h2 class="text-slate-800 text-sm font-bold tracking-tight">Ringkasan Akademik</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            {{-- IPK --}}
            <div class="bg-slate-50/60 rounded-xl p-4 border border-slate-100 hover:shadow-sm transition-all duration-200">
                <div class="flex items-start justify-between mb-2">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Akumulatif Nilai (IPK)</p>
                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-md">Sangat Baik</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono">3.99</p>
                <div class="mt-3 w-full bg-slate-200/70 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-[#f9b17a] h-full rounded-full" style="width: 99.75%"></div>
                </div>
                <p class="text-[10px] text-slate-400 mt-1.5">dari skala maksimal 4.00</p>
            </div>

            {{-- Total SKS --}}
            <div class="bg-slate-50/60 rounded-xl p-4 border border-slate-100 hover:shadow-sm transition-all duration-200">
                <div class="flex items-start justify-between mb-2">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Total SKS Ditempuh</p>
                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-md">Kumulatif</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono">90</p>
                <div class="mt-3 w-full bg-slate-200/70 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-blue-500 h-full rounded-full" style="width: 62.5%"></div>
                </div>
                <p class="text-[10px] text-slate-400 mt-1.5">dari target kelulusan ~144 SKS</p>
            </div>

            {{-- Semester --}}
            <div class="bg-slate-50/60 rounded-xl p-4 border border-slate-100 hover:shadow-sm transition-all duration-200">
                <div class="flex items-start justify-between mb-2">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Semester Saat Ini</p>
                    <span class="text-[10px] font-bold text-violet-600 bg-violet-50 border border-violet-100 px-2 py-0.5 rounded-md">Aktif</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono">5</p>
                <div class="mt-3.5 flex gap-1.5">
                    @for ($i = 1; $i <= 8; $i++) 
                        <div class="h-1.5 flex-1 rounded-full {{ $i <= 5 ? 'bg-violet-500' : 'bg-slate-200' }}"></div>
                    @endfor
                </div>
                <p class="text-[10px] text-slate-400 mt-2">Berjalan di semester 5 dari 8</p>
            </div>

        </div>
    </div>

    {{-- ===== FILTER SEMESTER & DETAIL INDEKS ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Kiri: Detail Per Semester --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6 lg:col-span-2 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-slate-800 text-sm font-bold tracking-tight">Detail Per Semester</h2>
                    </div>
                </div>

                {{-- Action Controls --}}
                <div class="flex items-center gap-2">
                    <select class="sem-select text-xs text-slate-600 bg-slate-50 rounded-xl px-3 py-2 border border-slate-200 font-medium focus:outline-none focus:ring-1 focus:ring-[#f9b17a]">
                        <option>Semester 6</option>
                        <option selected>Semester 5</option>
                        <option>Semester 4</option>
                        <option>Semester 3</option>
                        <option>Semester 2</option>
                        <option>Semester 1</option>
                    </select>

                    <button class="inline-flex items-center gap-1.5 bg-[#f9b17a] hover:bg-[#e29d68] text-white text-xs font-bold px-3.5 py-2 rounded-xl transition-colors shadow-sm shadow-[#f9b17a]/10">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Ekspor PDF
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-slate-50/60 border border-slate-100 rounded-xl p-4">
                    <p class="text-[11px] font-semibold text-slate-400 mb-1">IPS Semester Ini</p>
                    <p class="text-2xl font-extrabold text-slate-800 mono">3.99</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">Skala Batas 4.00</p>
                </div>

                <div class="bg-slate-50/60 border border-slate-100 rounded-xl p-4">
                    <p class="text-[11px] font-semibold text-slate-400 mb-1">SKS Diambil</p>
                    <p class="text-2xl font-extrabold text-slate-800 mono">24</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">Beban semester berjalan</p>
                </div>
            </div>
        </div>

        {{-- Kanan: Skala Nilai --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center gap-2.5 mb-4">
                <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h2 class="text-slate-800 text-sm font-bold tracking-tight">Skala Nilai</h2>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">A</span>
                    <span class="text-[11px] font-medium text-slate-400">85–100</span>
                </div>
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">B+</span>
                    <span class="text-[11px] font-medium text-slate-400">80–84</span>
                </div>
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">B</span>
                    <span class="text-[11px] font-medium text-slate-400">75–79</span>
                </div>
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">C+</span>
                    <span class="text-[11px] font-medium text-slate-400">70–74</span>
                </div>
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">C</span>
                    <span class="text-[11px] font-medium text-slate-400">65–69</span>
                </div>
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">D+</span>
                    <span class="text-[11px] font-medium text-slate-400">60–64</span>
                </div>
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">D</span>
                    <span class="text-[11px] font-medium text-slate-400">55–59</span>
                </div>
                <div class="bg-slate-50 rounded-xl py-2 px-3 flex justify-between items-center border border-slate-100">
                    <span class="text-xs font-bold text-slate-700">E</span>
                    <span class="text-[11px] font-medium text-slate-400">0–54</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== MODERN DATA TABLE ===== --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm" data-aos="fade-up" data-aos-delay="400">
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Daftar Nilai Kuliah</h3>
            <p class="text-xs text-slate-400 mt-0.5">Rincian nilai huruf dan mutu angka per mata kuliah</p>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-100 shadow-sm shadow-slate-100/40">
            <table class="w-full text-sm border-collapse">
                
                {{-- TABLE HEADER --}}
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-xs font-bold uppercase tracking-wider">Kode</th>
                        <th class="px-5 py-3.5 text-left text-xs font-bold uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-5 py-3.5 text-left text-xs font-bold uppercase tracking-wider">Dosen Pengajar</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold uppercase tracking-wider">SKS</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold uppercase tracking-wider">Nilai Angka</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold uppercase tracking-wider">Nilai Huruf</th>
                    </tr>
                </thead>

                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-slate-100 bg-white">
                    
                    {{-- Row 1 --}}
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="px-5 py-4 text-slate-800 font-bold tracking-wide">IF202</td>
                        <td class="px-5 py-4 font-semibold text-slate-700">Pemrograman Web</td>
                        <td class="px-5 py-4 text-slate-500 font-medium">Ir. Zaid Hasbiya</td>
                        <td class="px-5 py-4 text-center text-slate-700 font-bold">3</td>
                        <td class="px-5 py-4 text-center font-bold text-slate-800 mono">100</td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-block bg-emerald-50 text-emerald-600 border border-emerald-100 px-3 py-1 rounded-full text-xs font-bold">A</span>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="px-5 py-4 text-slate-800 font-bold tracking-wide">IF204</td>
                        <td class="px-5 py-4 font-semibold text-slate-700">Statistika & Probabilitas</td>
                        <td class="px-5 py-4 text-slate-500 font-medium">Drs. Supriyadi, M.T.</td>
                        <td class="px-5 py-4 text-center text-slate-700 font-bold">4</td>
                        <td class="px-5 py-4 text-center font-bold text-slate-800 mono">82</td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-block bg-blue-50 text-blue-600 border border-blue-100 px-2.5 py-1 rounded-full text-xs font-bold">B+</span>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="px-5 py-4 text-slate-800 font-bold tracking-wide">IF206</td>
                        <td class="px-5 py-4 font-semibold text-slate-700">Arsitektur Komputer</td>
                        <td class="px-5 py-4 text-slate-500 font-medium">Prof. Hermawan</td>
                        <td class="px-5 py-4 text-center text-slate-700 font-bold">3</td>
                        <td class="px-5 py-4 text-center font-bold text-slate-800 mono">78</td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-block bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full text-xs font-bold">B</span>
                        </td>
                    </tr>

                    {{-- Row 4 --}}
                    <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                        <td class="px-5 py-4 text-slate-800 font-bold tracking-wide">IF208</td>
                        <td class="px-5 py-4 font-semibold text-slate-700">Etika Profesi IT</td>
                        <td class="px-5 py-4 text-slate-500 font-medium">Siti Aminah, M.Kom.</td>
                        <td class="px-5 py-4 text-center text-slate-700 font-bold">2</td>
                        <td class="px-5 py-4 text-center font-bold text-slate-800 mono">95</td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-block bg-emerald-50 text-emerald-600 border border-emerald-100 px-3 py-1 rounded-full text-xs font-bold">A</span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
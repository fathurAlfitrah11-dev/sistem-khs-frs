@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

@php
// 1. Hitung total SKS diambil secara mandiri di Blade agar semua matkul (dinilai/belum) ikut terhitung
$totalSksPasti = 0;
foreach($krs as $dataKrs) {
foreach($dataKrs->detail as $item) {
if(isset($item->pengajar->semester) && $item->pengajar->semester == $semesterDipilih) {
$totalSksPasti += ($item->pengajar->mataKuliah->sks ?? 0);
}
}
}

// 2. Sinkronisasi progress bar IPK dari Controller (Gunakan fallback agar aman)
$persenIpkBar = $persen_ipk ?? 0;

// 3. Hitung persentase progress SKS Kelulusan global (Target nasional: 144 SKS)
$persenSksBar = ($totalSksPasti / 144) * 100;
if($persenSksBar > 100){
$persenSksBar = 100;
}
@endphp

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
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 24 24'%3E%3Cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 32px;
}
</style>

<div class="khs-wrap p-4 md:p-6 bg-slate-50/50 min-h-screen">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Kartu Hasil Studi (KHS)</h1>
        <p class="text-xs text-slate-400 mt-1">Pantau perkembangan indeks prestasi dan seluruh nilai mata kuliah Anda
        </p>
    </div>

    {{-- ===== RINGKASAN AKADEMIK CONTAINER ===== --}}
    <div class="bg-[#4f547d] rounded-3xl p-6 mb-6 shadow-lg">

        <div class="flex items-center gap-2.5 mb-5">
            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-300" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <h2 class="text-white text-base font-bold tracking-tight">Ringkasan Akademik</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            {{-- IPK CARD --}}
            <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between mb-2">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Akumulatif Nilai (IPK)
                    </p>
                    <span
                        class="text-[10px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-md">Sangat
                        Baik</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono">{{ number_format($ipk, 2) }}</p>
                <div class="mt-3 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-yellow-400 h-full rounded-full transition-all duration-500"
                        style="width: {{ $persenIpkBar }}%"></div>
                </div>
                <p class="text-[10px] text-slate-400 mt-1.5">dari skala maksimal 4.00</p>
            </div>

            {{-- TOTAL SKS CARD --}}
            <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between mb-2">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Total SKS Ditempuh</p>
                    <span
                        class="text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-md">Kumulatif</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono">{{ $totalSksPasti }}</p>
                <div class="mt-3 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-blue-500 h-full rounded-full transition-all duration-500"
                        style="width: {{ $persenSksBar }}%"></div>
                </div>
                <p class="text-[10px] text-slate-400 mt-1.5">dari target kelulusan ~144 SKS</p>
            </div>

            {{-- SEMESTER CARD --}}
            <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between mb-2">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Semester Saat Ini</p>
                    <span
                        class="text-[10px] font-bold text-violet-600 bg-violet-50 border border-violet-100 px-2 py-0.5 rounded-md">Aktif</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono">{{ $semesterSaatIni }}</p>
                <div class="mt-3.5 flex gap-1.5">
                    @for ($i = 1; $i <= 8; $i++) <div
                        class="h-1.5 flex-1 rounded-full {{ $i <= $semesterSaatIni ? 'bg-violet-500' : 'bg-slate-200' }}">
                </div>
                @endfor
            </div>
            <p class="text-[10px] text-slate-400 mt-2">Berjalan di semester {{ $semesterSaatIni }} dari 8</p>
        </div>

    </div>
</div>

{{-- ===== FILTER SEMESTER & DETAIL INDEKS ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

    {{--Detail Per Semester--}}
    <div class="bg-[#4f547d] rounded-3xl p-6 lg:col-span-2 shadow-lg flex flex-col justify-between">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-white text-base font-bold tracking-tight">Detail Per Semester</h2>
                </div>
            </div>

            {{-- Action Controls --}}
            <div class="flex items-center gap-2">
                <form method="GET">
                    <select name="semester" onchange="this.form.submit()"
                        class="sem-select text-xs text-white bg-[#5a5f86] rounded-xl px-3 py-2 border border-white/10 font-medium focus:outline-none focus:ring-1 focus:ring-yellow-400 cursor-pointer">
                        @foreach($semesterList as $semester)
                        <option value="{{ $semester }}" {{ $semesterDipilih == $semester ? 'selected' : '' }}
                            class="text-black">
                            Semester {{ $semester }}
                        </option>
                        @endforeach
                    </select>
                </form>

                <a href="{{ url('/khsmahasiswa/cetak') }}?semester={{ $semesterDipilih }}"
                    class="inline-flex items-center gap-1.5 bg-orange-400 hover:bg-orange-300 text-black text-xs font-bold px-3.5 py-2 rounded-xl transition-colors shadow-md">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Ekspor PDF
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 h-full">

            {{-- CARD IPS SEMESTER INI --}}
            @php
            // Hitung persentase IPS (IPS / 4.00) * 100
            $persenIpsDetail = ($ipsSemester / 4) * 100;
            if($persenIpsDetail > 100) $persenIpsDetail = 100;
            @endphp
            <div
                class="bg-white rounded-2xl p-5 py-6 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mb-1">IPS Semester Ini
                    </p>
                    <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono mt-1">
                        {{ number_format($ipsSemester, 2) }}</p>

                    {{-- PROGRESS BAR IPS --}}
                    <div class="mt-3 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-yellow-500 h-full rounded-full transition-all duration-500"
                            style="width: {{ $persenIpsDetail }}%"></div>
                    </div>
                </div>
                <p class="text-[10px] text-slate-400 mt-4">dari skala maksimal 4.00</p>
            </div>

            {{-- CARD SKS DIAMBIL --}}
            @php
            // Hitung persentase SKS terhadap batas maksimal semesteran (24 SKS)
            $persenSksDetail = ($totalSksPasti / 24) * 100;
            if($persenSksDetail > 100) $persenSksDetail = 100;
            @endphp
            <div
                class="bg-white rounded-2xl p-5 py-6 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mb-1">SKS Diambil</p>
                    <p class="text-3xl font-extrabold text-slate-800 tracking-tight mono mt-1">{{ $totalSksPasti }}</p>

                    {{-- PROGRESS BAR SKS --}}
                    <div class="mt-3 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-blue-500 h-full rounded-full transition-all duration-500"
                            style="width: {{ $persenSksDetail }}%"></div>
                    </div>
                </div>
                <p class="text-[10px] text-slate-400 mt-4">dari batas maksimum 24 SKS semesteran</p>
            </div>

        </div>
    </div>

    {{-- Kanan: Skala Nilai --}}
    <div class="bg-[#4f547d] rounded-3xl p-6 shadow-lg">
        <div class="flex items-center gap-2.5 mb-4">
            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                <svg class="w-4 h-4 text-violet-300" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138z" />
                </svg>
            </div>
            <h2 class="text-white text-base font-bold tracking-tight">Skala Nilai</h2>
        </div>

        <div class="grid grid-cols-2 gap-2">
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">A</span>
                <span class="text-[11px] font-medium text-slate-400">85–100</span>
            </div>
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">B+</span>
                <span class="text-[11px] font-medium text-slate-400">80–84</span>
            </div>
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">B</span>
                <span class="text-[11px] font-medium text-slate-400">75–79</span>
            </div>
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">C+</span>
                <span class="text-[11px] font-medium text-slate-400">70–74</span>
            </div>
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">C</span>
                <span class="text-[11px] font-medium text-slate-400">65–69</span>
            </div>
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">D+</span>
                <span class="text-[11px] font-medium text-slate-400">60–64</span>
            </div>
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">D</span>
                <span class="text-[11px] font-medium text-slate-400">55–59</span>
            </div>
            <div class="bg-white rounded-xl py-2 px-3 flex justify-between items-center shadow-sm">
                <span class="text-xs font-bold text-slate-700">E</span>
                <span class="text-[11px] font-medium text-slate-400">0–54</span>
            </div>
        </div>
    </div>

</div>

{{-- ===== MODERN DATA TABLE ===== --}}
<div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="400">

    <h2 class="text-white text-3xl font-bold mb-6">Daftar Nilai Kuliah</h2>

    <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm shadow-slate-900/20">
        <div class="bg-white overflow-hidden rounded-2xl">

            <table class="w-full border-collapse">

                {{-- TABLE HEADER --}}
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Kode</th>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Dosen Pengajar</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">SKS</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Nilai Angka</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Nilai Huruf</th>
                    </tr>
                </thead>

                {{-- TABLE BODY --}}
                <tbody>
                    @php $adaData = false; @endphp
                    @foreach($krs as $dataKrs)
                    @foreach($dataKrs->detail as $item)
                    @if(isset($item->pengajar->semester) && $item->pengajar->semester == $semesterDipilih)
                    @php $adaData = true; @endphp
                    <tr
                        class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">

                        <td class="px-6 py-3 text-left whitespace-nowrap font-medium font-mono">
                            {{ $item->pengajar->mataKuliah->kode_mk ?? '-' }}
                        </td>

                        <td class="px-6 py-3 text-left break-words font-semibold">
                            {{ $item->pengajar->mataKuliah->nama_mk ?? '-' }}
                        </td>

                        {{-- DOSEN CHECK --}}
                        <td class="px-6 py-3 text-left break-words text-gray-600">
                            @if($item->pengajar && $item->pengajar->dosen)
                            {{ $item->pengajar->dosen->nama_dosen }}
                            @else
                            <span class="text-gray-400 italic">Belum Diplot</span>
                            @endif
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap font-bold">
                            {{ $item->pengajar->mataKuliah->sks ?? 0 }}
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            @if($item->khs)
                            <span class="text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full text-xs font-bold">
                                {{ $item->khs->na }}
                            </span>
                            @else
                            <span class="text-amber-700 font-semibold bg-amber-100 px-3 py-1 rounded-full text-xs">Belum
                                Dinilai</span>
                            @endif
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            @if($item->khs && $item->khs->nh)
                            <span class="text-blue-700 bg-blue-100 px-3 py-1 rounded-full text-xs font-extrabold">
                                {{ $item->khs->nh }}
                            </span>
                            @else
                            <span class="text-gray-400 font-bold">-</span>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach

                    @if(!$adaData)
                    <tr>
                        <td colspan="6" class="text-center py-8 text-xs text-gray-400 font-medium bg-gray-50">
                            Belum ada data nilai mata kuliah untuk semester {{ $semesterDipilih }}.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>

</div>

</div>

@endsection
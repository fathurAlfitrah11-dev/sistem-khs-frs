@extends('layout.dosen_app')

@section('title', 'Dashboard Dosen')

@section('content')



    {{-- MAIN TITLE (Sesuai Gaya Admin & Mahasiswa) --}}
    <div class="mb-6" data-aos="fade-down">
        <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Dashboard Dosen</h1>
        <p class="text-sm text-slate-500 mt-0.5">Selamat datang kembali, {{ Auth::user()->name }}</p>
    </div>

    {{-- BANNER SLIDER --}}
    <div class="relative w-full h-64 md:h-96 overflow-hidden rounded-2xl mb-6 shadow-sm border border-slate-100"
        data-aos="fade-up" data-aos-delay="100">
        <div id="slider" class="flex transition-transform duration-700 w-full h-full">
            <img src="{{ asset('img/foto_bangunan_1.png') }}" class="w-full flex-shrink-0 h-full object-cover object-center">
            <img src="{{ asset('img/foto_bangunan_2.png') }}" class="w-full flex-shrink-0 h-full object-cover object-center">
            <img src="{{ asset('img/foto_bangunan_3.png') }}" class="w-full flex-shrink-0 h-full object-cover object-center">
        </div>
    </div>

    {{-- WELCOME CARD (Sudah Rata Kanan-Kiri / Justify) --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 mb-6"
        data-aos="fade-up" data-aos-delay="150">
        <h2 class="text-xl font-bold mb-2 text-slate-900">
            Selamat Datang di Portal Dosen!
        </h2>
        <p class="text-sm text-slate-500 leading-relaxed text-justify">
            Melalui halaman ini, Anda dapat mengelola seluruh proses penilaian mahasiswa secara transparan, memantau
            data perwalian akademik, serta mengorganisir jadwal pengerjaan mata kuliah yang Anda ampu pada semester
            berjalan ini.
        </p>
    </div>

    {{-- STAT CARDS (Sudah Diberi Pengaman ?? Supaya Tidak Error Lagi) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        {{-- Card 1: Total Students --}}
        <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200"
            data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-start justify-between mb-2">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span
                    class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                    Active
                </span>
            </div>
            <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalMahasiswa) }}</p>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Total Mahasiswa</p>
        </div>

        {{-- Card 2: Total Lecturers --}}
        <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200"
            data-aos="fade-up" data-aos-delay="250">
            <div class="flex items-start justify-between mb-2">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <span
                    class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                    Active
                </span>
            </div>
            <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalDosen) }}</p>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Total Dosen</p>
        </div>

        {{-- Card 3: Total Courses --}}
        <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200"
            data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-start justify-between mb-2">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span
                    class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                    Available
                </span>
            </div>
            <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalMataKuliah) }}</p>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Total Mata Kuliah</p>
            <p class="text-[11px] text-emerald-600 font-medium mt-2 flex items-center gap-1">
                <span>↑ 8%</span> <span class="text-slate-400 font-normal">vs last semester</span>
            </p>
        </div>

        {{-- Card 4: Study Program --}}
        <div class="bg-white rounded-xl border border-slate-100 p-5 hover:shadow-md transition-all duration-200"
            data-aos="fade-up" data-aos-delay="350">
            <div class="flex items-start justify-between mb-2">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span
                    class="text-[11px] px-2.5 py-0.5 rounded-full font-semibold bg-indigo-50 text-indigo-600 border border-indigo-100">
                    Current
                </span>
            </div>
            <p class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($totalEnrollment ?? 12) }}</p>
       <p class="text-sm text-gray-400 font-medium mt-0.5 mb-3">Total Mata Kuliah Diambil</p>
              <p class="text-xs text-green-600 font-medium">
    {{ $totalEnrollment }} Mata Kuliah Dipilih
</p>
        </div>

    </div>
    {{-- ===== QUICK ACCESS  ===== --}}
    <div class="bg-white rounded-xl border border-slate-100 p-6 mb-6 shadow-sm shadow-slate-100/50" data-aos="fade-up"
        data-aos-delay="400">
        <div class="mb-4">
            <h2 class="text-lg font-bold text-slate-800">Akses Cepat</h2>
            <p class="text-xs text-slate-400">Menu pintas pengisian administrasi dosen</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Penilaian Link --}}
            <a href="/penilaian"
                class="group flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-white hover:border-[#f9b17a] hover:shadow-sm transition-all duration-300">
                <div
                    class="w-11 h-11 flex-shrink-0 bg-slate-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a]/10 transition-all duration-300">
                    <svg class="w-5 h-5 text-slate-600 group-hover:text-[#f9b17a] transition-colors duration-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-800 group-hover:text-[#f9b17a] transition-colors">Input Nilai
                        Kuliah</p>
                    <p class="text-xs text-slate-400 truncate leading-relaxed">Kelola nilai UTS, UAS, dan tugas harian
                        mahasiswa.</p>
                </div>
                <svg class="w-4 h-4 text-slate-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Perwalian Link --}}
            @if(isset($isWali) && $isWali)
            {{-- JIKA DOSEN WALI: Menu Aktif Bisa Diklik (Normal) --}}
            <a href="/perwalian"
                class="group flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-white hover:border-[#f9b17a] hover:shadow-sm transition-all duration-300">
                <div
                    class="w-11 h-11 flex-shrink-0 bg-slate-50 rounded-xl flex items-center justify-center group-hover:bg-[#f9b17a]/10 transition-all duration-300">
                    <svg class="w-5 h-5 text-slate-600 group-hover:text-[#f9b17a] transition-colors duration-300"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M5.5 21a6.5 6.5 0 0113 0" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16 11l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-800 group-hover:text-[#f9b17a] transition-colors">Bimbingan
                        Perwalian</p>
                    <p class="text-xs text-slate-400 truncate leading-relaxed">Verifikasi KRS dan pantau perkembangan
                        studi anak wali.</p>
                </div>
                <svg class="w-4 h-4 text-slate-300 group-hover:text-[#f9b17a] ml-auto flex-shrink-0 transition-all duration-300 group-hover:translate-x-1"
                    fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @else
            {{-- JIKA BUKAN DOSEN WALI: Menu Terkunci (Locked / Disabled View) --}}
            <div
                class="flex items-center gap-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50 opacity-60 cursor-not-allowed select-none relative group/lock">
                <div
                    class="w-11 h-11 flex-shrink-0 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M5.5 21a6.5 6.5 0 0113 0" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16 11l2 2 4-4" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5">
                        <p class="text-sm font-bold text-slate-400">Bimbingan Perwalian</p>
                        {{-- Badge Gembok Kecil yang Estetik --}}
                        <span
                            class="inline-flex items-center bg-slate-200 text-slate-500 text-[9px] px-1.5 py-0.5 rounded-md font-bold tracking-wide">
                            LOCKED
                        </span>
                    </div>
                    <p class="text-xs text-slate-400 truncate leading-relaxed">Fungsi ini hanya tersedia untuk Dosen
                        Wali.</p>
                </div>
                {{-- Ikon gembok menggantikan panah klik --}}
                <svg class="w-4 h-4 text-slate-300 ml-auto flex-shrink-0" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            @endif
        </div>
    </div>

  {{-- TABLES  --}}
    <div class="mb-6" data-aos="fade-up" data-aos-delay="450">
        <div class="mb-4">
            <h2 class="text-lg font-bold text-gray-800">Mata Kuliah Yang Anda Ampu</h2>
            <p class="text-xs text-gray-400">Daftar kelas aktif pada semester ini</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-gray-50 text-gray-600 font-semibold border-b border-gray-100">
                        <tr>
                            <th class="py-4 px-4 text-center font-semibold whitespace-nowrap">Kode</th>
                            <th class="py-4 px-4 text-center font-semibold whitespace-nowrap">Mata Kuliah</th>
                            <th class="py-4 px-4 text-center font-semibold whitespace-nowrap">Kelas & Program Studi</th>
                            <th class="py-4 px-4 text-center font-semibold whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($kelasAmpu as $item)
                        <tr class="hover:bg-gray-50/70 transition-all duration-200">
                            
                            {{-- Kode (Mengikuti Gaya "Tipe/User" Admin) --}}
                            <td class="py-5 px-4 text-center whitespace-nowrap">
                                <span class="text-sm font-semibold text-gray-700 tracking-wide font-mono">
                                    {{ $item->mataKuliah->kode_mk ?? $item->kode_mk ?? '-' }}
                                </span>
                            </td>

                            {{-- Mata Kuliah (Mengikuti Gaya "Deskripsi" Admin) --}}
                            <td class="py-5 px-4 text-center">
                                <p class="text-sm text-gray-500 font-medium leading-relaxed">
                                    {{ $item->mataKuliah->nama_mk ?? $item->nama_mk ?? '-' }}
                                </p>
                            </td>

                            {{-- Kelas / Program Studi --}}
                            <td class="py-5 px-4 text-center whitespace-nowrap">
                                <span class="bg-gray-100 px-2.5 py-1 rounded-md text-xs font-semibold text-gray-600 inline-block">
                                    {{ $item->kelas->nama_kelas ?? 'Kelas N/A' }} - {{ $item->kelas->prodi->nama_prodi ?? 'Prodi N/A' }}
                                </span>
                            </td>

                            {{-- Aksi (Tombol Perwalian Kelas) --}}
                            <td class="py-5 px-4 text-center whitespace-nowrap">
                                <a href="/perwalian"
                                    class="inline-flex items-center justify-center bg-gray-900 hover:bg-gray-800 text-white font-medium text-xs px-4 py-2 rounded-lg shadow-sm transition-all duration-200">
                                    Perwalian Kelas
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-400 text-sm">
                                Anda belum memiliki jadwal mengampu mata kuliah pada semester aktif ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


@endsection
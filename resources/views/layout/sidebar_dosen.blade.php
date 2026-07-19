@php
$dosen = \App\Models\Dosen::where('user_id', Auth::id())->first();

$isWali = $dosen
    ? \App\Models\Kelas::where('nik_wali', $dosen->nik)->exists()
    : false;

$isKps = $dosen
    ? \App\Models\Prodi::where('nik_kps', $dosen->nik)->exists()
    : false;
@endphp

<div id="sidebar" class="w-64 h-screen bg-[#3b3f64] fixed left-0 top-0 flex flex-col z-50 transition-transform duration-300 transform -translate-x-full lg:translate-x-0">

        <!-- LOGO -->
<div class="p-4 border-b border-white/10 flex items-center justify-center">
    <img src="{{ asset('img/logo sidebar.svg') }}" alt="Logo" class="w-70 object-contain">
</div>

    <div class="flex-1 p-4 space-y-2 text-sm overflow-y-auto">
        @if(Auth::user()->role == 'dosen')
        
            {{-- DASHBOARD --}}
            <a href="/dosen" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->routeIs('dosen') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            {{-- PENILAIAN --}}
            <a href="/penilaian" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('penilaian') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-chart-bar"></i>
                <span>Penilaian</span>
            </a>
            
            {{-- PERWALIAN --}}
            @if(isset($isWali) && $isWali)
            <a href="/perwalian" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('perwalian') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-user-check"></i>
                <span>Perwalian</span>
            </a>
            @endif
            
            {{-- KPS --}}
            @if(isset($isKps) && $isKps)
            <a href="/kps-penguncian" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('kps-penguncian') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-user-tie"></i>
                <span>KPS</span>
            </a>
            @endif
            
            {{-- LOGOUT --}}
            <a href="/logout" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-500 text-gray-300 hover:text-white transition">
                <i class="fa-solid fa-door-open"></i>
                <span>Keluar</span>
            </a>

        {{-- Perbaikan: Memindahkan @endif ke dalam sini sebelum tag penutup DIV Menu --}}
        @endif
    </div>
</div>

{{-- Perbaikan: Menambahkan elemen overlay yang sama seperti mahasiswa untuk handle tampilan di mode mobile --}}
<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"></div>
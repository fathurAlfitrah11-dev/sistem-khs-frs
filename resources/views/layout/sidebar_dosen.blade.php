@php
    $dosen = \App\Models\Dosen::where('user_id', Auth::id())->first();

    $isWali = $dosen
        ? \App\Models\Kelas::where('nik_wali', $dosen->nik)->exists()
        : false;

    $isKps = $dosen
        ? \App\Models\Prodi::where('nik_kps', $dosen->nik)->exists()
        : false;
@endphp

<div class="w-64 h-screen bg-[#3b3f63] fixed left-0 top-0 flex flex-col">

    <!-- LOGO -->
    <div class="p-4 border-b border-white/10 flex items-center justify-center">
        <img src="{{ asset('img/logo sidebar.svg') }}" alt="Logo" class="w-70 object-contain">
    </div>

    <!-- MENU -->
    <div class="flex-1 p-4 space-y-2 text-sm">
        @if(Auth::user()->role == 'dosen')
        <a href="/dosen" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->routeIs('dosen') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

            <i class="fa-solid fa-house" style="color: rgb(255, 255, 255);"></i>
            <span>Dashboard</span>

        </a>

        <a href="/penilaian" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('penilaian') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

            <i class="fa-solid fa-chart-bar"></i>
            <span>Penilaian</span>

        </a>
        @if(isset($isWali) && $isWali)
        <a href="/perwalian" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('perwalian') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

            <i class="fa-solid fa-user-check"></i>
            <span>Perwalian</span>

        </a>
        @endif
        @if(isset($isKps) && $isKps)
<a href="/kps"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
    {{ request()->is('kps') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-user-tie"></i>
    <span>KPS</span>

</a>
@endif
        <a href="/logout" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-500 transition">
            <i class="fa-solid fa-door-open"></i>
            <span>Keluar</span>
        </a>

    </div>

    @endif

</div>
</div>
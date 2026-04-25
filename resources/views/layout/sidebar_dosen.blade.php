<div class="w-64 h-screen bg-[#3b3f63] fixed left-0 top-0 flex flex-col">

    <!-- LOGO -->
    <div class="p-6 text-xl font-bold border-b border-white/10">
        Smart Academyc System
    </div>

    <!-- MENU -->
    <div class="flex-1 p-4 space-y-2 text-sm">
        @if(Auth::user()->role == 'dosen')
        <a href="/dosen"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->routeIs('dosen') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-house" style="color: rgb(255, 255, 255);"></i>
    <span>Dashboard</span>

</a>

<a href="/matakuliahdosen"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('matakuliahdosen') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-book"></i>
    <span>Matakuliah</span>

</a>
        <a href="/penilaian"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('penilaian') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-chart-bar"></i>
    <span>Penilaian</span>

</a>
        <a href="/logout"
    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#2d3250] transition">

    <i class="fa-solid fa-door-closed" style="color: rgb(255, 255, 255);"></i>
    <span>Keluar</span>

</a>
    
</div>

@endif

    </div>
</div>
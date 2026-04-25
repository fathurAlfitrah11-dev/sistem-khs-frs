<div class="w-64 h-screen bg-[#3b3f63] fixed left-0 top-0 flex flex-col">

    <!-- LOGO -->
    <div class="p-6 text-xl font-bold border-b border-white/10">
        Smart Academyc System
    </div>

    <!-- MENU -->
    <div class="flex-1 p-4 space-y-2 text-sm">
        @if(Auth::user()->role == 'admin')
        <a href="/admin" class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('admin') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">
            <i class="fa-solid fa-house" style="color: rgb(255, 255, 255);"></i>
            <span>Dashboard</span>
        </a>

        <a href="/kelas" class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('kelas') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">
            <i class="fa-solid fa-chalkboard"></i>
            <span>Kelas</span>
        </a>

        <a href="/prodi" class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('prodi') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">
            <i class="fa-solid fa-user-graduate"></i>
            <span>Program Studi</span>
        </a>
        
        <a href="/mahasiswa" class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('mahasiswa') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">
            <i class="fa-solid fa-user"></i>
            <span>Mahasiswa</span>
        </a>
        <a href="/tahun-ajaran" class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('tahun-ajaran') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Tahun Ajaran</span>
        </a>

        <a href="/mata-kuliah" class="flex items-center gap-3 px-4 py-2 rounded-lg transition {{ request()->routeIs('mata-kuliah') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">
            <i class="fa-solid fa-book-open"></i>
            <span>Matakuliah</span>
        </a>
        <!-- DOSEN DROPDOWN -->
<div>
    <button onclick="toggleDosen()"
        class="w-full flex items-center justify-between px-4 py-2 rounded-lg transition 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">
    <i class="fa-solid fa-chalkboard-user"></i>
        <div class="flex items-center gap-3">
            <span>Dosen</span>
        </div>

        <svg id="arrowDosen" class="w-4 h-4 transition-transform duration-300"
            fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- SUB MENU -->
    <div id="dropdownDosen" class="hidden flex flex-col ml-8 mt-2 space-y-1 text-sm">

        <a href="/dosen-admin"
            class="px-3 py-2 rounded hover:bg-[#2d3250] transition">
            Data Dosen
        </a>

        <a href="/pengajar"
            class="px-3 py-2 rounded hover:bg-[#2d3250] transition">
            Data Pengajar
        </a>

        <a href="/dosen-wali"
            class="px-3 py-2 rounded hover:bg-[#2d3250] transition">
            Dosen Wali
        </a>
    </div>
        <a href="/logout"
    class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#2d3250] transition">

    <i class="fa-solid fa-door-closed" style="color: rgb(255, 255, 255);"></i>
    <span>Keluar</span>

</a>  
</div>

@endif

    </div>
</div>
<script>
function toggleDosen() {
    const menu = document.getElementById('dropdownDosen');
    const arrow = document.getElementById('arrowDosen');

    menu.classList.toggle('hidden');

    arrow.classList.toggle('rotate-180');
}
</script>
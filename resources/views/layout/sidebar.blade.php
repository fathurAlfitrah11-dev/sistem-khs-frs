<div id="sidebar" class="fixed top-0 left-0 w-64 h-screen bg-[#3b3f64] flex flex-col z-50 transition-transform duration-300 transform -translate-x-full lg:translate-x-0">

        <!-- LOGO -->
<div class="p-4 border-b border-white/10 flex items-center justify-center">
    <img src="{{ asset('img/logo sidebar.svg') }}" alt="Logo" class="w-70 object-contain">
</div>

    {{-- MENU --}}
    <div class="flex-1 p-4 space-y-2 text-sm overflow-y-auto">
        @if(Auth::user()->role == 'admin')
        
            {{-- DASHBOARD --}}
            <a href="/admin" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('admin') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
            
            {{-- DROPDOWN DOSEN --}}
            @php
            $isDosenMenu = request()->is('dosen-admin') || request()->is('pengajar') || request()->is('dosen-wali') || request()->is('kps');
            @endphp

            <div>
                <button onclick="toggleDosen()" class="w-full flex items-center justify-between px-4 py-2 rounded-lg transition
                    {{ $isDosenMenu ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Manajemen Dosen</span>
                    </div>
                    <svg id="arrowDosen" class="w-4 h-4 transition-transform duration-300 {{ $isDosenMenu ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                {{-- SUB MENU --}}
                <div id="dropdownDosen" class="overflow-hidden flex flex-col ml-8 mt-2 space-y-1 text-sm transition-all duration-300 
                    {{ $isDosenMenu ? 'max-h-64' : 'max-h-0 hidden' }}">
                    <a href="/dosen-admin" class="px-3 py-2 rounded transition {{ request()->is('dosen-admin') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">Data Dosen</a>
                    <a href="/pengajar" class="px-3 py-2 rounded transition {{ request()->is('pengajar') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">Data Pengajar</a>
                    <a href="/dosen-wali" class="px-3 py-2 rounded transition {{ request()->is('dosen-wali') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">Data Dosen Wali</a>
                    <a href="/kps" class="px-3 py-2 rounded transition {{ request()->is('kps') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">Data KPS</a>
                </div>
            </div>

            {{-- MATA KULIAH --}}
            <a href="/mata-kuliah" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('mata-kuliah') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-book-open"></i>
                <span>Mata Kuliah</span>
            </a>

            {{-- TAHUN AJARAN --}}
            <a href="/tahun-ajaran" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('tahun-ajaran') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Tahun Ajaran</span>
            </a>

            {{-- PRODI --}}
            <a href="/prodi" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('prodi') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Program Studi</span>
            </a>

            {{-- KELAS --}}
            <a href="/kelas" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('kelas') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-chalkboard"></i>
                <span>Kelas</span>
            </a>

            {{-- MAHASISWA --}}
            <a href="/mahasiswa" class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('mahasiswa') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250] text-gray-300' }}">
                <i class="fa-solid fa-user"></i>
                <span>Mahasiswa</span>
            </a>

            {{-- LOGOUT --}}
            <a href="/logout" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-500 text-gray-300 hover:text-white transition">
                <i class="fa-solid fa-door-open"></i>
                <span>Keluar</span>
            </a>
        @endif
    </div>
</div>

<script>
function toggleDosen() {
    const dropdown = document.getElementById('dropdownDosen');
    const arrow = document.getElementById('arrowDosen');

    if (dropdown.classList.contains('max-h-0')) {
        dropdown.classList.remove('max-h-0', 'hidden');
        dropdown.classList.add('max-h-64');
    } else {
        dropdown.classList.remove('max-h-64');
        dropdown.classList.add('max-h-0');
        setTimeout(() => {
            if (dropdown.classList.contains('max-h-0')) {
                dropdown.classList.add('hidden');
            }
        }, 300);
    }
    arrow.classList.toggle('rotate-180');
}
</script>
<div id="sidebar" class="fixed top-0 left-0 w-64 h-screen bg-[#3b3f64] flex flex-col z-50 transition-transform duration-300 transform -translate-x-full lg:translate-x-0">

    <!-- LOGO -->
<div class="p-4 border-b border-white/10 flex items-center justify-center">
    <img src="{{ asset('img/logo sidebar.svg') }}" alt="Logo" class="w-70 object-contain">
</div>
    <!-- MENU -->
    <div class="flex-1 p-4 space-y-2 text-sm"> 
        @if(Auth::user()->role == 'mahasiswa')
        <a href="/mahasiswa-real"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->routeIs('mahasiswa-real') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-house" style="color: rgb(255, 255, 255);"></i>
    <span>Dashboard</span>

</a>
<a href="/matakuliahmahasiswa"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('matakuliahmahasiswa') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-book"></i>
    <span>Matakuliah</span>

</a>
        <a href="/krsmahasiswa"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('krsmahasiswa') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-list-check"></i>
    <span>KRS</span>

</a>
        <a href="/khsmahasiswa"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('khsmahasiswa') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-chart-bar"></i>
    <span>KHS</span>

</a>

        <a href="/PengaturanAkunMahasiswa"
    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
{{ request()->is('PengaturanAkunMahasiswa') ? 'bg-[#2d3250] text-white font-semibold' : 'hover:bg-[#2d3250]' }}">

    <i class="fa-solid fa-user"></i>
    <span>Akun</span>

</a>
        <a href="/logout"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-500 transition">
            <i class="fa-solid fa-door-open"></i>
            <span>Keluar</span>
        </a>
    
</div>

@endif

    </div>
</div>
<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"></div>
<script>

</script>
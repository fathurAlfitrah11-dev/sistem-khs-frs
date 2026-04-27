<div class="w-64 h-screen bg-[#3b3f63] fixed left-0 top-0 flex flex-col">

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
        <a href="/logout"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-500 transition">
            <i class="fa-solid fa-door-open"></i>
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
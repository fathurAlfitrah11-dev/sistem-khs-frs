<div class="w-64 h-screen bg-[#3b3f63] fixed left-0 top-0 flex flex-col">

    <!-- LOGO -->
    <div class="p-6 text-xl font-bold border-b border-white/10">
        Smart Academyc System
    </div>

    <!-- MENU -->
    <div class="flex-1 p-4 space-y-2 text-sm">
        @if(Auth::user()->role == 'mahasiswa')
        <a href="/mahasiswa"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#2d3250] transition">
            Dashboard
        </a>

        <a href="/matakuliahmahasiswa"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#2d3250] transition">
            Matakuliah
        </a>
        <a href="/krsmahasiswa"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#2d3250] transition">
            KRS Tersimpan
        </a>
        <a href="/khsmahasiswa"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#2d3250] transition">
            KHS
        </a>
        <a href="/login"
            class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-[#2d3250] transition">
            Keluar
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
@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<div class="p-6">

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-sm text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 shadow-sm text-sm">
        {{ session('error') }}
    </div>
    @endif

    {{-- SEARCH + BUTTON --}}
    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="100">
        <div class="flex-1">
            <div class="flex items-center bg-white rounded px-3 py-2">
                <input type="text" id="searchInput" placeholder="Telusuri Nama atau Kode Mata Kuliah..."
                    class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h2 class="text-white text-3xl font-bold">Data Mata Kuliah</h2>
            <a href="https://polibatam.id/jadwalperkuliahansemestergenap2526" target="_blank"
                class="bg-green-500 hover:bg-green-400 text-white font-semibold px-4 py-2 rounded-lg text-sm shadow transition inline-flex items-center gap-2 self-start md:self-auto">
                <i class="fa-solid fa-calendar-days"></i> Jadwal Perkuliahan
            </a>
        </div>

        <div class="bg-white overflow-hidden rounded-2xl">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Kode</th>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Semester</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">SKS</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($matakuliah as $mk)
                    <tr
                        class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">
                        <td class="px-6 py-3 text-left whitespace-nowrap font-medium">{{ $mk->kode_mk }}</td>
                        <td class="px-6 py-3 text-left break-words">{{ $mk->nama_mk }}</td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">{{ $mk->semester}}</td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">{{ $mk->sks }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center">

                                <button type="button"
                                    onclick="openConfirm('{{ $mk->kode_mk }}', '{{ $mk->nama_mk }}', '{{ $mk->sks }}', '{{ $mk->kode_mk }}')"
                                    class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
                                    + Tambah Mata Kuliah
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-5 list-none">
            <div class="bg-white p-1 rounded-xl shadow-xs list-none">
                @if(method_exists($matakuliah, 'links'))
                <div class="laravel-pagination-container">
                    {{ $matakuliah->links() }}
                </div>
                @else
                <div class="flex space-x-1 text-xs font-semibold p-1">
                    <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">‹</button>
                    <button class="bg-blue-600 text-white px-3 py-1.5 rounded-lg">1</button>
                    <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">›</button>
                </div>
                @endif
            </div>
        </div>

    </div>

    {{-- CONFIRM MODAL --}}
    <div id="confirmModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div
            class="bg-[#5a5f86] w-full max-w-md rounded-xl p-6 text-white shadow-lg modal-content transform opacity-0 translate-y-10 transition-all duration-300">

            <h2 class="text-lg font-bold mb-4 text-center">Konfirmasi Mata Kuliah</h2>

            <div class="bg-[#4d5275] p-4 rounded-lg mb-4 text-sm space-y-2 border border-white/10">
                <p><b>Kode:</b> <span id="c_kode"></span></p>
                <p><b>Nama:</b> <span id="c_nama"></span></p>
                <p><b>SKS:</b> <span id="c_sks"></span></p>
            </div>

            <p class="text-gray-200 text-xs text-center mb-5">
                Pastikan mata kuliah yang dipilih sudah benar sebelum disimpan ke KRS Anda.
            </p>

            <div class="flex justify-center gap-3">
                <button onclick="closeConfirm()"
                    class="bg-gray-300 hover:bg-gray-200 text-black px-4 py-1.5 rounded-lg text-sm font-medium transition">
                    Batal
                </button>
                <button onclick="submitKRS()"
                    class="bg-orange-400 hover:bg-orange-300 text-black px-4 py-1.5 rounded-lg text-sm font-semibold shadow transition">
                    Ya, Ambil
                </button>
            </div>

        </div>
    </div>
</div>

<style>
.laravel-pagination-container ul,
.laravel-pagination-container li {
    list-style-type: none !important;
    list-style: none !important;
}
</style>

<script>
let selectedMK = {};

// FITUR PENCARIAN
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        let kode = row.cells[0] ? row.cells[0].textContent.toLowerCase() : '';
        let namaMk = row.cells[1] ? row.cells[1].textContent.toLowerCase() : '';

        if (kode.includes(filter) || namaMk.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

// FUNGSI BUKA MODAL
function openConfirm(kode, nama, sks, id) {
    // Memasukkan data ke variabel global
    selectedMK = {
        kode: kode,
        nama: nama,
        sks: sks,
        id: id
    };

    document.getElementById('c_kode').innerText = kode;
    document.getElementById('c_nama').innerText = nama;
    document.getElementById('c_sks').innerText = sks;

    const modal = document.getElementById('confirmModal');
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

// FUNGSI TUTUP MODAL
function closeConfirm() {
    const modal = document.getElementById('confirmModal');
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', 'translate-y-10');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// FUNGSI SUBMIT FORM KE CONTROLLER
function submitKRS() {
    // Validasi pengaman untuk mendeteksi apakah ID kosong
    if (!selectedMK.id || selectedMK.id === 'undefined' || selectedMK.id.trim() === '') {
        alert('Gagal mengambil data! Nilai ID Mata Kuliah kosong atau tidak terbaca oleh JavaScript.');
        return;
    }

    let form = document.createElement('form');
    form.method = 'POST';
    form.action = '/mahasiswa/tambah-krs/' + selectedMK.id;

    let csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);

    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection
@extends('layout.app')

@section('title','Data Tahun Ajaran')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Tahun Ajaran</h1>

    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="200">

        <div class="flex-1 mr-4">
            <form action="{{ url('/tahun-ajaran') }}" method="GET">
                <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Telusuri Tahun Ajaran"
                        class="w-full outline-none text-sm text-gray-700">

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </button>
                </div>
            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Tahun Ajaran
        </button>
    </div>

    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-3xl font-bold mb-6">Data Tahun Ajaran</h2>

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">No</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Tahun Ajaran</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Semester</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Status</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $d)
                    <tr
                        class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">
                        <td class="px-8 py-3 text-left whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">{{ $d->tahun_awal }}/{{ $d->tahun_akhir }}
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">{{ $d->semester }}</td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            <a href="/tahun-ajaran/status/{{ $d->id_tahun_ajaran }}"
                                class="px-3 py-1 rounded text-white font-semibold transition text-xs
                            {{ $d->status == 'aktif' ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-500 hover:bg-gray-600' }}">
                                {{ $d->status == 'aktif' ? 'Aktif' : 'Non-aktif' }}
                            </a>
                        </td>

                        <td class="px-6 py-3">
                            <div class="flex justify-center gap-3">

                                {{-- VIEW --}}
                                <button data-tahun="{{ $d->tahun_awal }}/{{ $d->tahun_akhir }}"
                                    data-semester="{{ $d->semester }}" data-status="{{ $d->status }}" data-tanggal-mulai="{{ \Carbon\Carbon::parse($d->tanggal_mulai)->format('Y-m-d') }}" data-tanggal-selesai="{{ \Carbon\Carbon::parse($d->tanggal_selesai)->format('Y-m-d') }}"
                                    onclick="openDetail(this)"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>
                                </button>

                                {{-- EDIT --}}
                                <button data-id="{{ $d->id_tahun_ajaran }}"
                                    data-tahun="{{ $d->tahun_awal }}/{{ $d->tahun_akhir }}"
                                    data-semester="{{ $d->semester }}" data-status="{{ $d->status }}" data-tanggal-mulai="{{ \Carbon\Carbon::parse($d->tanggal_mulai)->format('Y-m-d') }}" data-tanggal-selesai="{{ \Carbon\Carbon::parse($d->tanggal_selesai)->format('Y-m-d') }}"
                                    onclick="openEdit(this)"
                                    class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/tahun-ajaran/delete/{{ $d->id_tahun_ajaran }}"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">
                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 text-sm">Data Tahun Ajaran tidak
                            ditemukan</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-5">
                    {{ $data->appends(request()->query())->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div
        class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="mb-4 font-bold">Tambah Tahun Ajaran</h2>
        <form action="/tahun-ajaran/store" method="POST">
            @csrf
           <label class="block text-sm mb-1">Tahun Ajaran</label>
<input
    type="text"
    id="tahun_ajaran"
    class="w-full mb-3 px-3 py-2 text-black bg-gray-100 rounded"
    readonly
>

            <label class="block text-sm mb-1">Semester</label>
            <select name="semester" class="w-full mb-3 px-3 py-2 text-black rounded">
                <option value="ganjil">Ganjil</option>
                <option value="genap">Genap</option>
            </select>
             @error('semester','tambah')
             <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="w-full mb-3 px-3 py-2 text-black rounded" required>

            <label class="block text-sm mb-1">Tanggal Selesai</label>
            <input
    type="text"
    id="tanggal_selesai"
    class="w-full mb-3 px-3 py-2 rounded text-black bg-gray-100"
    readonly
>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')"
                    class="bg-gray-300 px-3 py-1 rounded text-black">Batal</button>
                <button class="bg-blue-600 px-3 py-1 rounded" type="submit">Simpan</button>
            </div>
        </form>
    </div>

</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div
        class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="mb-4 font-bold">Ubah Tahun Ajaran</h2>

        <form id="formEdit" method="POST">
            @csrf
            <label class="block text-sm mb-1">Tahun Ajaran</label>

<input
    type="text"
    id="editTahunAjaran"
    class="w-full mb-3 px-3 py-2 text-black bg-gray-100 rounded"
    readonly
>

            <label class="block text-sm mb-1">Semester</label>
            <select name="semester" id="editSemester" class="w-full mb-3 px-3 py-2 text-black rounded">
                <option value="ganjil">Ganjil</option>
                <option value="genap">Genap</option>
            </select>
             @error('semester','edit')
             <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="editTanggalMulai" class="w-full mb-3 px-3 py-2 text-black rounded" required>

            <label class="block text-sm mb-1">Tanggal Selesai</label>
            <input
    type="text"
    id="editTanggalSelesai"
    class="w-full mb-3 px-3 py-2 text-black bg-gray-100 rounded"
    readonly>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')"
                    class="bg-gray-300 px-3 py-1 rounded text-black">Tutup</button>
                <button class="bg-yellow-500 text-white px-3 py-1 rounded" type="submit">Ubah</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div
        class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="mb-4 font-bold">Detail Tahun Ajaran</h2>
        <div class="space-y-3">
            <label class="text-sm">Tahun Awal</label>
            <p id="dTahunAwal" class="bg-white text-black px-3 py-2 rounded"></p>
            <label class="text-sm">Tahun Akhir</label>
            <p id="dTahunAkhir" class="bg-white text-black px-3 py-2 rounded"></p>
            <label class="text-sm">Semester</label>
            <p id="dSemester" class="bg-white text-black px-3 py-2 rounded"></p>
            <label class="text-sm">Status</label>
            <p id="dStatus" class="bg-white text-black px-3 py-2 rounded"></p>
        </div>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">Tutup</button>
        </div>

    </div>
</div>

<style>
/* Mengamankan agar bullet points bawaan pagination tidak muncul menjadi titik putih */
.laravel-pagination-container ul,
.laravel-pagination-container li {
    list-style-type: none !important;
    list-style: none !important;
}
</style>

<script>
function showModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function hideModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', 'translate-y-10');

    setTimeout(() => modal.classList.add('hidden'), 300);
}

function openModal(id) {
    showModal(id);

    if (id === 'tambahModal') {
        setTimeout(() => hitungOtomatis(), 200);
    }
}

function closeModal(id) {
    hideModal(id);
}

// HITUNG OTOMATIS TAHUN AJARAN DAN TANGGAL SELESAI

function hitungOtomatis() {
    const modal = document.getElementById('tambahModal');

    const semester = modal.querySelector('select[name="semester"]')?.value;
    const tanggalMulai = modal.querySelector('input[name="tanggal_mulai"]')?.value;

    if (!semester || !tanggalMulai) return;

    const year = parseInt(tanggalMulai.substring(0, 4));

    let tahunAwal, tahunAkhir, tanggalSelesai;

    if (semester === 'ganjil') {
        tahunAwal = year;
        tahunAkhir = year + 1;
        tanggalSelesai = `${tahunAkhir}-01-31`;
    } else {
        tahunAwal = year - 1;
        tahunAkhir = year;
        tanggalSelesai = `${tahunAkhir}-07-31`;
    }

    document.getElementById('tahun_ajaran').value = `${tahunAwal}/${tahunAkhir}`;
    document.getElementById('tanggal_selesai').value = tanggalSelesai;
}

// EVENT LISTENER

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('tambahModal');

    const semester = modal.querySelector('select[name="semester"]');
    const tanggal = modal.querySelector('input[name="tanggal_mulai"]');

    semester?.addEventListener('change', hitungOtomatis);
    tanggal?.addEventListener('change', hitungOtomatis);
    tanggal?.addEventListener('input', hitungOtomatis);
});

// EDIT MODAL

function openEdit(el) {
    openModal('editModal');

    const id = el.dataset.id;
    const semester = el.dataset.semester;
    const tanggalMulai = el.dataset.tanggalMulai;

    if (!tanggalMulai) return;

    // set action form (INI WAJIB)
    document.getElementById('formEdit').action = `/tahun-ajaran/update/${id}`;

    // set value form
    document.getElementById('editSemester').value = semester;
    document.getElementById('editTanggalMulai').value = tanggalMulai;

    const year = parseInt(tanggalMulai.split('-')[0]);

    let tahunAwal, tahunAkhir, tanggalSelesai;

    if (semester === 'ganjil') {
        tahunAwal = year;
        tahunAkhir = year + 1;
        tanggalSelesai = `${tahunAkhir}-01-31`;
    } else {
        tahunAwal = year - 1;
        tahunAkhir = year;
        tanggalSelesai = `${tahunAkhir}-07-31`;
    }

    document.getElementById('editTahunAjaran').value = `${tahunAwal}/${tahunAkhir}`;
    document.getElementById('editTanggalSelesai').value = tanggalSelesai;
}

// DETAIL

function openDetail(el) {
    openModal('detailModal');

    const tahun = el.dataset.tahun.split('/');

    document.getElementById('dTahunAwal').innerText = tahun[0];
    document.getElementById('dTahunAkhir').innerText = tahun[1];
    document.getElementById('dSemester').innerText = el.dataset.semester;
    document.getElementById('dStatus').innerText =
        el.dataset.status === 'aktif' ? 'Aktif' : 'Non-aktif';
}
</script>

@endsection
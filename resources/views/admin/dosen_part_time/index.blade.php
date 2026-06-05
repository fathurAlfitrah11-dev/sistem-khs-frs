@extends('layout.app')

@section('title','Data Dosen Part Time')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Dosen Part Time</h1>

    <div class="bg-[#4f547d] p-4 rounded-xl flex justify-between items-center mb-6 shadow-sm" data-aos="fade-up"
        data-aos-delay="200">

        <div class="flex-1 mr-4">
            <form action="{{ url('/dosen_part_time') }}" method="GET" class="w-full">
                <div class="flex items-center bg-white rounded-lg px-3 py-2 w-full shadow-inner">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Telusuri Dosen Part Time..."
                        class="w-full outline-none text-sm text-gray-700 placeholder-gray-400 bg-transparent">

                    <button type="submit" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-bold px-5 py-2 rounded-lg text-sm transition shadow-sm active:scale-95">
            + Tambah Dosen
        </button>
    </div>

    {{-- KONTEN UTAMA TABEL --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-3xl font-bold mb-6">
            Data Dosen Part Time
        </h2>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-[#243b63] font-bold text-sm">
                            NIK
                        </th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Nama Dosen
                        </th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Kode Dosen
                        </th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                    <tr class="border-b border-gray-100 hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm whitespace-nowrap">
                            {{ $d->nik }}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center break-words">
                            {{ $d->user->name }}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $d->kode_dosen }}
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-3">
                                {{-- DETAIL --}}
                                <button
                                    onclick="openDetail('{{ $d->nik }}','{{ $d->user->name }}','{{ $d->kode_dosen }}','{{ $d->tempat_part_time }}')"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition"
                                    title="Detail">
                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>
                                </button>

                                {{-- EDIT --}}
                                <button
                                    onclick="openEdit('{{ $d->id_dosen_part_time }}','{{ $d->nik }}','{{ $d->user->name }}','{{ $d->kode_dosen }}','{{ $d->tempat_part_time }}')"
                                    class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition"
                                    title="Ubah">
                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/dosen_part_time/delete/{{ $d->id_dosen_part_time }}"
                                    onclick="return confirm('Yakin hapus?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex"
                                    title="Hapus">
                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-10 text-center text-gray-500 text-sm">
                            <div class="flex flex-col items-center justify-center gap-1">
                                <span>Data dosen part time tidak ditemukan</span>
                                @if(request('search'))
                                <span>untuk pencarian "<strong>{{ request('search') }}</strong>"</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-5">
            <div class="bg-white p-1 rounded-xl shadow-xs">
                @if(method_exists($data, 'links'))
                {{ $data->appends(request()->query())->links() }}
                @else
                {{-- Navigasi fallback manual bawaan jika tidak memakai objek panjang otomatis --}}
                <div class="flex space-x-1 text-xs font-semibold p-1">
                    <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">‹</button>
                    <button class="bg-blue-600 text-white px-3 py-1.5 rounded-lg">1</button>
                    <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">2</button>
                    <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">›</button>
                </div>
                @endif
            </div>
        </div>

    </div>

</div>

{{-- TAMBAH MODAL --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div
        class="modal-content bg-[#3b3f63] w-full max-w-xl rounded-2xl p-6 text-white relative transform opacity-0 translate-y-10 transition-all duration-300 shadow-2xl">
        <h2 class="text-base font-bold mb-4 border-b border-white/10 pb-2">Tambah Dosen Part Time</h2>

        <form action="/dosen_part_time/store" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">NIK</label>
                <input type="text" name="nik" placeholder="NIK" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Nama Dosen</label>
                <input type="text" name="nama_dosen" placeholder="Nama Dosen" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Kode Dosen</label>
                <input type="text" name="kode_dosen" placeholder="Kode Dosen" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Password</label>
                <input type="password" name="password" placeholder="Password" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Tempat Part Time</label>
                <input type="text" name="tempat_part_time" placeholder="Tempat Part Time" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-white/10">
                <button type="button" onclick="closeModal('tambahModal')"
                    class="bg-slate-500/40 hover:bg-slate-500/60 px-4 py-2 rounded-lg text-xs font-bold transition">
                    Batal
                </button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div
        class="modal-content bg-[#3b3f63] w-full max-w-xl rounded-2xl p-6 text-white relative transform opacity-0 translate-y-10 transition-all duration-300 shadow-2xl">
        <h2 class="text-base font-bold mb-4 border-b border-white/10 pb-2">Ubah Data Pengajar</h2>

        <form id="formEdit" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">NIK</label>
                <input type="text" id="editNik" readonly
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg bg-slate-100 text-gray-500 text-sm font-bold outline-none cursor-not-allowed">
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Kode Dosen</label>
                <input type="text" name="kode_dosen" id="editKode" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Nama Dosen Part Time</label>
                <input type="text" name="nama_dosen" id="editNama" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Tempat Part Time</label>
                <input type="text" name="tempat_part_time" id="editTempat" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-black text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-white/10">
                <button type="button" onclick="closeModal('editModal')"
                    class="bg-slate-500/40 hover:bg-slate-500/60 px-4 py-2 rounded-lg text-xs font-bold transition">
                    Batal
                </button>
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-md">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- DETAIL MODAL --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div
        class="modal-content bg-[#3b3f63] w-full max-w-md rounded-2xl p-6 text-white relative transform opacity-0 translate-y-10 transition-all duration-300 shadow-2xl">
        <h2 class="text-base font-bold mb-4 border-b border-white/10 pb-2">Detail Informasi Pengajar</h2>

        <div class="space-y-4">
            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">NIK</label>
                <p id="detailNik" class="bg-white text-gray-800 px-3 py-2 rounded-lg font-bold text-sm shadow-xs"></p>
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Nama Dosen Part Time</label>
                <p id="detailNama" class="bg-white text-gray-800 px-3 py-2 rounded-lg font-semibold text-sm shadow-xs">
                </p>
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Kode Dosen</label>
                <p id="detailKode"
                    class="bg-white text-gray-800 px-3 py-1.5 rounded-lg font-bold text-xs shadow-xs inline-block min-w-[50px] text-center border border-slate-200">
                </p>
            </div>

            <div>
                <label class="text-xs font-semibold text-slate-300 block mb-1">Tempat Part Time</label>
                <p id="detailTempat" class="bg-white text-gray-800 px-3 py-2 rounded-lg font-medium text-sm shadow-xs">
                </p>
            </div>
        </div>

        <div class="flex justify-end mt-6 pt-2 border-t border-white/10">
            <button onclick="closeModal('detailModal')"
                class="bg-white hover:bg-slate-100 text-gray-800 px-4 py-2 rounded-lg text-xs font-bold transition shadow-xs">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
// ===== MODAL ANIMATION SYSTEM =====
function showModal(id) {
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')
    modal.classList.remove('hidden')
    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10')
        content.classList.add('opacity-100', 'translate-y-0')
    }, 15)
}

function hideModal(id) {
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')
    content.classList.remove('opacity-100', 'translate-y-0')
    content.classList.add('opacity-0', 'translate-y-10')
    setTimeout(() => {
        modal.classList.add('hidden')
    }, 250)
}

// ===== OPEN CLOSE =====
function openModal(id) {
    showModal(id)
}

function closeModal(id) {
    hideModal(id)
}

// ===== DATA ACTION ASSIGNMENT =====
function openEdit(id, nik, nama, kode, tempat) {
    showModal('editModal')
    document.getElementById('editNik').value = nik
    document.getElementById('editNama').value = nama
    document.getElementById('editKode').value = kode
    document.getElementById('editTempat').value = tempat
    document.getElementById('formEdit').action = '/dosen_part_time/update/' + id
}

// ===== DETAIL =====
function openDetail(nik, nama, kode, tempat) {
    showModal('detailModal')
    document.getElementById('detailNik').innerText = nik
    document.getElementById('detailNama').innerText = nama
    document.getElementById('detailKode').innerText = kode
    document.getElementById('detailTempat').innerText = tempat
}
</script>

@endsection
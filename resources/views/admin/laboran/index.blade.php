@extends('layout.app')

@section('title','Data Laboran')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Laboran</h1>

    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="200">
        
        <div class="flex-1 mr-4">
            <form method="GET" action="/laboran" class="w-full">
                <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Telusuri Laboran"
                        class="w-full outline-none text-sm text-gray-700">

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </button>
                </div>
            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Laboran
        </button>
    </div>

    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-white text-3xl font-bold">
                Data Laboran
            </h2>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-8 py-4 text-left text-[#243b63] font-bold text-xs md:text-sm">
                            NIK
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">
                            Nama Laboran
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">
                            Kode Laboran
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $d)

                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">

                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm whitespace-nowrap">
                            {{ $d->nik }}
                        </td>

                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center break-words">
                            {{ $d->user->name }}
                        </td>

                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $d->kode_laboran }}
                        </td>

                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-3">

                                {{-- DETAIL --}}
                                <button
                                    onclick="openDetail('{{ $d->nik }}','{{ $d->user->name }}','{{ $d->kode_laboran }}')"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">

                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>

                                </button>

                                {{-- EDIT --}}
                                <button
                                    onclick="openEdit('{{ $d->id_laboran }}','{{ $d->nik }}','{{ $d->user->name }}','{{ $d->kode_laboran }}')"
                                    class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">

                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>

                                </button>

                                {{-- DELETE --}}
                                <a href="/laboran/delete/{{ $d->id_laboran }}" onclick="return confirm('Yakin hapus?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">

                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="py-10 text-center text-gray-500 text-sm">

                            Data laboran tidak ditemukan

                            @if(request('search'))
                            untuk pencarian
                            "<strong>{{ request('search') }}</strong>"
                            @endif

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

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Laboran</h2>

        <form action="/laboran/store" method="POST">
            @csrf

            <label class="block text-sm mb-1">NIK</label>
            <input type="text" name="nik" placeholder="NIK" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Nama Laboran</label>
            <input type="text" name="nama_laboran" placeholder="Nama Laboran" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Kode Laboran</label>
            <input type="text" name="kode_laboran" placeholder="Kode Laboran" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password" placeholder="Password" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')" class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4">Ubah Laboran</h2>

        <form id="formEdit" method="POST">
            @csrf

            <label class="block text-sm mb-1">NIK</label>
            <input type="text" id="editNik" readonly class="w-full mb-3 px-3 py-2 border rounded text-black bg-gray-100 cursor-not-allowed">

            <label class="block text-sm mb-1">Nama Laboran</label>
            <input type="text" name="nama_laboran" id="editNama" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Kode Laboran</label>
            <input type="text" name="kode_laboran" id="editKode" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Password Baru</label>
            <input type="password" name="password" id="editPassword" placeholder="Kosongkan jika tidak ingin mengubah" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')" class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>
                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4">Detail Laboran</h2>

        <div class="space-y-3">
            <div>
                <label class="text-sm">NIK</label>
                <p id="detailNik" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Nama Laboran</label>
                <p id="detailNama" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
        </div>

        <label class="text-sm mb-1 block mt-3">Kode Laboran</label>
        <p id="detailKode" class="bg-white text-black px-3 py-2 rounded"></p>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
// ===== MODAL ANIMATION =====
function showModal(id) {
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    modal.classList.remove('hidden')

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10')
        content.classList.add('opacity-100', 'translate-y-0')
    }, 10)
}

function hideModal(id) {
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    content.classList.remove('opacity-100', 'translate-y-0')
    content.classList.add('opacity-0', 'translate-y-10')

    setTimeout(() => {
        modal.classList.add('hidden')
    }, 300)
}

// ===== OPEN CLOSE =====
function openModal(id) {
    showModal(id)
}

function closeModal(id) {
    hideModal(id)
}

// ===== EDIT =====
function openEdit(id, nik, nama, kode) {
    showModal('editModal')

    document.getElementById('editNik').value = nik
    document.getElementById('editNama').value = nama
    document.getElementById('editKode').value = kode

    // reset password
    document.getElementById('editPassword').value = ''

    document.getElementById('formEdit').action = '/laboran/update/' + id
}

// ===== DETAIL =====
function openDetail(nik, nama, kode) {
    showModal('detailModal')

    document.getElementById('detailNik').innerText = nik
    document.getElementById('detailNama').innerText = nama
    document.getElementById('detailKode').innerText = kode
}
</script>

@endsection
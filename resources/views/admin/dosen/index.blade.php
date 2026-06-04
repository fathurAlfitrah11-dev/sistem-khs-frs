@extends('layout.app')

@section('title','Data Dosen')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Dosen</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="200">
        
         <div class="flex-1 mr-4">
            <form action="{{ url('/dosen-admin') }}" method="GET" class="w-full">
    <div class="flex items-center bg-white rounded px-3 py-2 w-full">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Telusuri Dosen"
            class="w-full outline-none text-sm text-gray-700">

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        </button>
    </div>
</form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Dosen
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">

            <h2 class="text-white text-xl font-bold mb-4">Data Dosen</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="text-black px-6 py-3">NIK</th>
                        <th class="text-black px-6 py-3">Nama Dosen</th>
                        <th class="text-black px-6 py-3">Kode Dosen</th>
                        <th class="text-black px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
    @forelse($data as $d)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-3 text-black">{{ $d->nik }}</td>
        <td class="px-6 py-3 text-black">{{ $d->user->name }}</td>
        <td class="px-6 py-3 text-black">{{ $d->kode_dosen }}</td>
        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

                <button onclick="openDetail('{{ $d->nik }}','{{ $d->user->name }}','{{ $d->kode_dosen }}')"
                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                    <i class="fa-solid fa-eye text-black"></i>
                </button>

                <button onclick="openEdit('{{ $d->id_dosen }}','{{ $d->nik }}','{{ $d->user->name }}','{{ $d->kode_dosen }}')"
                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                    <i class="fa-solid fa-pen text-black"></i>
                </button>

                <a href="/dosen/delete/{{ $d->id_dosen }}"
                    onclick="return confirm('Yakin hapus?')"
                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full inline-block">
                    <i class="fa-solid fa-trash text-black"></i>
                </a>

            </div>
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="4" class="py-8 text-center text-gray-500 font-medium">
            Data dosen tidak ditemukan
            @if(request('search'))
                untuk pencarian "<strong>{{ request('search') }}</strong>"
            @endif
        </td>
    </tr>
    @endforelse
</tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-4 space-x-2">
    {{ $data->appends(request()->query())->links() }}
</div>

    </div>
</div>

<div id="tambahModal"
class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Dosen</h2>

        <form action="/dosen/store" method="POST">
            @csrf
            <label class="text-sm mb-1 block">NIK</label>
            <input type="text" name="nik" placeholder="NIK"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Nama Dosen</label>
            <input type="text" name="nama_dosen" placeholder="Nama Dosen"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

                <label class="text-sm mb-1 block">Kode Dosen</label>
            <input type="text" name="kode_dosen" placeholder="Kode Dosen"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Password</label>
            <input type="password" name="password" placeholder="Password"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')"
                    class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>

                <button type="submit"
                    class="bg-blue-600 text-white px-3 py-1 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="editModal"
    class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Ubah Dosen</h2>

        <form id="formEdit" method="POST">
            @csrf
            <label class="text-sm mb-1 block">NIK</label>
            <input type="text" id="editNik" readonly
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Nama Dosen</label>
            <input type="text" name="nama_dosen" id="editNama"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Kode Dosen</label>
            <input type="text" name="kode_dosen" id="editKode"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Password Baru</label>
            <input type="password" name="password" id="editPassword" placeholder="Kosongkan jika tidak ingin mengubah" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')"
                    class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>

                <button type="submit"
                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<div id="detailModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Detail Dosen</h2>

        <div class="space-y-3">
            <div>
                <label class="text-sm">NIK</label>
                <p id="detailNik" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Nama Dosen</label>
                <p id="detailNama" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
        </div>

        <label class="text-sm mb-1 block mt-3">Kode Dosen</label>
        <p id="detailKode" class="bg-white text-black px-3 py-2 rounded"></p>
        
        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')"
                class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
// ===== MODAL ANIMATION =====
function showModal(id){
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    modal.classList.remove('hidden')

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10')
        content.classList.add('opacity-100', 'translate-y-0')
    }, 10)
}

function hideModal(id){
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    content.classList.remove('opacity-100', 'translate-y-0')
    content.classList.add('opacity-0', 'translate-y-10')

    setTimeout(() => {
        modal.classList.add('hidden')
    }, 300)
}

// ===== OPEN CLOSE =====
function openModal(id){
    showModal(id)
}

function closeModal(id){
    hideModal(id)
}

// ===== EDIT =====
function openEdit(id, nik, nama, kode){
    showModal('editModal')

    document.getElementById('editNik').value = nik
    document.getElementById('editNama').value = nama
    document.getElementById('editKode').value = kode

    // reset password
    document.getElementById('editPassword').value=''

    document.getElementById('formEdit').action='/dosen/update/'+id
}

// ===== DETAIL =====
function openDetail(nik, nama, kode){
    showModal('detailModal')

    document.getElementById('detailNik').innerText = nik
    document.getElementById('detailNama').innerText = nama
    document.getElementById('detailKode').innerText = kode
}
</script>

@endsection
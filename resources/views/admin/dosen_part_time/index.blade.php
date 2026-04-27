@extends('layout.app')

@section('title','Data Dosen Part Time')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Dosen Part Time</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="200">
        
        <div class="flex items-center bg-white rounded px-3 py-2 w-1/2">
            <input type="text" placeholder="Telusuri Dosen"
                class="w-full outline-none text-sm text-gray-700">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Dosen
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-xl font-bold mb-4">Data Dosen Part Time</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="text-left px-6 py-3">NIDK</th>
                        <th class="text-left px-6 py-3">Nama Dosen</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($data as $d)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $d->nidk }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->user->name }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- VIEW --}}
                                <button onclick="openDetail('{{ $d->nidk }}','{{ $d->user->name }}')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                {{-- EDIT --}}
                                <button onclick="openEdit('{{ $d->id }}','{{ $d->nidk }}','{{ $d->user->name }}')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-pen text-black"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/dosen_part_time/delete/{{ $d->id }}"
                                    onclick="return confirm('Yakin hapus?')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full inline-block">
                                    <i class="fa-solid fa-trash text-black"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-4 space-x-2">
            <button class="bg-orange-300 px-3 py-1 rounded">‹</button>
            <button class="bg-orange-300 px-3 py-1 rounded">1</button>
            <button class="bg-orange-300 px-3 py-1 rounded">2</button>
            <button class="bg-orange-300 px-3 py-1 rounded">3</button>
            <button class="bg-orange-300 px-3 py-1 rounded">›</button>
        </div>

    </div>
</div>

<div id="tambahModal"
class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Dosen</h2>

        <form action="/dosen_part_time/store" method="POST">
            @csrf
            <label class="text-sm mb-1 block">NIDK</label>
            <input type="text" name="nidk" placeholder="NIDK"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Nama Dosen</label>
            <input type="text" name="nama_dosen" placeholder="Nama Dosen"
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
            <label class="text-sm mb-1 block">NIDK</label>
            <input type="text" id="editNidk" readonly
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Nama Dosen</label>
            <input type="text" name="nama_dosen" id="editNama"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

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
                <label class="text-sm">NIDK</label>
                <p id="detailNidk" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Nama Dosen</label>
                <p id="detailNama" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
        </div>

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
function openEdit(id, nidk, nama){
    showModal('editModal')

    document.getElementById('editNidk').value = nidk
    document.getElementById('editNama').value = nama
    document.getElementById('formEdit').action = '/dosen_part_time/update/' + id
}

// ===== DETAIL =====
function openDetail(nidk, nama){
    showModal('detailModal')

    document.getElementById('detailNidk').innerText = nidk
    document.getElementById('detailNama').innerText = nama
}
</script>

@endsection
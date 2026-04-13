@extends('layout.app')

@section('title','Data Dosen')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Dosen</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6">
        
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

    <div class="bg-[#3b3f63] rounded-xl p-6">

        <h2 class="text-white text-xl font-bold mb-4">Data Dosen</h2>

        <div class="bg-white rounded-lg overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="text-left px-6 py-3">NIDN</th>
                        <th class="text-left px-6 py-3">Nama Dosen</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($data as $d)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $d->nidn }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->user->name }}</td>
                        <td class="px-6 py-3 text-center space-x-2">

                            <button onclick="openEdit('{{ $d->id }}','{{ $d->nidn }}','{{ $d->user->name }}')"
                                class="bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Ubah
                            </button>

                            <a href="/dosen/delete/{{ $d->id }}"
                                onclick="return confirm('Yakin hapus?')"
                                class="bg-orange-400 hover:bg-orange-300 p-2 rounded-full inline-block">
                                <i class="fa-solid fa-trash"></i>
                                Hapus
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
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

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative">
        <h2 class="text-lg font-bold mb-4">Tambah Dosen</h2>

        <form action="/dosen/store" method="POST">
            @csrf

            <input type="text" name="nidn" placeholder="NIDN"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <input type="text" name="nama_dosen" placeholder="Nama Dosen"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

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

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative">
        <h2 class="text-lg font-bold mb-4">Edit Dosen</h2>

        <form id="formEdit" method="POST">
            @csrf

            <input type="text" id="editNidn" readonly
                class="w-full mb-3 px-3 py-2 border rounded">

            <input type="text" name="nama_dosen" id="editNama"
                class="w-full mb-3 px-3 py-2 border rounded">

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

<script>
function openModal(id){
    document.getElementById(id).classList.remove('hidden')
}

function closeModal(id){
    document.getElementById(id).classList.add('hidden')
}

function openEdit(id, nidn, nama){
    document.getElementById('editModal').classList.remove('hidden')
    document.getElementById('editNidn').value = nidn
    document.getElementById('editNama').value = nama
    document.getElementById('formEdit').action = '/dosen/update/' + id
}
</script>

@endsection
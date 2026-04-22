@extends('layout.app')

@section('title','Data Pengajar')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Pengajar</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6">
        
        <div class="flex items-center bg-white rounded px-3 py-2 w-1/2">
            <input type="text" placeholder="Telusuri Pengajar"
                class="w-full outline-none text-sm text-gray-700">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Pengajar
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6">

        <h2 class="text-white text-xl font-bold mb-4">Data Pengajar</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left">Dosen</th>
                        <th class="px-6 py-3 text-left">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left">Kelas</th>
                        <th class="px-6 py-3 text-left">Semester</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    {{-- DATA STATIS --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">Dr. Andi</td>
                        <td class="px-6 py-3 text-black">Pemrograman Web</td>
                        <td class="px-6 py-3 text-black">IF-A</td>
                        <td class="px-6 py-3 text-black">3</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                <button onclick="openDetail('Dr. Andi','Pemrograman Web','IF-A','3')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                <button onclick="openEdit('1','Dr. Andi','Pemrograman Web','IF-A','3')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-pen text-black"></i>
                                </button>

                                <button class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-trash text-black"></i>
                                </button>

                            </div>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal"
class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white">
        <h2 class="text-lg font-bold mb-4">Tambah Pengajar</h2>

        <form>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen</option>
                <option value="1">Dr. Andi</option>
                <option value="2">Dr. Budi</option>
                <option value="3">Dr. Siti</option>
            </select>

            <input type="text" placeholder="Mata Kuliah"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <input type="text" placeholder="Kelas"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <input type="number" placeholder="Semester"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')"
                    class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>

                <button type="button"
                    class="bg-blue-600 text-white px-3 py-1 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white">

        <h2 class="text-lg font-bold mb-4">Edit Pengajar</h2>

        <form>
            <select id="editDosen"
    class="w-full mb-3 px-3 py-2 border rounded text-black">
    <option value="Dr. Andi">Dr. Andi</option>
    <option value="Dr. Budi">Dr. Budi</option>
    <option value="Dr. Siti">Dr. Siti</option>
</select>

            <input type="text" id="editMk"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <input type="text" id="editKelas"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <input type="number" id="editSemester"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')"
                    class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>

                <button type="button"
                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white">

        <h2 class="text-lg font-bold mb-4">Detail Pengajar</h2>

        <label class="text-sm mb-1 block">Dosen</label>
        <p id="detailDosen" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Mata Kuliah</label>
        <p id="detailMk" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Kelas</label>
        <p id="detailKelas" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Semester</label>
        <p id="detailSemester" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')"
                class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function openModal(id){
    document.getElementById(id).classList.remove('hidden')
}

function closeModal(id){
    document.getElementById(id).classList.add('hidden')
}

function openEdit(id, dosen, mk, kelas, semester){
    document.getElementById('editModal').classList.remove('hidden')
    document.getElementById('editDosen').value = dosen
    document.getElementById('editMk').value = mk
    document.getElementById('editKelas').value = kelas
    document.getElementById('editSemester').value = semester
}

function openDetail(dosen, mk, kelas, semester){
    document.getElementById('detailModal').classList.remove('hidden')
    document.getElementById('detailDosen').innerText = dosen
    document.getElementById('detailMk').innerText = mk
    document.getElementById('detailKelas').innerText = kelas
    document.getElementById('detailSemester').innerText = semester
}
</script>

@endsection
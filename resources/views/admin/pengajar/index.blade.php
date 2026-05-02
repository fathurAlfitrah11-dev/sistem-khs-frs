@extends('layout.app')

@section('title','Data Pengajar')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Pengajar</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="200">

     <div class="flex-1 mr-4">
            <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input type="text" placeholder="Telusuri Pengajar" class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Pengajar
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-xl font-bold mb-4">Data Pengajar</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left">Dosen</th>
                        <th class="px-6 py-3 text-left">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left">Kelas</th>
                        <th class="px-6 py-3 text-left">Tahun Ajaran</th>
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
                        <td class="px-6 py-3 text-black">2023/2024 - Ganjil</td>
                        <td class="px-6 py-3 text-black">3</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                <button
                                    onclick="openDetail('Dr. Andi','Pemrograman Web','IF-A','2023/2024 - Ganjil','3')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                <button
                                    onclick="openEdit('1','Dr. Andi','Pemrograman Web','IF-A','2023/2024 - Ganjil','3')"
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
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Pengajar</h2>

        <form>
            <label class="block text-sm mb-1">Dosen</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen</option>
                <option value="1">Dr. Andi</option>
                <option value="2">Dr. Budi</option>
                <option value="3">Dr. Siti</option>
            </select>

            <label class="block text-sm mb-1">Mata Kuliah</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Mata Kuliah</option>
                <option value="1">Pemrograman Web</option>
                <option value="2">Basis Data</option>
                <option value="3">Jaringan Komputer</option>
            </select>

            <label class="block text-sm mb-1">Kelas</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kelas</option>
                <option value="1">IF-A</option>
                <option value="2">IF-B</option>
                <option value="3">IF-C</option>
            </select>

            <label class="block text-sm mb-1">Tahun Ajaran</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Tahun Ajaran</option>
                <option value="1">2023/2024</option>
                <option value="2">2024/2025</option>
                <option value="3">2025/2026</option>
            </select>

            <label class="block text-sm mb-1">Semester</label>
            <input type="number" placeholder="Semester" class="w-full mb-3 px-3 py-2 border rounded text-black">


            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')" class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>

                <button type="button" class="bg-blue-600 text-white px-3 py-1 rounded">
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

        <h2 class="text-lg font-bold mb-4">Ubah Pengajar</h2>

        <form>
            <label class="block text-sm mb-1">Dosen</label>
            <select id="editDosen" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="Dr. Andi">Dr. Andi</option>
                <option value="Dr. Budi">Dr. Budi</option>
                <option value="Dr. Siti">Dr. Siti</option>
            </select>

            <label class="block text-sm mb-1">Mata Kuliah</label>
            <select id="editMk" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="Pemrograman Web">Pemrograman Web</option>
                <option value="Basis Data">Basis Data</option>
                <option value="Jaringan Komputer">Jaringan Komputer</option>
            </select>

            <label class="block text-sm mb-1">Kelas</label>
            <select id="editKelas" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="IF-A">IF-A</option>
                <option value="IF-B">IF-B</option>
                <option value="IF-C">IF-C</option>
            </select>
            <label class="block text-sm mb-1">Tahun Ajaran</label>
            <select id="editTahun" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Tahun Ajaran</option>
                <option value="2023/2024 - Ganjil">2023/2024 - Ganjil</option>
                <option value="2024/2025 - Genap">2024/2025 - Genap</option>
                <option value="2025/2026 - Ganjil">2025/2026 - Ganjil</option>
            </select>

            <label class="block text-sm mb-1">Semester</label>
            <input type="number" id="editSemester" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')" class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>

                <button type="button" class="bg-yellow-500 text-white px-3 py-1 rounded">
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

        <h2 class="text-lg font-bold mb-4">Detail Pengajar</h2>

        <label class="text-sm mb-1 block">Dosen</label>
        <p id="detailDosen" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Mata Kuliah</label>
        <p id="detailMk" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Kelas</label>
        <p id="detailKelas" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Tahun Ajaran</label>
        <p id="detailTahun" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Semester</label>
        <p id="detailSemester" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

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
function openEdit(id, dosen, mk, kelas, tahun, semester) {
    showModal('editModal')

    document.getElementById('editDosen').value = dosen
    document.getElementById('editMk').value = mk
    document.getElementById('editKelas').value = kelas
    document.getElementById('editTahun').value = tahun
    document.getElementById('editSemester').value = semester
}

// ===== DETAIL =====
function openDetail(dosen, mk, kelas, tahun, semester) {
    showModal('detailModal')

    document.getElementById('detailDosen').innerText = dosen
    document.getElementById('detailMk').innerText = mk
    document.getElementById('detailKelas').innerText = kelas
    document.getElementById('detailTahun').innerText = tahun
    document.getElementById('detailSemester').innerText = semester
}
</script>

@endsection
@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

    {{-- SEARCH + BUTTON --}}
    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="100">

        <div class="flex-1 mr-4">
            <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input type="text" placeholder="Telusuri Mata Kuliah" class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="200"> 

        <h2 class="text-white text-xl font-bold mb-4">Data Mata Kuliah</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>    
                        <th class="text-left px-6 py-3">Kode</th>
                        <th class="text-left px-6 py-3">Nama Mata Kuliah</th>
                        <th class="text-left px-6 py-3">Semester</th>
                        <th class="text-left px-6 py-3">SKS</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-3 text-black">IF101</td>
        <td class="px-6 py-3 text-black">Pemrograman Dasar</td>
        <td class="px-6 py-3 text-black">1</td>
        <td class="px-6 py-3 text-black">3</td>

        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

<button 
    onclick="openConfirm('IF101','Pemrograman Dasar',3)"
    class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
    + Tambah Mata Kuliah
</button>

            </div>
        </td>
    </tr>

    <tr class="hover:bg-gray-50">
        <td class="px-6 py-3 text-black">IF102</td>
        <td class="px-6 py-3 text-black">Struktur Data</td>
        <td class="px-6 py-3 text-black">2</td>
        <td class="px-6 py-3 text-black">4</td>

        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

<button 
    onclick="openConfirm('IF101','Pemrograman Dasar',3)"
    class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
    + Tambah Mata Kuliah
</button>
            </div>
        </td>
    </tr>
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
<div id="confirmModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#3b3f63] w-full max-w-md rounded-xl p-6 text-white shadow-lg">

        <h2 class="text-lg font-bold mb-4 text-center">Konfirmasi Mata Kuliah</h2>

        <div class="bg-[#4a4f73] p-4 rounded mb-4 text-sm">
            <p><b>Kode:</b> <span id="c_kode"></span></p>
            <p><b>Nama:</b> <span id="c_nama"></span></p>
            <p><b>SKS:</b> <span id="c_sks"></span></p>
        </div>

        <p class="text-gray-300 text-sm text-center mb-5">
            Pastikan mata kuliah yang dipilih sudah benar.
        </p>

        <div class="flex justify-center gap-3">

            <button onclick="closeConfirm()"
                class="bg-gray-400 hover:bg-gray-300 text-black px-4 py-2 rounded">
                Batal
            </button>

            <button onclick="submitKRS()"
                class="bg-orange-400 hover:bg-orange-300 text-black px-4 py-2 rounded font-semibold">
                Ya, Ambil
            </button>

        </div>

    </div>
</div>
</div>
<script>
let selectedMK = {}

function openConfirm(kode, nama, sks){
    selectedMK = {kode, nama, sks}

    document.getElementById('c_kode').innerText = kode
    document.getElementById('c_nama').innerText = nama
    document.getElementById('c_sks').innerText = sks

    document.getElementById('confirmModal').classList.remove('hidden')
}

function closeConfirm(){
    document.getElementById('confirmModal').classList.add('hidden')
}

function submitKRS(){
    alert("Berhasil ambil: " + selectedMK.nama) // dummy

    closeConfirm()
}
</script>
@endsection
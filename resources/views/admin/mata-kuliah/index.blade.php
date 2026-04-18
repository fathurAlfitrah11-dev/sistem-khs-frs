@extends('layout.app')

@section('title','Data Mata Kuliah')

@section('content')

@php
$data = [
(object)[
'id' => 1,
'kode_mk' => 'IF101',
'nama_mk' => 'Pemrograman Web',
'semester' => 1,
'prodi' => (object)['nama_prodi' => 'Informatika']
],
(object)[
'id' => 2,
'kode_mk' => 'IF102',
'nama_mk' => 'Basis Data',
'semester' => 2,
'prodi' => (object)['nama_prodi' => 'Informatika']
]
];
@endphp

<div class="p-6">

    {{-- SEARCH + BUTTON --}}
    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6">

        <div class="flex-1 mr-4">
            <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input type="text" placeholder="Telusuri Mata Kuliah" class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Mata Kuliah
        </button>
    </div>

    {{-- TABLE --}}
    <div class="bg-[#3b3f63] rounded-xl p-6">

        <h2 class="text-white text-xl font-bold mb-4">Data Mata Kuliah</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="text-left px-6 py-3">No</th>
                        <th class="text-left px-6 py-3">Kode</th>
                        <th class="text-left px-6 py-3">Nama Mata Kuliah</th>
                        <th class="text-left px-6 py-3">Prodi</th>
                        <th class="text-left px-6 py-3">Semester</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($data as $d)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->kode_mk }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->nama_mk }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->prodi->nama_prodi }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->semester }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- VIEW --}}
                                <button
                                    onclick="openDetail('{{ $d->nama_mk }}','{{ $d->kode_mk }}','{{ $d->semester }}')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                {{-- EDIT --}}
                                <button
                                    onclick="openEdit('{{ $d->id }}','{{ $d->nama_mk }}','{{ $d->kode_mk }}','{{ $d->semester }}')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-pen text-black"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="#" onclick="return confirm('Yakin hapus?')"
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

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white">
        <h2 class="text-lg font-bold mb-4">Tambah Mata Kuliah</h2>

        <form>
            <input type="text" placeholder="Kode MK" class="w-full mb-3 px-3 py-2 rounded text-black">
            <input type="text" placeholder="Nama MK" class="w-full mb-3 px-3 py-2 rounded text-black">
            <input type="number" placeholder="Semester" class="w-full mb-3 px-3 py-2 rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')"
                    class="bg-gray-300 px-3 py-1 rounded text-black">
                    Batal
                </button>
                <button class="bg-blue-600 px-3 py-1 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white">
        <h2 class="text-lg font-bold mb-4">Detail Mata Kuliah</h2>

        <div class="space-y-3">
            <p id="detailNama" class="bg-white text-black px-3 py-2 rounded"></p>
            <p id="detailKode" class="bg-white text-black px-3 py-2 rounded"></p>
            <p id="detailSemester" class="bg-white text-black px-3 py-2 rounded"></p>
        </div>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden')
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden')
}

function openDetail(nama, kode, semester) {
    document.getElementById('detailModal').classList.remove('hidden')
    document.getElementById('detailNama').innerText = "Nama: " + nama
    document.getElementById('detailKode').innerText = "Kode: " + kode
    document.getElementById('detailSemester').innerText = "Semester: " + semester
}
</script>

@endsection
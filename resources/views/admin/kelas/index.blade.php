@extends('layout.app')

@section('title','Data Kelas')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Kelas</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6">
        
        <div class="flex items-center bg-white rounded px-3 py-2 w-1/2">
            <input type="text" placeholder="Telusuri Kelas"
                class="w-full outline-none text-sm text-gray-700">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Kelas
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6">

        <h2 class="text-white text-xl font-bold mb-4">Data Kelas</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="text-left px-6 py-3">No</th>
                        <th class="text-left px-6 py-3">Nama Kelas</th>
                        <th class="text-center px-6 py-3">Dosen Wali</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($data as $d)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->prodi->nama_prodi }} - {{ $d->semester }}{{$d->nama_kelas}} {{ $d->kategori }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->dosen_wali }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- VIEW --}}
                                <button onclick="openDetail('{{ $d->nama_kelas }}', '{{ $d->semester }}', '{{ $d->id_prodi }}', 
                                '{{ $d->kategori }}', '{{ $d->dosen_wali }}')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                {{-- EDIT --}}
                                <button onclick="openEdit('{{ $d->id }}', '{{ $d->nama_kelas }}', '{{ $d->semester }}',
                                '{{ $d->id_prodi }}', '{{ $d->kategori }}', '{{ $d->dosen_wali }}')" 
                                class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-pen text-black"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/kelas/delete/{{ $d->id }}"
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

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative">
        <h2 class="text-lg font-bold mb-4">Tambah Kelas</h2>

        <form action="/kelas/store" method="POST">
            @csrf
            <label class="text-sm mb-1 block">Nama Kelas</label>
            <select name="nama_kelas" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kelas</option>
                <option value="A">Kelas A</option>
                <option value="B">Kelas B</option>
                <option value="C">Kelas C</option>
                <option value="D">Kelas D</option>
                <option value="E">Kelas E</option>
            </select>
            <label class="text-sm mb-1 block">Semester</label>
            <input type="number" name="semester" placeholder="Semester"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                @endforeach
            </select>

            <label class="text-sm mb-1 block">Kategori</label>
           <select name="kategori" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kategori</option>
                <option value="Pagi">Pagi</option>
                <option value="Malam">Malam</option>
            </select>

            <label class="text-sm mb-1 block">Dosen Wali</label>
            <select name="nidn_wali" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen Wali</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nidn }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

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
        <h2 class="text-lg font-bold mb-4">Ubah Kelas</h2>

        <form id="formEdit" method="POST">
            @csrf
            <label class="text-sm mb-1 block">Nama Kelas</label>
            <select name="nama_kelas" id="editNama" class="w-full mb-3 px-3 py-2 border rounded text-black">
                 <option value="A">Kelas A</option>
                <option value="B">Kelas B</option>
                <option value="C">Kelas C</option>
                <option value="D">Kelas D</option>
                <option value="E">Kelas E</option>
            </select>

            <label class="text-sm mb-1 block">Semester</label>
            <input type="number" name="semester" id="editSemester"
                class="w-full mb-3 px-3 py-2 border rounded text-black" min="1" max="8">

                <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" id="editProdi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                @endforeach
            </select>

            <label class="text-sm mb-1 block">Kategori</label>
           <select name="kategori" id="editKategori" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="Pagi">Pagi</option>
                <option value="Malam">Malam</option>
            </select>

            <label class="text-sm mb-1 block">Dosen Wali</label>
            <select name="nidn_wali" id="editDosen" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen Wali</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nidn }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

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

    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white">
        <h2 class="text-lg font-bold mb-4">Detail Kelas</h2>

        <div class="space-y-3">
            <div>
                <label class="text-sm">Nama Kelas</label>
                <p id="detailNamaKelas" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Semester</label>
                <p id="detailSemester" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
            <div>
                <label class="text-sm">Program Studi</label>
                <p id="detailProdi" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
            <div>
                <label class="text-sm">Kategori</label>
                <p id="detailKategori" class="bg-white text-black px-3 py-2 rounded"></p>
        </div>
            <div>
                <label class="text-sm">Dosen Wali</label>
                <p id="detailDosenWali" class="bg-white text-black px-3 py-2 rounded"></p>
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
function openModal(id){
    document.getElementById(id).classList.remove('hidden')
}

function closeModal(id){
    document.getElementById(id).classList.add('hidden')
}

function openEdit(id, nama_kelas, semester, prodi, kategori, nidn_wali){
    document.getElementById('editModal').classList.remove('hidden')
    document.getElementById('editNama').value = nama_kelas
    document.getElementById('editSemester').value = semester
    document.getElementById('editProdi').value = prodi
    document.getElementById('editKategori').value = kategori
    document.getElementById('editDosen').value = nidn_wali
    document.getElementById('formEdit').action = '/kelas/update/' + id
}

function openDetail(nama_kelas, semester, prodi, kategori, dosen_wali){
    document.getElementById('detailModal').classList.remove('hidden')
    document.getElementById('detailNamaKelas').innerText = nama_kelas
    document.getElementById('detailSemester').innerText = semester
    document.getElementById('detailProdi').innerText = prodi
    document.getElementById('detailKategori').innerText = kategori
    document.getElementById('detailDosenWali').innerText = dosen_wali
}
</script>

@endsection
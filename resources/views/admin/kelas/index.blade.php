@extends('layout.app')

@section('title','Data Kelas')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Kelas</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="100">
        
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

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="200">

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
                        <td class="px-6 py-3 text-black">{{ $d->prodi->nama_prodi }}-{{ $d->semester }}{{$d->nama_kelas}} {{ $d->kategori }}</td>
                        <td class="px-6 py-3 text-black text-center">{{ $d->wali->user->name ?? '-' }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- VIEW --}}
                                <button onclick="openDetail(
                                '{{ $d->wali->user->name ?? '-' }}',
                                '{{ $d->prodi->nama_prodi }}',
                                '{{ $d->nama_kelas }}',
                                '{{ $d->semester }}',
                                '{{ $d->kategori }}'
                                )" class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                {{-- EDIT --}}
                                <button onclick="openEdit(
                                '{{ $d->id_kelas }}',
                                '{{ $d->nuptk_wali }}',
                                '{{ $d->id_prodi }}',
                                '{{ $d->nama_kelas }}',
                                '{{ $d->semester }}',
                                '{{ $d->kategori }}'
                                )" class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-pen text-black"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/kelas/delete/{{ $d->id_kelas }}"
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
class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 "data-aos="fade-up" data-aos-delay="100">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative
transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Kelas</h2>

        <form action="/kelas/store" method="POST">
            @csrf

            <label class="text-sm mb-1 block">Dosen Wali</label>
            <select name="nuptk_wali" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen Wali</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nuptk }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{ $p->nama_prodi }}</option>
                @endforeach
            </select>

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

            <label class="text-sm mb-1 block">Kategori</label>
           <select name="kategori" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kategori</option>
                <option value="Pagi">Pagi</option>
                <option value="Malam">Malam</option>
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
    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative
transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Ubah Kelas</h2>

        <form id="formEdit" method="POST">
            @csrf
             <label class="text-sm mb-1 block">Dosen Wali</label>
            <select name="nuptk_wali" id="editDosen" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen Wali</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nuptk }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" id="editProdi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{ $p->nama_prodi }}</option>
                @endforeach
            </select>
            
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

            <label class="text-sm mb-1 block">Kategori</label>
           <select name="kategori" id="editKategori" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="Pagi">Pagi</option>
                <option value="Malam">Malam</option>
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
    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white
transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Detail Kelas</h2>

        <div class="space-y-3">
            <div>
                <label class="text-sm">Dosen Wali</label>
                <p id="detailDosenWali" class="bg-white text-black px-3 py-2 rounded"></p>
        </div>

        <div>
                <label class="text-sm">Program Studi</label>
                <p id="detailProdi" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Nama Kelas</label>
                <p id="detailNamaKelas" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Semester</label>
                <p id="detailSemester" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
    
            <div>
                <label class="text-sm">Kategori</label>
                <p id="detailKategori" class="bg-white text-black px-3 py-2 rounded"></p>
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
    const modal = document.getElementById(id);
    const content = modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0','translate-y-10');
        content.classList.add('opacity-100','translate-y-0');
    }, 10);
}

function closeModal(id){
    const modal = document.getElementById(id);
    const content = modal.querySelector('div');

    content.classList.remove('opacity-100','translate-y-0');
    content.classList.add('opacity-0','translate-y-10');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function openEdit(id, nuptk_wali, prodi, nama_kelas, semester, kategori){
    const modal = document.getElementById('editModal');
    const content = modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0','translate-y-10');
        content.classList.add('opacity-100','translate-y-0');
    }, 10);

    document.getElementById('editDosen').value = nuptk_wali
    document.getElementById('editProdi').value = prodi
    document.getElementById('editNama').value = nama_kelas
    document.getElementById('editSemester').value = semester
    document.getElementById('editKategori').value = kategori
    document.getElementById('formEdit').action = '/kelas/update/' + id
}

function openDetail(dosen_wali, prodi, nama_kelas, semester, kategori){
    const modal = document.getElementById('detailModal');
    const content = modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0','translate-y-10');
        content.classList.add('opacity-100','translate-y-0');
    }, 10);
    document.getElementById('detailDosenWali').innerText = dosen_wali
    document.getElementById('detailProdi').innerText = prodi
    document.getElementById('detailNamaKelas').innerText = nama_kelas
    document.getElementById('detailSemester').innerText = semester
    document.getElementById('detailKategori').innerText = kategori
}
</script>

@endsection
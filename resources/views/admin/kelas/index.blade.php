@extends('layout.app')

@section('title','Data Kelas')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Kelas</h1>

    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="100">

       <div class="flex-1 mr-4">
            <form method="GET" action="/kelas">
                <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Telusuri Kelas"
                        class="w-full outline-none text-sm text-gray-700">

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </button>
                </div>
            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Kelas
        </button>
    </div>

    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-white text-3xl font-bold mb-6">Data Kelas</h2>

        <div class="bg-white rounded-2xl overflow-hidden">

         <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">No</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Nama Kelas</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Program Studi</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">
                        <td class="px-6 py-3 text-left whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-center break-words">
                            {{ $d->prodi->nama_prodi }}-{{ $d->semester }}{{$d->nama_kelas}} {{ $d->kategori }}</td>
                        <td class="px-6 py-3 text-center break-words">{{ $d->prodi->nama_prodi }}</td>

                        <td class="px-6 py-3">
                            <div class="flex justify-center gap-3">

                                {{-- VIEW --}}
                                <button onclick="openDetail(
                                '{{ $d->prodi->nama_prodi }}',
                                '{{ $d->nama_kelas }}',
                                '{{ $d->semester }}',
                                '{{ $d->kategori }}'
                                )" class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>
                                </button>

                                {{-- EDIT --}}
                                <button onclick="openEdit(
                                '{{ $d->id_kelas }}',
                                '{{ $d->id_prodi }}',
                                '{{ $d->nama_kelas }}',
                                '{{ $d->semester }}',
                                '{{ $d->kategori }}'
                                )" class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/kelas/delete/{{ $d->id_kelas }}" onclick="return confirm('Yakin hapus?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">
                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 text-sm">Data Kelas tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
         <div class="mt-4 flex justify-end">
             
                        {{ $data->appends(request()->query())->links() }}
                 
        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Kelas</h2>

        <form action="/kelas/store" method="POST">
            @csrf

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} - {{ $p->nama_prodi }}</option>
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

            <label class="text-sm mb-1 block">Kategori</label>
            <select name="kategori" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kategori</option>
                <option value="Pagi">Pagi</option>
                <option value="Malam">Malam</option>
            </select>
            
            <label class="text-sm mb-1 block">Semester</label>
            <input type="number" name="semester" placeholder="Semester"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
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
    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Ubah Kelas</h2>

        <form id="formEdit" method="POST">
            @csrf

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" id="editProdi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} - {{ $p->nama_prodi }}</option>
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
                <button type="button" onclick="closeModal('editModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                    Batal
                </button>

                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Ubah
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Detail Kelas</h2>

        <div class="space-y-3">

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
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function closeModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', 'translate-y-10');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function openEdit(id, prodi, nama_kelas, semester, kategori) {
    openModal('editModal');

    document.getElementById('editProdi').value = prodi
    document.getElementById('editNama').value = nama_kelas
    document.getElementById('editSemester').value = semester
    document.getElementById('editKategori').value = kategori
    document.getElementById('formEdit').action = '/kelas/update/' + id
}

function openDetail(prodi, nama_kelas, semester, kategori) {
    openModal('detailModal');
    
    document.getElementById('detailProdi').innerText = prodi
    document.getElementById('detailNamaKelas').innerText = nama_kelas
    document.getElementById('detailSemester').innerText = semester
    document.getElementById('detailKategori').innerText = kategori
}
</script>

@endsection
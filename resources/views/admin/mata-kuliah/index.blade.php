@extends('layout.app')

@section('title','Data Mata Kuliah')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">
        Data Mata Kuliah
    </h1>

    {{-- SEARCH + BUTTON --}}
    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="100">

        <div class="flex-1 mr-4">
            <form action="{{ url('/mata-kuliah') }}" method="GET">
                <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Telusuri Mata Kuliah"
                        class="w-full outline-none text-sm text-gray-700">

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </button>
                </div>
            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Mata Kuliah
        </button>
    </div>

    {{-- TABLE --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-white text-3xl font-bold mb-6">Data Mata Kuliah</h2>

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">No</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Kode</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Prodi</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Semester</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">SKS</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)

                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="px-7 py-3 text-gray-800 text-xs md:text-sm whitespace-nowrap text-left">
                            {{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $d->kode_mk }}</td>
                        <td class="px-6 py-3 text-gray-800 text-xs md:text-sm text-center break-words">{{ $d->nama_mk }}
                        </td>
                        <td class="px-6 py-3 text-gray-800 text-xs md:text-sm text-center break-words">
                            {{$d->prodi->jenjang}} {{ $d->prodi->nama_prodi }}</td>
                        <td class="px-6 py-3 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $d->semester }}</td>
                        <td class="px-6 py-3 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $d->sks }}</td>

                        <td class="px-6 py-3">
                            <div class="flex justify-center gap-3">

                                {{-- VIEW --}}
                                <button
                                    onclick="openDetail('{{ $d->prodi->nama_prodi }}','{{ $d->kode_mk }}','{{ $d->nama_mk }}','{{ $d->semester }}','{{ $d->sks }}')"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>
                                </button>

                                {{-- EDIT --}}
                                <button
                                    onclick="openEdit('{{ $d->kode_mk }}','{{ $d->id_prodi }}','{{ $d->nama_mk }}','{{ $d->semester }}','{{ $d->sks }}')"
                                    class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/mata-kuliah/delete/{{ $d->kode_mk }}" onclick="return confirm('Yakin hapus?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">
                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-gray-500 text-sm">Data Mata Kuliah tidak
                            ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-5">
            {{ $data->appends(request()->query())->links() }}
        </div>
    </div>
</div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div
        class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Mata Kuliah</h2>

        <form action="/mata-kuliah/store" method="POST">
            @csrf
            <label class="block text-sm mb-1">Program Studi</label>
            <select class="w-full mb-3 px-3 py-2 rounded text-black" name="id_prodi">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} {{ $p->nama_prodi }}</option>
                @endforeach
            </select>

            <label class="block text-sm mb-1">Kode Mata Kuliah</label>
            <input type="text" placeholder="Kode MK" name="kode_mk" class="w-full mb-3 px-3 py-2 rounded text-black">

            <label class="block text-sm mb-1">Nama Mata Kuliah</label>
            <input type="text" placeholder="Nama MK" name="nama_mk" class="w-full mb-3 px-3 py-2 rounded text-black">

            <label class="block text-sm mb-1">Semester</label>
            <input type="number" placeholder="Semester" name="semester"
                class="w-full mb-3 px-3 py-2 rounded text-black">

            <label class="block text-sm mb-1">SKS</label>
            <input type="number" placeholder="SKS" name="sks" class="w-full mb-3 px-3 py-2 rounded text-black" max="4"
                min="2">

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

    <div
        class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Detail Mata Kuliah</h2>

        <div class="space-y-3">
            <label class="block text-sm mb-1">Program Studi</label>
            <p id="detailProdi" class="bg-white text-black px-3 py-2 rounded"></p>

            <label class="block text-sm mb-1">Nama Mata Kuliah</label>
            <p id="detailNama" class="bg-white text-black px-3 py-2 rounded"></p>

            <label class="block text-sm mb-1">Kode Mata Kuliah</label>
            <p id="detailKode" class="bg-white text-black px-3 py-2 rounded"></p>

            <label class="block text-sm mb-1">Semester</label>
            <p id="detailSemester" class="bg-white text-black px-3 py-2 rounded"></p>

            <label class="block text-sm mb-1">SKS</label>
            <p id="detailSks" class="bg-white text-black px-3 py-2 rounded"></p>

        </div>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    @csrf
    <div
        class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Ubah Mata Kuliah</h2>

        <form id="formEdit" method="POST">
            @csrf
            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" id="editProdi" class="w-full mb-3 px-3 py-2 rounded text-black">
                <option value="">Pilih Program Studi</option>

                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} {{ $p->nama_prodi }}</option>
                @endforeach
            </select>
            @method('PUT')
            <label class="text-sm mb-1 block">Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" id="editKode" class="w-full mb-3 px-3 py-2 rounded text-black">

            <label class="text-sm mb-1 block">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" id="editNama" class="w-full mb-3 px-3 py-2 rounded text-black">

            <label class="text-sm mb-1 block">Semester</label>
            <input type="number" name="semester" id="editSemester" class="w-full mb-3 px-3 py-2 rounded text-black">

            <label class="text-sm mb-1 block">SKS</label>
            <input type="number" name="sks" id="editSks" class="w-full mb-3 px-3 py-2 rounded text-black" max="4"
                min="2">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')"
                    class="bg-gray-300 px-3 py-1 rounded text-black">
                    Batal
                </button>

                <button type="submit" class="bg-yellow-500 px-3 py-1 rounded text-white">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    modal.classList.remove('hidden')

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10')
        content.classList.add('opacity-100', 'translate-y-0')
    }, 10)
}

function closeModal(id) {
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    content.classList.remove('opacity-100', 'translate-y-0')
    content.classList.add('opacity-0', 'translate-y-10')

    setTimeout(() => {
        modal.classList.add('hidden')
    }, 300)
}

function openDetail(prodi, kode, nama, semester, sks) {
    openModal('detailModal')

    document.getElementById('detailProdi').innerText = prodi
    document.getElementById('detailKode').innerText = kode
    document.getElementById('detailNama').innerText = nama
    document.getElementById('detailSemester').innerText = semester
    document.getElementById('detailSks').innerText = sks
}

function openEdit(kode, prodi, nama, semester, sks) {
    openModal('editModal')

    document.getElementById('editKode').value = kode
    document.getElementById('editProdi').value = prodi
    document.getElementById('editNama').value = nama
    document.getElementById('editSemester').value = semester
    document.getElementById('editSks').value = sks

    document.getElementById('formEdit').action = '/mata-kuliah/update/' + kode
}
</script>

@endsection
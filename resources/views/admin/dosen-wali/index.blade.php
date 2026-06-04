@extends('layout.app')

@section('title','Data Dosen Wali')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Dosen Wali</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="200">
        <div class="flex-1 mr-4">

           <form action="/dosen-wali" method="GET" class="w-full">
    <div class="flex items-center bg-white rounded px-3 py-2">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Telusuri Dosen Wali"
            class="w-full outline-none text-sm text-gray-700">

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        </button>

    </div>
</form>

        </div>
            <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Dosen Wali
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-xl font-bold mb-4">Data Dosen Wali</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-black">NIK</th>
                        <th class="px-6 py-3 text-black">Nama Dosen</th>
                        <th class="px-6 py-3 text-black">Kelas</th>
                        <th class="px-6 py-3 text-black">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($kelasWali as $k)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $k->nik_wali }}</td>
                        <td class="px-6 py-3 text-black">{{ $k->wali->user->name ?? '-' }}</td>
                        <td class="px-6 py-3 text-black">{{$k->prodi->nama_prodi}} {{ $k->semester }}{{ $k->nama_kelas }} {{ $k->kategori }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                <button onclick="openDetail('{{$k->nik_wali}}','{{$k->wali->user->name}}','{{$k->prodi->nama_prodi}} {{$k->semester}}{{$k->nama_kelas}} {{$k->kategori}}','{{$k->prodi->nama_prodi}}')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                <button onclick="openEdit('{{$k->id_kelas}}','{{$k->nik_wali}}','{{$k->id_kelas}}')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-pen text-black"></i>
                                </button>

                                <a href="/dosen-wali/delete/{{ $k->id_kelas }}" onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-trash text-black"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                     <tr>
                        <td colspan="4" class="py-10 text-center text-gray-500 font-medium">
                            Data dosen wali tidak ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
            
        </div>
        <div class="mt-4 flex justify-end">
    {{ $kelasWali->appends(request()->query())->links() }}
</div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Dosen Wali</h2>

        <form action="/dosen-wali/store" method="POST">
            @csrf
            <label class="block text-sm mb-1">Dosen</label>
            <select name="nik_wali" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen</option>
               @foreach($dosen as $d)

                @if(!in_array($d->nik, $dosenWali))
                <option value="{{ $d->nik }}">
                    {{ $d->user->name }}
                </option>
                @endif
            @endforeach
            </select>

            <label class="block text-sm mb-1">Kelas</label>
            <select name="id_kelas" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kelas</option>
                @foreach($allKelas as $kelasItem)
                <option value="{{ $kelasItem->id_kelas }}">{{ $kelasItem->prodi->nama_prodi ?? '-' }} {{ $kelasItem->semester }}{{ $kelasItem->nama_kelas }} {{ $kelasItem->kategori }}</option>
                @endforeach
            </select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')" class="bg-gray-300 px-3 py-1 rounded">
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

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4">Ubah Dosen Wali</h2>

        <form id="formEdit" method="POST">
            @csrf
            <label class="block text-sm mb-1">Dosen</label>
            <select name="nik_wali" id="editDosen" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nik }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm mb-1">Kelas</label>
           <select name="id_kelas" id="editKelas" class="w-full mb-3 px-3 py-2 border rounded text-black">
    <option value="">Pilih Kelas</option>
@foreach($allKelas as $kelasItem)
<option value="{{ $kelasItem->id_kelas }}">
    {{ $kelasItem->prodi->nama_prodi ?? '-' }} {{ $kelasItem->semester }}{{ $kelasItem->nama_kelas }} {{ $kelasItem->kategori }}
</option>
@endforeach
</select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')" class="bg-gray-300 px-3 py-1 rounded">
                    Batal
                </button>

                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded">
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

        <h2 class="text-lg font-bold mb-4">Detail Dosen Wali</h2>

        <label class="text-sm mb-1 block">NIK</label>
        <p id="detailNik" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Nama Dosen</label>
        <p id="detailNama" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Kelas</label>
        <p id="detailKelas" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Prodi</label>
        <p id="detailProdi" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
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

function openModal(id) {
    showModal(id)
}

function closeModal(id) {
    hideModal(id)
}

function openEdit(id, dosen, kelas) {
    showModal('editModal')

    document.getElementById('editDosen').value = dosen
    document.getElementById('editKelas').value = kelas
    document.getElementById('formEdit').action = '/dosen-wali/update/' + id
}

function openDetail(nik, nama, kelas, prodi) {
    showModal('detailModal')

    document.getElementById('detailNik').innerText = nik
    document.getElementById('detailNama').innerText = nama
    document.getElementById('detailKelas').innerText = kelas
    document.getElementById('detailProdi').innerText = prodi
}
</script>
@endsection
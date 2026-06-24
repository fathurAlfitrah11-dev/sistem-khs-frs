@extends('layout.app')

@section('title','Data KPS')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">
        Data KPS
    </h1>

    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="100">

        <div class="flex-1 mr-4">
            <form method="GET" action="/kps" class="flex-1">
                <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Prodi / KPS..."
                        class="w-full outline-none text-sm text-gray-700">

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </button>
                </div>
            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah KPS
        </button>
    </div>

    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-white text-3xl font-bold mb-6">Data KPS</h2>

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-4 py-4 text-left text-[#243b63] font-bold text-xs md:text-sm">No</th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">NIK</th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">Nama Dosen</th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">Kode Dosen</th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">Program Studi</th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-xs md:text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($prodiKps as $p)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4 text-gray-800 text-xs md:text-sm whitespace-nowrap text-left">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $p->kps->nik ?? '-'}}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center break-words">
                            {{ $p->kps->nama_dosen ?? '-'}}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $p->kps->kode_dosen ?? '-'}}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center break-words">
                            {{ $p->jenjang }} - {{ $p->nama_prodi }}
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-3">

                                {{-- VIEW --}}
                                <button
                                    onclick="openDetail('{{ $p->kps->nik ?? '-' }}','{{ $p->kps->nama_dosen ?? '-' }}','{{ $p->kps->kode_dosen ?? '-' }}','{{ $p->jenjang }} {{ $p->nama_prodi }}')"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>
                                </button>

                                {{-- EDIT --}}
                                <button
                                    onclick="openEdit('{{ $p->id_prodi }}', '{{ $p->kps->nik }}', '{{ $p->id_prodi }}')"
                                    class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/kps/delete/{{ $p->id_prodi }}" onclick="return confirm('Yakin hapus?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">
                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-gray-500 text-sm">
                            Data KPS tidak ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-5">
                {{ $prodiKps->appends(request()->query())->links() }}
        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 ">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah KPS</h2>

        <form action="/kps/store" method="POST">
            @csrf
            <label class="text-sm mb-1 block">Dosen</label>
            <select name="nik_kps" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen</option>
                @foreach($dosen as $d)

                @if(!in_array($d->nik, $DosenKps))

                <option value="{{ $d->nik }}">
                    {{ $d->user->name }}
                </option>

                @endif

                @endforeach
            </select>

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($allProdi as $p)
                <option value="{{ $p->id_prodi }}">{{ $p->jenjang }} {{ $p->nama_prodi }}</option>
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
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 ">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Ubah KPS</h2>

        <form id="formEdit" method="POST">
            @csrf

            <label class="text-sm mb-1 block">Dosen</label>
            <select name="nik_kps" id="editDosen" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Dosen</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nik }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="id_prodi" id="editProdi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($allProdi as $p)
                <option value="{{ $p->id_prodi }}">{{ $p->jenjang }} {{ $p->nama_prodi }}</option>
                @endforeach
            </select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')" class="bg-gray-300 px-3 py-1 rounded">
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
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 ">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Detail KPS</h2>

        <div class="space-y-3">
            <div>
                <label class="text-sm">NIK</label>
                <p id="detailNik" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
            <div>
                <label class="text-sm">Nama Dosen</label>
                <p id="detailNamaDosen" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
            <div>
                <label class="text-sm">Kode Dosen</label>
                <p id="detailKodeDosen" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
            <div>
                <label class="text-sm">Program Studi</label>
                <p id="detailNamaProdi" class="bg-white text-black px-3 py-2 rounded"></p>
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
function showAnimatedModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function hideAnimatedModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', 'translate-y-10');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function openModal(id) {
    showAnimatedModal(id);
}

function closeModal(id) {
    hideAnimatedModal(id);
}

function openEdit(id, dosen, id_prodi) {
    showAnimatedModal('editModal');
    document.getElementById('editDosen').value = dosen;
    document.getElementById('editProdi').value = id_prodi;
    document.getElementById('formEdit').action = '/kps/update/' + id;
}

function openDetail(nik, nama_dosen, kode_dosen, nama_prodi) {
    showAnimatedModal('detailModal');

    document.getElementById('detailNik').innerText = nik;
    document.getElementById('detailNamaDosen').innerText = nama_dosen;
    document.getElementById('detailKodeDosen').innerText = kode_dosen;
    document.getElementById('detailNamaProdi').innerText = nama_prodi;
}
</script>

@endsection
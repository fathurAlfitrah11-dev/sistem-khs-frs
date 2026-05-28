@extends('layout.app')

@section('title','Data KPS')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6"
        data-aos="fade-up" data-aos-delay="100">
        Data KPS
    </h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="100">

        <div class="flex-1 mr-4">
            <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input type="text" placeholder="Telusuri KPS" class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah KPS
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-white text-xl font-bold mb-4">Data KPS</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="text-black px-6 py-3">No</th>
                        <th class="text-black px-6 py-3">NIK</th>
                        <th class="text-black px-6 py-3">Nama Dosen</th>
                        <th class="text-black px-6 py-3">Kode Dosen</th>
                        <th class="text-black px-6 py-3">Program Studi</th>
                        <th class="text-black px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($prodiKps as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-black">{{ $p->kps->nik ?? '-'}}</td>
                        <td class="px-6 py-3 text-black">{{ $p->kps->nama_dosen ?? '-'}}</td>
                        <td class="px-6 py-3 text-black">{{ $p->kps->kode_dosen ?? '-'}}</td>
                        <td class="px-6 py-3 text-black">{{ $p->jenjang }} - {{ $p->nama_prodi }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- VIEW --}}
                               <button onclick="openDetail('{{ $p->kps->nik ?? '-' }}','{{ $p->kps->nama_dosen ?? '-' }}','{{ $p->kps->kode_dosen ?? '-' }}','{{ $p->jenjang }} {{ $p->nama_prodi }}')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                {{-- EDIT --}}
                                <button onclick="openEdit('{{ $p->id_prodi }}', '{{ $p->kps->nik }}', '{{ $p->id_prodi }}')"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">
                                    <i class="fa-solid fa-pen text-black"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/kps/delete/{{ $p->id_prodi }}" onclick="return confirm('Yakin hapus?')"
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

<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 ">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
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

<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 ">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
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
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 ">

    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white transform opacity-0 translate-y-10 transition-all duration-300">
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
    const content = modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function hideAnimatedModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('div');

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
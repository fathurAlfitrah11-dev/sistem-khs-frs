@extends('layout.app')

@section('title','Data Mahasiswa')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Mahasiswa</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="150">

        <div class="flex gap-3 flex-1 mr-4">

            {{-- Filter Prodi --}}
            <form method="GET" action="/mahasiswa">
                <select name="prodi" onchange="this.form.submit()"
                    class="px-3 py-2 rounded text-black">

                    <option value="">Semua Prodi</option>

                    @foreach($prodi as $p)
                        <option 
                            value="{{ $p->id_prodi }}"
                            {{ request('prodi') == $p->id_prodi ? 'selected' : '' }}>

                            {{ $p->nama_prodi }}

                        </option>
                    @endforeach

                </select>
            </form>

            {{-- Search --}}
            <form method="GET" action="/mahasiswa" class="flex-1 mr-4">
    <div class="flex items-center bg-white rounded px-3 py-2 w-full">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Telusuri Mahasiswa"
            class="w-full outline-none text-sm text-gray-700">

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        </button>
    </div>
</form>

        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Mahasiswa
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-xl font-bold mb-4">Data Mahasiswa</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="text-black px-6 py-3">NIM</th>
                        <th class="text-black px-6 py-3">Nama</th>
                        <th class="text-black px-6 py-3">Kelas</th>
                        <th class="text-black px-6 py-3">Program Studi</th>
                        <th class="text-black px-6 py-3">Angkatan</th>
                        <th class="text-black px-6 py-3">Aksi</th>
                    </tr>
                </thead>

               <tbody class="divide-y">
@forelse($data as $d)
<tr class="hover:bg-gray-50">

    <td class="px-6 py-3 text-black">{{ $d->nim }}</td>

    <td class="px-6 py-3 text-black">{{ $d->nama }}</td>

    <td class="px-6 py-3 text-black">
        {{$d->kelas->prodi->nama_prodi}} {{$d->kelas->semester}}{{ $d->kelas->nama_kelas ?? '-' }} {{$d->kelas->kategori ?? '-' }}
    </td>

    <td class="px-6 py-3 text-black">{{ $d->prodi->nama_prodi ?? '-' }}</td>

    <td class="px-6 py-3 text-black">{{ $d->angkatan }}</td>

    <td class="px-6 py-3 text-center">
        <div class="flex justify-center gap-2">

            {{-- DETAIL --}}
            <button
                onclick="openDetail(
                    '{{ $d->nim }}',
                    '{{ $d->nama }}',
                    '{{ $d->prodi->nama_prodi ?? '-' }}',
                    '{{ $d->angkatan }}',
                    '{{$d->kelas->prodi->nama_prodi ?? '-' }} {{$d->kelas->semester}}{{ $d->kelas->nama_kelas ?? '-' }} {{$d->kelas->kategori ?? '-' }}'
                )"
                class="w-8 h-8 bg-orange-400 p-2 rounded-full">

                <i class="fa-solid fa-eye text-black"></i>
            </button>

            {{-- EDIT --}}
            <button
                onclick="openEdit(
                    '{{ $d->id_mahasiswa }}',
                    '{{ $d->id_prodi }}',
                    '{{ $d->id_kelas }}',
                    '{{ $d->nim }}',
                    '{{ $d->nama }}',
                    '{{ $d->angkatan }}'
                )"
                class="w-8 h-8 bg-orange-400 p-2 rounded-full">

                <i class="fa-solid fa-pen text-black"></i>
            </button>

            {{-- DELETE --}}
            <a href="/mahasiswa/delete/{{ $d->id_mahasiswa }}"
                onclick="return confirm('Yakin hapus data?')"
                class="w-8 h-8 bg-orange-400 p-2 rounded-full inline-block">

                <i class="fa-solid fa-trash text-black"></i>
            </a>

        </div>
    </td>

</tr>
@empty
<tr>
    <td colspan="7" class="px-6 py-3 text-center text-gray-500">Data mahasiswa tidak ditemukan
        @if(request('search'))
            untuk pencarian "<strong>{{ request('search') }}</strong>"
        @endif
    </td>
</tr>
@endforelse
</tbody>

            </table>

        </div>
        <div class="flex justify-end mt-4 space-x-2">
    {{ $data->appends(request()->query())->links() }}
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div
        class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Mahasiswa</h2>

        <form action="/mahasiswa/store" method="POST">
            @csrf
            <label class="block text-sm mb-1">Program Studi</label>
            <select name="id_prodi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} - {{ $p->nama_prodi }}</option>
                @endforeach
            </select>

            <label class="block text-sm mb-1">Kelas</label>
            <select name="id_kelas" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">{{$k->prodi->nama_prodi}} {{$k->semester}}  {{ $k->nama_kelas }} {{$k->kategori}}</option>
                @endforeach
            </select>

            <label class="block text-sm mb-1">NIM</label>
            <input type="text" name="nim" placeholder="NIM" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Nama</label>
            <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 px-3 py-2 border rounded text-black">
            
            <label class="block text-sm mb-1">Angkatan</label>
            <input type="number" name="angkatan" placeholder="Angkatan" class="w-full mb-3 px-3 py-2 border rounded text-black">
            
            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password" placeholder="Password" class="w-full mb-3 px-3 py-2 border rounded text-black">

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
        class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4">Ubah Data Mahasiswa</h2>

        <form id="formEdit" method="POST">
            @csrf
            <label class="block text-sm mb-1">Program Studi</label>
            <select name="id_prodi" id="editProdi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} - {{ $p->nama_prodi }}</option>
                @endforeach
            </select>

             <label class="block text-sm mb-1">Kelas</label>
            <select id="editKelas" name="id_kelas" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">{{$k->prodi->nama_prodi}} {{$k->semester}}{{ $k->nama_kelas }} {{$k->kategori}}</option>
                @endforeach
            </select>
            <label class="block text-sm mb-1">NIM</label>
            <input type="text" id="editNim" name="nim" readonly class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Nama</label>
            <input type="text" id="editNama" name="nama" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Angkatan</label>
            <input type="number" id="editAngkatan" name="angkatan" class="w-full mb-3 px-3 py-2 border rounded text-black">

            <label class="block text-sm mb-1">Password Baru</label>
            <input type="password" id="editPassword" name="password" placeholder="Kosongkan jika tidak ingin mengubah" class="w-full mb-3 px-3 py-2 border rounded text-black">

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
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div
        class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4">Detail Mahasiswa</h2>
        <div class="space-y-3">

            <label class="text-sm">NIM</label>
            <p class="bg-white text-black px-3 py-2 rounded"><span id="detailNim"></span></p>
            <label class="text-sm">Nama</label>
            <p class="bg-white text-black px-3 py-2 rounded"><span id="detailNama"></span></p>
            <label class="text-sm">Program Studi</label>
            <p class="bg-white text-black px-3 py-2 rounded"><span id="detailProdi"></span></p>
            <label class="text-sm">Angkatan</label>
            <p class="bg-white text-black px-3 py-2 rounded"><span id="detailAngkatan"></span></p>
            <label class="text-sm">Kelas</label>
            <p class="bg-white text-black px-3 py-2 rounded"><span id="detailKelas"></span></p>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function showModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function hideModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('div');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', 'translate-y-10');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function openModal(id) {
    showModal(id);
}

function closeModal(id) {
    hideModal(id);
}

function openEdit(id, prodi, kelas, nim, nama, angkatan) {
    showModal('editModal');

    document.getElementById('editProdi').value = prodi;
    document.getElementById('editKelas').value = kelas;
    document.getElementById('editNim').value = nim;
    document.getElementById('editNama').value = nama;
    document.getElementById('editAngkatan').value = angkatan;

    document.getElementById('editPassword').value='';

    document.getElementById('formEdit').action =
        '/mahasiswa/update/' + id;
}

function openDetail(nim, nama, prodi, angkatan, kelas) {
    showModal('detailModal');

    document.getElementById('detailNim').innerText = nim;
    document.getElementById('detailNama').innerText = nama;
    document.getElementById('detailProdi').innerText = prodi;
    document.getElementById('detailAngkatan').innerText = angkatan;
    document.getElementById('detailKelas').innerText = kelas;
}
</script>

@endsection
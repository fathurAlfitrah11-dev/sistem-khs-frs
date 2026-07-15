@extends('layout.app')

@section('title','Data Mahasiswa')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Mahasiswa</h1>

    {{-- ===== FORM PENCARIAN & MULTI-FILTER DROPDOWN ===== --}}
    <div class="bg-[#4f547d] p-4 rounded-lg flex flex-col md:flex-row justify-between items-center gap-4 mb-6" data-aos="fade-up" data-aos-delay="150">

        <div class="flex-1 w-full">
            <form method="GET" action="/mahasiswa" class="flex flex-col sm:flex-row gap-3 w-full">
   
                <div class="flex items-center bg-white rounded px-3 py-2 flex-1 border border-gray-300">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Telusuri Mahasiswa"
                        class="w-full outline-none text-sm text-gray-700">

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </button>
                </div>

                <select name="prodi" onchange="this.form.submit()"
                    class="px-3 py-2 rounded text-black text-sm font-medium outline-none bg-white min-w-[180px] border border-gray-300 cursor-pointer">
                    <option value="">Semua Prodi</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->id_prodi }}" {{ request('prodi') == $p->id_prodi ? 'selected' : '' }}>
                            {{ $p->nama_prodi }}
                        </option>
                    @endforeach
                </select>

                <select name="angkatan" onchange="this.form.submit()"
                    class="px-3 py-2 rounded text-black text-sm font-medium outline-none bg-white min-w-[150px] border border-gray-300 cursor-pointer">
                    <option value="">Semua Angkatan</option>
                    @foreach($listAngkatan as $a)
                        <option value="{{ $a }}" {{ request('angkatan') == $a ? 'selected' : '' }}>
                            {{ $a }}
                        </option>
                    @endforeach
                </select>

            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg transition whitespace-nowrap">
            + Tambah Mahasiswa
        </button>
    </div>

    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-xl font-bold mb-6">Data Mahasiswa</h2>

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-12 py-3 text-left text-[#243b63] font-bold text-sm">NIM</th>
                        <th class="px-14 py-3 text-left text-[#243b63] font-bold text-sm">Nama</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Kelas</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Program Studi</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Angkatan</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">

                        <td class="px-6 py-3 text-left whitespace-nowrap font-medium">{{ $d->nim }}</td>

                        <td class="px-6 py-3 text-left break-words">{{ $d->nama }}</td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{$d->kelas->prodi->nama_prodi}} {{$d->kelas->semester}}{{ $d->kelas->nama_kelas ?? '-' }} {{$d->kelas->kategori ?? '-' }}
                        </td>

                        <td class="px-6 py-3 text-center break-words">{{ $d->prodi->nama_prodi ?? '-' }}</td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">{{ $d->angkatan }}</td>

                        <td class="px-6 py-3">
                            <div class="flex justify-center gap-3">

                                {{-- DETAIL --}}
                                <button
                                    onclick="openDetail(
                                        '{{ $d->nim }}',
                                        '{{ $d->nama }}',
                                        '{{ $d->prodi->nama_prodi ?? '-' }}',
                                        '{{ $d->angkatan }}',
                                        '{{$d->kelas->prodi->nama_prodi ?? '-' }} {{$d->kelas->semester}}{{ $d->kelas->nama_kelas ?? '-' }} {{$d->kelas->kategori ?? '-' }}'
                                    )"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>
                                </button>

                                {{-- EDIT --}}
                                <button
                                    onclick="openEdit(
                                        '{{ $d->nim }}',
                                        '{{ $d->id_prodi }}',
                                        '{{ $d->id_kelas }}',
                                        '{{ $d->nama }}',
                                        '{{ $d->angkatan }}'
                                    )"
                                    class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/mahasiswa/delete/{{ $d->nim }}"
                                    onclick="return confirm('Yakin hapus data?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">
                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>
                                </a>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 text-sm">Data mahasiswa tidak ditemukan
                            @if(request('search'))
                                untuk pencarian "<strong>{{ request('search') }}</strong>"
                            @endif
                        </td>
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

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Mahasiswa</h2>
        
        <form action="/mahasiswa/store" method="POST">
            @csrf
            <label class="block text-sm mb-1">Program Studi</label>
            <select name="id_prodi" onchange="filterKelasTambah()" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} - {{ $p->nama_prodi }}</option>
                @endforeach
            </select>
          
            @error('id_prodi','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Kelas</label>
            <select name="id_kelas" id="kelasTambah" class="w-full mb-3 px-3 py-2 border rounded text-black">
    <option value="">Isi Program Studi dan Angkatan terlebih dahulu</option>
</select>
        
            @error('id_kelas','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">NIM</label>
            <input type="text" name="nim" placeholder="NIM" class="w-full mb-3 px-3 py-2 border rounded text-black">
                @error('nim','tambah')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror

            <label class="block text-sm mb-1">Nama</label>
            <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 px-3 py-2 border rounded text-black">
            @error('nama','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Angkatan</label>
            <input
    type="number"
    id="angkatan"
    name="angkatan"
    oninput="filterKelasTambah()"
    placeholder="Angkatan"
    class="w-full mb-3 px-3 py-2 border rounded text-black">
            @error('angkatan','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password" placeholder="Password" class="w-full mb-3 px-3 py-2 border rounded text-black">
            @error('password','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

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

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4">Ubah Data Mahasiswa</h2>
      
        <form id="formEdit" method="POST">
            @csrf
            <label class="block text-sm mb-1">Program Studi</label>
            <select name="id_prodi" id="editProdi" onchange="filterKelasEdit()" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                @foreach($prodi as $p)
                <option value="{{ $p->id_prodi }}">{{$p->jenjang}} - {{ $p->nama_prodi }}</option>
                @endforeach
            </select>
            @error('id_prodi','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror
            
             <label class="block text-sm mb-1">Kelas</label>
           <select id="editKelas" name="id_kelas" class="w-full mb-3 px-3 py-2 border rounded text-black">
    <option value="">Isi Program Studi dan Angkatan terlebih dahulu</option>
</select>
            @error('id_kelas','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">NIM</label>
            <input type="text" id="editNim" name="nim" readonly class="w-full mb-3 px-3 py-2 border rounded text-black bg-gray-100">
            @error('nim','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Nama</label>
            <input type="text" id="editNama" name="nama" class="w-full mb-3 px-3 py-2 border rounded text-black">
            @error('nama','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Angkatan</label>
            <input type="number" 
       id="editAngkatan" 
       name="angkatan" 
       oninput="filterKelasEdit()"
       class="w-full mb-3 px-3 py-2 border rounded text-black">
            @error('angkatan','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Password Baru</label>
            <input type="password" id="editPassword" name="password" placeholder="Kosongkan jika tidak ingin mengubah" class="w-full mb-3 px-3 py-2 border rounded text-black">
            @error('password','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

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

        <h2 class="text-lg font-bold mb-4">Detail Mahasiswa</h2>
        <div class="space-y-3">
            <div>
                <label class="text-sm">NIM</label>
                <p class="bg-white text-black px-3 py-2 rounded"><span id="detailNim"></span></p>
            </div>
            <div>
                <label class="text-sm">Nama</label>
                <p class="bg-white text-black px-3 py-2 rounded"><span id="detailNama"></span></p>
            </div>
            <div>
                <label class="text-sm">Program Studi</label>
                <p class="bg-white text-black px-3 py-2 rounded"><span id="detailProdi"></span></p>
            </div>
            <div>
                <label class="text-sm">Angkatan</label>
                <p class="bg-white text-black px-3 py-2 rounded"><span id="detailAngkatan"></span></p>
            </div>
            <div>
                <label class="text-sm">Kelas</label>
                <p class="bg-white text-black px-3 py-2 rounded"><span id="detailKelas"></span></p>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
    /* Mengamankan agar bullet points bawaan pagination tidak muncul menjadi titik putih */
    .laravel-pagination-container ul, 
    .laravel-pagination-container li {
        list-style-type: none !important;
        list-style: none !important;
    }
</style>

<script>
const tahunAktif = {{ $tahunAktif->tahun_awal }};
const offset = {{ $tahunAktif->semester == 'ganjil' ? 1 : 2 }};
const semuaKelas = @json($kelas);

function showModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function hideModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

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

function openEdit(nim, prodi, kelas, nama, angkatan) {
    showModal('editModal');
    
    document.getElementById('editNim').value = nim;
    document.getElementById('editProdi').value = prodi;
    document.getElementById('editKelas').value = kelas;
    document.getElementById('editNama').value = nama;
    document.getElementById('editAngkatan').value = angkatan;

    document.getElementById('editPassword').value = '';

   filterKelasEdit();
   setTimeout(() => {
    document.getElementById('editKelas').value = kelas;
}, 100);
    
    document.getElementById('formEdit').action = '/mahasiswa/update/' + nim;
}

function openDetail(nim, nama, prodi, angkatan, kelas) {
    showModal('detailModal');

    document.getElementById('detailNim').innerText = nim;
    document.getElementById('detailNama').innerText = nama;
    document.getElementById('detailProdi').innerText = prodi;
    document.getElementById('detailAngkatan').innerText = angkatan;
    document.getElementById('detailKelas').innerText = kelas;
}
function hitungSemester(angkatan) {
    let selisih = tahunAktif - angkatan;
    if (selisih < 0) selisih = 0;
    return (selisih * 2) + offset;
}

function filterKelasTambah() {

    let angkatan = parseInt(document.getElementById('angkatan').value);
    let prodi = document.querySelector('[name="id_prodi"]').value;
    let select = document.getElementById('kelasTambah');

    select.innerHTML = '<option value="">Pilih Kelas</option>';

    if (isNaN(angkatan) || !prodi) {
        select.innerHTML = '<option value="">Isi Program Studi dan Angkatan terlebih dahulu</option>';
        return;
    }

    let semester = hitungSemester(angkatan);

    let ada = false;

    semuaKelas.forEach(k => {

        if (
            parseInt(k.semester) === semester &&
            k.id_prodi == prodi
        ) {

            ada = true;

            select.innerHTML += `
                <option value="${k.id_kelas}">
                    ${k.prodi.nama_prodi} ${k.semester}${k.nama_kelas} ${k.kategori}
                </option>
            `;
        }

    });

    if (!ada) {
        select.innerHTML = '<option value="">Tidak ada kelas untuk semester tersebut</option>';
    }
}

function filterKelasEdit() {

    let angkatan = parseInt(document.getElementById('editAngkatan').value);
    let prodi = document.getElementById('editProdi').value;
    let select = document.getElementById('editKelas');


    select.innerHTML = '<option value="">Pilih Kelas</option>';


    if (isNaN(angkatan) || !prodi) {

        select.innerHTML =
            '<option value="">Isi Program Studi dan Angkatan terlebih dahulu</option>';

        return;
    }


    let semester = hitungSemester(angkatan);

    let ada = false;


    semuaKelas.forEach(k => {

        if (
            parseInt(k.semester) === semester &&
            k.id_prodi == prodi
        ) {

            ada = true;

            select.innerHTML += `
                <option value="${k.id_kelas}">
                    ${k.prodi.nama_prodi} ${k.semester}${k.nama_kelas} ${k.kategori}
                </option>
            `;
        }

    });


    if (!ada) {

        select.innerHTML =
            '<option value="">Tidak ada kelas untuk semester tersebut</option>';

    }
}
</script>

@endsection
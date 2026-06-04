@extends('layout.app')

@section('title','Data Pengajar')

@section('content')

<div class="p-6">

    <div class="flex items-center gap-3 mb-6"
    data-aos="fade-up"
    data-aos-delay="100">

    <h1 class="text-2xl font-bold text-gray-800">
        Data Pengajar
    </h1>

    @php
        $aktif = collect($tahunAjaran)->where('status', 'aktif')->first();
    @endphp

   @if($aktif)
    <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full font-semibold">
        Tahun Ajaran Aktif :
        {{ $aktif->tahun_awal }}/{{ $aktif->tahun_akhir }}
        - {{ ucfirst($aktif->semester) }}
    </span>
@else
    <span class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full font-semibold">
        Belum ada tahun ajaran
    </span>
@endif

</div>
     
    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="200">

     <div class="flex-1 mr-4">
                <form method="GET" action="/pengajar" class="w-full">
    <input type="hidden" name="id_tahun_ajaran" value="{{ $idTahun }}">

     <div class="flex items-center bg-white rounded px-3 py-2 w-full">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari pengajar..."
            class="w-full outline-none text-sm text-gray-700">

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
        </button>
    </div>
</form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Pengajar
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">
        <div class="flex justify-between items-center mb-4 gap-4">
        <h2 class="text-white text-xl font-bold mb-4">Data Pengajar</h2>
        <form method="GET" action="/pengajar" class="mb-4">

    <select
        name="id_tahun_ajaran"
        onchange="this.form.submit()"
        class="px-3 py-2 rounded text-black">

        @if(count($tahunAjaran) > 0)
                @foreach($tahunAjaran as $ta)
                    <option value="{{ $ta->id_tahun_ajaran }}"
    {{ $idTahun == $ta->id_tahun_ajaran ? 'selected' : '' }}>
    {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}
    - {{ ucfirst($ta->semester) }}
</option>
                @endforeach
            @else
                <option disabled>Belum ada tahun ajaran</option>
            @endif

    </select>

</form>
        </div>
        <div class="bg-white overflow-hidden">

           <table class="w-full text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-black">Dosen</th>
                        <th class="px-6 py-3 text-black">Mata Kuliah</th>
                        <th class="px-6 py-3 text-black">Kelas</th>
                        <th class="px-6 py-3 text-black">Tahun Ajaran</th>
                        <th class="px-6 py-3 text-black">Semester</th>
                        <th class="px-6 py-3 text-black">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                   @forelse($data as $d)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $d->dosen->user->name }}</td>
                        <td class="px-6 py-3 text-black"> {{ $d->mataKuliah->nama_mk }} - {{ ucfirst($d->mataKuliah->jenis) }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->kelas->prodi->nama_prodi }} {{ $d->kelas->semester }}{{ $d->kelas->nama_kelas }} {{ $d->kelas->kategori }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->tahun->tahun_awal }} / {{ $d->tahun->tahun_akhir }} - {{ $d->tahun->semester }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->semester }}</td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                <button
                                    onclick="openDetail('{{ $d->dosen->user->name }}','{{ $d->mataKuliah->nama_mk }}','{{$d->kelas->prodi->nama_prodi}} {{ $d->kelas->semester }}{{ $d->kelas->nama_kelas }} {{ $d->kelas->kategori }}','{{ $d->tahun->tahun_awal }} / {{ $d->tahun->tahun_akhir }} - {{ $d->tahun->semester }}','{{ $d->semester }}')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-eye text-black"></i>
                                </button>

                                <button
                                        onclick="openEdit(
                                        '{{ $d->id_pengajar }}',
                                        '{{ $d->nik }}',
                                        '{{ $d->id_mata_kuliah }}',
                                        '{{ $d->kelas_id }}',
                                        '{{ $d->id_tahun_ajaran }}',
                                        '{{ $d->semester }}'
                                        )"
                                        class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                            <i class="fa-solid fa-pen text-black"></i>
                                        </button>

                                <a href="/pengajar/delete/{{ $d->id_pengajar }}" onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="w-8 h-8 bg-orange-400 p-2 rounded-full">
                                    <i class="fa-solid fa-trash text-black"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                     <tr>
        <td colspan="6" class="py-10 text-center text-gray-500 font-medium">
            Data pengajar tidak ditemukan
        </td>
    </tr>
@endforelse
                </tbody>

            </table>
            
        </div>
        
<div class="mt-4 flex justify-end space-x-2">
    {{ $data->appends(request()->query())->links() }}
</div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Pengajar</h2>

        <form action="/pengajar/store" method="POST">
            @csrf
            <label class="block text-sm mb-1">Dosen</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black" name="nik">
                <option value="">Pilih Dosen</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nik }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm mb-1">Mata Kuliah</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black" name="id_mata_kuliah">
                <option value="">Pilih Mata Kuliah</option>
               @foreach($mataKuliah as $mk)

                        @php
                            $jenisList = explode(',', $mk->jenis);
                        @endphp

                        @foreach($jenisList as $jenis)

                            <option value="{{ $mk->id_mata_kuliah }}">
                                {{ $mk->kode_mk }}
                                - {{ $mk->nama_mk }} Semester {{ $mk->semester }}
                                ({{ ucfirst(trim($jenis)) }})
                            </option>

                        @endforeach

                    @endforeach
            </select>

            <label class="block text-sm mb-1">Kelas</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black" name="kelas_id">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">{{$k->prodi->nama_prodi}} {{$k->semester}}{{ $k->nama_kelas }} {{$k->kategori}}</option>
                @endforeach
            </select>

           <label class="block text-sm mb-1">Tahun Ajaran</label>
                <select
                    class="w-full mb-3 px-3 py-2 border rounded text-black"
                    name="id_tahun_ajaran"
                    id="tahunAjaranSelect">

                    <option value="">Pilih Tahun Ajaran</option>

                    @foreach($tahunAjaran as $ta)

                    <option
                        value="{{ $ta->id_tahun_ajaran }}"
                        data-semester="{{ $ta->semester }}">

                        {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}
                        - {{ ucfirst($ta->semester) }}

                        {{ $ta->status == 'aktif' ? '(Aktif)' : '' }}

                    </option>

                    @endforeach

                </select>

                <label class="block text-sm mb-1">Semester</label>

                <select
                    name="semester"
                    id="semesterSelect"
                    class="w-full mb-3 px-3 py-2 border rounded text-black">

                    <option value="">Pilih Semester</option>

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

        <h2 class="text-lg font-bold mb-4">Ubah Pengajar</h2>

        <form id="formEdit" method="POST">
            @csrf
            <label class="block text-sm mb-1">Dosen</label>
            <select id="editDosen" class="w-full mb-3 px-3 py-2 border rounded text-black" name="nik">
                <option value="">Pilih Dosen</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nik }}">{{ $d->user->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm mb-1">Mata Kuliah</label>
            <select id="editMk" class="w-full mb-3 px-3 py-2 border rounded text-black" name="id_mata_kuliah">
                <option value="">Pilih Mata Kuliah</option>
                @foreach($mataKuliah as $mk)

                    @php
                        $jenisList = explode(',', $mk->jenis);
                    @endphp

                    @foreach($jenisList as $jenis)

                    <option value="{{ $mk->id_mata_kuliah }}">
                        {{ $mk->kode_mk }}
                        - {{ $mk->nama_mk }}
                        ({{ ucfirst(trim($jenis)) }})
                    </option>

                    @endforeach

                @endforeach
            </select>

            <label class="block text-sm mb-1">Kelas</label>
            <select id="editKelas" class="w-full mb-3 px-3 py-2 border rounded text-black" name="kelas_id">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">{{ $k->prodi->nama_prodi }} {{ $k->semester }} {{ $k->nama_kelas }} {{ $k->kategori }}</option>
                @endforeach
            </select>
            <label class="block text-sm mb-1">Tahun Ajaran</label>
            <select id="editTahun" class="w-full mb-3 px-3 py-2 border rounded text-black" name="id_tahun_ajaran">
                <option value="">Pilih Tahun Ajaran</option>
                 @foreach($tahunAjaran as $ta)

                <option
                    value="{{ $ta->id_tahun_ajaran }}"
                    data-semester="{{ $ta->semester }}">

                    {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}
                    - {{ ucfirst($ta->semester) }}
                    {{ $ta->status == 'aktif' ? '(Aktif)' : '' }}
                </option>

                @endforeach
            </select>

            <label class="block text-sm mb-1">Semester</label>
             <select
                id="editSemester"
                name="semester"
                class="w-full mb-3 px-3 py-2 border rounded text-black">

                <option value="">Pilih Semester</option>

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

        <h2 class="text-lg font-bold mb-4">Detail Pengajar</h2>

        <label class="text-sm mb-1 block">Dosen</label>
        <p id="detailDosen" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Mata Kuliah</label>
        <p id="detailMk" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Kelas</label>
        <p id="detailKelas" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Tahun Ajaran</label>
        <p id="detailTahun" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <label class="text-sm mb-1 block">Semester</label>
        <p id="detailSemester" class="mb-3 px-3 py-2 border rounded text-black bg-white"></p>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
// ===== MODAL ANIMATION =====
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

// ===== OPEN CLOSE =====
function openModal(id) {
    showModal(id)
}

function closeModal(id) {
    hideModal(id)
}

// ===== EDIT =====
function openEdit(id, nik, mk, kelas, tahun, semester) {

    showModal('editModal')

    document.getElementById('editDosen').value = nik
    document.getElementById('editMk').value = mk
    document.getElementById('editKelas').value = kelas
    document.getElementById('editTahun').value = tahun

    const editTahun = document.getElementById('editTahun')
    const editSemester = document.getElementById('editSemester')

    const semesterType =
        editTahun.options[editTahun.selectedIndex]
        .getAttribute('data-semester')

    editSemester.innerHTML =
        '<option value="">Pilih Semester</option>'

    for (let i = 1; i <= 14; i++) {

        if (semesterType === 'ganjil' && i % 2 !== 0) {

            editSemester.innerHTML +=
                `<option value="${i}">${i}</option>`
        }

        if (semesterType === 'genap' && i % 2 === 0) {

            editSemester.innerHTML +=
                `<option value="${i}">${i}</option>`
        }
    }

    editSemester.value = semester

    document.getElementById('formEdit').action =
        '/pengajar/update/' + id
}
const editTahun = document.getElementById('editTahun')
const editSemester = document.getElementById('editSemester')

editTahun.addEventListener('change', function () {

    const semesterType =
        this.options[this.selectedIndex]
        .getAttribute('data-semester')

    editSemester.innerHTML =
        '<option value="">Pilih Semester</option>'

    for (let i = 1; i <= 14; i++) {

        if (semesterType === 'ganjil' && i % 2 !== 0) {

            editSemester.innerHTML +=
                `<option value="${i}">${i}</option>`
        }

        if (semesterType === 'genap' && i % 2 === 0) {

            editSemester.innerHTML +=
                `<option value="${i}">${i}</option>`
        }
    }
})
// ===== DETAIL =====
function openDetail(dosen, mk, kelas, tahun, semester) {
    showModal('detailModal')

    document.getElementById('detailDosen').innerText = dosen
    document.getElementById('detailMk').innerText = mk
    document.getElementById('detailKelas').innerText = kelas
    document.getElementById('detailTahun').innerText = tahun
    document.getElementById('detailSemester').innerText = semester
}
const tahunSelect = document.getElementById('tahunAjaranSelect')
const semesterSelect = document.getElementById('semesterSelect')

tahunSelect.addEventListener('change', function () {

    const semesterType =
        this.options[this.selectedIndex]
        .getAttribute('data-semester')

    semesterSelect.innerHTML =
        '<option value="">Pilih Semester</option>'

    for (let i = 1; i <= 14; i++) {

        if (semesterType === 'ganjil' && i % 2 !== 0) {

            semesterSelect.innerHTML +=
                `<option value="${i}">${i}</option>`
        }

        if (semesterType === 'genap' && i % 2 === 0) {

            semesterSelect.innerHTML +=
                `<option value="${i}">${i}</option>`
        }
    }
})
tahunSelect.dispatchEvent(new Event('change'))
</script>

@endsection
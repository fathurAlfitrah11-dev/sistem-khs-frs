@extends('layout.app')

@section('title','Data Pengajar')

@section('content')
<style>
    .select2-black-text .select2-selection__rendered,
.select2-container--default .select2-results__option,
.select2-container--default .select2-search--dropdown input {
    color: #000 !important;
    
    }
</style>

<div class="p-6">

    <div class="flex items-center gap-3 mb-6" data-aos="fade-up" data-aos-delay="100">

        <h1 class="text-2xl font-bold text-gray-800">Data Pengajar</h1>

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

    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="200">

        <div class="flex-1 mr-4">
            <form method="GET" action="/pengajar" class="w-full">
                <input type="hidden" name="id_tahun_ajaran" value="{{ $idTahun }}">

                <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Telusuri Pengajar"
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

    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-white text-3xl font-bold">
                Data Pengajar
            </h2>

            <form method="GET" action="/pengajar">
                <select name="id_tahun_ajaran" onchange="this.form.submit()"
                    class="px-3 py-2 rounded text-black text-sm">

                    @if(count($tahunAjaran) > 0)
                    @foreach($tahunAjaran as $ta)
                    <option value="{{ $ta->id_tahun_ajaran }}" {{ $idTahun == $ta->id_tahun_ajaran ? 'selected' : '' }}>
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

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left text-[#243b63] font-bold text-sm">
                            NIK
                        </th>
                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Nama Dosen
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Mata Kuliah
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Kelas
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Tahun Ajaran
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Semester
                        </th>

                        <th class="px-4 py-4 text-center text-[#243b63] font-bold text-sm">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $d)

                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">

                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm whitespace-nowrap">
                            {{ $d->dosen->nik }}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm whitespace-nowrap">
                            {{ $d->dosen->user->name }}
                        </td>
                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center break-words">
                            {{ $d->mataKuliah->nama_mk }}
                        </td>

                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $d->kelas->prodi->nama_prodi }} {{ $d->kelas->semester }}{{ $d->kelas->nama_kelas }}
                            {{ $d->kelas->kategori }}
                        </td>

                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center whitespace-nowrap">
                            {{ $d->tahun->tahun_awal }} / {{ $d->tahun->tahun_akhir }} - <span
                                class="capitalize">{{ $d->tahun->semester }}</span>
                        </td>

                        <td class="px-4 py-4 text-gray-800 text-xs md:text-sm text-center font-medium">
                            {{ $d->semester }}
                        </td>

                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-3">

                                {{-- DETAIL --}}
                                <button
                                    onclick="openDetail('{{ $d->dosen->nik }}','{{ $d->dosen->user->name }}','{{ $d->mataKuliah->nama_mk }}','{{$d->kelas->prodi->nama_prodi}} {{ $d->kelas->semester }}{{ $d->kelas->nama_kelas }} {{ $d->kelas->kategori }}','{{ $d->tahun->tahun_awal }} / {{ $d->tahun->tahun_akhir }} - {{ $d->tahun->semester }}','{{ $d->semester }}')"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">

                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>

                                </button>

                                {{-- EDIT --}}
                                <button onclick="openEdit(
                            '{{ $d->id_pengajar }}',
                            '{{ $d->nik }}',
                            '{{ $d->kode_mk }}',
                            '{{ $d->kelas_id }}',
                            '{{ $d->id_tahun_ajaran }}',
                            '{{ $d->semester }}'
                        )" class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">

                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>

                                </button>

                                {{-- DELETE --}}
                                <a href="/pengajar/delete/{{ $d->id_pengajar }}"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">

                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="py-10 text-center text-gray-500 text-sm">

                            Data pengajar tidak ditemukan

                            @if(request('search'))
                            untuk pencarian
                            "<strong>{{ request('search') }}</strong>"
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

    <div
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Pengajar</h2>

        <form action="/pengajar/store" method="POST">
            @csrf

            <label class="block text-sm mb-1">Dosen</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black" name="nik" id="dosenTambah">
                <option value="">Pilih Dosen</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nik }}">{{ $d->user->name }}</option>
                @endforeach
            </select>
             @error('nik','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Mata Kuliah</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black" name="kode_mk" id="mkSelect">
                <option value="">Pilih Mata Kuliah</option>
                @foreach($mataKuliah as $semester => $list)

                    <optgroup label="Semester {{ $semester }}">

                        @foreach($list as $mk)

                            <option
                                value="{{ $mk->kode_mk }}"
                                data-prodi="{{ $mk->id_prodi }}">

                                {{ $mk->kode_mk }}
                                -
                                {{ $mk->nama_mk }}

                            </option>

                        @endforeach

                    </optgroup>

                @endforeach
            </select>
             @error('kode_mk','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Kelas</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black" name="kelas_id" id="kelasSelect">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}"
    data-semester="{{ $k->semester }}"
    data-prodi="{{ $k->id_prodi }}">
    {{ $k->prodi->nama_prodi }}
    {{ $k->semester }}{{ $k->nama_kelas }}
    {{ $k->kategori }}
</option>
                @endforeach
            </select>
             @error('kelas_id','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Tahun Ajaran</label>
            <select class="w-full mb-3 px-3 py-2 border rounded text-black" name="id_tahun_ajaran"
                id="tahunAjaranSelect">

                <option value="">Pilih Tahun Ajaran</option>

                @foreach($tahunAjaran as $ta)
                <option value="{{ $ta->id_tahun_ajaran }}" data-semester="{{ $ta->semester }}">
                    {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}
                    - {{ ucfirst($ta->semester) }}
                    {{ $ta->status == 'aktif' ? '(Aktif)' : '' }}
                </option>
                @endforeach
            </select>
             @error('id_tahun_ajaran','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

           <label class="block text-sm mb-1">Semester</label>
<input type="text" name="semester" id="semesterSelect" readonly
       class="w-full mb-3 px-3 py-2 border rounded text-black">
        @error('semester','tambah')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

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

            <label class="block text-sm mb-1">NIK</label>
            <select id="editDosen" class="w-full mb-3 px-3 py-2 border rounded text-black" name="nik">
                <option value="">Pilih Dosen</option>
                @foreach($dosen as $d)
                <option value="{{ $d->nik }}">{{ $d->user->name }}</option>
                @endforeach
            </select>
             @error('nik','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Mata Kuliah</label>
            <select id="editMk" class="w-full mb-3 px-3 py-2 border rounded text-black" name="kode_mk">
                <option value="">Pilih Mata Kuliah</option>
               @foreach($mataKuliah as $semester => $list)

                    <optgroup label="Semester {{ $semester }}">

                        @foreach($list as $mk)

                            <option
                                value="{{ $mk->kode_mk }}"
                                data-prodi="{{ $mk->id_prodi }}">

                                {{ $mk->kode_mk }}
                                -
                                {{ $mk->nama_mk }}

                            </option>

                        @endforeach

                    </optgroup>

                @endforeach
            </select>
           @error('kode_mk','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Kelas</label>
            <select id="editKelas" class="w-full mb-3 px-3 py-2 border rounded text-black" name="kelas_id">
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}"
    data-semester="{{ $k->semester }}"
    data-prodi="{{ $k->id_prodi }}">
                    {{ $k->prodi->nama_prodi }} {{ $k->semester }} {{ $k->nama_kelas }}
                    {{ $k->kategori }}
                </option>
                @endforeach
            </select>
            @error('kelas_id','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Tahun Ajaran</label>
            <select id="editTahun" class="w-full mb-3 px-3 py-2 border rounded text-black" name="id_tahun_ajaran">
                <option value="">Pilih Tahun Ajaran</option>
                @foreach($tahunAjaran as $ta)
                <option value="{{ $ta->id_tahun_ajaran }}" data-semester="{{ $ta->semester }}">
                    {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}
                    - {{ ucfirst($ta->semester) }}
                    {{ $ta->status == 'aktif' ? '(Aktif)' : '' }}
                </option>
                @endforeach
            </select>
            @error('id_tahun_ajaran','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

            <label class="block text-sm mb-1">Semester</label>
           <input type="text" id="editSemester" name="semester"
       class="w-full mb-3 px-3 py-2 border rounded text-black" readonly>
       @error('semester','edit')
            <p class="text-red-400 text-sm">{{ $message }}</p>
            @enderror

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
        class="modal-content bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4">Detail Pengajar</h2>

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
                <label class="text-sm">Mata Kuliah</label>
                <p id="detailMk" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Kelas</label>
                <p id="detailKelas" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

            <div>
                <label class="text-sm">Tahun Ajaran</label>
                <p id="detailTahun" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
        </div>

        <label class="text-sm mb-1 block mt-3">Semester</label>
        <p id="detailSemester" class="bg-white text-black px-3 py-2 rounded"></p>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    $('#dosenTambah').select2({
        width: '100%',
        placeholder: 'Pilih Dosen',
        allowClear: true,
        dropdownParent: $('#tambahModal'),
       dropdownCssClass: 'select2-black-text'
    });

    $('#mkSelect').select2({
        width: '100%',
        placeholder: 'Pilih Mata Kuliah',
        allowClear: true,
        dropdownParent: $('#tambahModal'),
       dropdownCssClass: 'select2-black-text'
    });

    $('#editDosen').select2({
        width: '100%',
        placeholder: 'Pilih Dosen',
        allowClear: true,
        dropdownParent: $('#editModal'),
       dropdownCssClass: 'select2-black-text'
    });

    $('#editMk').select2({
        width: '100%',
        placeholder: 'Pilih Mata Kuliah',
        allowClear: true,
        dropdownParent: $('#editModal'),
       dropdownCssClass: 'select2-black-text'
    });

});

function formatState(state) {

    if (!state.id) {
        return state.text;
    }

    return $('<span>' + state.text + '</span>');
}


// =====================================
// SHOW MODAL
// =====================================
function showModal(id) {

    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content');

    modal.classList.remove('hidden');

    setTimeout(() => {

        content.classList.remove(
            'opacity-0',
            'translate-y-10'
        );

        content.classList.add(
            'opacity-100',
            'translate-y-0'
        );

    }, 10);

}


// =====================================
// HIDE MODAL
// =====================================
function hideModal(id) {

    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content');

    content.classList.remove(
        'opacity-100',
        'translate-y-0'
    );

    content.classList.add(
        'opacity-0',
        'translate-y-10'
    );

    setTimeout(() => {

        modal.classList.add('hidden');

    }, 300);

}


// =====================================
// OPEN MODAL
// =====================================
function openModal(id) {

    showModal(id);

    setTimeout(function () {

        if (id === 'tambahModal') {

            $('#dosenTambah').val(null).trigger('change');
            $('#mkSelect').val(null).trigger('change');

            $('#kelasSelect').val('');
            $('#semesterSelect').val('');

        }

    },100);

}


// =====================================
// CLOSE MODAL
// =====================================
function closeModal(id) {

    hideModal(id);

    if(id === 'editModal'){

        $('#editDosen').val(null).trigger('change');
        $('#editMk').val(null).trigger('change');
        $('#editKelas').val('');
        $('#editTahun').val('');
        $('#editSemester').val('');

    }

}

// =====================================
// DETAIL
// =====================================
function openDetail(
    nik,
    namaDosen,
    mk,
    kelas,
    tahun,
    semester
) {

    showModal('detailModal');

    document.getElementById('detailNik').innerText =
        nik;

    document.getElementById('detailNamaDosen').innerText =
        namaDosen;

    document.getElementById('detailMk').innerText =
        mk;

    document.getElementById('detailKelas').innerText =
        kelas;

    document.getElementById('detailTahun').innerText =
        tahun;

    document.getElementById('detailSemester').innerText =
        semester;

}
// =====================================
// MODAL TAMBAH
// FILTER KELAS BERDASARKAN PRODI
// =====================================

const mkSelect = document.getElementById('mkSelect');
const kelasSelect = document.getElementById('kelasSelect');
const semesterInput = document.getElementById('semesterSelect');

$('#mkSelect').on('change', function () {

    const selected = this.options[this.selectedIndex];

    if (!selected) return;

    const prodi = selected.getAttribute('data-prodi');

    Array.from(kelasSelect.options).forEach(function(option){

        if(option.value === ''){
            option.hidden = false;
            return;
        }

        option.hidden =
            option.getAttribute('data-prodi') != prodi;

    });

    // reset pilihan kelas
    kelasSelect.value = '';
    semesterInput.value = '';

    // refresh select2 kalau nanti kelas juga dibuat select2
    $('#kelasSelect').trigger('change');

});


// =====================================
// AUTO ISI SEMESTER
// =====================================

$('#kelasSelect').on('change', function () {

    const selected = this.options[this.selectedIndex];

    if(!selected){

        semesterInput.value = '';
        return;

    }

    semesterInput.value =
        selected.getAttribute('data-semester') ?? '';

});

// =====================================
// MODAL EDIT
// FILTER KELAS BERDASARKAN PRODI
// =====================================

const editMk = document.getElementById('editMk');
const editKelas = document.getElementById('editKelas');
const editSemester = document.getElementById('editSemester');

$('#editMk').on('change', function () {

    const selected = this.options[this.selectedIndex];

    if (!selected) return;

    const prodi = selected.getAttribute('data-prodi');

    Array.from(editKelas.options).forEach(function(option){

        if(option.value === ''){
            option.hidden = false;
            return;
        }

        option.hidden =
            option.getAttribute('data-prodi') != prodi;

    });

    // reset kelas
    editKelas.value = '';
    editSemester.value = '';

    $('#editKelas').trigger('change');

});


// =====================================
// AUTO ISI SEMESTER
// =====================================

$('#editKelas').on('change', function () {

    const selected = this.options[this.selectedIndex];

    if(!selected){

        editSemester.value = '';
        return;

    }

    editSemester.value =
        selected.getAttribute('data-semester') ?? '';

});


// =====================================
// OPEN EDIT
// =====================================

function openEdit(
    id,
    nik,
    mk,
    kelas,
    tahun,
    semester
){

    showModal('editModal');

    $('#editDosen').val(nik).trigger('change');

    $('#editMk').val(mk).trigger('change');

    // Tunggu filter kelas selesai
    setTimeout(function(){

        $('#editKelas').val(kelas).trigger('change');

        $('#editTahun').val(tahun).trigger('change');

        $('#editSemester').val(semester);

    },100);

    $('#formEdit').attr(
        'action',
        '/pengajar/update/' + id
    );

}
</script>

@endsection
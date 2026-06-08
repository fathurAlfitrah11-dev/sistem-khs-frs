@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

@php
$totalSks = 0;

foreach($krs as $k){
foreach($k->detail as $item){
$totalSks += $item->pengajar->mataKuliah->sks ?? 0;
}
}

$maxSks = 20;
@endphp

<div class="p-6">

    {{-- TABLE --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="100">

        <h2 class="text-white text-3xl font-bold mb-6">Data Mata Kuliah</h2>

        <div class="bg-white overflow-hidden rounded-2xl">
        <form method="GET" class="mb-4">

            <select
                name="semester"
                onchange="this.form.submit()"
                class="text-black rounded px-3 py-2">

                @foreach($semesterList as $s)

                    <option
                        value="{{ $s }}"
                        {{ $semesterDipilih == $s ? 'selected' : '' }}>

                        Semester {{ $s }}

                    </option>

                @endforeach

            </select>

        </form>
            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Kode</th>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Nama Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Semester</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Status</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">SKS</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($krs as $k)
                    @foreach($k->detail as $item)
                    <tr
                        class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">

                        <td class="px-6 py-3 text-left whitespace-nowrap font-medium">
                            {{ $item->pengajar->mataKuliah->kode_mk }}
                        </td>

                        <td class="px-6 py-3 text-left break-words">
                            {{ $item->pengajar->mataKuliah->nama_mk }}
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $item->pengajar->mataKuliah->semester }}
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            @if(strtolower($item->status_wali) == 'pending' || strtolower($item->status_wali) ==
                            'menunggu')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $item->status_wali }}
                            </span>
                            @elseif(strtolower($item->status_wali) == 'approved' || strtolower($item->status_wali) ==
                            'disetujui')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $item->status_wali }}
                            </span>
                            @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $item->status_wali }}
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $item->pengajar->mataKuliah->sks }}
                        </td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center">
                                @if(strtolower($item->status_wali) == 'pending' || strtolower($item->status_wali) ==
                                'menunggu')
                                <button type="button" onclick="openDelete(
                                                '{{ $item->pengajar->mataKuliah->kode_mk }}',
                                                '{{ $item->pengajar->mataKuliah->nama_mk }}',
                                                '{{ $item->id_krs_detail }}'
                                            )"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 rounded-full flex items-center justify-center shadow transition duration-200">
                                    <i class="fa-solid fa-trash text-black text-xs"></i>
                                </button>
                                @else
                                <span class="text-gray-400 text-xs italic">-</span>
                                @endif
                            </div>
                        </td>

                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>

        </div>
            {{-- INFO SKS --}}
            <div class="mt-4 flex justify-between items-center text-white text-sm">

                <div>
                    Total SKS: <b id="totalSks">{{ $totalSks }}</b>
                </div>

                <div class="text-gray-300">
                    Maksimal SKS: <b>{{$maxSks}}</b>
                </div>

            </div>

            {{-- WARNING --}}
            @if($totalSks >= $maxSks)

                <div class="mt-2 text-yellow-400 text-sm">
                    Batas maksimum SKS sudah tercapai ({{ $maxSks }} SKS)
                </div>

            @endif

        </div>

    {{-- DELETE MODAL --}}
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div
            class="bg-[#5a5f86] w-full max-w-md rounded-xl p-6 text-white shadow-lg modal-content transform opacity-0 translate-y-10 transition-all duration-300">

            <h2 class="text-lg font-bold mb-4 text-center">Batalkan Mata Kuliah</h2>

            <div class="bg-[#4d5275] p-4 rounded-lg mb-4 text-sm space-y-2 border border-white/10">
                <p><b>Kode:</b> <span id="d_kode"></span></p>
                <p><b>Nama:</b> <span id="d_nama"></span></p>
            </div>

            <p class="text-gray-200 text-xs text-center mb-5">
                Mata kuliah ini akan dihapus secara permanen dari rencana studi (KRS) kamu.
            </p>

            <div class="flex justify-center gap-3">
                <button onclick="closeDelete()"
                    class="bg-gray-300 hover:bg-gray-200 text-black px-4 py-1.5 rounded-lg text-sm font-medium transition">
                    Batal
                </button>
                <button onclick="confirmDelete()"
                    class="bg-red-500 hover:bg-red-400 text-white px-4 py-1.5 rounded-lg text-sm font-semibold shadow transition">
                    Ya, Hapus
                </button>
            </div>

        </div>
    </div>

</div>

<script>
let deleteData = {}

function openDelete(kode, nama, id) {
    deleteData = {
        kode,
        nama,
        id
    }

    document.getElementById('d_kode').innerText = kode
    document.getElementById('d_nama').innerText = nama

    const modal = document.getElementById('deleteModal');
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function closeDelete() {
    const modal = document.getElementById('deleteModal');
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', 'translate-y-10');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function confirmDelete() {
    let form = document.createElement('form')
    form.method = 'POST'
    form.action = '/mahasiswa/krs/hapus/' + deleteData.id

    let csrf = document.createElement('input')
    csrf.type = 'hidden'
    csrf.name = '_token'
    csrf.value = '{{ csrf_token() }}'
    form.appendChild(csrf)

    let method = document.createElement('input')
    method.type = 'hidden'
    method.name = '_method'
    method.value = 'DELETE'
    form.appendChild(method)

    document.body.appendChild(form)
    form.submit()
}
</script>
@endsection
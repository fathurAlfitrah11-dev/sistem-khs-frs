@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

@php
$totalSks = 0;

foreach($krs as $k){
foreach($k->detail as $item){

if(strtolower($item->status_wali) != 'ditolak'){
$totalSks += $item->pengajar->mataKuliah->sks ?? 0;
}

}
}

$maxSks = 20;
@endphp

<div class="p-6">

    {{-- CONTAINER UTAMA DENGAN WARNA UNGER/NAVY GELAP --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="100">

        <h2 class="text-white text-3xl font-bold mb-6">Data Rencana Studi (KRS)</h2>

        {{-- FILTER SEMESTER --}}
        <div class="mb-4">
            <form method="GET">
                <select name="semester" onchange="this.form.submit()"
                    class="text-black rounded-lg px-4 py-2 font-semibold bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 cursor-pointer shadow-sm">

                    {{-- Kata-kata petunjuk default kalau belum ada yang dipilih --}}
                    <option value="" disabled {{ empty($semesterDipilih) ? 'selected' : '' }}>
                        -- Pilih Semester --
                    </option>

                    @foreach($semesterList as $s)
                    <option value="{{ $s }}" {{ $semesterDipilih == $s ? 'selected' : '' }}>
                        Semester {{ $s }}
                    </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- CONTAINER TABEL PUTIH KELUARAN OVAL --}}
        <div class="bg-white overflow-hidden rounded-2xl">
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
                    @php $adaData = false; @endphp
                    @foreach($krs as $k)
                    @foreach($k->detail as $item)
                    @if(($item->pengajar->mataKuliah->semester ?? 0) == $semesterDipilih)
                    {{-- Hanya tampilkan mata kuliah yang sesuai dengan semester terpilih --}}
                    @php $adaData = true; @endphp
                    <tr
                        class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">

                        <td class="px-6 py-3 text-left whitespace-nowrap font-medium font-mono">
                            {{ $item->pengajar->mataKuliah->kode_mk ?? '-' }}
                        </td>

                        <td class="px-6 py-3 text-left break-words font-semibold">
                            {{ $item->pengajar->mataKuliah->nama_mk ?? '-' }}
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $item->pengajar->semester ?? '-' }}
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            @if(strtolower($item->status_wali) == 'pending' || strtolower($item->status_wali) ==
                            'menunggu')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{-- 💡 MENGGUNAKAN ucfirst() AGAR HURUF AWAL KAPITAL --}}
                                {{ ucfirst($item->status_wali) }}
                            </span>
                            @elseif(strtolower($item->status_wali) == 'approved' || strtolower($item->status_wali) ==
                            'disetujui')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{-- 💡 MENGGUNAKAN ucfirst() AGAR HURUF AWAL KAPITAL --}}
                                {{ ucfirst($item->status_wali) }}
                            </span>
                            @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{-- 💡 MENGGUNAKAN ucfirst() AGAR HURUF AWAL KAPITAL --}}
                                {{ ucfirst($item->status_wali) }}
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap font-bold">
                            {{ $item->pengajar->mataKuliah->sks ?? 0 }}
                        </td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center">
                                @if(
                                strtolower($item->status_wali) == 'pending' ||
                                strtolower($item->status_wali) == 'ditolak'
                                )
                                <button type="button" onclick="openDelete(
                                    '{{ $item->pengajar->mataKuliah->kode_mk }}',
                                    '{{ $item->pengajar->mataKuliah->nama_mk }}',
                                    '{{ $item->id_krs_detail }}'
                                )"
                                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 rounded-full flex items-center justify-center shadow transition duration-200">
                                    <svg class="w-3.5 h-3.5 text-black" fill="none" stroke="currentColor"
                                        stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                @else
                                <span class="text-gray-400 text-xs italic">-</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach

                    @if(!$adaData)
                    <tr>
                        <td colspan="6" class="text-center py-8 text-xs text-gray-400 font-medium bg-gray-50">
                            Belum ada rincian rencana kuliah yang diambil untuk semester {{ $semesterDipilih }}.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- INFO AKUMULASI SKS DI BAWAH TABEL --}}
        <div class="mt-4 flex justify-between items-center text-white text-sm">
            <div>
                Total SKS Diambil: <b id="totalSks">{{ $totalSks }}</b>
            </div>
            <div class="text-gray-200">
                Maksimal Kuota SKS: <b class="text-white">{{ $maxSks }}</b>
            </div>
        </div>

        {{-- BANNER WARNING JIKA SKS PENULL --}}
        @if($totalSks >= $maxSks)
        <div
            class="mt-3 bg-yellow-500/20 border border-yellow-500/30 text-yellow-300 rounded-xl p-3 text-xs md:text-sm font-medium">
            Batas maksimum beban pengambilan studi SKS telah tercapai (Maks {{ $maxSks }} SKS).
        </div>
        @endif

    </div>

    {{-- DELETE MODAL SESUAI TEMA MATAKULIAH --}}
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div
            class="bg-[#5a5f86] w-full max-w-md rounded-xl p-6 text-white shadow-lg modal-content transform opacity-0 translate-y-10 transition-all duration-300">

            <h2 class="text-lg font-bold mb-4 text-center">Batalkan Rencana Mata Kuliah</h2>

            <div class="bg-[#4d5275] p-4 rounded-lg mb-4 text-sm space-y-2 border border-white/10">
                <p><b>Kode MK:</b> <span id="d_kode" class="font-mono text-yellow-300"></span></p>
                <p><b>Nama MK:</b> <span id="d_nama"></span></p>
            </div>

            <p class="text-gray-200 text-xs text-center mb-5">
                Mata kuliah ini akan dihapus secara permanen dari rencana studi (KRS) kamu semester ini.
            </p>

            <div class="flex justify-center gap-3">
                <button onclick="closeDelete()"
                    class="bg-gray-300 hover:bg-gray-200 text-black px-4 py-1.5 rounded-lg text-sm font-medium transition">
                    Kembali
                </button>
                <button onclick="confirmDelete()"
                    class="bg-red-500 hover:bg-red-400 text-white px-4 py-1.5 rounded-lg text-sm font-semibold shadow transition">
                    Ya, Batalkan
                </button>
            </div>

        </div>
    </div>

</div>

{{-- JAVASCRIPT ANIMASI MODAL & SAKTI TRIGGER FORM --}}
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
    const content = modal.querySelector('.modal-content');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function closeDelete() {
    const modal = document.getElementById('deleteModal');
    const content = modal.querySelector('.modal-content');

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
@extends('layout.dosen_app')

@section('title','Matakuliah')

@section('content')

@php
$matakuliah = [
(object)[
'kode' => 'IF201',
'nama' => 'Pemrograman Web',
'prodi' => 'DIII Teknik Informatika'
],
(object)[
'kode' => 'IF202',
'nama' => 'Basis Data',
'prodi' => 'DIII Teknik Informatika'
],
(object)[
'kode' => 'IF203',
'nama' => 'Struktur Data',
'prodi' => 'DIII Teknik Informatika'
],
(object)[
'kode' => 'IF204',
'nama' => 'Jaringan Komputer',
'prodi' => 'DIII Teknik Informatika'
],
(object)[
'kode' => 'IF205',
'nama' => 'Sistem Operasi',
'prodi' => 'DIII Teknik Informatika'
],
];
@endphp

<div class="p-6">

    {{-- SEARCH CARD --}}
    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="100">

        <div class="flex-1 mr-4">
            <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input type="text" placeholder="Cari Matakuliah" class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            Cari
        </button>
    </div>

    {{-- TABLE --}}
    <div class="bg-[#4a4f73] p-6 rounded-xl" data-aos="fade-up" data-aos-delay="200">

        <div class="bg-white rounded overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="text-left px-4 py-2">Kode</th>
                        <th class="text-left px-4 py-2">Mata kuliah</th>
                        <th class="text-left px-4 py-2">Program Studi</th>
                        <th class="text-center px-4 py-2">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($matakuliah as $mk)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $mk->kode }}</td>
                        <td class="px-6 py-3 text-black">{{ $mk->nama }}</td>
                        <td class="px-6 py-3 text-black">{{ $mk->prodi }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="#"
                                class="bg-orange-300 hover:bg-orange-400 text-black text-xs px-4 py-1 rounded-full">
                                Buka
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
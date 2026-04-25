@extends('layout.dosen_app')

@section('title','Penilaian')

@section('content')

@php
$mahasiswa = [];

for ($i = 1; $i <= 15; $i++) { $mahasiswa[]=(object)[ 'nim'=> '33125010' . str_pad($i, 2, '0', STR_PAD_LEFT),
    'nama' => 'Reifandra Kinadi',
    'nilai' => 2
    ];
    }
    @endphp

    <div class="p-6">


        {{-- FILTER --}}
        <div class="bg-[#4a4f73] p-6 rounded-xl mb-6 text-white" data-aos="fade-up" data-aos-delay="100">

            <h2 class="text-lg font-bold mb-4">
                Input Nilai Mahasiswa Pemrograman Web
            </h2>

            <div class="grid grid-cols-4 gap-4 items-end">

                <div>
                    <label class="text-sm">Semester</label>
                    <select class="w-full mt-1 px-3 py-2 rounded text-black">
                        <option>Semester 6</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm">Kelas</label>
                    <select class="w-full mt-1 px-3 py-2 rounded text-black">
                        <option>A</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm">Sesi</label>
                    <select class="w-full mt-1 px-3 py-2 rounded text-black">
                        <option>Pagi</option>
                    </select>
                </div>

                <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            Cari
        </button>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-[#4a4f73] p-6 rounded-xl" data-aos="fade-up" data-aos-delay="200">

            <div class="bg-white rounded overflow-hidden">

                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                        <tr>
                            <th class="text-left px-4 py-2">NIM</th>
                            <th class="text-left px-4 py-2">Nama Mahasiswa</th>
                            <th class="text-center px-4 py-2">Partisipatif</th>
                            <th class="text-center px-4 py-2">Tugas</th>
                            <th class="text-center px-4 py-2">Proyek</th>
                            <th class="text-center px-4 py-2">Quiz</th>
                            <th class="text-center px-4 py-2">UTS</th>
                            <th class="text-center px-4 py-2">UAS</th>
                            <th class="text-center px-4 py-2">NA</th>
                            <th class="text-center px-4 py-2">NH</th>
                            <th class="text-center px-4 py-2">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($mahasiswa as $m)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-3 text-black">{{ $m->nim }}</td>
                            <td class="px-6 py-3 text-black">{{ $m->nama }}</td>

                            @for($i=0;$i<6;$i++) <td class="px-6 py-3 text-black text-center">
                                <input type="number" value="2" class="w-14 border rounded text-center">
                                </td>
                                @endfor

                                <td class="px-6 py-3 text-black text-center">2</td>
                                <td class="px-6 py-3 text-black text-center">2</td>

                                <td class="px-6 py-3 text-black">
                                    <input type="text" class="w-full border rounded px-2">
                                </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

    </div>

    @endsection
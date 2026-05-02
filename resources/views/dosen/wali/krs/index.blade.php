@extends('layout.dosen_app')

@section('title','Perwalian KRS')

@section('content')

<div class="px-6 pb-6">

    <h2 class="text-xl font-bold text-white mb-4">Perwalian Mahasiswa (ACC KRS)</h2>

    {{-- SEARCH --}}
    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-4" data-aos="fade" data-aos-delay="100"
        data-aos-offset="0" data-aos-duration="500">

        <div class="flex-1 mr-4">
            <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input type="text" placeholder="Cari Mahasiswa / NIM" class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-[#4a4f73] p-6 rounded-xl" data-aos="fade-up" data-aos-delay="200">

        <div class="bg-white rounded overflow-hidden">

            <table class="w-full text-sm text-center">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-black">NIM</th>
                        <th class="px-6 py-3 text-black">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-black">Kelas</th>
                        <th class="px-6 py-3 text-black">Status</th>
                        <th class="px-6 py-3 text-black">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    {{-- CONTOH DATA --}}
                    @php
                    $krs = [
                    (object)[
                    'id' => 1,
                    'nim' => '220001',
                    'nama' => 'Budi Santoso',
                    'kelas' => 'IF-2A',
                    'status' => 'Menunggu'
                    ],
                    (object)[
                    'id' => 2,
                    'nim' => '220002',
                    'nama' => 'Siti Aminah',
                    'kelas' => 'IF-2A',
                    'status' => 'Disetujui'
                    ]
                    ];
                    @endphp

                    @foreach($krs as $d)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-black">{{ $d->nim }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->nama }}</td>
                        <td class="px-6 py-3 text-black">{{ $d->kelas }}</td>
                        <td class="px-6 py-3 text-black">
                            <span class="
                                {{ $d->status == 'Menunggu' ? 'text-yellow-600' : '' }}
                                {{ $d->status == 'Disetujui' ? 'text-green-600' : '' }}
                                {{ $d->status == 'Ditolak' ? 'text-red-600' : '' }}
                            ">
                                {{ $d->status }}
                            </span>
                        </td>

                        <td class="px-6 py-3 text-center">
                            <a href="/lihatkrs"
                                class="bg-orange-400 hover:bg-orange-300 text-black text-xs px-4 py-1 rounded-full">
                                Lihat KRS
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
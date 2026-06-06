@extends('layout.dosen_app')

@section('title','Perwalian KRS')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">
        Perwalian KRS
    </h1>

    {{-- SEARCH --}}
    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="200">

        <div class="flex-1">

            <div class="flex items-center bg-white rounded px-3 py-2">

                <input type="text" placeholder="Cari Mahasiswa / NIM" class="w-full outline-none text-sm text-gray-700">

                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>

            </div>

        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-white text-3xl font-bold mb-6">
            Data Perwalian Mahasiswa
        </h2>

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">NIM</th>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Kelas</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Status</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($krs as $d)
                    <tr
                        class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">
                        <td class="px-6 py-3 text-left whitespace-nowrap font-medium">
                            {{ $d->mahasiswa->nim ?? $d->nim }}
                        </td>
                        <td class="px-6 py-3 text-left break-words">
                            {{ $d->mahasiswa->nama ?? 'Nama Tidak Ada' }}
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{ $d->mahasiswa->kelas->nama_kelas ?? '-' }}
                        </td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            {{-- Kita cek status secara dinamis --}}
                            @if($d->detail->contains('status_wali', 'pending'))
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Menunggu
                            </span>
                            @else
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Selesai Diperiksa
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center">
                                {{-- Mengarahkan link secara dinamis membawa ID KRS ke route detail --}}
                                <a href="{{ route('perwalian.detail', $d->id_krs) }}"
                                    class="bg-orange-400 hover:bg-orange-300 text-black font-semibold text-xs px-4 py-1.5 rounded-lg shadow transition">
                                    Lihat KRS
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>

</div>

@endsection
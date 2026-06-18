@extends('layout.app')

@section('title','KPS Penilaian')

```blade
@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        KPS Penilaian
    </h1>

    {{-- Search --}}
    <div class="bg-[#4f547d] p-4 rounded-xl mb-6">

        <div class="flex items-center bg-white rounded-lg px-3 py-2">

            <input
                type="text"
                placeholder="Cari Mata Kuliah..."
                class="w-full outline-none text-sm text-gray-700">

            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>

        </div>

    </div>

    {{-- Card Tabel --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg">

        <h2 class="text-white text-3xl font-bold mb-6">
            Data Persentase Nilai
        </h2>

        <form action="{{ url('/kps-penilaian/simpan') }}" method="POST">
        @csrf

        <div class="bg-white rounded-2xl overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-[#f5f6fa] border-b border-gray-300">

                    <tr>

                        <th class="px-6 py-4 text-left text-[#243b63]">Mata Kuliah</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">Partisipatif</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">Tugas</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">Quiz</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">Proyek</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">UTS</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">UAS</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">Total</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">Status</th>
                        <th class="px-6 py-4 text-center text-[#243b63]">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($matkul as $mk)

                    <tr class="border-b border-gray-200 hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium whitespace-nowrap text-black">
                            {{ $mk->nama_mk }}

                            <input
                                type="hidden"
                                name="kode_mk[]"
                                value="{{ $mk->kode_mk }}">
                        </td>

                        <td class="px-4 py-4 text-center">
                            <input type="number"
                            name="persen_partisipatif[{{$mk->kode_mk}}]"
                            value="{{$mk->persen_partisipatif}}"
                            min="0"
                            max="100"
                            class="w-20 border border-gray-300 rounded-lg text-center py-1 text-black"
                            @if($mk->dikunci) readonly @endif>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <input type="number"
                            name="persen_tugas[{{$mk->kode_mk}}]"
                            value="{{$mk->persen_tugas}}"
                            min="0"
                            max="100"
                            class="w-20 border border-gray-300 rounded-lg text-center py-1 text-black"
                            @if($mk->dikunci) readonly @endif>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <input type="number"
                            name="persen_quiz[{{$mk->kode_mk}}]"
                            value="{{$mk->persen_quiz}}"
                            min="0"
                            max="100"
                            class="w-20 border border-gray-300 rounded-lg text-center py-1 text-black"
                            @if($mk->dikunci) readonly @endif>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <input type="number"
                            name="persen_proyek[{{$mk->kode_mk}}]"
                            value="{{$mk->persen_proyek}}"
                            min="0"
                            max="100"
                            class="w-20 border border-gray-300 rounded-lg text-center py-1 text-black"
                            @if($mk->dikunci) readonly @endif>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <input type="number"
                            name="persen_uts[{{$mk->kode_mk}}]"
                            value="{{$mk->persen_uts}}"
                            min="0"
                            max="100"
                            class="w-20 border border-gray-300 rounded-lg text-center py-1 text-black"
                            @if($mk->dikunci) readonly @endif>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <input type="number"
                            name="persen_uas[{{$mk->kode_mk}}]"
                            value="{{$mk->persen_uas}}"
                            min="0"
                            max="100"
                            class="w-20 border border-gray-300 rounded-lg text-center py-1 text-black"
                            @if($mk->dikunci) readonly @endif>
                        </td>

                        <td class="px-6 py-4 text-center font-bold text-green-600">

                            {{
                            $mk->persen_partisipatif +
                            $mk->persen_tugas +
                            $mk->persen_quiz +
                            $mk->persen_proyek +
                            $mk->persen_uts +
                            $mk->persen_uas
                            }}%

                        </td>

                        <td class="px-6 py-4 text-center whitespace-nowrap">

                            @if($mk->dikunci)

                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-xs font-bold">
                                    Sudah Dikunci
                                </span>

                            @else

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-xs font-bold">
                                    Belum Dikunci
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 text-center whitespace-nowrap">

                            @if(!$mk->dikunci)

                                <a href="{{ url('/kps-penilaian/kunci/'.$mk->kode_mk) }}" 
                                class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-semibold shadow">
                                    Kunci
                                </a>

                            @else

                                <a href="{{ url('/kps-penilaian/buka/'.$mk->kode_mk) }}"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold shadow">
                                    Buka Kunci
                                </a>

                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

            <div class="flex justify-end p-6">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow-md">

                    Simpan Bobot

                </button>

            </div>

        </div>

        </form>

    </div>

</div>

@endsection

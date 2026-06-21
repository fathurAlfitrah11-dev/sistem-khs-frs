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
        @if(!$tahun->nilai_dikunci)

<form action="{{ url('/kps-penilaian/tutup-nilai') }}" method="POST">
    @csrf
    <button class="bg-red-500 text-white px-4 py-2 rounded">
        Tutup Penginputan Nilai
    </button>
</form>

@else

<form action="{{ url('/kps-penilaian/buka-nilai') }}" method="POST">
    @csrf
    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Buka Penginputan Nilai
    </button>
</form>

@endif

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

    <td colspan="10" class="p-0">

        <form action="{{ url('/kps-penilaian/kunci/'.$mk->kode_mk) }}" method="POST" class="flex w-full items-center">
            @csrf

            <!-- kolom 1 -->
            <div class="w-[200px] px-6 py-4 font-medium text-black">
                {{ $mk->nama_mk }}
            </div>

            <!-- partisipatif -->
            <div class="flex-1 text-center">
                <input type="number" name="persen_partisipatif"
                    value="{{ $mk->persen_partisipatif }}"
                    class="w-20 border rounded text-center text-black"
                    @if($mk->dikunci) readonly @endif>
            </div>

            <!-- tugas -->
            <div class="flex-1 text-center">
                <input type="number" name="persen_tugas"
                    value="{{ $mk->persen_tugas }}"
                    class="w-20 border rounded text-center text-black"
                    @if($mk->dikunci) readonly @endif>
            </div>

            <!-- quiz -->
            <div class="flex-1 text-center">
                <input type="number" name="persen_quiz"
                    value="{{ $mk->persen_quiz }}"
                    class="w-20 border rounded text-center text-black"
                    @if($mk->dikunci) readonly @endif>
            </div>

            <!-- proyek -->
            <div class="flex-1 text-center">
                <input type="number" name="persen_proyek"
                    value="{{ $mk->persen_proyek }}"
                    class="w-20 border rounded text-center text-black"
                    @if($mk->dikunci) readonly @endif>
            </div>

            <!-- uts -->
            <div class="flex-1 text-center">
                <input type="number" name="persen_uts"
                    value="{{ $mk->persen_uts }}"
                    class="w-20 border rounded text-center text-black"
                    @if($mk->dikunci) readonly @endif>
            </div>

            <!-- uas -->
            <div class="flex-1 text-center">
                <input type="number" name="persen_uas"
                    value="{{ $mk->persen_uas }}"
                    class="w-20 border rounded text-center text-black"
                    @if($mk->dikunci) readonly @endif>
            </div>

            <!-- total -->
            <div class="flex-1 text-center font-bold text-green-600">
                {{ $mk->persen_partisipatif + $mk->persen_tugas + $mk->persen_quiz + $mk->persen_proyek + $mk->persen_uts + $mk->persen_uas }}%
            </div>

            <!-- status -->
            <div class="flex-1 text-center">
                @if($mk->dikunci)
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                        Dikunci
                    </span>
                @else
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                        Belum
                    </span>
                @endif
            </div>

            <!-- aksi -->
            <div class="flex-1 text-center">
                @if(!$mk->dikunci)
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">
                        Kunci
                    </button>
                @else
                    <a href="{{ url('/kps-penilaian/buka/'.$mk->kode_mk) }}"
                       class="bg-red-500 text-white px-4 py-2 rounded">
                        Buka
                    </a>
                @endif
            </div>

        </form>

    </td>

</tr>

@endforeach

</tbody>

            </table>

        </div>


    </div>

</div>

@endsection

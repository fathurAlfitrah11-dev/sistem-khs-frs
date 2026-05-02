@extends('layout.dosen_app')

@section('title','Detail KRS Mahasiswa')

@section('content')

<div class="p-6 mt-4 max-w-6xl mx-auto">

    {{-- HEADER MAHASISWA --}}
    <div class="bg-gradient-to-br from-[#3b3f63] via-[#4a4f73] to-[#2f3250] 
    p-6 md:p-8 rounded-3xl mb-6 text-white shadow-xl relative overflow-hidden" data-aos="fade" data-aos-delay="100"
        data-aos="fade-up" data-aos-offset="0" data-aos-duration="500">

        {{-- DECORATION (blur circle biar aesthetic) --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-400 opacity-20 rounded-full blur-3xl"></div>

        {{-- TITLE --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl md:text-3xl font-bold flex items-center gap-2">
                📘 Detail KRS Mahasiswa
            </h2>

            {{-- STATUS --}}
            <span
                class="bg-yellow-400 text-black px-4 py-1 rounded-full text-xs font-semibold shadow flex items-center gap-1">
                ⏳ Menunggu Persetujuan
            </span>
        </div>

        {{-- INFO GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">

            <div class="bg-white/10 backdrop-blur p-3 rounded-xl">
                <p class="text-gray-300 text-xs">Nama</p>
                <p class="font-semibold text-sm">Budi Santoso</p>
            </div>

            <div class="bg-white/10 backdrop-blur p-3 rounded-xl">
                <p class="text-gray-300 text-xs">NIM</p>
                <p class="font-semibold text-sm">220001</p>
            </div>

            <div class="bg-white/10 backdrop-blur p-3 rounded-xl">
                <p class="text-gray-300 text-xs">Kelas</p>
                <p class="font-semibold text-sm">IF-2A</p>
            </div>

            <div class="bg-white/10 backdrop-blur p-3 rounded-xl">
                <p class="text-gray-300 text-xs">Semester</p>
                <p class="font-semibold text-sm">3</p>
            </div>

        </div>

    </div>

    {{-- FORM --}}
    <form>

        {{-- CARD TABEL --}}
        <div class="bg-[#4a4f73] p-6 rounded-2xl shadow-lg" data-aos="fade-up" data-aos-delay="200">

            <div class="bg-white rounded-xl overflow-hidden shadow-sm">

                {{-- ❗ TABEL ASLI (TIDAK DIUBAH) --}}
                <table class="w-full text-sm text-center">
                    <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-black">Kode</th>
                            <th class="px-6 py-3 text-black">Mata Kuliah</th>
                            <th class="px-6 py-3 text-black">SKS</th>
                            <th class="px-6 py-3 text-black">Kelas</th>
                            <th class="px-6 py-3 text-black">Keputusan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @php
                        $mk = [
                        (object)['id'=>1,'kode'=>'IF101','nama'=>'Pemrograman Dasar','sks'=>3,'kelas'=>'IF-A'],
                        (object)['id'=>2,'kode'=>'IF102','nama'=>'Struktur Data','sks'=>4,'kelas'=>'IF-A'],
                        (object)['id'=>3,'kode'=>'IF103','nama'=>'Basis Data','sks'=>3,'kelas'=>'IF-A'],
                        ];
                        @endphp

                        @foreach($mk as $d)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-black">{{ $d->kode }}</td>
                            <td class="px-6 py-3 text-black">{{ $d->nama }}</td>
                            <td class="px-6 py-3 text-black">{{ $d->sks }}</td>
                            <td class="px-6 py-3 text-black">{{ $d->kelas }}</td>

                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-4">

                                    <label class="flex items-center gap-1 text-green-600">
                                        <input type="radio" name="status[{{ $d->id }}]" value="disetujui">
                                        Setujui
                                    </label>

                                    <label class="flex items-center gap-1 text-red-600">
                                        <input type="radio" name="status[{{ $d->id }}]" value="ditolak">
                                        Tolak
                                    </label>

                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

            {{-- FOOTER INFO --}}
            <div class="mt-4 flex flex-col md:flex-row justify-between items-center text-white text-sm gap-3">

                <div class="bg-[#3b3f63] px-4 py-2 rounded-lg shadow">
                    Total SKS: <b>10</b>
                </div>

                <div class="flex gap-2">
                    <button type="button" onclick="setAll('disetujui')"
                        class="bg-green-500 hover:bg-green-400 text-white px-3 py-1 rounded text-xs shadow">
                        ✔ Setujui Semua
                    </button>

                    <button type="button" onclick="setAll('ditolak')"
                        class="bg-red-500 hover:bg-red-400 text-white px-3 py-1 rounded text-xs shadow">
                        ✖ Tolak Semua
                    </button>
                </div>

            </div>

        </div>

        {{-- CATATAN --}}
        <div class="mt-6" data-aos="fade-up" data-aos-delay="300">
            <label class="text-white text-sm font-semibold">Catatan Dosen</label>
            <textarea
                class="w-full mt-2 px-4 py-3 rounded-xl text-black border border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 outline-none"
                placeholder="Tambahkan catatan jika perlu..."></textarea>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-between mt-6" data-aos="fade-up" data-aos-delay="400">

            <a href="/perwalian" class="bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded-lg text-black shadow">
                ← Kembali
            </a>

            <button type="submit" class="bg-green-500 hover:bg-green-400 text-white px-5 py-2 rounded-lg shadow">
                Simpan Keputusan
            </button>

        </div>

    </form>

</div>

<script>
function setAll(status) {
    const radios = document.querySelectorAll('input[type=radio]')

    radios.forEach(radio => {
        if (radio.value === status) {
            radio.checked = true
        }
    })
}
</script>

@endsection
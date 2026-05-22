@extends('layout.dosen_app')

@section('title','Detail KRS Mahasiswa')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="relative overflow-hidden rounded-3xl p-8 mb-8
        bg-gradient-to-br from-[#3b3f63] via-[#4a4f73] to-[#2f3250]
        shadow-[0_10px_40px_rgba(59,63,99,0.35)]" data-aos="fade-up">

        {{-- Blur Decoration --}}
        <div class="absolute -top-16 -right-10 w-56 h-56 bg-orange-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-400/10 rounded-full blur-3xl"></div>

        <div class="relative z-10">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">

                <div>
                    <p class="text-sm text-gray-300 mb-2">
                        Perwalian Akademik
                    </p>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">
                        Detail KRS Mahasiswa
                    </h1>
                </div>

                {{-- STATUS --}}
                <div
                    class="inline-flex items-center gap-2 bg-yellow-400 text-black px-5 py-2 rounded-2xl text-sm font-bold shadow-lg">
                     Menunggu Persetujuan
                </div>

            </div>

            {{-- INFO CARD --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                    <p class="text-xs text-gray-300 mb-1">Nama Mahasiswa</p>
                    <h3 class="text-lg font-bold text-white">Budi Santoso</h3>
                </div>

                <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                    <p class="text-xs text-gray-300 mb-1">NIM</p>
                    <h3 class="text-lg font-bold text-white">220001</h3>
                </div>

                <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                    <p class="text-xs text-gray-300 mb-1">Kelas</p>
                    <h3 class="text-lg font-bold text-white">IF-2A</h3>
                </div>

                <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                    <p class="text-xs text-gray-300 mb-1">Semester</p>
                    <h3 class="text-lg font-bold text-white">3</h3>
                </div>

            </div>

        </div>
    </div>

    {{-- FORM --}}
    <form>

        {{-- TABLE CARD --}}
        <div class="bg-[#3b3f63] rounded-3xl
    p-6 mb-6 shadow-[0_10px_30px_rgba(59,63,99,0.25)]" data-aos="fade-up" data-aos-delay="100">

            {{-- TOP --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <div>
                    <h2 class="text-2xl font-bold text-white">
                        Mata Kuliah Diambil
                    </h2>

                    <p class="text-sm text-gray-300 mt-1">
                        Daftar mata kuliah yang diajukan mahasiswa
                    </p>
                </div>

                <div class="flex gap-3">

                    <button type="button" onclick="setAll('disetujui')" class="bg-green-500 hover:bg-green-400
                text-white px-4 py-2 rounded-xl
                text-sm font-medium transition shadow">

                        ✔ Setujui Semua

                    </button>

                    <button type="button" onclick="setAll('ditolak')" class="bg-red-500 hover:bg-red-400
                text-white px-4 py-2 rounded-xl
                text-sm font-medium transition shadow">

                        ✖ Tolak Semua

                    </button>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto rounded-2xl border border-white/10">

                <table class="w-full">

                    {{-- HEADER --}}
                    <thead class="bg-[#2f3250] border-b border-white/10">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-300">
                                Kode
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-300">
                                Mata Kuliah
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-300">
                                SKS
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-300">
                                Kelas
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-300">
                                Keputusan
                            </th>

                        </tr>

                    </thead>

                    {{-- BODY --}}
                    <tbody class="divide-y divide-white/5 bg-[#4a4f73]">

                        @php
                        $mk = [
                        (object)['id'=>1,'kode'=>'IF101','nama'=>'Pemrograman Dasar','sks'=>3,'kelas'=>'IF-A'],
                        (object)['id'=>2,'kode'=>'IF102','nama'=>'Struktur Data','sks'=>4,'kelas'=>'IF-A'],
                        (object)['id'=>3,'kode'=>'IF103','nama'=>'Basis Data','sks'=>3,'kelas'=>'IF-A'],
                        (object)['id'=>4,'kode'=>'IF104','nama'=>'Jaringan Komputer','sks'=>3,'kelas'=>'IF-A'],
                        ];
                        @endphp

                        @foreach($mk as $d)

                        <tr class="hover:bg-white/5 transition-all duration-200">

                            {{-- KODE --}}
                            <td class="px-6 py-5 text-white font-semibold">
                                {{ $d->kode }}
                            </td>

                            {{-- MATA KULIAH --}}
                            <td class="px-6 py-5">

                                <p class="font-semibold text-white text-[15px]">
                                    {{ $d->nama }}
                                </p>

                            </td>

                            {{-- SKS --}}
                            <td class="px-6 py-5 text-center text-white font-semibold">
                                {{ $d->sks }}
                            </td>

                            {{-- KELAS --}}
                            <td class="px-6 py-5 text-center text-gray-200 font-medium">
                                {{ $d->kelas }}
                            </td>

                            </td>

                            {{-- KEPUTUSAN --}}
                            <td class="px-6 py-5">

                                <div class="flex justify-center gap-3">

                                    {{-- SETUJUI --}}
                                    <label class="cursor-pointer flex items-center gap-2
                                px-4 py-2 rounded-xl
                                border border-green-400/20
                                bg-green-500/10
                                hover:bg-green-500/20
                                transition">

                                        <input type="radio" name="status[{{ $d->id }}]" value="disetujui"
                                            class="accent-green-400">

                                        <span class="text-sm font-medium text-green-300">
                                            Setujui
                                        </span>

                                    </label>

                                    {{-- TOLAK --}}
                                    <label class="cursor-pointer flex items-center gap-2
                                px-4 py-2 rounded-xl
                                border border-red-400/20
                                bg-red-500/10
                                hover:bg-red-500/20
                                transition">

                                        <input type="radio" name="status[{{ $d->id }}]" value="ditolak"
                                            class="accent-red-400">

                                        <span class="text-sm font-medium text-red-300">
                                            Tolak
                                        </span>

                                    </label>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- FOOTER --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6">

                {{-- TOTAL SKS --}}
                <div class="inline-flex items-center gap-2
            bg-white/10 backdrop-blur-xl
            border border-white/10
            text-white px-5 py-3 rounded-2xl shadow">

                     Total SKS :
                    <span class="font-bold text-lg">13</span>

                </div>

                {{-- INFO --}}
                <div class="text-sm text-gray-300">
                    Pastikan keputusan KRS sudah sesuai sebelum disimpan.
                </div>

            </div>

        </div>

        {{-- NOTES --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-white/40
            p-6 mb-6 shadow-sm" data-aos="fade-up" data-aos-delay="200">

            <div class="mb-4">

                <h2 class="text-xl font-bold text-gray-800">
                    Catatan Dosen
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan catatan atau revisi untuk mahasiswa
                </p>

            </div>

            <textarea class="w-full h-36 rounded-2xl border border-gray-200
                px-5 py-4 text-gray-700 focus:ring-2 focus:ring-[#3b3f63]
                outline-none resize-none" placeholder="Tambahkan catatan jika diperlukan..."></textarea>

        </div>

        {{-- ACTION --}}
        <div class="flex flex-col sm:flex-row justify-between gap-4" data-aos="fade-up" data-aos-delay="300">

            <a href="/perwalian" class="inline-flex items-center justify-center gap-2
                bg-gray-200 hover:bg-gray-300
                text-gray-700 font-medium
                px-5 py-3 rounded-2xl transition">

                ← Kembali

            </a>

            <button type="submit" class="inline-flex items-center justify-center gap-2
                bg-green-500 hover:bg-green-400
                text-white font-semibold
                px-6 py-3 rounded-2xl shadow-lg transition">

                ✔ Simpan Keputusan

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
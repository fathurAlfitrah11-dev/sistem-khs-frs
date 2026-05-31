@extends('layout.dosen_app')

@section('title', 'Detail KRS Mahasiswa')

@section('content')

<div class="max-w-7xl mx-auto p-2">

    {{-- HEADER (Clean Slate Style - Menyesuaikan Dasbor Utama) --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6 mb-6 shadow-sm" data-aos="fade-up">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-xs font-semibold text-[#f9b17a] uppercase tracking-wider mb-1">
                    Perwalian Akademik
                </p>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">
                    Detail KRS Mahasiswa
                </h1>
                <p class="text-xs text-slate-400 mt-1">Periksa lembar rencana studi mahasiswa bimbingan Anda</p>
            </div>

            {{-- STATUS BADGE (Amber Soft Modern) --}}
            <div>
                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200 px-4 py-2 rounded-xl text-xs font-bold shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    Menunggu Persetujuan
                </span>
            </div>
        </div>

        {{-- INFO GRID (Minimalis & Rapi) --}}
      {{-- INFO GRID (Sudah Dirapatkan dan Sejajar) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4 pt-4 border-t border-slate-100">
            <div class="bg-slate-50/60 rounded-xl px-4 py-2 border border-slate-100">
                <p class="text-[11px] font-medium text-slate-400 mb-0.5">Nama Mahasiswa</p>
                <h3 class="text-sm font-bold text-slate-700">Budi Santoso</h3>
            </div>

            <div class="bg-slate-50/60 rounded-xl px-4 py-2 border border-slate-100">
                <p class="text-[11px] font-medium text-slate-400 mb-0.5">NIM</p>
                <h3 class="text-sm font-bold text-slate-700">220001</h3>
            </div>

            <div class="bg-slate-50/60 rounded-xl px-4 py-2 border border-slate-100">
                <p class="text-[11px] font-medium text-slate-400 mb-0.5">Kelas</p>
                <h3 class="text-sm font-bold text-slate-700">IF-2A</h3>
            </div>

            <div class="bg-slate-50/60 rounded-xl px-4 py-2 border border-slate-100">
                <p class="text-[11px] font-medium text-slate-400 mb-0.5">Semester</p>
                <h3 class="text-sm font-bold text-slate-700">3</h3>
            </div>
        </div>
    </div>

    {{-- FORM UTAMA --}}
    <form>
        {{-- TABLE CARD CONTAINER --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6 mb-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
            
            {{-- TOP CONTROL TABLE --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Mata Kuliah Diambil</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Daftar mata kuliah yang diajukan oleh mahasiswa bersangkutan</p>
                </div>

                {{-- BULK ACTION BUTTONS --}}
                <div class="flex gap-2.5">
                    <button type="button" onclick="setAll('disetujui')" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-200 flex items-center gap-1.5 shadow-sm">
                        ✔ Setujui Semua
                    </button>

                    <button type="button" onclick="setAll('ditolak')" class="bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-200 flex items-center gap-1.5 shadow-sm">
                        ✖ Tolak Semua
                    </button>
                </div>
            </div>

            {{-- MODERN LIGHT TABLE --}}
            <div class="overflow-x-auto rounded-xl border border-slate-100 shadow-sm shadow-slate-100/40">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3.5 text-center text-xs font-bold uppercase tracking-wider">SKS</th>
                            <th class="px-6 py-3.5 text-center text-xs font-bold uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3.5 text-center text-xs font-bold uppercase tracking-wider">Keputusan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white">
                        @php
                        $mk = [
                            (object)['id'=>1,'kode'=>'IF101','nama'=>'Pemrograman Dasar','sks'=>3,'kelas'=>'IF-A'],
                            (object)['id'=>2,'kode'=>'IF102','nama'=>'Struktur Data','sks'=>4,'kelas'=>'IF-A'],
                            (object)['id'=>3,'kode'=>'IF103','nama'=>'Basis Data','sks'=>3,'kelas'=>'IF-A'],
                            (object)['id'=>4,'kode'=>'IF104','nama'=>'Jaringan Komputer','sks'=>3,'kelas'=>'IF-A'],
                        ];
                        @endphp

                        @foreach($mk as $d)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            {{-- KODE --}}
                            <td class="px-6 py-4 text-slate-800 font-bold tracking-wide">
                                {{ $d->kode }}
                            </td>

                            {{-- MATA KULIAH --}}
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-700">
                                    {{ $d->nama }}
                                </p>
                            </td>

                            {{-- SKS --}}
                            <td class="px-6 py-4 text-center text-slate-700 font-bold">
                                {{ $d->sks }}
                            </td>

                            {{-- KELAS --}}
                            <td class="px-6 py-4 text-center text-slate-500 font-medium">
                                <span class="bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-md text-xs font-semibold">
                                    {{ $d->kelas }}
                                </span>
                            </td>

                            {{-- KEPUTUSAN RADIO BUTTONS (Super Clean & Minimalis) --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2.5">
                                    {{-- SETUJUI --}}
                                    <label class="cursor-pointer flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:border-emerald-300 hover:bg-emerald-50/30 transition-all duration-150 group">
                                        <input type="radio" name="status[{{ $d->id }}]" value="disetujui" class="accent-emerald-600 w-3.5 h-3.5">
                                        <span class="text-xs font-semibold text-slate-600 group-hover:text-emerald-700">
                                            Setujui
                                        </span>
                                    </label>

                                    {{-- TOLAK --}}
                                    <label class="cursor-pointer flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:border-rose-300 hover:bg-rose-50/30 transition-all duration-150 group">
                                        <input type="radio" name="status[{{ $d->id }}]" value="ditolak" class="accent-rose-600 w-3.5 h-3.5">
                                        <span class="text-xs font-semibold text-slate-600 group-hover:text-rose-700">
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

            {{-- TABLE FOOTER CONTROL --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-5 pt-4 border-t border-slate-100">
                {{-- TOTAL SKS --}}
                <div class="inline-flex items-center gap-2 bg-slate-50 text-slate-700 border border-slate-100 px-4 py-2 rounded-xl shadow-sm text-xs font-medium">
                    Total SKS Diambil:
                    <span class="font-extrabold text-sm text-slate-800">{{ 13 }}</span>
                </div>

                {{-- INFO --}}
                <div class="text-xs text-slate-400 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pastikan keputusan KRS sudah sesuai sebelum disimpan ke pangkalan data.
                </div>
            </div>
        </div>

        {{-- CATATAN DOSEN CARD --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-6 mb-6 shadow-sm" data-aos="fade-up" data-aos-delay="150">
            <div class="mb-3">
                <h2 class="text-lg font-bold text-slate-800">Catatan Tambahan Dosen</h2>
                <p class="text-xs text-slate-400">Berikan pesan atau instruksi khusus revisi jika ada berkas yang ditolak</p>
            </div>

            <textarea class="w-full h-28 rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 focus:border-[#f9b17a] focus:ring-1 focus:ring-[#f9b17a] outline-none resize-none transition-all placeholder:text-slate-300" placeholder="Ketikkan catatan bimbingan akademik di sini..."></textarea>
        </div>

        {{-- ACTIONS BUTTON BOTTOM --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4" data-aos="fade-up" data-aos-delay="200">
            <a href="/perwalian" class="inline-flex items-center justify-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-xs px-5 py-3 rounded-xl transition-colors duration-200 shadow-sm">
                ← Kembali ke List
            </a>

            <button type="submit" class="inline-flex items-center justify-center gap-1.5 bg-[#f9b17a] hover:bg-[#e29d68] text-white font-bold text-xs px-6 py-3 rounded-xl shadow-md transition-all duration-200 tracking-wide">
                ✔ Simpan Semua Keputusan
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
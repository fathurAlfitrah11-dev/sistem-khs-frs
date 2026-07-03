@extends('layout.dosen_app')

@section('title','Penilaian')

@section('content')

<div class="p-6">

    {{-- ===== BARU: STRUKTUR FORM FILTER UTAMA DENGAN FILTER MATA KULIAH INTEGRAL ===== --}}
    <div class="bg-[#4a4f73] p-6 rounded-xl mb-6 text-white" data-aos="fade-up" data-aos-delay="100">
        {{-- Mengganti text h2 dinamis sesuai matkul yang sedang dicari dosen --}}
        @php
            $matkulAktif = 'Input Nilai Mahasiswa';
            if(request('id_pengajar')) {
                foreach($matkulDiampu as $row) {
                    if($row->id_pengajar == request('id_pengajar')) {
                        $matkulAktif = 'Input Nilai Mahasiswa ' . ($row->mataKuliah->nama_mk ?? '');
                    }
                }
            }
        @endphp
        <h2 class="text-xl font-bold mb-4">{{ $matkulAktif }}</h2>

        <form action="{{ url('/penilaian') }}" method="GET">
            {{-- Grid disesuaikan menjadi xl:grid-cols-6 agar lebar kolom pas, presisi, dan tidak jomplang --}}
            <div class="grid grid-cols-2 xl:grid-cols-6 gap-4 items-end bg-[#3b3a5e] p-4 rounded-xl text-white">
                
                {{-- PROGRAM STUDI --}}
                <div class="flex flex-col gap-1 col-span-2 xl:col-span-1">
                    <label class="text-xs text-slate-300 font-medium">Program Studi</label>
                    <select name="id_prodi" class="w-full px-2 py-1.5 text-xs rounded bg-white text-black border border-gray-300 focus:outline-none font-medium">
                        <option value="">Pilih Prodi</option>
                        @foreach($prodi as $p)
                        <option value="{{ $p->id_prodi }}" {{ request('id_prodi') == $p->id_prodi ? 'selected' : '' }}>
                            {{ $p->jenjang }} - {{ $p->nama_prodi }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- SEMESTER --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-slate-300 font-medium">Semester</label>
                <select name="semester"
        id="semester"
        class="w-full px-2 py-1.5 text-xs rounded bg-white text-black border">

    <option value="">Pilih Semester</option>

    @for($i = 1; $i <= 8; $i++)
        <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
            Semester {{ $i }}
        </option>
    @endfor

</select>
                </div>

                {{-- SESI --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-slate-300 font-medium">Sesi</label>
                    <select name="sesi" class="w-full px-2 py-1.5 text-xs rounded bg-white text-black border border-gray-300 focus:outline-none font-medium">
                        <option value="">Pilih Sesi</option>
                        <option value="Pagi" {{ request('sesi') == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="Malam" {{ request('sesi') == 'Malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                </div>

                {{-- KELAS --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-slate-300 font-medium">Kelas</label>
                    <select name="id_kelas" class="w-full px-2 py-1.5 text-xs rounded bg-white text-black border border-gray-300 focus:outline-none font-medium">
                        <option value="">Pilih Kelas</option>
                       @foreach($kelas->unique('nama_kelas') as $k)
    <option value="{{ $k->nama_kelas }}">
        {{ $k->nama_kelas }}
    </option>
@endforeach
                    </select>
                </div>

                {{-- DROPDOWN MATA KULIAH (PINDAH KE ATAS DAN DI-FILTER UNIQUE AGAR KELAS A & B TIDAK MUNCUL GANDA) --}}
                <div class="flex flex-col gap-1 col-span-2 xl:col-span-1">
                    <label class="text-xs text-slate-300 font-medium">Mata Kuliah</label>
                    <select name="id_pengajar" id="id_pengajar" class="w-full px-2 py-1.5 text-xs rounded bg-white text-black border border-gray-300 focus:outline-none font-medium cursor-pointer">
                        <option value="">Semua Mata Kuliah</option>
                        {{-- Menggunakan ->unique('kode_mk') agar Sistem Komputer hanya keluar 1 baris saja di dropdown --}}
                       @foreach(($matkulDiampu ?? collect())->unique('kode_mk') as $row)
                        <option value="{{ $row->id_pengajar }}" {{ request('id_pengajar') == $row->id_pengajar ? 'selected' : '' }}>
                            {{ $row->mataKuliah->nama_mk ?? $row->kode_mk }}
                        </option>
                        @endforeach
                    </select>
                </div>

               {{-- TAHUN AJARAN --}}
<div class="flex flex-col gap-1">
    <label class="text-xs text-slate-300 font-medium">Tahun Ajaran</label>

    <select name="id_tahun_ajaran"
        class="w-full px-2 py-1.5 text-xs rounded bg-white text-black border">

        <option value="">Pilih Tahun Ajaran</option>

        @foreach($tahunAjaranList as $ta)

            <option value="{{ $ta->id_tahun_ajaran }}"
                {{ request('id_tahun_ajaran') == $ta->id_tahun_ajaran ? 'selected' : '' }}>

                {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}
                - {{ ucfirst($ta->semester) }}

                {{-- LABEL AKTIF --}}
                @if($ta->status == 'aktif')
                    (AKTIF)
                @endif

            </option>

        @endforeach

    </select>
</div>

                {{-- TOMBOL CARI --}}
                <div class="col-span-2 xl:col-span-1">
                    <button type="submit" class="w-full bg-[#f4a261] hover:bg-[#e76f51] text-white font-semibold text-xs px-4 py-2 rounded shadow transition-all duration-200 h-[34px]">
                        Cari
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- ===== FORM UTAMA UNTUK SIMPAN NILAI ===== --}}
    <form id="formSimpanNilai" action="{{ url('/penilaian/simpan') }}" method="POST">
        @csrf
    </form>

    {{-- ===== WIDGET AREA TABEL PENILAIAN ===== --}}
    <div class="bg-[#4a4f73] p-6 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="200">

        {{-- AREA ATAS TABEL: TINGGAL INDIKATOR JUMLAH BARIS SAJA --}}
        <div class="flex flex-row justify-end items-center mb-4">
            <div class="text-right">
                <span class="text-xs text-slate-300">Total Baris Nilai Mahasiswa: <b class="text-yellow-400 font-mono text-sm">{{ count($mahasiswa) }}</b></span>
            </div>
        </div>

        {{-- CONTAINER TABEL --}}
        <div class="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-inner">
            <table class="w-full text-sm">
                <thead class="bg-slate-100 text-slate-700 border-b border-slate-200">
                    <tr>
                       @php
$mk = null;

if(request('id_pengajar')) {
    $pengajar = $matkulDiampu->firstWhere('id_pengajar', request('id_pengajar'));
    $mk = $pengajar?->mataKuliah;
}
@endphp
                        <th class="text-left px-5 py-3.5 font-semibold">NIM</th>
                        <th class="text-left px-5 py-3.5 font-semibold">Nama Mahasiswa</th>
                        <th class="text-left px-5 py-3.5 font-semibold">Mata Kuliah</th>
                        <th class="text-center px-3 py-3.5 font-semibold">Partisipatif
                            <br>
                            <span class="text-xs font-normal text-slate-500">({{ $mk->persen_partisipatif ?? 0 }}%)</span>
                        </th>
                        <th class="text-center px-3 py-3.5 font-semibold">Tugas
                            <br>
                            <span class="text-xs font-normal text-slate-500">({{ $mk->persen_tugas ?? 0 }}%)</span>
                        </th>
                        <th class="text-center px-3 py-3.5 font-semibold">Proyek
                            <br>
                            <span class="text-xs font-normal text-slate-500">({{ $mk->persen_proyek ?? 0 }}%)</span>
                        </th>
                        <th class="text-center px-3 py-3.5 font-semibold">Quiz
                            <br>
                            <span class="text-xs font-normal text-slate-500">({{ $mk->persen_quiz ?? 0 }}%)</span>
                        </th>
                        <th class="text-center px-3 py-3.5 font-semibold">UTS
                            <br>
                            <span class="text-xs font-normal text-slate-500">({{ $mk->persen_uts ?? 0 }}%)</span>
                        </th>
                        <th class="text-center px-3 py-3.5 font-semibold">UAS
                            <br>
                            <span class="text-xs font-normal text-slate-500">({{ $mk->persen_uas ?? 0 }}%)</span>
                        </th>
                        <th class="text-center px-4 py-3.5 font-semibold bg-slate-100">NA</th>
                        <th class="text-center px-4 py-3.5 font-semibold bg-slate-100">NH</th>
                        <th class="text-left px-5 py-3.5 font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($mahasiswa as $m)
                    <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                        <td class="px-5 py-3.5 font-medium text-slate-700 font-mono">{{ $m->nim }}</td>
                        <td class="px-5 py-3.5 font-medium text-slate-800 font-semibold">{{ $m->nama }}</td>
                        <td class="px-5 py-3.5 font-semibold text-slate-600 bg-blue-50/30 font-sans text-xs">{{ $m->nama_mk }}</td>

                        @php
                            $id_detail = $m->id_krs_detail;
                            $khsData   = $m->khs;
                        @endphp

                        <input type="hidden" name="krs_detail_id[]" value="{{ $id_detail }}" form="formSimpanNilai">

                        <td class="px-2 py-3 text-center">
                            <input type="number" name="partisipatif[{{ $id_detail }}]" value="{{ $khsData->partisipatif ?? 0 }}" min="0" max="100" form="formSimpanNilai" class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                        </td>
                        <td class="px-2 py-3 text-center">
                            <input type="number" name="tugas[{{ $id_detail }}]" value="{{ $khsData->tugas ?? 0 }}" min="0" max="100" form="formSimpanNilai" class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                        </td>
                        <td class="px-2 py-3 text-center">
                            <input type="number" name="proyek[{{ $id_detail }}]" value="{{ $khsData->proyek ?? 0 }}" min="0" max="100" form="formSimpanNilai" class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                        </td>
                        <td class="px-2 py-3 text-center">
                            <input type="number" name="quiz[{{ $id_detail }}]" value="{{ $khsData->quiz ?? 0 }}" min="0" max="100" form="formSimpanNilai" class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:outline-none transition-all">
                        </td>
                        <td class="px-2 py-3 text-center">
                            <input type="number" name="uts[{{ $id_detail }}]" value="{{ $khsData->uts ?? 0 }}" min="0" max="100" form="formSimpanNilai" class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                        </td>
                        <td class="px-2 py-3 text-center">
                            <input type="number" name="uas[{{ $id_detail }}]" value="{{ $khsData->uas ?? 0 }}" min="0" max="100" form="formSimpanNilai" class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                        </td>

                        <td class="px-4 py-3 text-center bg-slate-50/50">
                            <span class="inline-block px-2 py-1 text-xs font-bold text-slate-700 bg-slate-200/60 rounded">
                                {{ $khsData->na ?? '-' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center bg-slate-50/50">
                            <span class="inline-block px-2.5 py-1 text-xs font-bold text-blue-600 bg-blue-50 rounded border border-blue-100">
                                {{ $khsData->nh ?? '-' }}
                            </span>
                        </td>

                        <td class="px-5 py-3 text-black">
                            <input type="text" name="keterangan[{{ $id_detail }}]" value="{{ $khsData->keterangan ?? '' }}" placeholder="Tambahkan catatan..." form="formSimpanNilai" class="w-full h-9 px-3 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center py-10 text-slate-400 bg-slate-50 font-medium">
                            Data mahasiswa tidak ditemukan atau silakan pilih filter terlebih dahulu.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ACTION BUTTON BOTTOM --}}
        <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-slate-300 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                Pastikan semua nilai sudah benar sebelum finalisasi.
            </div>

            <div class="flex gap-3">
                @php
                $kpsLocked = \App\Models\PenguncianNilai::where('status', 'dikunci')->exists();
            @endphp

                <button type="submit" name="action" value="draft" form="formSimpanNilai" {{ $kpsLocked ? 'disabled' : '' }} class="bg-orange-400 hover:bg-orange-500 disabled:bg-gray-500 disabled:cursor-not-allowed text-slate-900 px-5 py-2 rounded-xl font-semibold transition-all duration-150 shadow-md">
                    Simpan Draft
                </button>

                <button type="submit" name="action" value="final" form="formSimpanNilai" {{ $kpsLocked ? 'disabled' : '' }} onclick="return confirm('Apakah Anda yakin ingin melakukan finalisasi? Nilai yang sudah difinalisasi tidak akan dapat diubah kembali.')" class="bg-emerald-500 hover:bg-emerald-600 disabled:bg-gray-600 disabled:cursor-not-allowed text-white px-5 py-2 rounded-xl font-bold transition-all duration-150 shadow-md">
                    Finalisasi Nilai
                </button>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('semester').addEventListener('change', function () {

    fetch(`/penilaian?semester=${this.value}`)
        .then(res => res.text())
        .then(html => {

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newOptions = doc.querySelector('#id_pengajar');

            document.getElementById('id_pengajar').innerHTML = newOptions.innerHTML;
        });

});
</script>
@endsection
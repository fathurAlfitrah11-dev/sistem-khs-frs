@extends('layout.dosen_app')

@section('title','Penilaian')

@section('content')

<div class="p-6">

    {{-- FILTER --}}
    <div class="bg-[#4a4f73] p-6 rounded-xl mb-6 text-white" data-aos="fade-up" data-aos-delay="100">
        <h2 class="text-lg font-bold mb-4">
            Input Nilai Mahasiswa Pemrograman Web
        </h2>

        <form action="{{ url('/penilaian') }}" method="GET">
            <div class="grid grid-cols-2 xl:grid-cols-5 gap-4 items-end bg-[#3b3a5e] p-4 rounded-xl text-white">

                {{-- PROGRAM STUDI --}}
                <div class="flex flex-col gap-1 col-span-2 xl:col-span-1">
                    <label class="text-xs text-slate-300 font-medium">Program Studi</label>
                    <select name="id_prodi"
                        class="w-full px-2 py-1.5 text-sm rounded bg-white text-black border border-gray-300 focus:outline-none">
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
                        class="w-full px-2 py-1.5 text-sm rounded bg-white text-black border border-gray-300 focus:outline-none">
                        <option value="">Pilih Semester</option>
                        @for($i = 1; $i <= 8; $i++) <option value="{{ $i }}"
                            {{ request('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                            @endfor
                    </select>
                </div>

                {{-- SESI --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-slate-300 font-medium">Sesi</label>
                    <select name="sesi"
                        class="w-full px-2 py-1.5 text-sm rounded bg-white text-black border border-gray-300 focus:outline-none">
                        <option value="">Pilih Sesi</option>
                        <option value="Pagi" {{ request('sesi') == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                        <option value="Malam" {{ request('sesi') == 'Malam' ? 'selected' : '' }}>Malam</option>
                    </select>
                </div>

                {{-- KELAS --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-slate-300 font-medium">Kelas</label>
                    <select name="id_kelas"
                        class="w-full px-2 py-1.5 text-sm rounded bg-white text-black border border-gray-300 focus:outline-none">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ request('id_kelas') == $k->id_kelas ? 'selected' : '' }}>
                            {{ $k->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- TOMBOL CARI --}}
                <div class="col-span-2 xl:col-span-1">
                    <button type="submit"
                        class="w-full bg-[#f4a261] hover:bg-[#e76f51] text-white font-semibold text-sm px-4 py-2 rounded shadow transition-all duration-200">
                        Cari
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- TABLE INPUT NILAI --}}
    <form action="{{ url('/penilaian/simpan') }}" method="POST">
        @csrf
        <div class="bg-[#4a4f73] p-6 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="200">
            <div class="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-inner">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 text-slate-700 border-b border-slate-200">
                        <tr>
                            <th class="text-left px-5 py-3.5 font-semibold">NIM</th>
                            <th class="text-left px-5 py-3.5 font-semibold">Nama Mahasiswa</th>
                            <th class="text-center px-3 py-3.5 font-semibold">Partisipatif</th>
                            <th class="text-center px-3 py-3.5 font-semibold">Tugas</th>
                            <th class="text-center px-3 py-3.5 font-semibold">Proyek</th>
                            <th class="text-center px-3 py-3.5 font-semibold">Quiz</th>
                            <th class="text-center px-3 py-3.5 font-semibold">UTS</th>
                            <th class="text-center px-3 py-3.5 font-semibold">UAS</th>
                            <th class="text-center px-4 py-3.5 font-semibold bg-slate-100">NA</th>
                            <th class="text-center px-4 py-3.5 font-semibold bg-slate-100">NH</th>
                            <th class="text-left px-5 py-3.5 font-semibold">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($mahasiswa as $m)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="px-5 py-3.5 font-medium text-slate-700">{{ $m->nim }}</td>
                            <td class="px-5 py-3.5 font-medium text-slate-800">{{ $m->nama }}</td>

                            @php
                            // 1. Ambil data KRS pertama milik mahasiswa
                            $krsUtama = $m->krs->first() ?? null;

                            // 2. Ambil detail KRS pertama menggunakan relasi 'detail'
                            $krsDetail = $krsUtama ? $krsUtama->detail->first() : null;

                            // 3. Tentukan ID Detail. Jika detail KRS belum ada, gunakan id_mahasiswa sebagai cadangan
                            $id_detail = $krsDetail ? $krsDetail->id_krs_detail : $m->id_mahasiswa;

                            // 4. Ambil data KHS (Nilai)
                            $khsData = $krsDetail ? $krsDetail->khs : null;
                            @endphp

                            {{-- Input hidden ID detail --}}
                            <input type="hidden" name="krs_detail_id[]" value="{{ $id_detail }}">

                            <td class="px-2 py-3 text-center">
                                <input type="number" name="partisipatif[{{ $id_detail }}]"
                                    value="{{ $khsData->partisipatif ?? 0 }}" min="0" max="100"
                                    class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                            </td>
                            <td class="px-2 py-3 text-center">
                                <input type="number" name="tugas[{{ $id_detail }}]" value="{{ $khsData->tugas ?? 0 }}"
                                    min="0" max="100"
                                    class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                            </td>
                            <td class="px-2 py-3 text-center">
                                <input type="number" name="proyek[{{ $id_detail }}]" value="{{ $khsData->proyek ?? 0 }}"
                                    min="0" max="100"
                                    class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                            </td>
                            <td class="px-2 py-3 text-center">
                                <input type="number" name="quiz[{{ $id_detail }}]" value="{{ $khsData->quiz ?? 0 }}"
                                    min="0" max="100"
                                    class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 focus:outline-none transition-all">
                            </td>
                            <td class="px-2 py-3 text-center">
                                <input type="number" name="uts[{{ $id_detail }}]" value="{{ $khsData->uts ?? 0 }}"
                                    min="0" max="100"
                                    class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                            </td>
                            <td class="px-2 py-3 text-center">
                                <input type="number" name="uas[{{ $id_detail }}]" value="{{ $khsData->uas ?? 0 }}"
                                    min="0" max="100"
                                    class="w-14 h-9 bg-slate-50 border border-slate-200 rounded-lg text-center text-slate-800 font-medium focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                            </td>

                            <td class="px-4 py-3 text-center bg-slate-50/50">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-bold text-slate-700 bg-slate-200/60 rounded">
                                    {{ $khsData->na ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center bg-slate-50/50">
                                <span
                                    class="inline-block px-2.5 py-1 text-xs font-bold text-blue-600 bg-blue-50 rounded border border-blue-100">
                                    {{ $khsData->nh ?? '-' }}
                                </span>
                            </td>

                            <td class="px-5 py-3 text-black">
                                <input type="text" name="keterangan[{{ $id_detail }}]"
                                    value="{{ $khsData->keterangan ?? '' }}" placeholder="Tambahkan catatan..."
                                    class="w-full h-9 px-3 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-10 text-slate-400 bg-slate-50 font-medium">
                                Data mahasiswa tidak ditemukan atau silakan pilih filter terlebih dahulu.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div> {{-- ACTION BUTTON --}}
            <div class="flex justify-between items-center mt-6">
                <div class="text-sm text-slate-300 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Pastikan semua nilai sudah benar sebelum finalisasi.
                </div>

                <div class="flex gap-3">
                    @php
                    // Membaca status untuk mengunci tombol jika nilai sudah bersifat Final
                    $isFinal = isset($mahasiswa[0]->khs) && $mahasiswa[0]->khs->status === 'Final';
                    @endphp

                    {{-- TOMBOL SIMPAN DRAFT --}}
                    <button type="submit" name="action" value="draft" {{ $isFinal ? 'disabled' : '' }}
                        class="bg-orange-400 hover:bg-orange-500 disabled:bg-gray-500 disabled:cursor-not-allowed text-slate-900 px-5 py-2 rounded-xl font-semibold transition-all duration-150 shadow-md">
                        Simpan Draft
                    </button>

                    {{-- TOMBOL FINALISASI --}}
                    <button type="submit" name="action" value="final" {{ $isFinal ? 'disabled' : '' }}
                        onclick="return confirm('Apakah Anda yakin ingin melakukan finalisasi? Nilai yang sudah difinalisasi tidak akan dapat diubah kembali.')"
                        class="bg-emerald-500 hover:bg-emerald-600 disabled:bg-gray-600 disabled:cursor-not-allowed text-white px-5 py-2 rounded-xl font-bold transition-all duration-150 shadow-md">
                        Finalisasi Nilai
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
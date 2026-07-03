@extends('layout.dosen_app')

@section('title','Perwalian KRS')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">
        Perwalian KRS
    </h1>

    {{-- SEARCH --}}
    <div class="bg-[#4f547d] p-4 rounded-lg mb-6" data-aos="fade-up" data-aos-delay="200">

        <form method="GET" action="{{ url('/perwalian') }}">

            <div class="flex flex-col gap-3">

                {{-- SEARCH --}}
                <div class="flex items-center bg-white rounded px-3 py-2">
                    <input type="text"
                        placeholder="Cari Mahasiswa / NIM"
                        class="w-full outline-none text-sm text-gray-700">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>

                {{-- TAHUN AJARAN --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-slate-300 font-medium">
                        Tahun Ajaran
                    </label>

                    <select name="id_tahun_ajaran"
                        onchange="this.form.submit()"
                        class="w-full px-3 py-2 text-xs rounded bg-white text-black border">

                        <option value="">
                            -- Semua Tahun Ajaran --
                        </option>

                        @foreach($tahunAjaranList as $ta)
                            <option value="{{ $ta->id_tahun_ajaran }}"
                                {{ ($selectedTahun ?? null) == $ta->id_tahun_ajaran ? 'selected' : '' }}>

                                {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}
                                - {{ ucfirst($ta->semester) }}

                                @if($ta->status === 'aktif')
                                    (AKTIF)
                                @endif

                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

        </form>

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

                    @forelse($krs as $d)
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
                            {{-- Langsung cek status dari tabel KRS utama --}}
                            @if($d->status_wali == 'pending')
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
                                <a href="{{ route('perwalian.detail', $d->id_krs) }}"
                                    class="bg-orange-400 hover:bg-orange-300 text-black font-semibold text-xs px-4 py-1.5 rounded-lg shadow transition">
                                    Lihat KRS
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    {{-- TAMPILAN JIKA MAHASISWA BIMBINGAN PERWALIAN KOSONG --}}
                    <tr>
                        <td colspan="5" class="text-center py-10 text-slate-400 bg-slate-50 font-medium text-sm">
                            <i class="fa-solid fa-user-slash block text-gray-300 text-2xl mb-2"></i>
                            Data perwalian mahasiswa tidak ditemukan untuk dosen wali ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</div>

@endsection
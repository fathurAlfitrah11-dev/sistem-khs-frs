@extends('layout.dosen_app')

@section('title','Detail KRS Mahasiswa')

@section('content')

<div class="p-6 mt-16">

    {{-- HEADER MAHASISWA --}}
    <div class="bg-[#3b3f63] p-5 rounded-xl mb-6 text-white" data-aos="fade-up" data-aos-delay="100">
        <h2 class="text-xl font-bold">Detail KRS Mahasiswa</h2>

        <div class="mt-3 text-sm">
            <p><b>Nama:</b> Budi Santoso</p>
            <p><b>NIM:</b> 220001</p>
            <p><b>Kelas:</b> IF-2A</p>
            <p><b>Semester:</b> 3</p>
        </div>

        {{-- STATUS --}}
        <div class="mt-3">
            <span class="bg-yellow-400 text-black px-3 py-1 rounded text-xs font-semibold">
                Menunggu
            </span>
        </div>
    </div>

    {{-- FORM --}}
    <form>

        {{-- TABEL --}}
        <div class="bg-[#4a4f73] p-6 rounded-xl" data-aos="fade-up" data-aos-delay="200">

            <div class="bg-white rounded overflow-hidden">

                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left">Kode</th>
                            <th class="px-6 py-3 text-left">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left">SKS</th>
                            <th class="px-6 py-3 text-left">Kelas</th>
                            <th class="px-6 py-3 text-center">Keputusan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        {{-- DATA STATIS --}}
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

                                    {{-- RADIO SETUJUI --}}
                                    <label class="flex items-center gap-1 text-green-600">
                                        <input type="radio" name="status[{{ $d->id }}]" value="disetujui">
                                        Setujui
                                    </label>

                                    {{-- RADIO TOLAK --}}
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

<div class="mt-4 flex justify-between items-center text-white text-sm">

    {{-- TOTAL SKS --}}
    <div>
        Total SKS: <b>10</b>
    </div>

    {{-- BUTTON --}}
    <div class="flex gap-2">
        <button type="button" onclick="setAll('disetujui')"
            class="bg-green-500 hover:bg-green-400 text-white px-3 py-1 rounded text-xs">
            ✔ Setujui Semua
        </button>

        <button type="button" onclick="setAll('ditolak')"
            class="bg-red-500 hover:bg-red-400 text-white px-3 py-1 rounded text-xs">
            ✖ Tolak Semua
        </button>
    </div>

</div>
        </div>

        {{-- CATATAN --}}
        <div class="mt-6" data-aos="fade-up" data-aos-delay="300">
            <label class="text-white text-sm">Catatan Dosen</label>
            <textarea class="w-full mt-2 px-3 py-2 rounded text-black border border-gray-200"
                placeholder="Tambahkan catatan jika perlu..."></textarea>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-between mt-6" data-aos="fade-up" data-aos-delay="400">

            <a href="/perwalian"
                class="bg-gray-300 px-4 py-2 rounded text-black">
                ← Kembali
            </a>

            <button type="submit"
                class="bg-green-500 hover:bg-green-400 text-white px-4 py-2 rounded">
                Simpan Keputusan
            </button>

        </div>

    </form>

</div>
<script>
function setAll(status){
    const radios = document.querySelectorAll('input[type=radio]')

    radios.forEach(radio => {
        if(radio.value === status){
            radio.checked = true
        }
    })
}
</script>
@endsection
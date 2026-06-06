@extends('layout.app')

@section('title','KPS Penilaian')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">
        KPS Penilaian
    </h1>

    {{-- Search + Filter --}}
    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up"
        data-aos-delay="200">

        <div class="flex-1">

            <div class="flex items-center bg-white rounded px-3 py-2">

                <input type="text" placeholder="Cari Mata Kuliah..." class="w-full outline-none text-sm text-gray-700">

                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>

            </div>

        </div>
    </div>

    {{-- TABEL --}}
    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-3xl font-bold mb-6">
            Data Persentase Nilai
        </h2>

        <div class="bg-white overflow-hidden rounded-2xl">

            <table class="w-full border-collapse">

                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">Dosen</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Kelas</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Tugas</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Quiz</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">UTS</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">UAS</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Total</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Status</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @for($i=1;$i<=5;$i++) <tr
                        class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm"
                        data-aos="fade-up" data-aos-delay="{{ 350 + ($i*100) }}">

                        <td class="px-6 py-3 text-left font-medium break-words">
                            Pemrograman Web
                        </td>

                        <td class="px-6 py-3 text-left break-words">
                            Dosen {{ $i }}
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            IF{{ $i }}A
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            20%
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            10%
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            30%
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            40%
                        </td>

                        <td class="px-6 py-3 text-center font-bold text-green-600 whitespace-nowrap">
                            100%
                        </td>

                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Belum Dikunci
                            </span>
                        </td>

                        <td class="px-6 py-3">
                            <div class="flex justify-center">
                                <button onclick="openModal()"
                                    class="bg-orange-400 hover:bg-orange-300 px-4 py-1.5 rounded-lg text-black font-semibold text-xs shadow transition">
                                    Kunci
                                </button>
                            </div>
                        </td>

                        </tr>
                        @endfor
                </tbody>

            </table>

        </div>

    </div>
</div>

<script>
function openModal() {
    let modal = document.getElementById('kunciModal')
    let content = modal.querySelector('.modal-content') || modal.querySelector('div')

    modal.classList.remove('hidden')

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10')
        content.classList.add('opacity-100', 'translate-y-0')
    }, 10)
}

function closeModal() {
    let modal = document.getElementById('kunciModal')
    let content = modal.querySelector('.modal-content') || modal.querySelector('div')

    content.classList.remove('opacity-100', 'translate-y-0')
    content.classList.add('opacity-0', 'translate-y-10')

    setTimeout(() => {
        modal.classList.add('hidden')
    }, 300)
}
</script>

@endsection
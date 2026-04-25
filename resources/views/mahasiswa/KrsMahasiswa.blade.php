@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

    {{-- TABLE --}}
    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="100">

        <h2 class="text-white text-xl font-bold mb-4">Data Mata Kuliah</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>    
                        <th class="text-left px-6 py-3">Kode</th>
                        <th class="text-left px-6 py-3">Nama Mata Kuliah</th>
                        <th class="text-left px-6 py-3">Semester</th>
                        <th class="text-left px-6 py-3">SKS</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-3 text-black">IF101</td>
        <td class="px-6 py-3 text-black">Pemrograman Dasar</td>
        <td class="px-6 py-3 text-black">1</td>
        <td class="px-6 py-3 text-black">3</td>

        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

                    <button
                        onclick="openModal('tambahModal')"
                        class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-plus text-black"></i>
                    </button>

                {{-- DELETE --}}
                    <a href="#" onclick="return confirm('Yakin hapus?')"
                        class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full inline-block">
                        <i class="fa-solid fa-trash text-black"></i>
                    </a>

            </div>
        </td>
    </tr>

    <tr class="hover:bg-gray-50">
        <td class="px-6 py-3 text-black">IF102</td>
        <td class="px-6 py-3 text-black">Struktur Data</td>
        <td class="px-6 py-3 text-black">2</td>
        <td class="px-6 py-3 text-black">4</td>

        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

                    <button
                        onclick="openModal('tambahModal')"
                        class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-plus text-black"></i>
                    </button>

                {{-- DELETE --}}
                    <a href="#" onclick="return confirm('Yakin hapus?')"
                        class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full inline-block">
                        <i class="fa-solid fa-trash text-black"></i>
                    </a>
            </div>
        </td>
    </tr>
</tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-4 space-x-2">
            <button class="bg-orange-300 px-3 py-1 rounded">‹</button>
            <button class="bg-orange-300 px-3 py-1 rounded">1</button>
            <button class="bg-orange-300 px-3 py-1 rounded">2</button>
            <button class="bg-orange-300 px-3 py-1 rounded">3</button>
            <button class="bg-orange-300 px-3 py-1 rounded">›</button>
        </div>

    </div>
</div>

@endsection

@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

<div class="p-6 bg-gray-100 min-h-screen">

    <!-- Transkrip Akademik -->
    <div class="bg-[#3b3f63] rounded-2xl p-6 text-white mb-6" data-aos="fade-up" data-aos-delay="100">
        <h2 class="text-2xl font-semibold mb-4">Transkrip Akademik</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- IPK -->
            <div class="bg-white text-gray-800 rounded-xl p-4 shadow">
                <p class="text-sm">Akumulatif Nilai</p>
                <h3 class="text-3xl font-bold">3.99</h3>
                <p class="text-sm text-gray-500">Dari 4.00</p>
            </div>

            <!-- SKS -->
            <div class="bg-white text-gray-800 rounded-xl p-4 shadow">
                <p class="text-sm">Total SKS</p>
                <h3 class="text-3xl font-bold">90</h3>
            </div>

            <!-- Semester -->
            <div class="bg-white text-gray-800 rounded-xl p-4 shadow">
                <p class="text-sm">Semester Saat Ini</p>
                <h3 class="text-3xl font-bold">5</h3>
            </div>

        </div>
    </div>


    <!-- Pilih Semester Section -->
    <div class="grid md:grid-cols-3 gap-6 mb-6" data-aos="fade-up" data-aos-delay="300">

        <div class="bg-[#3b3f63] rounded-2xl p-6 text-white col-span-2">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">Pilih Semester</h2>

                <div class="flex gap-2">
                    <select class="text-gray-800 rounded-lg px-3 py-1">
                        <option>Semester 6</option>
                        <option>Semester 5</option>
                        <option>Semester 4</option>
                    </select>

                    <button class="bg-orange-400 hover:bg-orange-500 text-white px-4 py-1 rounded-lg">
                        Ekspor PDF
                    </button>
                </div>
            </div>


            <div class="grid grid-cols-2 gap-4" >

                <!-- IPK Semester -->
                <div class="bg-white text-gray-800 rounded-xl p-4 shadow">
                    <p class="text-sm">Nilai Per Semester</p>
                    <h3 class="text-3xl font-bold">3.99</h3>
                    <p class="text-sm text-gray-500">Dari 4.00</p>
                </div>

                <!-- SKS Semester -->
                <div class="bg-white text-gray-800 rounded-xl p-4 shadow">
                    <p class="text-sm">SKS di Ambil</p>
                    <h3 class="text-3xl font-bold">90</h3>
                </div>

            </div>

        </div>


        <!-- Grade Info -->
        <div class="bg-[#3b3f63] rounded-2xl p-6 text-white" data-aos="fade-up" data-aos-delay="400">
            <div class="grid grid-cols-2 gap-3 text-center">
                <div class="bg-white text-gray-800 rounded-lg py-2">A = 85-100</div>
                <div class="bg-white text-gray-800 rounded-lg py-2">B+ = 80-84</div>
                <div class="bg-white text-gray-800 rounded-lg py-2">B = 75-79</div>
                <div class="bg-white text-gray-800 rounded-lg py-2">C+ = 70-74</div>
                <div class="bg-white text-gray-800 rounded-lg py-2">C = 65-69</div>
                <div class="bg-white text-gray-800 rounded-lg py-2">D+ = 60-64</div>
                <div class="bg-white text-gray-800 rounded-lg py-2">D = 55-59</div>
                <div class="bg-white text-gray-800 rounded-lg py-2">E = 0-54</div>
            </div>
        </div>

    </div>


    <!-- Table Section -->
    <div class="bg-[#3b3f63] rounded-2xl p-6" data-aos="fade-up" data-aos-delay="500">

        <div class="overflow-x-auto bg-white rounded-xl">
            <table class="min-w-full text-left">

                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="px-4 text-black py-3">Kode</th>
                        <th class="px-4 text-black py-3">Mata kuliah</th>
                        <th class="px-4 text-black py-3">Dosen Pengajar</th>
                        <th class="px-4 text-black py-3">SKS</th>
                        <th class="px-4 text-black py-3">Nilai</th>
                        <th class="px-4 text-black py-3">Rata-rata</th>
                    </tr>
                </thead>

                <tbody>

                                        <tr class="border-b">
                        <td class="px-4 text-black py-2">IF202</td>
                        <td class="px-4 text-black py-2">Pemrograman Web</td>
                        <td class="px-4 text-black py-2">Ir. Zaid Hasbiya</td>
                        <td class="px-4 text-black py-2">2</td>
                        <td class="px-4 text-black py-2">100</td>
                        <td class="px-4 text-black py-2">3.99</td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 text-black">IF202</td>
                        <td class="px-4 py-2 text-black">Pemrograman Web</td>
                        <td class="px-4 py-2 text-black">Ir. Zaid Hasbiya</td>
                        <td class="px-4 py-2 text-black">4</td>
                        <td class="px-4 py-2 text-black">100</td>
                        <td class="px-4 py-2 text-black">3.99</td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 text-black">IF202</td>
                        <td class="px-4 py-2 text-black">Pemrograman Web</td>
                        <td class="px-4 py-2 text-black">Ir. Zaid Hasbiya</td>
                        <td class="px-4 py-2 text-black">2</td>
                        <td class="px-4 py-2 text-black">100</td>
                        <td class="px-4 py-2 text-black">3.99</td>
                    </tr>

                    <tr>
                        <td class="px-4 py-2 text-black">IF202</td>
                        <td class="px-4 py-2 text-black">Pemrograman Web</td>
                        <td class="px-4 py-2 text-black">Ir. Zaid Hasbiya</td>
                        <td class="px-4 py-2 text-black">2</td>
                        <td class="px-4 py-2 text-black">100</td>
                        <td class="px-4 py-2 text-black">3.00</td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection
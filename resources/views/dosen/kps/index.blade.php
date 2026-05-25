@extends('layout.app')

@section('title','KPS Penilaian')

@section('content')

<h1 class="text-2xl font-bold text-gray-800 mb-6"
    data-aos="fade-up"
    data-aos-delay="100">

    KPS Penilaian

</h1>

{{-- Search + Filter --}}
<div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6"
    data-aos="fade-up"
    data-aos-delay="200">

    <div class="flex-1">

        <div class="flex items-center bg-white rounded px-3 py-2">

            <input
                type="text"
                placeholder="Cari Mata Kuliah..."
                class="w-full outline-none text-sm text-gray-700">

            <i class="fa-solid fa-magnifying-glass text-gray-400"></i>

        </div>

    </div>

</div>


{{-- TABEL --}}
<div class="bg-[#3b3f63] rounded-xl p-6"
    data-aos="fade-up"
    data-aos-delay="300">

    <h2 class="text-white text-xl font-bold mb-4">

        Data Persentase Nilai

    </h2>

    <div class="bg-white overflow-hidden rounded-lg">

        <table class="w-full text-sm text-center">

            <thead class="bg-gray-100 border-b-4 border-gray-800">

                <tr>
                    <th class="text-black px-4 py-3">Mata Kuliah</th>
                    <th class="text-black px-4 py-3">Dosen</th>
                    <th class="text-black px-4 py-3">Kelas</th>
                    <th class="text-black px-4 py-3">Tugas</th>
                    <th class="text-black px-4 py-3">Quiz</th>
                    <th class="text-black px-4 py-3">UTS</th>
                    <th class="text-black px-4 py-3">UAS</th>
                    <th class="text-black px-4 py-3">Total</th>
                    <th class="text-black px-4 py-3">Status</th>
                    <th class="text-black px-4 py-3">Aksi</th>
                </tr>

            </thead>

            <tbody class="divide-y">

                @for($i=1;$i<=5;$i++)

                <tr class="hover:bg-gray-50"
                    data-aos="fade-up"
                    data-aos-delay="{{ 350 + ($i*100) }}">

                    <td class="px-4 py-3 text-black">
                        Pemrograman Web
                    </td>

                    <td class="px-4 py-3 text-black">
                        Dosen {{ $i }}
                    </td>

                    <td class="px-4 py-3 text-black">
                        IF{{ $i }}A
                    </td>

                    <td class="px-4 py-3 text-black">
                        20%
                    </td>

                    <td class="px-4 py-3 text-black">
                        10%
                    </td>

                    <td class="px-4 py-3 text-black">
                        30%
                    </td>

                    <td class="px-4 py-3 text-black">
                        40%
                    </td>

                    <td class="px-4 py-3 font-bold text-green-600">
                        100%
                    </td>

                    <td class="px-4 py-3">

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                            Belum Dikunci

                        </span>

                    </td>

                    <td class="px-4 py-3">

                        <button
                        onclick="openModal()"
                        class="bg-orange-400 hover:bg-orange-300 px-4 py-2 rounded-lg text-black font-semibold">

                            Kunci

                        </button>

                    </td>

                </tr>

                @endfor

            </tbody>

        </table>

    </div>

</div>


<script>

function openModal(){

let modal=document.getElementById('kunciModal')
let content=modal.querySelector('.modal-content')

modal.classList.remove('hidden')

setTimeout(()=>{

content.classList.remove(
'opacity-0',
'translate-y-10'
)

content.classList.add(
'opacity-100',
'translate-y-0'
)

},10)

}

function closeModal(){

let modal=document.getElementById('kunciModal')
let content=modal.querySelector('.modal-content')

content.classList.remove(
'opacity-100',
'translate-y-0'
)

content.classList.add(
'opacity-0',
'translate-y-10'
)

setTimeout(()=>{

modal.classList.add('hidden')

},300)

}

</script>

@endsection
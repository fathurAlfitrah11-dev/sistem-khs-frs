@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    {{ session('error') }}
</div>
@endif

    {{-- SEARCH + BUTTON --}}
    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="100">

        <div class="flex-1 mr-4">
            <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input type="text" placeholder="Telusuri Mata Kuliah" class="w-full outline-none text-sm text-gray-700">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="200"> 
        <h2 class="text-white text-xl font-bold mb-4">Data Mata Kuliah</h2>
        <a href="https://polibatam.id/jadwalperkuliahansemestergenap2526" class="bg-green-400 hover:bg-green-300 text-white font-semibold px-4 py-2 rounded-lg mb-4 inline-block">
            Jadwal Perkuliahan
        </a>

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
                    @foreach($matakuliah as $mk)
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-3 text-black">{{ $mk->kode_mk }}</td>
        <td class="px-6 py-3 text-black">{{ $mk->nama_mk }}</td>
        <td class="px-6 py-3 text-black">{{ $mk->semester}}</td>
        <td class="px-6 py-3 text-black">{{ $mk->sks }}</td>

        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

    <form action="/mahasiswa/tambah-krs/{{ $mk->id_mata_kuliah }}"
    method="POST">

        @csrf

        <button
onclick="openConfirm(
'{{ $mk->kode_mk }}',
'{{ $mk->nama_mk }}',
'{{ $mk->sks }}',
'{{ $mk->id_mata_kuliah }}'
)"
class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">

+ Tambah Mata Kuliah

</button>

    </form>

            </div>
        </td>
    </tr>
    @endforeach
</tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-4 space-x-2">
    {{ $matakuliah->links() }}
        </div>

    </div>
<div id="confirmModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#3b3f63] w-full max-w-md rounded-xl p-6 text-white shadow-lg opacity-0 transform translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4 text-center">Konfirmasi Mata Kuliah</h2>

        <div class="bg-[#4a4f73] p-4 rounded mb-4 text-sm">
            <p><b>Kode:</b> <span id="c_kode"></span></p>
            <p><b>Nama:</b> <span id="c_nama"></span></p>
            <p><b>SKS:</b> <span id="c_sks"></span></p>
        </div>

        <p class="text-gray-300 text-sm text-center mb-5">
            Pastikan mata kuliah yang dipilih sudah benar.
        </p>

        <div class="flex justify-center gap-3">

            <button onclick="closeConfirm()"
                class="bg-gray-400 hover:bg-gray-300 text-black px-4 py-2 rounded">
                Batal
            </button>

            <button onclick="submitKRS()"
                class="bg-orange-400 hover:bg-orange-300 text-black px-4 py-2 rounded font-semibold">
                Ya, Ambil
            </button>

        </div>

    </div>
</div>
</div>
<script>
let selectedMK = {}

function openConfirm(kode,nama,sks,id){

    selectedMK={
        kode,
        nama,
        sks,
        id
    }

    document.getElementById('c_kode').innerText=kode
    document.getElementById('c_nama').innerText=nama
    document.getElementById('c_sks').innerText=sks

    document
    .getElementById('confirmModal')
    .classList.remove('hidden')

    setTimeout(()=>{

        let modal=document.querySelector(
            '#confirmModal .opacity-0'
        )

        modal.classList.remove('opacity-0')
        modal.classList.remove('translate-y-10')

    },10)
}

function closeConfirm(){

    document
    .getElementById('confirmModal')
    .classList.add('hidden')
}

function submitKRS(){

    let form=document.createElement('form')

    form.method='POST'

    form.action='/mahasiswa/tambah-krs/'+selectedMK.id

    let csrf=document.createElement('input')

    csrf.type='hidden'
    csrf.name='_token'
    csrf.value='{{ csrf_token() }}'
    form.appendChild(csrf)

    document.body.appendChild(form)

    form.submit()
}
</script>
@endsection
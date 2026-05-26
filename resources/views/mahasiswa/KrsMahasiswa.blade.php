@extends('layout.mahasiswa_app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

@php
$totalSks = 0;

foreach($krs as $k){
    foreach($k->detail as $item){
        $totalSks += $item->pengajar->mataKuliah->sks ?? 0;
    }
}

$maxSks = 20;
@endphp

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
                        <th class="text-left px-6 py-3">Status</th>
                        <th class="text-left px-6 py-3">SKS</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

@foreach($krs as $k)

    @foreach($k->detail as $item)

    <tr class="hover:bg-gray-50">

        <td class="px-6 py-3 text-black">
            {{ $item->pengajar->mataKuliah->kode_mk }}
        </td>

        <td class="px-6 py-3 text-black">
            {{ $item->pengajar->mataKuliah->nama_mk }}
        </td>

        <td class="px-6 py-3 text-black">
            {{ $item->pengajar->mataKuliah->semester }}
        </td>

        <td class="px-6 py-3 text-black">
            {{ $item->status_wali }}
        </td>

        <td class="px-6 py-3 text-black">
            {{ $item->pengajar->mataKuliah->sks }}
        </td>

        <td class="px-6 py-3 text-center">

            @if($item->status_wali == 'pending')

                <form action="/mahasiswa/krs/hapus/{{ $item->id_krs_detail }}"
                    method="POST"
                    class="inline">

                    @csrf
                    @method('DELETE')

                    <button
                    type="button"
                    onclick="openDelete(
                    '{{ $item->pengajar->mataKuliah->kode_mk }}',
                    '{{ $item->pengajar->mataKuliah->nama_mk }}',
                    '{{ $item->id_krs_detail }}'
                    )"
                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full">

                    <i class="fa-solid fa-trash text-black"></i>

                    </button>

                </form>

            @endif

        </td>

    </tr>

    @endforeach

@endforeach

</tbody>
            </table>

        </div>
            {{-- INFO SKS --}}
            <div class="mt-4 flex justify-between items-center text-white text-sm">

                <div>
                    Total SKS: <b id="totalSks">{{ $totalSks }}</b>
                </div>

                <div class="text-gray-300">
                    Maksimal SKS: <b>{{$maxSks}}</b>
                </div>

            </div>

            {{-- WARNING --}}
            @if($totalSks >= $maxSks)

                <div class="mt-2 text-yellow-400 text-sm">
                    Batas maksimum SKS sudah tercapai ({{ $maxSks }} SKS)
                </div>

            @endif

    </div>
</div>
 <div id="deleteModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#3b3f63] w-full max-w-md rounded-xl p-6 text-white shadow-lg opacity-0 transform translate-y-10 transition-all duration-300">

    <h2 class="text-lg font-bold mb-4 text-center">
    Batalkan Mata Kuliah
    </h2>

        <div class="bg-[#4a4f73] p-4 rounded mb-4 text-sm">

        <p>
        <b>Kode:</b>
        <span id="d_kode"></span>
        </p>

        <p>
        <b>Nama:</b>
        <span id="d_nama"></span>
        </p>

        </div>

        <p class="text-gray-300 text-sm text-center mb-5">
        Mata kuliah ini akan dihapus dari KRS kamu.
        </p>

            <div class="flex justify-center gap-3">

            <button
            onclick="closeDelete()"
            class="bg-gray-400 hover:bg-gray-300 text-black px-4 py-2 rounded">

            Batal

            </button>

            <button
            onclick="confirmDelete()"
            class="bg-red-500 hover:bg-red-400 text-white px-4 py-2 rounded font-semibold">

            Ya, Hapus

            </button>

            </div>

        </div>

    </div>
</div>
<script>

let deleteData={}

function openDelete(kode,nama,id){

    deleteData={
        kode,
        nama,
        id
    }

    document.getElementById(
        'd_kode'
    ).innerText=kode

    document.getElementById(
        'd_nama'
    ).innerText=nama

    document
    .getElementById(
        'deleteModal'
    )
    .classList.remove(
        'hidden'
    )

    setTimeout(()=>{

        let modal=document.querySelector(
            '#deleteModal .opacity-0'
        )

        modal.classList.remove(
            'opacity-0'
        )

        modal.classList.remove(
            'translate-y-10'
        )

    },10)
}

function closeDelete(){

    document
    .getElementById(
        'deleteModal'
    )
    .classList.add(
        'hidden'
    )
}

function confirmDelete(){

    let form=document.createElement(
        'form'
    )

    form.method='POST'

    form.action=
    '/mahasiswa/krs/hapus/'
    +deleteData.id

    let csrf=document.createElement(
        'input'
    )

    csrf.type='hidden'
    csrf.name='_token'
    csrf.value=
    '{{ csrf_token() }}'

    form.appendChild(csrf)

    let method=document.createElement(
        'input'
    )

    method.type='hidden'
    method.name='_method'
    method.value='DELETE'

    form.appendChild(method)

    document.body.appendChild(
        form
    )

    form.submit()
}
</script>
@endsection

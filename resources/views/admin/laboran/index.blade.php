@extends('layout.app')

@section('title','Data Laboran')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6"
        data-aos="fade-up"
        data-aos-delay="100">

        Data Laboran

    </h1>

    {{-- Search + Button --}}
    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6"
        data-aos="fade-up"
        data-aos-delay="200">

        <div class="flex-1 mr-4">

            <div class="flex items-center bg-white rounded px-3 py-2">

                <input
                    type="text"
                    placeholder="Telusuri Laboran"
                    class="w-full outline-none text-sm text-gray-700">

                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>

            </div>

        </div>

        <button
            onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">

            + Tambah Laboran

        </button>

    </div>


    {{-- TABEL --}}
    <div class="bg-[#3b3f63] rounded-xl p-6"
        data-aos="fade-up"
        data-aos-delay="300">

        <h2 class="text-white text-xl font-bold mb-4">

            Data Laboran

        </h2>

        <div class="bg-white overflow-hidden rounded-lg">

            <table class="w-full text-sm text-center">

                <thead class="bg-gray-100 border-b-4 border-gray-800">

                    <tr>

                        <th class="text-black px-6 py-3">
                            NIK
                        </th>

                        <th class="text-black px-6 py-3">
                            Nama Laboran
                        </th>

                        <th class="text-black px-6 py-3">
                            Kode Laboran
                        </th>

                        <th class="text-black px-6 py-3">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @for($i=1;$i<=5;$i++)

                    <tr class="hover:bg-gray-50"
                        data-aos="fade-up"
                        data-aos-delay="{{ 350 + ($i*100) }}">

                        <td class="px-6 py-3 text-black">

                            2210{{ $i }}

                        </td>

                        <td class="px-6 py-3 text-black">

                            Laboran {{ $i }}

                        </td>

                        <td class="px-6 py-3 text-black">

                            LAB00{{ $i }}

                        </td>

                        <td class="px-6 py-3">

                            <div class="flex justify-center gap-2">

                                {{-- DETAIL --}}
                                <button
                                    onclick="openDetail(
                                    '2210{{ $i }}',
                                    'Laboran {{ $i }}',
                                    'LAB00{{ $i }}'
                                    )"

                                    class="w-8 h-8 bg-orange-400 rounded-full">

                                    <i class="fa-solid fa-eye text-black"></i>

                                </button>


                                {{-- EDIT --}}
                                <button
                                    onclick="openEdit(
                                    '{{ $i }}',
                                    '2210{{ $i }}',
                                    'Laboran {{ $i }}',
                                    'LAB00{{ $i }}'
                                    )"

                                    class="w-8 h-8 bg-orange-400 rounded-full">

                                    <i class="fa-solid fa-pen text-black"></i>

                                </button>


                                {{-- DELETE --}}
                                <button
                                    class="w-8 h-8 bg-orange-400 rounded-full">

                                    <i class="fa-solid fa-trash text-black"></i>

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


{{-- MODAL TAMBAH --}}
<div id="tambahModal"
class="hidden fixed inset-0 bg-black/40 flex justify-center items-center z-50">

<div class="modal-content bg-[#5a5f86] p-8 rounded-xl max-w-3xl w-full text-white opacity-0 translate-y-10 transition-all">

<h2 class="font-bold text-lg mb-4">

Tambah Laboran

</h2>

<form>

<label>NIK</label>

<input type="text"
class="w-full mb-3 px-3 py-2 rounded text-black">

<label>Nama Laboran</label>

<input type="text"
class="w-full mb-3 px-3 py-2 rounded text-black">

<label>Kode Laboran</label>

<input type="text"
class="w-full mb-3 px-3 py-2 rounded text-black">

<label>Password</label>

<input type="password"
class="w-full mb-3 px-3 py-2 rounded text-black">

<div class="flex justify-end gap-2">

<button
type="button"
onclick="closeModal('tambahModal')"
class="bg-gray-300 text-black px-3 py-1 rounded">

Batal

</button>

<button
class="bg-blue-600 px-3 py-1 rounded">

Simpan

</button>

</div>

</form>

</div>

</div>


{{-- MODAL EDIT --}}
<div id="editModal"
class="hidden fixed inset-0 bg-black/40 flex justify-center items-center z-50">

<div class="modal-content bg-[#5a5f86] p-8 rounded-xl max-w-3xl w-full text-white opacity-0 translate-y-10 transition-all">

<h2 class="font-bold text-lg mb-4">

Ubah Laboran

</h2>

<form>

<label>NIK</label>

<input id="editNik"
readonly
class="w-full mb-3 px-3 py-2 rounded text-black">

<label>Nama Laboran</label>

<input id="editNama"
class="w-full mb-3 px-3 py-2 rounded text-black">

<label>Kode Laboran</label>

<input id="editKode"
class="w-full mb-3 px-3 py-2 rounded text-black">

<label>Password Baru</label>

<input
type="password"
placeholder="Kosongkan jika tidak diubah"
class="w-full mb-3 px-3 py-2 rounded text-black">

<div class="flex justify-end gap-2">

<button
type="button"
onclick="closeModal('editModal')"
class="bg-gray-300 text-black px-3 py-1 rounded">

Batal

</button>

<button
class="bg-yellow-500 px-3 py-1 rounded">

Update

</button>

</div>

</form>

</div>

</div>


{{-- MODAL DETAIL --}}
<div id="detailModal"
class="hidden fixed inset-0 bg-black/40 flex justify-center items-center z-50">

<div class="modal-content bg-[#5a5f86] p-8 rounded-xl max-w-2xl w-full text-white opacity-0 translate-y-10 transition-all">

<h2 class="font-bold text-lg mb-4">

Detail Laboran

</h2>

<label>NIK</label>
<p id="detailNik"
class="bg-white text-black px-3 py-2 rounded mb-3"></p>

<label>Nama Laboran</label>
<p id="detailNama"
class="bg-white text-black px-3 py-2 rounded mb-3"></p>

<label>Kode Laboran</label>
<p id="detailKode"
class="bg-white text-black px-3 py-2 rounded"></p>

<div class="flex justify-end mt-4">

<button
onclick="closeModal('detailModal')"
class="bg-gray-300 text-black px-3 py-1 rounded">

Tutup

</button>

</div>

</div>

</div>


<script>

function showModal(id){

let modal=document.getElementById(id)
let content=modal.querySelector('.modal-content')

modal.classList.remove('hidden')

setTimeout(()=>{

content.classList.remove('opacity-0','translate-y-10')
content.classList.add('opacity-100','translate-y-0')

},10)

}

function hideModal(id){

let modal=document.getElementById(id)
let content=modal.querySelector('.modal-content')

content.classList.remove('opacity-100','translate-y-0')
content.classList.add('opacity-0','translate-y-10')

setTimeout(()=>{

modal.classList.add('hidden')

},300)

}

function openModal(id){
showModal(id)
}

function closeModal(id){
hideModal(id)
}

function openEdit(id,nik,nama,kode){

showModal('editModal')

document.getElementById('editNik').value=nik
document.getElementById('editNama').value=nama
document.getElementById('editKode').value=kode

}

function openDetail(nik,nama,kode){

showModal('detailModal')

document.getElementById('detailNik').innerText=nik
document.getElementById('detailNama').innerText=nama
document.getElementById('detailKode').innerText=kode

}

</script>

@endsection
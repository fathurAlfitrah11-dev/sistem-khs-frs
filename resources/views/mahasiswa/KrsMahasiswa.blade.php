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
                        <th class="text-left px-6 py-3">Status</th>
                        <th class="text-left px-6 py-3">SKS</th>
                        <th class="text-center px-6 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
    <tr class="hover:bg-gray-50">
        <td class="px-6 py-3 text-black">IF101</td>
        <td class="px-6 py-3 text-black">Pemrograman Dasar</td>
        <td class="px-6 py-3 text-black">1</td>
        <td class="px-6 py-3 text-yellow-400">Menunggu</td>
        <td class="px-6 py-3 text-black">3</td>

        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

                {{-- DELETE --}}
                <a href="#"
                    onclick="openDelete('IF101','Pemrograman Dasar')"
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
        <td class="px-6 py-3 text-yellow-400">Menunggu</td>
        <td class="px-6 py-3 text-black">4</td>

        <td class="px-6 py-3 text-center">
            <div class="flex justify-center gap-2">

                {{-- DELETE --}}
                <a href="#"
                    onclick="openDelete('IF102','Struktur Data')"
                    class="w-8 h-8 bg-orange-400 hover:bg-orange-300 p-2 rounded-full inline-block">
                    <i class="fa-solid fa-trash text-black"></i>
                </a>
            </div>
        </td>
    </tr>
</tbody>
            </table>

        </div>
            {{-- INFO SKS --}}
            <div class="mt-4 flex justify-between items-center text-white text-sm">

                <div>
                    Total SKS: <b id="totalSks">7</b>
                </div>

                <div class="text-gray-300">
                    Maksimal SKS: <b>24</b>
                </div>

            </div>

            {{-- WARNING --}}
            <div id="sksWarning" class="mt-2 text-red-400 text-sm hidden">
                Total SKS melebihi batas maksimal!
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
 <div id="deleteModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#3b3f63] w-full max-w-md rounded-xl p-6 text-white shadow-lg opacity-0 transform translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-4 text-center">Batalkan Mata Kuliah</h2>

        <div class="bg-[#4a4f73] p-4 rounded mb-4 text-sm">
            <p><b>Kode:</b> <span id="d_kode"></span></p>
            <p><b>Nama:</b> <span id="d_nama"></span></p>
        </div>

        <p class="text-gray-300 text-sm text-center mb-5">
            Mata kuliah ini akan dihapus dari KRS kamu.
        </p>

        <div class="flex justify-center gap-3">

            <button onclick="closeDelete()"
                class="bg-gray-400 hover:bg-gray-300 text-black px-4 py-2 rounded">
                Batal
            </button>

            <button onclick="confirmDelete()"
                class="bg-red-500 hover:bg-red-400 text-white px-4 py-2 rounded font-semibold">
                Ya, Hapus
            </button>

        </div>

    </div>
</div>
<script>
let deleteData = {}

function openDelete(kode, nama){
    deleteData = {kode, nama}

    document.getElementById('d_kode').innerText = kode
    document.getElementById('d_nama').innerText = nama

    document.getElementById('deleteModal').classList.remove('hidden')
    // Trigger the transition effect
    setTimeout(() => {
        document.querySelector('#deleteModal .opacity-0').classList.remove('opacity-0')
        document.querySelector('#deleteModal .translate-y-10').classList.remove('translate-y-10')
    }, 10)
}

function closeDelete(){
    document.getElementById('deleteModal').classList.add('hidden')
}

function confirmDelete(){
    alert("Matakuliah " + deleteData.nama + " dihapus (dummy)")

    closeDelete()
}

function updateSKS(){
    // dummy ambil dari table (hardcode dulu karena lu masih statis)
    let sks = [3,4] // ambil dari data lu
    let total = sks.reduce((a,b)=>a+b,0)

    document.getElementById('totalSks').innerText = total

    let max = 24

    if(total > max){
        document.getElementById('sksWarning').classList.remove('hidden')
    }else{
        document.getElementById('sksWarning').classList.add('hidden')
    }
}

// jalanin saat load
updateSKS()
</script>
@endsection

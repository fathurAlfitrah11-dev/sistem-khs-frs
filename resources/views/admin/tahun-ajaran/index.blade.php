@extends('layout.app')

@section('title','Data Tahun Ajaran')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up" data-aos-delay="100">Data Tahun Ajaran</h1>

    <div class="bg-[#3b3f63] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="200">
        
      <div class="flex-1 mr-4">
    <div class="flex items-center bg-white rounded px-3 py-2 w-full">
        <input type="text" placeholder="Telusuri Tahun Ajaran"
            class="w-full outline-none text-sm text-gray-700">
        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
    </div>
</div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Tahun Ajaran
        </button>
    </div>

    <div class="bg-[#3b3f63] rounded-xl p-6" data-aos="fade-up" data-aos-delay="300">

        <h2 class="text-white text-xl font-bold mb-4">Data Tahun Ajaran</h2>

        <div class="bg-white overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700 border-b-4 border-gray-800">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Tahun Ajaran</th>
                        <th class="px-6 py-3 text-center">Semester</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    
                    {{-- DATA STATIS --}}
                    @php
                        $tahun = [
                            ["id"=>1,"tahun"=>"2023/2024","semester"=>"Ganjil","status"=>"Aktif"],
                            ["id"=>2,"tahun"=>"2023/2024","semester"=>"Genap","status"=>"Nonaktif"],
                            ["id"=>3,"tahun"=>"2024/2025","semester"=>"Ganjil","status"=>"Nonaktif"],
                        ];
                    @endphp

                    @foreach($tahun as $t)
                    <tr class="hover:bg-gray-50 text-black">
                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $t['tahun'] }}</td>
                        <td class="px-6 py-3 text-center">{{ $t['semester'] }}</td>
                        <td class="px-6 py-3 text-center">
                            <span class="{{ $t['status']=='Aktif' ? 'text-green-600 font-bold' : 'text-gray-500' }}">
                                {{ $t['status'] }}
                            </span>
                        </td>

                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center gap-2">

                                <button 
    data-tahun="{{ $t['tahun'] }}"
    data-semester="{{ $t['semester'] }}"
    data-status="{{ $t['status'] }}"
    onclick="openDetail(this)"
    class="w-8 h-8 flex items-center justify-center bg-orange-400 rounded-full">
    <i class="fa-solid fa-eye"></i>
</button>

<button 
    data-id="{{ $t['id'] }}"
    data-tahun="{{ $t['tahun'] }}"
    data-semester="{{ $t['semester'] }}"
    data-status="{{ $t['status'] }}"
    onclick="openEdit(this)"
    class="w-8 h-8 flex items-center justify-center bg-orange-400 rounded-full">
    <i class="fa-solid fa-pen"></i>
</button>

                                <button class="w-8 h-8 flex items-center justify-center bg-orange-400 rounded-full">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <div class="flex justify-end mt-4 space-x-2">
            <button class="bg-orange-300 px-3 py-1 rounded">‹</button>
            <button class="bg-orange-300 px-3 py-1 rounded">1</button>
            <button class="bg-orange-300 px-3 py-1 rounded">2</button>
            <button class="bg-orange-300 px-3 py-1 rounded">3</button>
            <button class="bg-orange-300 px-3 py-1 rounded">›</button>
        </div>
    </div>
</div>
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">

    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="mb-4 font-bold">Tambah Tahun Ajaran</h2>

        <label class="block text-sm mb-1">Tahun Awal</label>
<input type="number" id="tahunAwal"
    class="w-full mb-3 px-3 py-2 text-black rounded"
    placeholder="2026">

<label class="block text-sm mb-1">Tahun Akhir</label>
<input type="number" id="tahunAkhir"
    class="w-full mb-3 px-3 py-2 text-black rounded"
    placeholder="2027">

    <label class="block text-sm mb-1">Semester</label>
        <select class="w-full mb-3 px-3 py-2 text-black rounded">
            <option>Ganjil</option>
            <option>Genap</option>
        </select>

        <select class="w-full mb-3 px-3 py-2 text-black rounded">
            <option>Aktif</option>
            <option>Nonaktif</option>
        </select>

        <div class="flex justify-end gap-2">
            <button onclick="closeModal('tambahModal')" class="bg-gray-300 px-3 py-1 rounded">Batal</button>
            <button class="bg-blue-600 px-3 py-1 rounded">Simpan</button>
        </div>
    </div>

</div>
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 modal-content transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="mb-4 font-bold">Edit Tahun Ajaran</h2>

        <label class="block text-sm mb-1">Tahun Awal</label>
        <input type="number" id="editTahunAwal" class="w-full mb-3 px-3 py-2 text-black rounded">

        <label class="block text-sm mb-1">Tahun Akhir</label>
        <input type="number" id="editTahunAkhir" class="w-full mb-3 px-3 py-2 text-black rounded">

        <label class="block text-sm mb-1">Semester</label>
        <select id="editSemester" class="w-full mb-3 px-3 py-2 text-black rounded">
            <option>Ganjil</option>
            <option>Genap</option>
        </select>

        <select id="editStatus" class="w-full mb-3 px-3 py-2 text-black rounded">
            <option>Aktif</option>
            <option>Nonaktif</option>
        </select>

        <div class="flex justify-end">
            <button onclick="closeModal('editModal')" class="bg-gray-300 px-3 py-1 rounded">Tutup</button>
        </div>

    </div>
</div>


<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">
    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="mb-4 font-bold">Detail</h2>
        <div class="space-y-3">
        <label class="text-sm">Tahun Ajaran</label>
        <p id="dTahun" class="bg-white text-black px-3 py-2 rounded"></p>
        <label class="text-sm">Semester</label>
        <p id="dSemester" class="bg-white text-black px-3 py-2 rounded"></p>
        <label class="text-sm">Status</label>
        <p id="dStatus" class="bg-white text-black px-3 py-2 rounded"></p>
        </div>

        <button onclick="closeModal('detailModal')" class="mt-4 bg-gray-300 px-3 py-1 rounded">Tutup</button>

    </div>
</div>
<script>
// ===== MODAL ANIMATION =====
function showModal(id){
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    modal.classList.remove('hidden')

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10')
        content.classList.add('opacity-100', 'translate-y-0')
    }, 10)
}

function hideModal(id){
    const modal = document.getElementById(id)
    const content = modal.querySelector('.modal-content')

    content.classList.remove('opacity-100', 'translate-y-0')
    content.classList.add('opacity-0', 'translate-y-10')

    setTimeout(() => {
        modal.classList.add('hidden')
    }, 300)
}

// ===== OPEN CLOSE =====
function openModal(id){
    showModal(id)
}

function closeModal(id){
    hideModal(id)
}

// ===== EDIT =====
function openEdit(el){
    openModal('editModal')

    let tahun = el.dataset.tahun.split('/')

    document.getElementById('editTahunAwal').value = tahun[0]
    document.getElementById('editTahunAkhir').value = tahun[1]
    document.getElementById('editSemester').value = el.dataset.semester
    document.getElementById('editStatus').value = el.dataset.status
}

// ===== DETAIL =====
function openDetail(el){
    openModal('detailModal')

    document.getElementById('dTahun').innerText = el.dataset.tahun
    document.getElementById('dSemester').innerText = el.dataset.semester
    document.getElementById('dStatus').innerText = el.dataset.status
}

// ===== GENERATE TAHUN (DINAMIS) =====
function setupTahun(awalId, akhirId, hasilId){
    const awal = document.getElementById(awalId)
    const akhir = document.getElementById(akhirId)
    const hasil = document.getElementById(hasilId)

    function generate(){
        if(awal.value && akhir.value){
            hasil.value = awal.value + '/' + akhir.value
        }
    }

    awal.addEventListener('input', generate)
    akhir.addEventListener('input', generate)
}

// ===== INIT =====
// untuk tambah
setupTahun('tahunAwal', 'tahunAkhir', 'hasilTahun')

// untuk edit
setupTahun('editTahunAwal', 'editTahunAkhir', 'editHasilTahun')

</script>
@endsection
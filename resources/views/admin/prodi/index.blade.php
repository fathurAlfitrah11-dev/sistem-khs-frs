@extends('layout.app')

@section('title','Data Program Studi')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6"
        data-aos="fade-up" data-aos-delay="100">
        Data Program Studi
    </h1>

    <div class="bg-[#4f547d] p-4 rounded-lg flex justify-between items-center mb-6" data-aos="fade-up" data-aos-delay="100">

        <div class="flex-1 mr-4">
            <form method="GET" action="/prodi">
                <div class="flex items-center bg-white rounded px-3 py-2 w-full">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Telusuri Program Studi"
                    class="w-full outline-none text-sm text-gray-700">

                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </form>
        </div>

        <button onclick="openModal('tambahModal')"
            class="bg-orange-400 hover:bg-orange-300 text-black font-semibold px-4 py-2 rounded-lg">
            + Tambah Program Studi
        </button>
    </div>

    <div class="bg-[#4f547d] rounded-3xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">

        <h2 class="text-white text-3xl font-bold mb-6">Data Program Studi</h2>

        <div class="bg-white rounded-2xl overflow-hidden">

            <table class="w-full border-collapse">
                <thead class="bg-[#f5f6fa] border-b border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left text-[#243b63] font-bold text-sm">No</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Jenjang</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Program Studi</th>
                        <th class="px-6 py-3 text-center text-[#243b63] font-bold text-sm">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors text-gray-800 text-xs md:text-sm">
                        <td class="px-7 py-3 text-left whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">{{ $d->jenjang }}</td>
                        <td class="px-6 py-3 text-center break-words">{{ $d->nama_prodi }}</td>

                        <td class="px-6 py-3">
                            <div class="flex justify-center gap-3">

                                {{-- VIEW --}}
                               <button onclick="openDetail('{{ $d->jenjang }}','{{ $d->nama_prodi }}')"
                                    class="w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye text-blue-600 text-xs"></i>
                                </button>

                                {{-- EDIT --}}
                                <button onclick="openEdit('{{ $d->id_prodi }}', '{{ $d->jenjang }}', '{{ $d->nama_prodi }}')"
                                    class="w-8 h-8 rounded-full bg-yellow-100 hover:bg-yellow-200 flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen text-yellow-600 text-xs"></i>
                                </button>

                                {{-- DELETE --}}
                                <a href="/kelas/delete/{{ $d->id_prodi }}" onclick="return confirm('Yakin hapus?')"
                                    class="w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 flex items-center justify-center transition inline-flex">
                                    <i class="fa-solid fa-trash text-red-600 text-xs"></i>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 text-sm">Data Program Studi tidak ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-end mt-5 list-none">
            <div class="bg-white p-1 rounded-xl shadow-xs list-none">
                @if(method_exists($data, 'links'))
                    <div class="laravel-pagination-container">
                        {{ $data->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="flex space-x-1 text-xs font-semibold p-1">
                        <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">‹</button>
                        <button class="bg-blue-600 text-white px-3 py-1.5 rounded-lg">1</button>
                        <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">2</button>
                        <button class="bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg text-gray-700">›</button>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="tambahModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Tambah Program Studi</h2>

        <form action="/prodi/store" method="POST">
            @csrf
            <label class="text-sm mb-1 block">Jenjang</label>
            <select name="jenjang" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Jenjang</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S2">S2</option>
            </select>

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="nama_prodi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="">Pilih Program Studi</option>
                <option value="IF">Teknik Informatika</option>
                <option value="TRPL">Teknik Rekayasa Perangkat Lunak</option>
                <option value="GM">Teknologi Geomatika</option>
                <option value="TP">Teknologi Permainan</option>
                <option value="TRM">Teknologi Rekayasa Multimedia</option>
                <option value="RKS">Rekayasa Keamanan Siber</option>
            </select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('tambahModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                    Batal
                </button>

                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-4xl rounded-xl p-8 text-white relative modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Ubah Program Studi</h2>

        <form id="formEdit" method="POST">
            @csrf

            <label class="text-sm mb-1 block">Jenjang</label>
            <select name="jenjang" id="editJenjang" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S2">S2</option>
            </select>

            <label class="text-sm mb-1 block">Program Studi</label>
            <select name="nama_prodi" id="editProdi" class="w-full mb-3 px-3 py-2 border rounded text-black">
                <option value="IF">Teknik Informatika</option>
                <option value="TRPL">Teknik Rekayasa Perangkat Lunak</option>
                <option value="GM">Teknologi Geomatika</option>
                <option value="TP">Teknologi Permainan</option>
                <option value="TRM">Teknologi Rekayasa Multimedia</option>
                <option value="RKS">Rekayasa Keamanan Siber</option>
            </select>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                    Batal
                </button>

                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-2xl rounded-xl p-6 text-white modal-content transform opacity-0 translate-y-10 transition-all duration-300">
        <h2 class="text-lg font-bold mb-4">Detail Program Studi</h2>

        <div class="space-y-3">
            <div>
                <label class="text-sm">Jenjang</label>
                <p id="detailJenjang" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>
            <div>
                <label class="text-sm">Program Studi</label>
                <p id="detailNamaProdi" class="bg-white text-black px-3 py-2 rounded"></p>
            </div>

        </div>

        <div class="flex justify-end mt-4">
            <button onclick="closeModal('detailModal')" class="bg-gray-300 px-3 py-1 rounded text-black">
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
    /* Mengamankan agar bullet points bawaan pagination tidak muncul menjadi titik putih */
    .laravel-pagination-container ul, 
    .laravel-pagination-container li {
        list-style-type: none !important;
        list-style: none !important;
    }
</style>

<script>
function showAnimatedModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    modal.classList.remove('hidden');

    setTimeout(() => {
        content.classList.remove('opacity-0', 'translate-y-10');
        content.classList.add('opacity-100', 'translate-y-0');
    }, 10);
}

function hideAnimatedModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content') || modal.querySelector('div');

    content.classList.remove('opacity-100', 'translate-y-0');
    content.classList.add('opacity-0', 'translate-y-10');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function openModal(id) {
    showAnimatedModal(id);
}

function closeModal(id) {
    hideAnimatedModal(id);
}

function openEdit(id, jenjang, nama_prodi) {
    showAnimatedModal('editModal');
    document.getElementById('editJenjang').value = jenjang;
    document.getElementById('editProdi').value = nama_prodi;
    document.getElementById('formEdit').action = '/prodi/update/' + id;
}

function openDetail(jenjang, nama_prodi) {
    showAnimatedModal('detailModal');

    document.getElementById('detailJenjang').innerText = jenjang;
    document.getElementById('detailNamaProdi').innerText = nama_prodi;
}
</script>

@endsection
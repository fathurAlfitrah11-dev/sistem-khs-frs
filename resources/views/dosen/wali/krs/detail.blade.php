@extends('layout.app')
@section('title','Detail KRS Mahasiswa')
@section('content')

<div class="p-6 bg-[#4f547d] rounded-2xl text-white shadow-md m-6">
    <h3 class="text-xl font-bold mb-2">Persetujuan KRS Mahasiswa</h3>

    @if(session('success'))
    <div class="bg-emerald-500 text-white p-3 rounded-lg mb-4 text-sm font-semibold">
        {{ session('success') }}
    </div>
    @endif

    <p class="text-gray-200 mb-6 font-medium">
        Nama Mahasiswa: <span class="text-white font-bold">{{ $krs->mahasiswa->nama }} ({{ $krs->nim }})</span>
    </p>

    <form action="/dosen/wali/krs/proses" method="POST">
        @csrf
        <input type="hidden" name="id_krs" value="{{ $krs->id_krs }}">

        <div class="bg-white rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-sm text-gray-800 border-collapse">
                <thead class="bg-gray-100 text-[#243b63] border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left font-bold">Mata Kuliah</th>
                        <th class="px-6 py-3 text-center font-bold w-24">SKS</th>
                        <th class="px-6 py-3 text-center font-bold w-32">Setujui</th>
                        <th class="px-6 py-3 text-center font-bold w-32">Tolak</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach($krs->detail as $d)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $d->pengajar->mataKuliah->nama_mk ?? 'Matakuliah Terhapus' }}
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">
                            {{ $d->pengajar->mataKuliah->sks ?? 0 }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <input type="checkbox" name="status_wali[{{ $d->id_krs_detail }}]" value="disetujui"
                                class="w-4 h-4 text-emerald-600 rounded focus:ring-emerald-500 accent-emerald-500 cb-acc-{{ $d->id_krs_detail }}"
                                onclick="handleCheckbox('{{ $d->id_krs_detail }}', 'disetujui')"
                                {{ $d->status_wali == 'disetujui' ? 'checked' : '' }}>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <input type="checkbox" name="status_wali[{{ $d->id_krs_detail }}]" value="ditolak"
                                class="w-4 h-4 text-rose-600 rounded focus:ring-rose-500 accent-rose-500 cb-reject-{{ $d->id_krs_detail }}"
                                onclick="handleCheckbox('{{ $d->id_krs_detail }}', 'ditolak')"
                                {{ $d->status_wali == 'ditolak' ? 'checked' : '' }}>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('perwalian.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-5 py-2 rounded-xl transition text-sm">
                Kembali
            </a>
            <button type="submit"
                class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2 rounded-xl transition text-sm shadow">
                Simpan Keputusan
            </button>
        </div>
    </form>
</div>

<script>
// Fungsi pengunci agar dosen tidak bisa mencentang Setuju & Tolak sekaligus
function handleCheckbox(id, type) {
    const accBox = document.querySelector(`.cb-acc-${id}`);
    const rejectBox = document.querySelector(`.cb-reject-${id}`);

    if (type === 'disetujui' && accBox.checked) {
        rejectBox.checked = false;
    } else if (type === 'ditolak' && rejectBox.checked) {
        accBox.checked = false;
    }
}
</script>

@endsection
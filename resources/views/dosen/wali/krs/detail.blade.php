@extends('layout.app')
@section('title','Detail KRS Mahasiswa')
@section('content')
<h3>KRS Mahasiswa</h3>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<p>
    {{ $krs->mahasiswa->nama }} ({{ $krs->nim }})
</p>

<form action="/dosen/wali/krs/proses" method="POST">
@csrf

<input type="hidden" name="id_krs" value="{{ $krs->id_krs }}">

<table class="table table-bordered">
    <tr>
        <th>Mata Kuliah</th>
        <th>SKS</th>
        <th>Setujui</th>
        <th>Tolak</th>
    </tr>

    @foreach($krs->detail as $d)
    <tr>
        <td>{{ $d->pengajar->mataKuliah->nama_mk }}</td>
        <td>{{ $d->pengajar->mataKuliah->sks }}</td>

        <td>
            <input type="checkbox" name="status_wali[{{ $d->id }}]" value="disetujui"{{ $d->status_wali == 'disetujui' ? 'checked' : '' }}>
        </td>

        <td>
            <input type="checkbox" name="status_wali[{{ $d->id }}]" value="ditolak"{{ $d->status_wali == 'ditolak' ? 'checked' : '' }}>
        </td>
    </tr>
    @endforeach
</table>

<button class="btn btn-success">Simpan</button>

</form>
@endsection
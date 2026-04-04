@extends('layout.app')

@section('title','Edit Kelas')

@section('content')

<h3>Edit Kelas</h3>

<form action="/kelas/update/{{ $kelas->id_kelas }}" method="POST">
@csrf

<select name="nama_kelas" class="form-control mb-2">
    <option value="A" {{ $kelas->nama_kelas == 'A' ? 'selected' : '' }}>Kelas A</option>
    <option value="B" {{ $kelas->nama_kelas == 'B' ? 'selected' : '' }}>Kelas B</option>
    <option value="C" {{ $kelas->nama_kelas == 'C' ? 'selected' : '' }}>Kelas C</option>
    <option value="D" {{ $kelas->nama_kelas == 'D' ? 'selected' : '' }}>Kelas D</option>
    <option value="E" {{ $kelas->nama_kelas == 'E' ? 'selected' : '' }}>Kelas E</option>
</select>

<select name="kategori" class="form-control mb-2">
    <option value="Pagi" {{ $kelas->kategori == 'Pagi' ? 'selected' : '' }}>Pagi</option>
    <option value="Malam" {{ $kelas->kategori == 'Malam' ? 'selected' : '' }}>Malam</option>
</select>

<select name="nidn_wali" class="form-control mb-2">
    <option value="">Pilih Dosen Wali</option>
@foreach($dosen as $d)
    <option value="{{ $d->nidn }}" {{ $kelas->nidn_wali == $d->nidn ? 'selected' : '' }}>
        {{ $d->nama_dosen }}
    </option>
@endforeach
</select>

<button class="btn btn-success">Update</button>
<a href="/kelas" class="btn btn-secondary">Kembali</a>

</form>

@endsection
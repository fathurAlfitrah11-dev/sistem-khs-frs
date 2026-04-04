@extends('layout.app')

@section('title','Tambah Kelas')

@section('content')

<h3>Tambah Kelas</h3>

<form action="/kelas/store" method="POST">
@csrf

<select name="nama_kelas" class="form-control mb-2">
    <option value="A">Kelas A</option>
    <option value="B">Kelas B</option>
    <option value="C">Kelas C</option>
    <option value="D">Kelas D</option>
    <option value="E">Kelas E</option>
</select>

<select name="kategori" class="form-control mb-2">
    <option value="Pagi">Pagi</option>
    <option value="Malam">Malam</option>
</select>

<select name="nidn_wali" class="form-control mb-2">
    <option value="">Pilih Dosen Wali</option>
    @foreach($dosen as $d)
        <option value="{{ $d->nidn }}">{{ $d->nama_dosen }}</option>
    @endforeach
</select>

<button class="btn btn-success">Simpan</button>

</form>

@endsection
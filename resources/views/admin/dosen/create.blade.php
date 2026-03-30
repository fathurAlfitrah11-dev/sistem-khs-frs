@extends('layout.app')
@section('title','Tambah Dosen')
@section('content')
<h3>Tambah Dosen</h3>
<form action="/dosen/store" method="post">
    @csrf
    <div class="form-group">
        <label for="nidn">NIDN</label>
        <input type="text" class="form-control" id="nidn" name="nidn" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="nama_dosen">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
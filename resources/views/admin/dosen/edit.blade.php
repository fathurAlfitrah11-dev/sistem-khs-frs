@extends('layout.app')
@section('title','Edit Dosen')
@section('content')
<h3>Edit Dosen</h3>
<form action="/dosen/update/{{ $dosen->id }}" method="post">
    @csrf
    <div class="form-group">
        <label for="nidn">NIDN</label>
        <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $dosen->nidn }}" readonly>
    </div>
    <div class="form-group">
        <label for="nama_dosen">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="{{ $dosen->user->name }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
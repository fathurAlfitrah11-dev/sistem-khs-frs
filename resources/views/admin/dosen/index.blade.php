@extends('layout.app')

@section('title','Data Dosen')

@section('content')

<h3>Data Dosen</h3>
<a href="/dosen/create" class="btn btn-primary mb-2">Tambah Dosen</a>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>NIDN</th>
        <th>Nama Dosen</th>
        <th>Aksi</th>
    </tr>
    @foreach($data as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nidn }}</td>
        <td>{{ $d->user->name }}</td>
        <td>
            <a href="/dosen/edit/{{ $d->id }}" class="btn btn-warning">Edit</a>
            <a href="/dosen/delete/{{ $d->id }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
    @endsection
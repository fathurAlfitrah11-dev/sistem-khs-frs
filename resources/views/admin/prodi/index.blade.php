@extends('layout.app')

@section('title','Data Program Studi')

@section('content')

<h3>Data Program Studi</h3>

<a href="/prodi/create" class="btn btn-primary mb-3">Tambah</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Program Studi</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ ucwords($d->nama_prodi) }}</td>
        <td>
            <a href="/prodi/edit/{{ $d->id }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
            <a href="/prodi/delete/{{ $d->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
@extends('layout.app')

@section('title','Data Kelas')

@section('content')

<h3>Data Kelas</h3>

<a href="/kelas/create" class="btn btn-primary mb-3">Tambah</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Kategori</th>
        <th>Dosen Wali</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nama_kelas }}</td>
        <td>{{ $d->kategori }}</td>
        <td>{{ $d->wali ? $d->wali->nama_dosen : 'Belum ada' }}</td>

        <td>
            <a href="/kelas/edit/{{ $d->id_kelas }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</a>
            
            <a href="/kelas/delete/{{ $d->id_kelas }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')"><i class="fas fa-trash-alt"></i>Hapus</a>
            
        </td>
    </tr>
    @endforeach
</table>

@endsection
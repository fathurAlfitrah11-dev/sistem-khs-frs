@extends('layout.app')

@section('content')

    <h1>Tambah Prodi</h1>
    <form action="/prodi/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_prodi">Nama Prodi</label>
            <select name="nama_prodi" class="form-control mb-2">
                <option value="IF">Teknik Informatika</option>
                <option value="TRPL">TRPL</option>
                <option value="GM">Teknologi Geomatika</option>
                <option value="TP">Teknologi Permainan</option>
                <option value="TRM">Teknologi Rekayasa Multimedia</option>
                <option value="RKS">Rekayasa Keamanan Siber</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
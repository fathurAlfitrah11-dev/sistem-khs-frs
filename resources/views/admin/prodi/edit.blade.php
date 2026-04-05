@extends('layout.app')

@section('content')
    <h1>Edit Prodi</h1>
    <form action="/prodi/update/{{ $prodi->id }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_prodi">Nama Prodi</label>
            <select name="nama_prodi" class="form-control mb-2">
                <option value="IF" {{ $prodi->nama_prodi == 'IF' ? 'selected' : '' }}>Teknik Informatika</option>
                <option value="TRPL" {{ $prodi->nama_prodi == 'TRPL' ? 'selected' : '' }}>TRPL</option>
                <option value="GM" {{ $prodi->nama_prodi == 'GM' ? 'selected' : '' }}>Teknologi Geomatika</option>
                <option value="TP" {{ $prodi->nama_prodi == 'TP' ? 'selected' : '' }}>Teknologi Permainan</option>
                <option value="TRM" {{ $prodi->nama_prodi == 'TRM' ? 'selected' : '' }}>Teknologi Rekayasa Multimedia</option>
                <option value="RKS" {{ $prodi->nama_prodi == 'RKS' ? 'selected' : '' }}>Rekayasa Keamanan Siber</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
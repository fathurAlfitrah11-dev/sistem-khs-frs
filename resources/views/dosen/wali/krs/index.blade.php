@extends('layout.app')
@section('title','ACC KRS Mahasiswa')
@section('content')
<h3>ACC KRS Mahasiswa</h3>

@foreach($data as $krs)
    <div class="card mb-3">
        <div class="card-body">

            <h5>{{ $krs->mahasiswa->nama }} ({{ $krs->nim }})</h5>

            <a href="/dosen/wali/krs/{{ $krs->id_krs }}" class="btn btn-primary btn-sm">
    Lihat KRS
            </a>
        </div>
    </div>
@endforeach
@endsection
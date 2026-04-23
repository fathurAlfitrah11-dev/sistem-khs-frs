@extends('layout.app')

@section('content')

<h3>Mata Kuliah yang Diampu</h3>

@foreach($data as $d)
<div style="padding:10px;border:1px solid #ccc;margin:10px;">
    <h4>{{ $d->mataKuliah->nama_mk }}</h4>
    <a href="/dosen/matkul/{{ $d->id }}" class="btn btn-primary btn-sm">
        Buka
    </a>
</div>
@endforeach

@endsection
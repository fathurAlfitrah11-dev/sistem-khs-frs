@extends('layout.app')

@section('content')

<h3>{{ $pengajar->mataKuliah->nama_mk }}</h3>

<form method="GET">

    <select name="kelas_id">
        <option value="">Pilih Kelas</option>
        @foreach(\App\Models\Kelas::all() as $k)
            <option value="{{ $k->id_kelas }}">
                {{ $k->nama_kelas }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary btn-sm">Cari</button>
</form>

@if(count($data) == 0)
    <div class="alert alert-danger">
        Anda tidak mengajar di kelas ini
    </div>
@endif

<form method="POST" action="/khs/store">
@csrf

<table class="table table-bordered">
    <tr>
        <th>Mahasiswa</th>
        <th>Part</th>
        <th>Tugas</th>
        <th>Quiz</th>
        <th>Proyek</th>
        <th>UTS</th>
        <th>UAS</th>
    </tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->krs->mahasiswa->nama }}</td>

    <td><input name="nilai[{{ $d->id }}][partisipatif]"></td>
    <td><input name="nilai[{{ $d->id }}][tugas]"></td>
    <td><input name="nilai[{{ $d->id }}][quiz]"></td>
    <td><input name="nilai[{{ $d->id }}][proyek]"></td>
    <td><input name="nilai[{{ $d->id }}][uts]"></td>
    <td><input name="nilai[{{ $d->id }}][uas]"></td>
</tr>
@endforeach

</table>

<button class="btn btn-success">Simpan Nilai</button>

</form>

@endsection
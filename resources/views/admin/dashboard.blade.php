@extends('layout.app')

@section('title', 'Dashboard Admin')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <h6>Total Mahasiswa</h6>
                <h4>0</h4>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <h6>Total Dosen</h6>
                <h4>0</h4>
            </div>
        </div>
    </div>

</div>

@endsection
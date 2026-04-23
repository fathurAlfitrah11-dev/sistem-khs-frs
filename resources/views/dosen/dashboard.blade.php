@extends('layout.dosen_app')

@section('title','Dashboard Dosen')

@section('content')

<div class="p-6">

    {{-- TITLE --}}
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Dashboard Dosen</h1>

    {{-- WELCOME CARD --}}
    <div class="bg-[#4a4f73] text-white p-6 rounded-xl mb-6">
        <h2 class="text-lg font-bold mb-2">
            Selamat Datang {{ Auth::user()->name }}!
        </h2>
        <p class="text-sm text-gray-200">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        </p>
    </div>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-[#4a4f73] text-white p-4 rounded-xl">
            <p class="text-lg font-bold">999</p>
            <p class="text-sm">Mahasiswa</p>
        </div>

        <div class="bg-[#4a4f73] text-white p-4 rounded-xl">
            <p class="text-lg font-bold">999</p>
            <p class="text-sm">Matakuliah</p>
        </div>

        <div class="bg-[#4a4f73] text-white p-4 rounded-xl">
            <p class="text-lg font-bold">999</p>
            <p class="text-sm">Program Studi</p>
        </div>

        <div class="bg-[#4a4f73] text-white p-4 rounded-xl">
            <p class="text-lg font-bold">999</p>
            <p class="text-sm">Dosen</p>
        </div>

    </div>

    {{-- AKSES CEPAT --}}
    <div>
        <h2 class="text-gray-700 font-semibold mb-3">Akses Cepat</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <a href="/dosen/penilaian"
                class="bg-[#4a4f73] text-white p-4 rounded-xl flex items-center gap-3 hover:opacity-90">
                <i class="fa-solid fa-file text-xl"></i>
                <span>Penilaian</span>
            </a>

            <a href="/dosen/mata-kuliah"
                class="bg-[#4a4f73] text-white p-4 rounded-xl flex items-center gap-3 hover:opacity-90">
                <i class="fa-solid fa-book text-xl"></i>
                <span>Matakuliah</span>
            </a>

        </div>
    </div>

</div>

@endsection
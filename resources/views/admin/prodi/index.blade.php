@extends('layout.app')

@section('title','Data Program Studi')

@section('content')

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">Program Studi</h1>
            <p class="text-sm text-gray-400">Kelola data program studi</p>
        </div>

        <a href="/prodi/create"
            class="px-4 py-2 rounded-lg bg-[#f9b17a] text-[#1f2235] font-semibold text-sm hover:opacity-90 transition">
            + Tambah Prodi
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                {{-- HEADER --}}
                <thead>
                    <tr class="border-b border-white/10 text-left">
                        <th class="pb-3 text-xs text-gray-400">No</th>
                        <th class="pb-3 text-xs text-gray-400">Program Studi</th>
                        <th class="pb-3 text-xs text-gray-400">Aksi</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="space-y-2">

                    @foreach($data as $d)
                    <tr class="bg-[#2d3250] hover:bg-white/5 transition-all rounded-lg">

                        <td class="py-4 px-2 text-gray-300">
                            {{ $loop->iteration }}
                        </td>

                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-[#1f2235] text-[#f9b17a]">
                                    <i class="fas fa-book"></i>
                                </div>
                                <span class="font-medium text-white">
                                    {{ ucwords($d->nama_prodi) }}
                                </span>
                            </div>
                        </td>

                        <td class="py-4 px-2">
                            <div class="flex gap-2">

                                <a href="/prodi/edit/{{ $d->id }}"
                                    class="px-3 py-1.5 text-xs rounded-lg bg-yellow-500/20 text-yellow-400 border border-yellow-400/30 hover:bg-yellow-500/30 transition">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <a href="/prodi/delete/{{ $d->id }}"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="px-3 py-1.5 text-xs rounded-lg bg-red-500/20 text-red-400 border border-red-400/30 hover:bg-red-500/30 transition">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>

                            </div>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
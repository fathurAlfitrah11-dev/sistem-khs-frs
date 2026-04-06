@extends('layout.app')
@section('title','Edit Dosen')

@section('content')

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold text-gray-900 mb-6">
        Edit Dosen
    </h2>

    <form action="/dosen/update/{{ $dosen->id }}" method="POST">
        @csrf

        <div class="space-y-6">

            <!-- NIDN (readonly) -->
            <div>
                <label for="nidn" class="block text-sm font-medium text-gray-900">
                    NIDN
                </label>
                <div class="mt-2">
                    <input type="text" name="nidn" id="nidn"
                        value="{{ $dosen->nidn }}"
                        readonly
                        class="block w-full rounded-md bg-gray-100 px-3 py-2 text-gray-500 border border-gray-300 cursor-not-allowed">
                </div>
            </div>

            <!-- Nama Dosen -->
            <div>
                <label for="nama_dosen" class="block text-sm font-medium text-gray-900">
                    Nama Dosen
                </label>
                <div class="mt-2">
                    <input type="text" name="nama_dosen" id="nama_dosen"
                        value="{{ $dosen->user->name }}"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                        required>
                </div>
            </div>

        </div>

        <!-- Button -->
        <div class="mt-6 flex justify-end gap-x-4">
            <a href="/dosen-admin" class="text-sm font-semibold text-gray-600 hover:text-gray-900">
                Batal
            </a>

            <button type="submit"
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                Simpan
            </button>
        </div>

    </form>

</div>

@endsection

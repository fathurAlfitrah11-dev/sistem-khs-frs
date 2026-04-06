@extends('layout.app')
@section('title','Tambah Dosen')

@section('content')

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold text-gray-900 mb-6">
        Tambah Dosen
    </h2>

    <form action="/dosen/store" method="POST">
        @csrf

        <div class="space-y-6">

            <!-- NIDN -->
            <div>
                <label for="nidn" class="block text-sm font-medium text-gray-900">
                    NIDN
                </label>
                <div class="mt-2">
                    <input type="text" name="nidn" id="nidn"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                        placeholder="Masukkan NIDN" required>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-900">
                    Password
                </label>
                <div class="mt-2">
                    <input type="password" name="password" id="password"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                        placeholder="Masukkan Password" required>
                </div>
            </div>

            <!-- Nama Dosen -->
            <div>
                <label for="nama_dosen" class="block text-sm font-medium text-gray-900">
                    Nama Dosen
                </label>
                <div class="mt-2">
                    <input type="text" name="nama_dosen" id="nama_dosen"
                        class="block w-full rounded-md bg-white px-3 py-2 text-gray-900 border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:outline-none"
                        placeholder="Masukkan Nama Dosen" required>
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

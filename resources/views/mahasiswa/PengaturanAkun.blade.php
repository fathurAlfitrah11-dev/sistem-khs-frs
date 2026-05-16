@extends('layout.mahasiswa_app')

@section('title','Ubah Password')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6"
        data-aos="fade-up">
        Pengaturan Akun
    </h1>

    <div class="bg-[#3b3f63] rounded-xl p-6"
         data-aos="fade-up"
         data-aos-delay="100">

        <h2 class="text-white text-xl font-bold mb-6">
            Ubah Password
        </h2>

        <form action="/mahasiswa/password/update" method="POST">

            @csrf

            <div class="space-y-4">

                {{-- Password Lama --}}
                <div>
                    <label class="text-white text-sm block mb-1">
                        Password Lama
                    </label>

                    <input type="password"
                        name="password_lama"
                        placeholder="Masukkan password lama"
                        class="w-full px-3 py-2 rounded text-black">
                </div>

                {{-- Password Baru --}}
                <div>
                    <label class="text-white text-sm block mb-1">
                        Password Baru
                    </label>

                    <input type="password"
                        name="password_baru"
                        placeholder="Masukkan password baru"
                        class="w-full px-3 py-2 rounded text-black">
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="text-white text-sm block mb-1">
                        Konfirmasi Password
                    </label>

                    <input type="password"
                        name="konfirmasi_password"
                        placeholder="Masukkan ulang password"
                        class="w-full px-3 py-2 rounded text-black">
                </div>

            </div>

            <div class="mt-6 flex justify-end gap-2">

                <button type="reset"
                    class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-200">

                    Batal

                </button>

                <button type="button"
                onclick="openModal('passwordModal')"
                class="bg-orange-400 text-black font-semibold px-4 py-2 rounded">

                    Simpan Password

                </button>

            </div>

        </form>

    </div>

</div>
<!-- POPUP KONFIRMASI -->
<div id="passwordModal"
class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-[#5a5f86] w-full max-w-md rounded-xl p-6 text-white
    modal-content transform opacity-0 translate-y-10 transition-all duration-300">

        <h2 class="text-lg font-bold mb-3">
            Konfirmasi Perubahan
        </h2>

        <p class="text-sm text-gray-200 mb-6">
            Apakah Anda yakin ingin mengubah password?
        </p>

        <div class="flex justify-end gap-2">

            <button
            onclick="closeModal('passwordModal')"
            class="bg-gray-300 text-black px-4 py-2 rounded">

                Batal

            </button>

            <button
            onclick="submitPassword()"
            class="bg-orange-400 text-black font-semibold px-4 py-2 rounded">

                Ya, Simpan

            </button>

        </div>

    </div>

</div>

@endsection
<script>

function showModal(id){
    const modal=document.getElementById(id)
    const content=modal.querySelector('.modal-content')

    modal.classList.remove('hidden')

    setTimeout(()=>{

        content.classList.remove(
            'opacity-0',
            'translate-y-10'
        )

        content.classList.add(
            'opacity-100',
            'translate-y-0'
        )

    },10)
}

function hideModal(id){

    const modal=document.getElementById(id)
    const content=modal.querySelector('.modal-content')

    content.classList.remove(
        'opacity-100',
        'translate-y-0'
    )

    content.classList.add(
        'opacity-0',
        'translate-y-10'
    )

    setTimeout(()=>{

        modal.classList.add('hidden')

    },300)

}

function openModal(id){
    showModal(id)
}

function closeModal(id){
    hideModal(id)
}

function submitPassword(){

    document.querySelector('form').submit()

}

</script>
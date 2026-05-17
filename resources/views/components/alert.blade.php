{{-- LOGIN SUCCESS --}}
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'success',
        title: 'Login Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#fb923c',
        background: '#3b3f63',
        color: '#fff',
        timer: 2500,
        showConfirmButton: false
    })

})
</script>
@endif


{{-- LOGIN ERROR --}}
@if(session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'error',
        title: 'Login Gagal!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#ef4444',
        background: '#3b3f63',
        color: '#fff',
    })

})
</script>
@endif


{{-- LOGOUT SUCCESS --}}
@if(session('logout'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'info',
        title: 'Logout Berhasil!',
        text: '{{ session('logout') }}',
        confirmButtonColor: '#fb923c',
        background: '#3b3f63',
        color: '#fff',
        timer: 2000,
        showConfirmButton: false
    })

})
</script>
@endif
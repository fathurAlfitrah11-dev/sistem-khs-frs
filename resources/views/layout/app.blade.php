<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #fff;
        color: #fff;
    }
    </style>
</head>

<body>

    <x-alert />

    <div class="flex">

        {{-- SIDEBAR --}}
        @if(Auth::user()->role == 'dosen')
        @include('layout.sidebar_dosen')
        @else
        @include('layout.sidebar') {{-- Ini buat admin atau role lain jika ada --}}
        @endif

        {{-- MAIN CONTENT --}}
        <div class="flex-1 ml-64 pt-16">

            {{-- NAVBAR --}}
            @include('layout.navbar')

            {{-- CONTENT --}}
            <div id="swup" class="p-6 transition-fade">

                <x-dashboard-layout>
                    @yield('content')
                </x-dashboard-layout>

            </div>

        </div>

    </div>

    <script>
    AOS.init({
        once: true,
        duration: 800
    });
    </script>

</body>

<script>
const swup = new Swup();
</script>

</html>
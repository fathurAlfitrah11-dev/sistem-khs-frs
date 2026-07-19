<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    overflow-x: hidden;
    max-width: 100%;
    }
    </style>
</head>

<body>

    <x-alert />

    <div class="min-h-screen">

        {{-- SIDEBAR --}}
        @if(Auth::user()->role == 'dosen')
        @include('layout.sidebar_dosen')
        @else
        @include('layout.sidebar') {{-- Ini buat admin atau role lain jika ada --}}
        @endif

        {{-- SIDEBAR OVERLAY (Backdrop gelap saat sidebar mobile aktif) --}}
                <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 hidden lg:hidden z-40"></div>

                {{-- MAIN CONTENT BUNDLER --}}
                <div id="mainContent" class="flex-1 lg:ml-64 flex flex-col transition-all duration-300">

                    {{-- NAVBAR --}}
                    @include('layout.navbar')

                    {{-- CONTENT AREA --}}
                    <div id="swup" class="flex-1 p-4 md:p-6 overflow-x-hidden">
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
        const menuButton = document.getElementById('menuButton');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar && overlay) {
                // Membuka / Menutup Sidebar dengan memanipulasi utility class Tailwind
                sidebar.classList.toggle('-translate-x-full');
                
                // Memunculkan / Menyembunyikan lapisan backdrop gelap di belakangnya
                overlay.classList.toggle('hidden');
            }
        }

        // Tambahan: Pastikan ketika area backdrop hitam diklik, sidebar otomatis menutup kembali
        document.addEventListener('DOMContentLoaded', function () {

            const menuButton = document.getElementById('menuButton');
            const overlay = document.getElementById('sidebarOverlay');

            if (menuButton) {
                menuButton.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

        });
    </script>
</html>
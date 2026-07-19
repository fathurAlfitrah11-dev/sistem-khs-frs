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

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #fff;
        color: #fff;
    }
    </style>
</head>

<body class=" m-0 p-0">

    <x-alert />

    <div class="min-h-screen">

        {{-- SIDEBAR --}}
        @include('layout.sidebar_dosen')

        {{-- MAIN CONTENT --}}
        <div id="mainContent" class="flex-1 lg:ml-64 transition-all duration-300">

            {{-- NAVBAR --}}
            @include('layout.navbar')

            {{-- CONTENT --}}
            <div id="swup" class="p-6 transition-fade flex-1">
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
    <script>
    // Fungsi pembantu untuk membuka dan menutup sidebar secara sinkron
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (sidebar && overlay) {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const overlay = document.getElementById('sidebarOverlay');

        // Hubungkan tombol burger di navbar ke fungsi toggle
        if (menuButton) {
            menuButton.addEventListener('click', toggleSidebar);
        }

        // Hubungkan backdrop overlay hitam ke fungsi toggle
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }
    });
    // Sambungkan fungsi ke overlay klik agar saat area gelap diklik, menu menutup otomatis
    document.getElementById('sidebarOverlay')?.addEventListener('click', toggleSidebar);

    // Inisialisasi library animasi AOS
    AOS.init({
        once: true,
        duration: 800
    });
    </script>

    {{-- JAVASCRIPT SLIDER (DENGAN SECURITY CHECK) --}}
    <script>
        // Penambahan conditional check (if) agar script tidak error jika halaman tidak memiliki element slider
        const slider = document.getElementById('slider');
        if (slider && slider.children.length > 0) {
            let index = 0;
            const totalSlides = slider.children.length;

            setInterval(() => {
                index = (index + 1) % totalSlides;
                slider.style.transform = `translateX(-${index * 100}%)`;
            }, 3000);
        }
    </script>
</body>
</body>

</html>
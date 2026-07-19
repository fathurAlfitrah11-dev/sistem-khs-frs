    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        
    <body class="m-0 p-0">

        <x-alert />
        <div class="flex">

            {{-- SIDEBAR --}}
            @include('layout.sidebar_mahasiswa')

                <div
                    id="overlay"
                    class="fixed inset-0 bg-black/40 hidden lg:hidden z-40">
                </div>
            {{-- MAIN CONTENT --}}
            <div id="mainContent" class="flex-1 lg:ml-64 transition-all duration-300">

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
        <script>
        let index = 0;
        const slider = document.getElementById('slider');

        if (slider) {
            const totalSlides = slider.children.length;

            setInterval(() => {
                index = (index + 1) % totalSlides;
                slider.style.transform = `translateX(-${index * 100}%)`;
            }, 3000);
        }
        </script>
        <script>
            const menuButton = document.getElementById('menuButton');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Fungsi Buka / Tutup Sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }

            // Event Klik pada Tombol Hamburger
            menuButton.addEventListener('click', toggleSidebar);

            // Event Klik pada Overlay (Menutup kembali jika area luar sidebar diklik)
            sidebarOverlay.addEventListener('click', toggleSidebar);
        </script>
    </body>

    </html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
<body>

<div class="flex">

    {{-- SIDEBAR --}}
    @include('layout.sidebar_dosen')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 ml-64 pt-16">

        {{-- NAVBAR --}}
        @include('layout.navbar')

        {{-- CONTENT --}}
        <div class="p-6">
            @yield('content')
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
const totalSlides = slider.children.length;

setInterval(() => {
    index = (index + 1) % totalSlides;
    slider.style.transform = `translateX(-${index * 100}%)`;
}, 3000); // 3 detik
</script>
</body>
</body>
</html>
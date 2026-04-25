<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Smart Academy System</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #2f3654;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center 
bg-[url('img/wallpaper_login.png')] bg-cover bg-center">


    <!-- Card -->
    <div data-aos="zoom-in" data-aos-duration="800" class="relative w-full max-w-md p-8 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md shadow-lg">

        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('img/Logo_4-reborn.png') }}" alt="Logo" class="w-56 sm:w-50 md:w-54 h-auto">
        </div>

        <!-- Title -->
        <h2 class="text-center text-2xl font-semibold text-white -mt-2 mb-6">
            Smart Academy System
        </h2>

        <!-- Error -->
        @if (session('error'))
            <div class="mb-4 text-sm text-red-400 text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form action="/login" method="POST" class="space-y-5">
            @csrf

            <!-- Username -->
            <div>
                <label class="text-sm text-gray-300">NIM / NIDN</label>
                <input type="text" name="username"
                    placeholder="Ketik NIM / NIDN Anda"
                    class="w-full mt-2 px-4 py-2 rounded-md bg-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Password -->
            <div>
                <label class="text-sm text-gray-300">Kata Sandi</label>
                <input type="password" name="password"
                    placeholder="Ketik Kata Sandi Anda"
                    class="w-full mt-2 px-4 py-2 rounded-md bg-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full mt-6 bg-orange-400 hover:bg-orange-300 text-gray-900 font-semibold py-2 rounded-md flex items-center justify-center gap-2 transition">
                Masuk →
            </button>
        </form>

    </div>
    <script>
  AOS.init({
    duration: 800,
    once: true
  })
</script>
</body>
</html>
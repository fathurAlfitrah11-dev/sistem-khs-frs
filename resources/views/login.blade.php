<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Smart Academy System</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #2f3654;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">

    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-72 h-20 bg-white/10 rounded-full rotate-45 top-10 left-10"></div>
        <div class="absolute w-72 h-20 bg-white/10 rounded-full rotate-45 bottom-10 right-10"></div>
        <div class="absolute w-72 h-20 bg-white/10 rounded-full rotate-45 top-1/2 left-1/3"></div>
    </div>

    <!-- Card -->
    <div class="relative w-full max-w-md p-8 rounded-xl border border-white/10 bg-white/5 backdrop-blur-md shadow-lg">

        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <h1 class="text-4xl font-bold text-orange-400">SA</h1>
        </div>

        <!-- Title -->
        <h2 class="text-center text-2xl font-semibold text-white mb-6">
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

</body>
</html>
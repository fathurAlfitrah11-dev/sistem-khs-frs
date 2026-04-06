<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

</head>

<body>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="SAS" class="mx-auto h-10 w-auto" />
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-dark-300">Login Sistem KRS</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    @if (session('error'))
        <div class="mb-4 text-sm font-medium text-red-500">
            {{ session('error') }}
        </div>
    @endif
    <form action="/login" method="POST" class="space-y-6">
        @csrf
      <div>
        <label for="username" class="block text-sm/6 font-medium text-dark-100">Username</label>
        <div class="mt-2">
          <input id="username" type="text" name="username" placeholder="Masukkan username anda berupa NIM atau NIDN" autocomplete="username" class="block w-full rounded-md bg-dark/5 px-3 py-1.5 text-base text-dark outline-1 -outline-offset-1 outline-white/10 placeholder:text-dark-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-dark-100">Password</label>
        </div>
        <div class="mt-2">
          <input id="password" type="password" name="password" placeholder="Masukkan Password Anda" autocomplete="current-password" class="block w-full rounded-md bg-dark/5 px-3 py-1.5 text-base text-dark outline-1 -outline-offset-1 outline-white/10 placeholder:text-dark-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Login</button>
      </div>
    </form>

  </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    @include('layout.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 ml-64">

        {{-- NAVBAR --}}
        @include('layout.navbar')

        {{-- CONTENT --}}
        <div class="p-6">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
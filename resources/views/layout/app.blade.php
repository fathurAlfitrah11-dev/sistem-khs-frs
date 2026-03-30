<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/css/custom.css') }}" rel="stylesheet">

</head>

<body id="page-top">

<div id="wrapper">

    {{-- SIDEBAR --}}
    @include('layout.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            {{-- NAVBAR --}}
            @include('layout.navbar')

            <div class="container-fluid">

                {{-- NOTIFIKASI --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- CONTENT --}}
                @yield('content')

            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container text-center">
                <span>© KRS System 2026</span>
            </div>
        </footer>

    </div>
</div>

<script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('sbadmin/js/custom.js') }}"></script>

</body>
</html>
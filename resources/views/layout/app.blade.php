<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/css/custom.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<style>
    body {
        background-color: #1f2235; /* solid dark */
        font-family: 'Poppins', sans-serif;
        color: #ffffff;
    }

    /* Container transparan */
    #content-wrapper,
    #content,
    .container-fluid {
        background: transparent !important;
    }

    /* ===== CARD CLEAN ===== */
    .bg-white {
        background: #2d3250 !important;
        border-radius: 14px !important;
        border: 1px solid rgba(255,255,255,0.05) !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        color: #fff !important;
    }

    /* Text */
    .text-gray-800,
    .text-gray-900 {
        color: #ffffff !important;
    }

    .text-gray-500,
    .text-gray-600 {
        color: #aab0ff !important;
    }

    /* Accent */
    .text-green-600 {
        color: #f9b17a !important;
    }

    .bg-gray-900 {
        background-color: #f9b17a !important;
        color: #1f2235 !important;
    }

    /* Hover */
    .hover\:border-blue-500:hover {
        border-color: #f9b17a !important;
    }

    /* ===== SIDEBAR ===== */
    .sidebar {
        background: #181a2f !important;
        border-right: 1px solid rgba(255,255,255,0.05);
    }

    /* ===== TOPBAR (FIX PADDING) ===== */
    .topbar {
        background: #1f2235 !important;
        padding-top: 6px !important;
        padding-bottom: 6px !important;
        min-height: unset !important;
        height: 50px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    /* biar isi navbar gak kegedean */
    .topbar .navbar-nav .nav-item .nav-link {
        padding: 6px 10px !important;
    }

    /* ===== FOOTER ===== */
    .sticky-footer {
        background: transparent !important;
        color: #aaa;
    }

    /* ===== TABLE ===== */
/* ===== TABLE MODERN ===== */

/* hilangkan efek putih total */
table {
    border-collapse: separate;
    border-spacing: 0 8px; /* jarak antar row */
}

/* row jadi kayak card */
tbody tr {
    background: #2d3250;
    border-radius: 12px;
}

/* biar radius keliatan */
tbody tr td:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

tbody tr td:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}

/* hover effect clean */
tbody tr:hover {
    background: rgba(249, 177, 122, 0.08);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}

/* text & icon ikut berubah */
tbody tr:hover td {
    color: #ffffff;
}

tbody tr:hover svg {
    color: #f9b17a;
}

/* header biar beda */
thead {
    background: transparent !important;
}

thead th {
    color: #aab0ff !important;
    font-weight: 500;
}

    /* STATUS */
    .bg-red-600 {
        background: #ff5c5c !important;
    }

    .bg-yellow-500 {
        background: #ffb347 !important;
    }
</style>
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
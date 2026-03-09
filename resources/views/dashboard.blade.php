<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
     <style>
 body {
 background-color: #f8f9fa;
 }
 .navbar {
 background: linear-gradient(to right, #007bff, #00c4ff);
 }
 .sidebar {
 height: 100vh;
 background-color: #0056b3;
 color: white;
 }
 .sidebar a {
 color: white; /* Warna teks link sidebar */
 border-radius: 5px; /* Menambahkan border-radius */
 transition: background-color 0.3s, color 0.3s; /* Transisi saat hover */
 }
.sidebara:hover{
.sidebar a:hover {
 background: linear-gradient(to right, #ff8c00, #ffa500);
 } /* Gradasi oranye saat
hover */
 text-decoration: none; /* Menghilangkan garis bawah saat hover */
 padding: 10px; /* Jarak dalam */
 }
 .card {
 margin-top: 20px; /* Jarak atas untuk kartu */
 }
 .footer {
 background-color: #007bff; /* Warna footer */
 color: white;
 padding: 20px;
 text-align: center;
 }
 </style>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-light">
 <div class="container-fluid">
 <a class="navbar-brand text-white" href="#">DASHBOARD</a>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bstarget="#navbarNav" aria-controls="navbarNav" aria-expanded="false" arialabel="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
 </button>
 <div class="collapse navbar-collapse" id="navbarNav">
 <ul class="navbar-nav ms-auto">
 <li class="nav-item">
 <a class="nav-link text-white" href="#"><i class="fas fa-bell"></i></a>
 </li>
 <li class="nav-item dropdown">
 <a class="nav-link dropdown-toggle text-white" href="#"
id="navbarDropdown" role="button" data-bs-toggle="dropdown" ariaexpanded="false">
 <i class="fas fa-user-circle"></i>
 </a>
 <ul class="dropdown-menu dropdown-menu-end" arialabelledby="navbarDropdown">
 <li><a class="dropdown-item" href="#">Profil Saya</a></li>
 <li><a class="dropdown-item" href="#">Pengaturan</a></li>
 <li><hr class="dropdown-divider"></li>
 <li><a class="dropdown-item" href="/login">Keluar</a></li>
 </ul>
 </li>
 </ul>
 </div>
 </div>
 </nav>
 <div class="d-flex">
 <div class="sidebar p-3">
 <h4>Menu</h4>
 <ul class="nav flex-column">
 <li class="nav-item">
 <a class="nav-link active" href="#"><i class="fas fa-tachometer-alt"></i>
Dashboard</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="layout.html"><i class="fas fa-box"></i> Produk</a>
 </li>
 <li class="nav-item">
 <a class="nav-link" href="#"><i class="fas fa-users"></i> Pelanggan</a>
 </li>
 </ul>
 </div>
 <div class="container mt-4">
 <div class="row">
 <div class="col-md-12">
 <div class="card">
 <div class="card-header">
 <h5>Selamat Datang di Dashboard</h5>
 </div>
 <div class="card-body">
 <p>Ini adalah halaman dashboard Anda. Anda dapat menambahkan
konten sesuai kebutuhan.</p>
 <p>Gunakan menu di sebelah kiri untuk mengakses berbagai fitur.</p>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
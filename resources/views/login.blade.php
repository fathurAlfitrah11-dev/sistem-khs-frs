<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card">

<div class="card-header text-center">
<h4>Login Sistem KRS</h4>
</div>

<div class="card-body">

@if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="NIM / NIDN / Username" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>
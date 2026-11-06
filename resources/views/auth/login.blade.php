<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - KelasOnline</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-sm border-0 p-4" style="width: 400px;">
        <h3 class="text-center mb-2">Login Admin</h3>
        <p class="text-center text-muted">KelasOnline</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif


            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>

            <a href="{{ url('/') }}" class="d-block text-center mt-3">
                Kembali ke Beranda
            </a>
        </form>
    </div>
</div>

</body>

</html>
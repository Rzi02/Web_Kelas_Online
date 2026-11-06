
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $kelas->judul }} - KelasOnline</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-nexora fixed-top">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
            KelasOnline<span>.</span>
        </a>

        <div class="ms-auto">
            <a href="{{ route('home') }}" class="nav-link d-inline-block">
                Beranda
            </a>
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                Login Admin
            </a>
        </div>
    </div>
</nav>

<header class="page-header">
    <div class="container">
        <h1>{{ $kelas->judul }}</h1>

        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}">Beranda</a>
            <span>/</span>
            <span class="active">Detail Kelas</span>
        </div>
    </div>
</header>

<section class="section">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-8">

                <img
                    src="{{ $kelas->gambar
                        ? asset('storage/'.$kelas->gambar)
                        : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800' }}"
                    class="img-fluid rounded-4 w-100 mb-4"
                    style="height:350px; object-fit:cover;"
                    alt="{{ $kelas->judul }}">

                <span class="eyebrow">
                    {{ $kelas->kategori->nama_kategori ?? 'Umum' }}
                </span>

                <h2 class="mb-3">{{ $kelas->judul }}</h2>

                <p class="text-muted">
                    <i class="bi bi-person"></i>
                    {{ $kelas->instruktur }}
                </p>

                <h4 class="mt-4">Deskripsi Kelas</h4>
                <p>{{ $kelas->deskripsi }}</p>

            </div>

            <div class="col-lg-4">
                <div class="widget">
                    <h5>Informasi Kelas</h5>
                    <hr>

                    <p>Kategori</p>
                    <strong>
                        {{ $kelas->kategori->nama_kategori ?? 'Umum' }}
                    </strong>

                    <hr>

                    <p>Instruktur</p>
                    <strong>{{ $kelas->instruktur }}</strong>

                    <hr>

                    <p>Harga Kelas</p>
                    <h3 class="text-primary-custom">
                        {{ $kelas->harga > 0
                            ? 'Rp '.number_format($kelas->harga, 0, ',', '.')
                            : 'Gratis' }}
                    </h3>

                    <a href="#pendaftaran" class="btn btn-primary w-100 mt-3">
                        Daftar Kelas
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section bg-soft" id="pendaftaran">
    <div class="container">

        <div class="text-center mb-4">
            <span class="eyebrow">Pendaftaran</span>
            <h2 class="section-title">Daftar Kelas Sekarang</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="widget">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('kelas.daftar', $kelas->id_kelas) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama"
                                class="form-control"
                                placeholder="Nama lengkap"
                                value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                class="form-control"
                                placeholder="Alamat email"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="no_telepon"
                                class="form-control"
                                placeholder="Nomor telepon"
                                value="{{ old('no_telepon') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Kirim Pendaftaran
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</section>

<footer class="footer-nexora">
    <div class="container text-center">
        <h5 class="text-white">KelasOnline.</h5>

        <p class="text-white-50">
            Platform pembelajaran online untuk mengembangkan keterampilan.
        </p>

        <div class="footer-bottom">
            <p class="mb-0">
                &copy; {{ date('Y') }} KelasOnline. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KelasOnline - Platform Belajar Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-nexora fixed-top">
    <div class="container">

        <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
            KelasOnline<span>.</span>
        </a>

        <!-- Tombol Hamburger Mobile -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNav"
                aria-controls="mainNav"
                aria-expanded="false"
                aria-label="Buka menu navigasi">

            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>

        </button>

        <!-- Menu Navigasi -->
        <div class="collapse navbar-collapse" id="mainNav">

            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">

                <li class="nav-item">
                    <a class="nav-link nav2 active" href="{{ route('home') }}">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav2" href="#kelas">
                        Daftar Kelas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav2" href="#kategori">
                        Kategori
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav2" href="#kontak">
                        Kontak
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pendaftaran.cek') }}" class="nav-link nav2">
                        Cek Status Pendaftaran
                    </a>
                </li>

                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm-custom">
                        Login Admin
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>


<!-- HERO -->
<header class="hero">
    <div class="container">
        <div class="row align-items-center gy-4">

            <div class="col-lg-6 hero-content">

                <span class="eyebrow">
                    Platform Pembelajaran Online
                </span>

                <h1 class="mb-4">
                    Tingkatkan Skill dan
                    <span class="text-primary-custom">
                        Raih Masa Depanmu
                    </span>
                </h1>

                <p class="fs-5 mb-4">
                    Temukan berbagai kelas online untuk meningkatkan
                    pengetahuan dan mengembangkan keterampilanmu.
                </p>

                <a href="#kelas" class="btn btn-primary btn-lg-custom">
                    Jelajahi Kelas
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>

            </div>

            <div class="col-lg-6">
                <img
                    src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=700&h=500&fit=crop"
                    class="img-fluid rounded-4"
                    alt="Kegiatan belajar online">
            </div>

        </div>
    </div>
</header>


<!-- KATEGORI -->
<section class="section bg-soft" id="kategori">
    <div class="container">

        <div class="section-header text-center">
            <span class="eyebrow">Kategori</span>

            <h2 class="section-title">
                Kategori Pembelajaran
            </h2>

            <p class="section-subtitle mx-auto">
                Pilih kategori sesuai bidang yang ingin kamu pelajari.
            </p>
        </div>

        <div class="row g-4">

            @forelse($kategori as $item)

                <div class="col-md-4">
                    <a href="{{ route('home', ['kategori' => $item->id_kategori]) }}#kelas"
                       class="text-decoration-none">

                        <div class="card-premium text-center h-100">

                            <div class="icon-box icon-box-primary mx-auto mb-3">
                                <i class="bi bi-book"></i>
                            </div>

                            <h5 class="card-title">
                                {{ $item->nama_kategori }}
                            </h5>

                        </div>
                    </a>
                </div>

            @empty

                <div class="col-12 text-center">
                    <p>Belum ada kategori.</p>
                </div>

            @endforelse

        </div>
    </div>
</section>


<!-- DAFTAR KELAS -->
<section class="section" id="kelas">
    <div class="container">

        <div class="section-header text-center">
            <span class="eyebrow">Kelas Online</span>

            <h2 class="section-title">
                Kelas Pilihan Untukmu
            </h2>

            <p class="section-subtitle mx-auto">
                Temukan kelas terbaik untuk mengembangkan kemampuanmu.
            </p>
        </div>

        <!-- PENCARIAN -->
        <form action="{{ route('home') }}" method="GET" class="mb-4">

            <div class="row g-2">

                <div class="col-md-8">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari kelas..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100" type="submit">
                        <i class="bi bi-search"></i>
                        Cari Kelas
                    </button>
                </div>

            </div>
        </form>


        <!-- DATA KELAS -->
        <div class="row g-4">

            @forelse($kelas as $item)

                <div class="col-md-6 col-lg-4">

                    <div class="card-premium h-100 p-0 overflow-hidden">

                        <img
                            src="{{ $item->gambar
                                ? asset('storage/'.$item->gambar)
                                : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600' }}"
                            class="w-100"
                            style="height:200px; object-fit:cover;"
                            alt="{{ $item->judul }}">

                        <div class="p-4">

                            <span class="badge bg-primary-subtle text-primary mb-2">
                                {{ $item->kategori->nama_kategori ?? 'Umum' }}
                            </span>

                            <h5 class="card-title">
                                {{ $item->judul }}
                            </h5>

                            <p>
                                {{ \Illuminate\Support\Str::limit($item->deskripsi, 90) }}
                            </p>

                            <p class="text-muted mb-2">
                                <i class="bi bi-person"></i>
                                {{ $item->instruktur }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center">

                                <strong class="text-primary-custom">
                                    {{ $item->harga > 0
                                        ? 'Rp '.number_format($item->harga, 0, ',', '.')
                                        : 'Gratis' }}
                                </strong>

                                <a href="{{ route('kelas.detail', $item->id_kelas) }}"
                                   class="btn btn-primary btn-sm">
                                    Detail
                                </a>

                            </div>

                        </div>
                    </div>
                </div>

            @empty

                <div class="col-12 text-center">
                    <p>Belum ada kelas yang tersedia.</p>
                </div>

            @endforelse

        </div>


        <!-- PAGINATION -->
        <div class="d-flex justify-content-center mt-4">
            {{ $kelas->withQueryString()->links() }}
        </div>

    </div>
</section>


<!-- KONTAK -->
<section class="section bg-soft" id="kontak">
    <div class="container text-center">

        <span class="eyebrow">Kontak</span>

        <h2 class="section-title">
            Hubungi Kami
        </h2>

        <p class="section-subtitle mx-auto">
            Ada pertanyaan mengenai kelas? Silakan hubungi kami.
        </p>

        <p>
            <i class="bi bi-envelope"></i>
            info@kelasonline.test
        </p>

    </div>
</section>


<!-- FOOTER -->
<footer class="footer-nexora">
    <div class="container text-center">

        <a class="navbar-brand-custom d-inline-block mb-3"
           href="{{ route('home') }}" style="color:white;">
            KelasOnline<span>.</span>
        </a>

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


<!-- JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status Pendaftaran - KelasOnline</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                KelasOnline
            </a>

            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                Kembali ke Beranda
            </a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h3 class="text-center fw-bold mb-2">
                            Cek Status Pendaftaran
                        </h3>

                        <p class="text-center text-muted mb-4">
                            Masukkan email yang digunakan saat mendaftar kelas.
                        </p>

                        <form action="{{ route('pendaftaran.hasil') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="contoh@email.com"
                                    value="{{ old('email') }}"
                                    required
                                >

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Cek Status
                            </button>
                        </form>

                        @isset($pendaftaran)

                            <hr class="my-4">

                            <h5 class="fw-bold mb-3">
                                Hasil Pendaftaran
                            </h5>

                            @forelse($pendaftaran as $item)

                                @php
                                    $status = $item->status instanceof \App\Enums\StatusPendaftaran
                                        ? $item->status->value
                                        : $item->status;
                                @endphp

                                <div class="border rounded p-3 mb-3">

                                    <h6 class="fw-bold">
                                        {{ $item->kelas->judul }}
                                    </h6>

                                    <p class="mb-1">
                                        Nama: {{ $item->pendaftar->nama }}
                                    </p>

                                    <p class="mb-2">
                                        Tanggal Daftar:
                                        {{ $item->tanggal_daftar
                                            ? $item->tanggal_daftar->format('d-m-Y')
                                            : '-' }}
                                    </p>

                                    <p class="mb-2">
                                        Status:

                                        @if($status == 'accepted')
                                            <span class="badge bg-success">
                                                Diterima
                                            </span>

                                        @elseif($status == 'rejected')
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>

                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>
                                        @endif
                                    </p>

                                    @if($status == 'accepted')
                                        <div class="alert alert-success mb-0 mt-3">
                                            Selamat! Pendaftaran Anda telah diterima.
                                        </div>

                                    @elseif($status == 'rejected')
                                        <div class="alert alert-danger mb-0 mt-3">
                                            Mohon maaf, pendaftaran Anda belum diterima.
                                        </div>

                                    @else
                                        <div class="alert alert-warning mb-0 mt-3">
                                            Pendaftaran Anda sedang diproses oleh admin.
                                        </div>
                                    @endif

                                </div>

                            @empty

                                <div class="alert alert-info">
                                    Belum ada pendaftaran menggunakan email tersebut.
                                </div>

                            @endforelse

                        @endisset

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
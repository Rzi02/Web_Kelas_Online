<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - KelasOnline</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: #171c35;
            min-height: 100vh;
            padding: 25px 18px;
        }

        .brand {
            color: white;
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .brand span {
            color: #8b7bff;
        }

        .sidebar a {
            display: block;
            color: #b8bfd5;
            text-decoration: none;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #343b65;
            color: white;
        }

        .content {
            padding: 30px;
        }

        .stat-card,
        .table-card {
            border: none;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(0,0,0,.04);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 22px;
            background: #eeeaff;
            color: #7161e8;
        }

        .welcome {
            background: linear-gradient(120deg, #5146d8, #8875f5);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        @include('admin.layouts.sidebar')

        <!-- CONTENT -->
        <div class="col-md-10 content">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Dashboard</h4>
                    <p class="text-muted mb-0">
                        Ringkasan aktivitas KelasOnline
                    </p>
                </div>

                <span class="text-muted">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ auth()->user()->name }}
                </span>
            </div>

            <!-- WELCOME -->
            <div class="welcome">
                <h3>Selamat datang, {{ auth()->user()->name }}!</h3>
                <p class="mb-0">
                    Kelola kelas dan pendaftaran peserta melalui dashboard admin.
                </p>
            </div>

            <!-- STATISTIK -->
            <div class="row g-4 mb-4">

                <div class="col-md-4">
                    <div class="card stat-card">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">Total Kelas</p>
                                <h3 class="fw-bold">
                                    {{ \App\Models\Kelas::count() }}
                                </h3>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-book"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">Total Pendaftar</p>
                                <h3 class="fw-bold">
                                    {{ \App\Models\Pendaftaran::count() }}
                                </h3>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">Menunggu Konfirmasi</p>
                                <h3 class="fw-bold">
                                    {{ \App\Models\Pendaftaran::where('status', 'pending')->count() }}
                                </h3>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- KELOLA KELAS -->
            <div class="card table-card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Kelola Kelas</h5>
                        <p class="text-muted mb-0">
                            Tambahkan dan atur kelas online.
                        </p>
                    </div>

                    <a href="{{ route('admin.kelas.create') }}"
                       class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Kelas
                    </a>
                </div>
            </div>

            <!-- PENDAFTARAN TERBARU -->
            <div class="table-card">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Pendaftaran Terbaru</h5>

                    <a href="{{ route('admin.pendaftaran') }}"
                       class="btn btn-primary btn-sm">
                        Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse (\App\Models\Pendaftaran::with(['kelas', 'pendaftar'])->latest()->take(5)->get() as $item)

                                <tr>
                                    <td>{{ $item->pendaftar->nama }}</td>

                                    <td>{{ $item->kelas->judul }}</td>

                                    <td>
                                        {{ $item->tanggal_daftar->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        @php
                                            $status = $item->status instanceof \App\Enums\StatusPendaftaran
                                                ? $item->status->value
                                                : $item->status;
                                        @endphp

                                        <span class="badge {{ $status == 'accepted' ? 'bg-success' : ($status == 'rejected' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada pendaftaran.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
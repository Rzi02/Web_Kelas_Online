<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Kelas - KelasOnline</title>

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

        .table-card {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(0,0,0,.04);
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
                    <h4 class="fw-bold mb-1">Kelola Kelas</h4>
                    <p class="text-muted mb-0">
                        Daftar seluruh kelas online.
                    </p>
                </div>

                <a href="{{ route('admin.kelas.create') }}"
                   class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Kelas
                </a>
            </div>

            <!-- NOTIFIKASI -->
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

            <!-- TABEL KELAS -->
            <div class="table-card">

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Kelas</th>
                                <th>Kategori</th>
                                <th>Instruktur</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($kelas as $index => $item)

                                <tr>
                                    <td>{{ $kelas->firstItem() + $index }}</td>

                                    <td>{{ $item->judul }}</td>

                                    <td>
                                        {{ $item->kategori->nama_kategori ?? 'Umum' }}
                                    </td>

                                    <td>{{ $item->instruktur }}</td>

                                    <td>
                                        {{ $item->harga > 0
                                            ? 'Rp '.number_format($item->harga, 0, ',', '.')
                                            : 'Gratis' }}
                                    </td>

                                    <td>
                                        @php
                                            $status = $item->status instanceof \App\Enums\StatusKelas
                                                ? $item->status->value
                                                : $item->status;
                                        @endphp

                                        @if ($status == 'published')
                                            <span class="badge bg-success">
                                                Published
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Draft
                                            </span>
                                        @endif
                                    </td>

                                    <!-- TOMBOL AKSI -->
                                    <td>
                                        <div class="d-flex gap-1">

                                            <a href="{{ route('admin.kelas.edit', $item->id_kelas) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.kelas.destroy', $item->id_kelas) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7"
                                        class="text-center text-muted py-4">
                                        Belum ada kelas.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $kelas->links() }}
                </div>

            </div>

        </div>

    </div>
</div>

</body>

</html>
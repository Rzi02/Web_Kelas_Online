<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Kategori - KelasOnline</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar {
            min-height: 100vh;
            background: #171c35;
            padding: 25px 15px;
        }

        .sidebar h4 {
            color: white;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: #c5c8d5;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #6254d8;
            color: white;
        }

        .content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Konten -->
        <div class="col-md-10 content">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Kelola Kategori</h3>
                    <p class="text-muted mb-0">
                        Kelola kategori kelas online.
                    </p>
                </div>

                <a href="{{ route('admin.kategori.create') }}"
                   class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
                </a>
            </div>

            <!-- Pesan -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabel Kategori -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="70">No</th>
                                    <th>Nama Kategori</th>
                                    <th width="200">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($kategori as $item)
                                    <tr>
                                        <td>
                                            {{ $kategori->firstItem() + $loop->index }}
                                        </td>

                                        <td class="fw-semibold">
                                            {{ $item->nama_kategori }}
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.kategori.edit', $item->id_kategori) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.kategori.destroy', $item->id_kategori) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Belum ada kategori.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $kategori->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>

</html>
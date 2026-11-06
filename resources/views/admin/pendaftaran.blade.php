<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pendaftaran - KelasOnline</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            font-family: Arial, sans-serif;
        }

        .content {
            padding: 30px;
        }

        .table-card {
            background: white;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(0,0,0,.04);
        }

        .table thead th {
            white-space: nowrap;
            color: #5146d8;
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

            <h4 class="fw-bold mb-1">Data Pendaftaran</h4>

            <p class="text-muted mb-4">
                Kelola peserta yang mendaftar kelas online.
            </p>

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

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- TABEL PENDAFTARAN -->
            <div class="table-card">

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Kelas</th>
                                <th>Kategori</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($pendaftaran as $index => $item)

                                @php
                                    $status = $item->status instanceof \App\Enums\StatusPendaftaran
                                        ? $item->status->value
                                        : $item->status;
                                @endphp

                                <tr>
                                    <td>
                                        {{ $pendaftaran->firstItem() + $index }}
                                    </td>

                                    <td>
                                        {{ $item->pendaftar->nama ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->pendaftar->email ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->pendaftar->no_telepon ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->kelas->judul ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->kelas->kategori->nama_kategori ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->tanggal_daftar
                                            ? $item->tanggal_daftar->format('d-m-Y')
                                            : '-' }}
                                    </td>

                                    <!-- STATUS -->
                                    <td>
                                        @if ($status == 'accepted')
                                            <span class="badge bg-success">
                                                Accepted
                                            </span>
                                        @elseif ($status == 'rejected')
                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    <!-- AKSI -->
                                    <td>
                                        @if ($status == 'pending')

                                            <form action="{{ route('admin.pendaftaran.updateStatus', $item->id_pendaftaran) }}"
                                                  method="POST">

                                                @csrf
                                                @method('PATCH')

                                                <div class="d-flex gap-1">

                                                    <select name="status"
                                                            class="form-select form-select-sm"
                                                            required>

                                                        <option value="" selected disabled>
                                                            Pilih Status
                                                        </option>

                                                        <option value="accepted">
                                                            Accepted
                                                        </option>

                                                        <option value="rejected">
                                                            Rejected
                                                        </option>

                                                    </select>

                                                    <button type="submit"
                                                            class="btn btn-primary btn-sm">
                                                        Simpan
                                                    </button>

                                                </div>
                                            </form>

                                        @else

                                            <span class="text-muted small">
                                                <i class="bi bi-lock-fill me-1"></i>
                                                Sudah diproses
                                            </span>

                                        @endif
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="9"
                                        class="text-center text-muted py-4">
                                        Belum ada pendaftaran.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $pendaftaran->links() }}
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
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
                                        <form action="{{ route('admin.pendaftaran.updateStatus', $item->id_pendaftaran) }}"
                                              method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <div class="d-flex gap-1">

                                                <select name="status"
                                                        class="form-select form-select-sm">

                                                    <option value="pending"
                                                        {{ $status == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>

                                                    <option value="accepted"
                                                        {{ $status == 'accepted' ? 'selected' : '' }}>
                                                        Accepted
                                                    </option>

                                                    <option value="rejected"
                                                        {{ $status == 'rejected' ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>

                                                </select>

                                                <button type="submit"
                                                        class="btn btn-primary btn-sm">
                                                    Simpan
                                                </button>

                                            </div>
                                        </form>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8"
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
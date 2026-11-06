<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kelas - KelasOnline</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; font-family: Arial, sans-serif; }
        .sidebar { background: #171c35; min-height: 100vh; padding: 25px 18px; }
        .brand { color: white; font-size: 23px; font-weight: bold; margin-bottom: 40px; }
        .brand span { color: #8b7bff; }
        .sidebar a {
            display: block; color: #b8bfd5; text-decoration: none;
            padding: 13px; border-radius: 8px; margin-bottom: 8px;
        }
        .sidebar a:hover, .sidebar a.active { background: #343b65; color: white; }
        .content { padding: 30px; }
        .form-card {
            background: white; border-radius: 15px; padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,.04);
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar">
            <div class="brand">KelasOnline<span>.</span></div>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.kelas') }}" class="active">Kelola Kelas</a>
            <a href="{{ route('admin.pendaftaran') }}">Pendaftaran</a>
            <a href="{{ route('home') }}">Lihat Website</a>

            <hr class="text-secondary">

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-light w-100">Logout</button>
            </form>
        </div>

        <div class="col-md-10 content">
            <h4 class="fw-bold">Edit Kelas</h4>
            <p class="text-muted">Ubah informasi kelas di bawah ini.</p>

            <div class="form-card">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Judul Kelas</label>
                        <input type="text" name="judul" class="form-control"
                               value="{{ old('judul', $kelas->judul) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}"
                                    {{ old('id_kategori', $kelas->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"
                                  rows="4" required>{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instruktur</label>
                        <input type="text" name="instruktur" class="form-control"
                               value="{{ old('instruktur', $kelas->instruktur) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control"
                               min="0" value="{{ old('harga', $kelas->harga) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Kelas</label>

                        @if ($kelas->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $kelas->gambar) }}"
                                     width="150" class="rounded">
                            </div>
                        @endif

                        <input type="file" name="gambar" class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="draft"
                                {{ old('status', $kelas->status instanceof \App\Enums\StatusKelas ? $kelas->status->value : $kelas->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="published"
                                {{ old('status', $kelas->status instanceof \App\Enums\StatusKelas ? $kelas->status->value : $kelas->status) == 'published' ? 'selected' : '' }}>
                                Published
                            </option>
                        </select>
                    </div>

                    <a href="{{ route('admin.kelas') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
</body>

</html>
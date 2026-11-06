<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kategori - KelasOnline</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <h3 class="fw-bold mb-2">Edit Kategori</h3>
                    <p class="text-muted">Ubah nama kategori yang dipilih.</p>

                    <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input
                                type="text"
                                name="nama_kategori"
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                required
                            >

                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.kategori') }}" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
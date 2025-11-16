<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <style>
        /* Salin CSS dari file index.blade.php jika diperlukan untuk styling */
        body { font-family: "Segoe UI", sans-serif; background-color: #f5f6fa; }
        .container { padding: 20px; }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card-header { padding: 1rem; border-bottom: 1px solid #ddd; }
        .card-body { padding: 1rem; }
        .form-label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-control { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box; }
        .is-invalid { border-color: red; }
        .invalid-feedback { color: red; font-size: 0.9em; margin-top: 5px; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background-color: blue; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .d-flex { display: flex; }
        .justify-content-between { justify-content: space-between; }
        .mb-3 { margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kategori</h4>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                <input type="text"
                                    class="form-control @error('nama_kategori') is-invalid @enderror"
                                    id="nama_kategori" name="nama_kategori"
                                    value="{{ old('nama_kategori') }}" required>
                                @error('nama_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Simpan
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
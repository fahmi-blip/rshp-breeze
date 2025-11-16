<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pet</title>
    <style>
        body { 
            font-family: "Segoe UI", sans-serif; 
            background-color: #f5f6fa; 
            padding: 20px;
        }
        .container { 
            max-width: 700px;
            margin: 0 auto;
            padding: 20px; 
        }
        .card { 
            background: #fff; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
        }
        .card-header { 
            padding: 1rem; 
            border-bottom: 1px solid #ddd;
            background: #f8f9fa;
            border-radius: 8px 8px 0 0;
        }
        .card-header h4 {
            margin: 0;
            color: #333;
        }
        .card-body { 
            padding: 1.5rem; 
        }
        .form-label { 
            display: block; 
            margin-bottom: 5px; 
            font-weight: 600; 
            color: #333;
        }
        .form-control, .form-select { 
            width: 100%; 
            padding: 10px; 
            border-radius: 5px; 
            border: 1px solid #ccc; 
            box-sizing: border-box;
            font-size: 14px;
        }
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }
        .is-invalid { 
            border-color: red; 
        }
        .invalid-feedback { 
            color: red; 
            font-size: 0.875em; 
            margin-top: 5px;
            display: block;
        }
        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .btn { 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            text-decoration: none; 
            display: inline-block;
            font-size: 14px;
            font-weight: 600;
        }
        .btn-primary { 
            background-color: #007bff; 
            color: white; 
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary { 
            background-color: #6c757d; 
            color: white; 
        }
        .btn-secondary:hover {
            background-color: #545b62;
        }
        .d-flex { 
            display: flex; 
        }
        .justify-content-between { 
            justify-content: space-between; 
        }
        .mb-3 { 
            margin-bottom: 1rem; 
        }
        .ms-auto {
            margin-left: auto;
        }
        .row {
            display: flex;
            gap: 15px;
        }
        .col-6 {
            flex: 1;
        }
        small.text-muted {
            color: #6c757d;
            font-size: 0.875em;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data Tindakan Baru</h4>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
    <form action="{{ route('admin.tindakan-terapi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode">Kode</label>
            <input type="text" id="kode" name="kode" value="{{ old('kode') }}" required>
             @error('nama')
             <div class="invalid-feedback">
                 {{ $message }}
             </div>
             @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi_tindakan_terapi">Deskripsi</label>
            <input type="text" id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi"
                    value="{{ old('deskripsi_tindakan_terapi') }}"
                    required>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="idkategori" class="form-label">Kategori <span class="required">*</span></label>
                <select class="form-select @error('idkategori') is-invalid @enderror" 
                        id="idkategori" name="idkategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->idkategori }}" {{ old('idkategori') == $item->idkategori ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('idkategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        {{-- <div class="">
            <label for="idkategori">Kategori</label>
            <select id="idkategori" name="idkategori" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategori as $item)
                    <option value="{{ $item->idkategori }}"></option>
                @endforeach
            </select>
        </div> --}}
        {{-- <div class="form-group">
            <label for="idkategori_klinis">Kategori Klinis</label>
            <select id="idkategori_klinis" name="idkategori_klinis" required>
                <option value="">Pilih Kategori Klinis</option>
                @foreach($kategoriKlinis as $item)
                    <option value="{{ $item->idkategori_klinis }}">{{ $item->nama_kategori_klinis }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="col-6">
            <div class="mb-3">
                <label for="idkategori_klinis" class="form-label">Kategori Klinis<span class="required">*</span></label>
                <select class="form-select @error('idkategori_klinis') is-invalid @enderror" 
                        id="idkategori_klinis" name="idkategori_klinis" required>
                    <option value="">-- Pilih Kategori Klinis--</option>
                    @foreach($kategoriKlinis as $item)
                        <option value="{{ $item->idkategori_klinis }}" {{ old('idkategori_klinis') == $item->idkategori_klinis ? 'selected' : '' }}>
                            {{ $item->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
                @error('idkategori_klinis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tindakan-terapi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                    </div>
    </form>
  </div>
</main>
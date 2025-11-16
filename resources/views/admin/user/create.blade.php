<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <style>
        body { 
            font-family: "Segoe UI", sans-serif; 
            background-color: #f5f6fa; 
            padding: 20px;
        }
        .container { 
            max-width: 600px;
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
        .form-control { 
            width: 100%; 
            padding: 10px; 
            border-radius: 5px; 
            border: 1px solid #ccc; 
            box-sizing: border-box;
            font-size: 14px;
        }
        .form-control:focus {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah User Baru</h4>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.user.store') }}" method="POST">
                            @csrf
                            
                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" 
                                    name="nama"
                                    value="{{ old('nama') }}" 
                                    required
                                    placeholder="Masukkan nama lengkap">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email" 
                                    name="email"
                                    value="{{ old('email') }}" 
                                    required
                                    placeholder="contoh@email.com">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password" 
                                    name="password"
                                    required
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small style="color: #6c757d; font-size: 0.875em;">
                                    Password minimal 8 karakter
                                </small>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <i class="fas fa-save"></i> Simpan
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
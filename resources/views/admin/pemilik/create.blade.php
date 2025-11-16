<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemilik</title>
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
        textarea.form-control {
            resize: vertical;
            min-height: 80px;
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
        small.text-muted {
            color: #6c757d;
            font-size: 0.875em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Pemilik Baru</h4>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.pemilik.store') }}" method="POST">
                            @csrf
                            
                            <!-- User Pemilik -->
                            <div class="mb-3">
                                <label for="iduser" class="form-label">User Pemilik <span style="color: red;">*</span></label>
                                <select class="form-select @error('iduser') is-invalid @enderror" 
                                        id="iduser" name="iduser" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                            {{ $user->nama }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('iduser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small class="text-muted">Pilih user yang akan dijadikan pemilik</small>
                            </div>

                            <!-- Nomor WA -->
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">Nomor WhatsApp <span style="color: red;">*</span></label>
                                <input type="text"
                                    class="form-control @error('no_wa') is-invalid @enderror"
                                    id="no_wa" 
                                    name="no_wa"
                                    value="{{ old('no_wa') }}" 
                                    required
                                    placeholder="08123456789"
                                    maxlength="20">
                                @error('no_wa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small class="text-muted">Format: 08xxx atau 628xxx (minimal 10 digit)</small>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap <span style="color: red;">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          id="alamat" 
                                          name="alamat" 
                                          rows="4" 
                                          required
                                          placeholder="Masukkan alamat lengkap pemilik">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small class="text-muted">Minimal 5 karakter, maksimal 500 karakter</small>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <i class="fas fa-save"></i> Simpan Data
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
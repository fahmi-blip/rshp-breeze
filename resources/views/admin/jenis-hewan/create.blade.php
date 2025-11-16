<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Jenis Hewan</h4>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                            @csrf
                        <div class="mb-3">
                            <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                            <input type="text"
                                class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                                id="nama_jenis_hewan" name="nama_jenis_hewan"
                                value="{{ old('nama_jenis_hewan') }}" required
                                >
                                @error('nama_jenis_hewan')
                                <div class="invalid-feedback">
                                    {{$message }}
                                </div>
                                @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary ms-auto">
                                <i class="fas fa-save"></i>Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

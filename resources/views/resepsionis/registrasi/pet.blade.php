@extends('layouts.partial.main')

@section('title', 'Registrasi Pet')
@section('page-title', 'Registrasi Pet')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        
        {{-- Tampilkan Alert Sukses --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif

        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Registrasi Hewan Peliharaan</h6>
            </div>

            <div class="flex-auto p-6">
                {{-- Update Action Route --}}
                <form action="{{ route('resepsionis.registrasi.pet.store') }}" method="POST">
                    @csrf
                    
                    <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idpemilik" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                                Pemilik <span class="text-red-500">*</span>
                            </label>
                            <select id="idpemilik" name="idpemilik" required
                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idpemilik') border-red-500 @enderror">
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach($pemilik as $item)
                                    <option value="{{ $item->idpemilik }}" {{ old('idpemilik') == $item->idpemilik ? 'selected' : '' }}>
                                        {{ $item->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpemilik')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Nama Pet</label>
                            <input type="text" name="nama_pet" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Nama hewan" />
                        </div>
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Tanggal Lahir (Estimasi)</label>
                            <input type="date" name="tanggal_lahir" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Jenis Hewan</label>
                            <select name="idjenis_hewan" id="jenis_hewan" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                <option value="">-- Pilih Jenis --</option>
                                @foreach($jenisHewan as $jh)
                                    <option value="{{ $jh->idjenis_hewan }}">{{ $jh->nama_jenis_hewan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Ras Hewan</label>
                            <select name="idras_hewan" id="ras_hewan" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                <option value="">-- Pilih Jenis Terlebih Dahulu --</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                        <label for="jenis_kelamin" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            <option value="">-- Pilih Gender --</option>
                            <option value="J">Jantan</option>
                            <option value="B">Betina</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Warna / Tanda Khusus</label>
                        <input type="text" name="warna_tanda" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Contoh: Putih, ada tompel di kuping kanan" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('resepsionis.registrasi.index_pet') }}" 
                           class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center align-middle transition-all bg-transparent border rounded-lg cursor-pointer text-slate-700 border-slate-700 leading-pro ease-soft-in shadow-soft-xs hover:scale-102 active:opacity-85 hover:bg-slate-700 hover:text-white hover:shadow-soft-xs">
                            <i class="mr-1 fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" 
                                class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25">
                            <i class="mr-1 fas fa-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT AJAX --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisSelect = document.getElementById('jenis_hewan');
    const rasSelect = document.getElementById('ras_hewan');

    jenisSelect.addEventListener('change', function() {
        const idjenis = this.value;

        rasSelect.innerHTML = '<option value="">Sedang memuat...</option>';

        if (!idjenis) {
            rasSelect.innerHTML = '<option value="">-- Pilih Jenis Terlebih Dahulu --</option>';
            return;
        }

        fetch(`/resepsionis/registrasi/pet/get-ras-hewan/${idjenis}`)
            .then(res => res.json())
            .then(data => {
                rasSelect.innerHTML = '<option value="">-- Pilih Ras --</option>';

                if (data.length === 0) {
                    rasSelect.innerHTML += '<option value="">Tidak ada data ras</option>';
                    return;
                }

                data.forEach(r => {
                    rasSelect.innerHTML += `
                        <option value="${r.idras_hewan}">${r.nama_ras}</option>
                    `;
                });
            })
            .catch(() => {
                rasSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            });
    });
});
</script>


@endsection
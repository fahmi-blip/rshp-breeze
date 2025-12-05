@extends('layouts.partial.main')

@section('title', 'Tambah Temu Dokter')
@section('page-title', 'Tambah Temu Dokter')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        
        {{-- Tampilkan Alert Error --}}
        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">Terjadi kesalahan!</span>
                <ul class="mt-2 ml-4 list-disc">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Registrasi Temu Dokter</h6>
                <p class="text-xs text-slate-400">Daftarkan pasien untuk bertemu dengan dokter</p>
            </div>

            <div class="flex-auto p-6">
                <form action="{{ route('resepsionis.registrasi.temudokter.store') }}" method="POST">
                    @csrf
                    
                    {{-- Pilih Pet --}}
                    <div class="mb-4">
                        <label for="idpet" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Pilih Hewan Peliharaan <span class="text-red-500">*</span>
                        </label>
                        <select id="idpet" name="idpet" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idpet') border-red-500 @enderror">
                            <option value="">-- Pilih Pet --</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                                    {{ $pet->nama_pet }} - Pemilik: {{ $pet->nama_pemilik }}
                                </option>
                            @endforeach
                        </select>
                        @error('idpet')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pilih Dokter --}}
                    <div class="mb-4">
                        <label for="idrole_user" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Pilih Dokter <span class="text-red-500">*</span>
                        </label>
                        <select id="idrole_user" name="idrole_user" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idrole_user') border-red-500 @enderror">
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->idrole_user }}" {{ old('idrole_user') == $dokter->idrole_user ? 'selected' : '' }}>
                                    {{ $dokter->nama_dokter }}
                                </option>
                            @endforeach
                        </select>
                        @error('idrole_user')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('resepsionis.registrasi.temudokter') }}" 
                           class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center align-middle transition-all bg-transparent border rounded-lg cursor-pointer text-slate-700 border-slate-700 leading-pro ease-soft-in shadow-soft-xs hover:scale-102 active:opacity-85 hover:bg-slate-700 hover:text-white hover:shadow-soft-xs">
                            <i class="mr-1 fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" 
                                class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25">
                            <i class="mr-1 fas fa-save"></i> Tambah ke Antrian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.partial.main')

@section('title', 'Tambah Tindakan & Terapi')
@section('page-title', 'Tambah Tindakan')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Tambah Data Tindakan</h6>
            </div>

            <div class="flex-auto p-6">
                @if (session('error'))
                    <div alert class="relative w-full p-4 mb-4 text-white border border-red-300 border-solid rounded-lg bg-gradient-to-tl from-red-600 to-rose-400">{{ session('error') }}</div>

                @endif

                <form action="{{ route('admin.tindakan-terapi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="kode" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Kode Tindakan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode" name="kode" 
                               value="{{ old('kode') }}" required 
                               placeholder="Contoh: T001"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('kode') border-red-500 @enderror" />
                        @error('kode')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi_tindakan_terapi" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Deskripsi Tindakan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" 
                               value="{{ old('deskripsi_tindakan_terapi') }}" required 
                               placeholder="Masukkan deskripsi tindakan"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('deskripsi_tindakan_terapi') border-red-500 @enderror" />
                        @error('deskripsi_tindakan_terapi')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idkategori" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select id="idkategori" name="idkategori" required
                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idkategori') border-red-500 @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->idkategori }}" {{ old('idkategori') == $item->idkategori ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idkategori')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idkategori_klinis" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                                Kategori Klinis <span class="text-red-500">*</span>
                            </label>
                            <select id="idkategori_klinis" name="idkategori_klinis" required
                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idkategori_klinis') border-red-500 @enderror">
                                <option value="">-- Pilih Kategori Klinis --</option>
                                @foreach($kategoriKlinis as $item)
                                    <option value="{{ $item->idkategori_klinis }}" {{ old('idkategori_klinis') == $item->idkategori_klinis ? 'selected' : '' }}>
                                        {{ $item->nama_kategori_klinis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idkategori_klinis')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.tindakan-terapi.index') }}" 
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
@endsection
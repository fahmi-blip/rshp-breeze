@extends('layouts.partial.main')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Tambah User Baru</h6>
            </div>

            <div class="flex-auto p-6">
                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-white bg-red-500 rounded-lg shadow-soft-2xl" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nama" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" 
                               value="{{ old('nama') }}" required 
                               placeholder="Masukkan nama lengkap"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nama') border-red-500 @enderror" />
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" 
                               value="{{ old('email') }}" required 
                               placeholder="contoh@email.com"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('email') border-red-500 @enderror" />
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" 
                               required 
                               placeholder="Minimal 8 karakter"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('password') border-red-500 @enderror" />
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 ml-1 text-xs text-slate-400">Password minimal 8 karakter.</p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.user.index') }}" 
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
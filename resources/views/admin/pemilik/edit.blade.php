@extends('layouts.partial.main')

@section('title', 'Edit Pemilik')
@section('page-title', 'Edit Pemilik')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Edit Pemilik</h6>
            </div>

            <div class="flex-auto p-6">
                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-white bg-red-500 rounded-lg" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- User Pemilik -->
                    <div class="mb-4">
                        <label for="iduser" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            User Pemilik <span class="text-red-500">*</span>
                        </label>
                        <select id="iduser" name="iduser" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('iduser') border-red-500 @enderror">
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $item)
                                <option value="{{ $item->iduser }}" {{ old('iduser', $pemilik->iduser) == $item->iduser ? 'selected' : '' }}>
                                    {{ $item->nama }} ({{ $item->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('iduser')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 ml-1 text-xs text-slate-400">Pilih user yang akan dijadikan pemilik.</p>
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div class="mb-4">
                        <label for="no_wa" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="no_wa" 
                               name="no_wa" 
                               value="{{ old('no_wa', $pemilik->no_wa) }}" 
                               required 
                               placeholder="Contoh: 08123456789"
                               maxlength="20"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('no_wa') border-red-500 @enderror" />
                        @error('no_wa')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 ml-1 text-xs text-slate-400">Format: 08xxx atau 628xxx (minimal 10 digit).</p>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" 
                                  name="alamat" 
                                  rows="4" 
                                  required
                                  placeholder="Masukkan alamat lengkap pemilik"
                                  class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('alamat') border-red-500 @enderror">{{ old('alamat', $pemilik->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 ml-1 text-xs text-slate-400">Minimal 5 karakter, maksimal 500 karakter.</p>
                    </div>

                    <!-- Tombol Action -->
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.pemilik.index') }}" 
                           class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center align-middle transition-all bg-transparent border rounded-lg cursor-pointer text-slate-700 border-slate-700 leading-pro ease-soft-in shadow-soft-xs hover:scale-102 active:opacity-85 hover:bg-slate-700 hover:text-white hover:shadow-soft-xs">
                            <i class="mr-1 fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" 
                                class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25">
                            <i class="mr-1 fas fa-save"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
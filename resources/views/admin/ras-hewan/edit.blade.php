@extends('layouts.partial.main')

@section('title', 'Edit Ras Hewan')
@section('page-title', 'Edit Ras Hewan')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Edit Ras Hewan</h6>
            </div>

            <div class="flex-auto p-6">
                @if (session('error'))
                    <div class="relative w-full p-4 mb-4 text-white border border-red-300 border-solid rounded-lg bg-gradient-to-tl from-red-600 to-rose-400">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Asumsi variable yang dikirim dari controller adalah $rasHewan --}}
                <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nama_ras" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Nama Ras <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_ras" name="nama_ras" 
                               value="{{ old('nama_ras', $rasHewan->nama_ras) }}" required 
                               placeholder="Contoh: Persia, Anggora, Bulldog"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nama_ras') border-red-500 @enderror" />
                        @error('nama_ras')
                            <p class="relative w-full p-4 mt-1 mb-4 text-xs text-white border border-red-300 border-solid rounded-lg bg-gradient-to-tl from-red-600 to-rose-400">{{ $message }}</p>
                        @enderror
                         <p class="mt-1 ml-1 text-xs text-slate-400">Isi nama minimal 3 huruf.</p>
                    </div>

                    <div class="mb-4">
                        <label for="idjenis_hewan" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Jenis Hewan <span class="text-red-500">*</span>
                        </label>
                        <select id="idjenis_hewan" name="idjenis_hewan" required
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idjenis_hewan') border-red-500 @enderror">
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach($jenisHewan as $item)
                                <option value="{{ $item->idjenis_hewan }}" {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $item->idjenis_hewan ? 'selected' : '' }}>
                                    {{ $item->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>
                        @error('idjenis_hewan')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 ml-1 text-xs text-slate-400">Pilih jenis hewan yang sesuai dengan ras ini.</p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.ras-hewan.index') }}" 
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
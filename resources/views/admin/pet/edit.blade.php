@extends('layouts.partial.main')

@section('title', 'Edit Data Pet')
@section('page-title', 'Edit Pet')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Edit Data Pet</h6>
            </div>

            <div class="flex-auto p-6">
                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-white bg-red-500 rounded-lg shadow-soft-2xl" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Asumsi variable yang dikirim dari controller adalah $pet --}}
                <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nama" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Nama Pet <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" 
                               value="{{ old('nama', $pet->nama) }}" required 
                               placeholder="Contoh: Milo, Kitty, dll"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('nama') border-red-500 @enderror" />
                        @error('nama')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idpemilik" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                                Pemilik <span class="text-red-500">*</span>
                            </label>
                            <select id="idpemilik" name="idpemilik" required
                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idpemilik') border-red-500 @enderror">
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach($pemilik as $item)
                                    <option value="{{ $item->idpemilik }}" {{ old('idpemilik', $pet->idpemilik) == $item->idpemilik ? 'selected' : '' }}>
                                        {{ $item->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpemilik')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idras_hewan" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                                Ras Hewan <span class="text-red-500">*</span>
                            </label>
                            <select id="idras_hewan" name="idras_hewan" required
                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('idras_hewan') border-red-500 @enderror">
                                <option value="">-- Pilih Ras --</option>
                                @foreach($rasHewan as $item)
                                    <option value="{{ $item->idras_hewan }}" {{ old('idras_hewan', $pet->idras_hewan) == $item->idras_hewan ? 'selected' : '' }}>
                                        {{ $item->nama_ras }} ({{ $item->jenisHewan->nama_jenis_hewan }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idras_hewan')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="tanggal_lahir" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" 
                                   value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" required 
                                   max="{{ date('Y-m-d') }}"
                                   class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('tanggal_lahir') border-red-500 @enderror" />
                            @error('tanggal_lahir')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="jenis_kelamin" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required
                                class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('jenis_kelamin') border-red-500 @enderror">
                                <option value="">-- Pilih Gender --</option>
                                <option value="J" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' || old('jenis_kelamin', $pet->jenis_kelamin) == '1' ? 'selected' : '' }}>Jantan</option>
                                <option value="B" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' || old('jenis_kelamin', $pet->jenis_kelamin) == '0' ? 'selected' : '' }}>Betina</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="warna_tanda" class="mb-2 ml-1 text-xs font-bold text-slate-700">
                            Warna / Tanda Khusus <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="warna_tanda" name="warna_tanda" 
                               value="{{ old('warna_tanda', $pet->warna_tanda) }}" required 
                               placeholder="Contoh: Putih dengan bercak hitam di telinga"
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none @error('warna_tanda') border-red-500 @enderror" />
                        @error('warna_tanda')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 ml-1 text-xs text-slate-400">Deskripsikan ciri khas hewan peliharaan.</p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.pet.index') }}" 
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
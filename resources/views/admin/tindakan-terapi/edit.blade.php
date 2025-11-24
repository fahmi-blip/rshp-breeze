@extends('layouts.partial.main')

@section('title', 'Edit Tindakan & Terapi')
@section('page-title', 'Edit Tindakan')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Edit Tindakan</h6>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('admin.tindakan-terapi.update', $tindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="kode" class="mb-2 ml-1 text-xs font-bold text-slate-700">Kode</label>
                        <input type="text" name="kode" id="kode"
                               value="{{ old('kode', $tindakanTerapi->kode) }}" required
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi_tindakan_terapi" class="mb-2 ml-1 text-xs font-bold text-slate-700">Deskripsi</label>
                        <input type="text" name="deskripsi_tindakan_terapi" id="deskripsi_tindakan_terapi"
                               value="{{ old('deskripsi_tindakan_terapi', $tindakanTerapi->deskripsi_tindakan_terapi) }}" required
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                    </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idkategori" class="mb-2 ml-1 text-xs font-bold text-slate-700">Kategori</label>
                            <select name="idkategori" id="idkategori" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                @foreach($kategori as $item)
                                    <option value="{{ $item->idkategori }}" {{ old('idkategori', $tindakanTerapi->idkategori) == $item->idkategori ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idkategori_klinis" class="mb-2 ml-1 text-xs font-bold text-slate-700">Kategori Klinis</label>
                            <select name="idkategori_klinis" id="idkategori_klinis" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                @foreach($kategoriKlinis as $item)
                                    <option value="{{ $item->idkategori_klinis }}" {{ old('idkategori_klinis', $tindakanTerapi->idkategori_klinis) == $item->idkategori_klinis ? 'selected' : '' }}>
                                        {{ $item->nama_kategori_klinis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.tindakan-terapi.index') }}" class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center align-middle transition-all bg-transparent border rounded-lg cursor-pointer text-slate-700 border-slate-700 leading-pro ease-soft-in shadow-soft-xs hover:scale-102 active:opacity-85 hover:bg-slate-700 hover:text-white hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
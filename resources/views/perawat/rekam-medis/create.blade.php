@extends('layouts.partial.main')

@section('title', 'Input Pemeriksaan Awal')
@section('page-title', 'Pemeriksaan Awal')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 flex-0">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Pemeriksaan Awal (Perawat)</h6>
            </div>
            
            <div class="flex-auto p-6">
                <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                    @csrf
                    {{-- Hidden ID Reservasi --}}
                    <input type="hidden" name="idreservasi_dokter" value="{{ $data->idreservasi_dokter }}">

                    <div class="flex flex-wrap -mx-3">
                        {{-- Info Pasien (Readonly) --}}
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/3 md:flex-none">
                            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                <h6 class="mb-3 text-sm font-bold text-slate-700">Informasi Pasien</h6>
                                <div class="mb-2">
                                    <label class="text-xs text-slate-500">Nama Hewan</label>
                                    <p class="text-sm font-bold text-slate-800">{{ $data->nama_pet }} ({{ $data->jenis_kelamin }})</p>
                                </div>
                                <div class="mb-2">
                                    <label class="text-xs text-slate-500">Pemilik</label>
                                    <p class="text-sm font-bold text-slate-800">{{ $data->nama_pemilik }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Form Input Medis --}}
                        <div class="w-full max-w-full px-3 mb-6 md:w-2/3 md:flex-none">
                            {{-- Anamnesa --}}
                            <div class="mb-4">
                                <label for="anamnesa" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700">Anamnesa (Riwayat Kesehatan) <span class="text-red-500">*</span></label>
                                <textarea name="anamnesa" rows="4" required placeholder="Masukkan detail riwayat keluhan, makan/minum, muntah/diare, dll."
                                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">{{ old('anamnesa', $rekamMedis->anamnesa ?? '') }}</textarea>
                            </div>

                            {{-- Temuan Klinis --}}
                            <div class="mb-4">
                                <label for="temuan_klinis" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700">Temuan Klinis (Pemeriksaan Fisik) <span class="text-red-500">*</span></label>
                                <textarea name="temuan_klinis" rows="4" required placeholder="Masukkan hasil pemeriksaan fisik (Suhu, Berat Badan, Detak Jantung, Kondisi Fisik, dll)."
                                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">{{ old('temuan_klinis', $rekamMedis->temuan_klinis ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-4 mt-4 border-t">
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border rounded-lg cursor-pointer text-slate-700 border-slate-700 hover:bg-slate-700 hover:text-white">
                            Batal
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-102 shadow-soft-md">
                            <i class="mr-1 fas fa-save"></i> Simpan Data Medis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
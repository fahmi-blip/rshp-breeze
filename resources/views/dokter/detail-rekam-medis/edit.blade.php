@extends('layouts.partial.main')

@section('title', 'Pemeriksaan Dokter')
@section('page-title', 'Detail Pemeriksaan')

@section('content')
<form action="{{ route('dokter.detail-rekam-medis.update', $data->idreservasi_dokter) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="flex flex-wrap -mx-3">
        
        {{-- KOLOM KIRI: DATA DARI PERAWAT & PASIEN --}}
        <div class="w-full max-w-full px-3 mb-6 md:w-1/3 md:flex-none">
            
            {{-- Kartu Pasien --}}
            <div class="relative flex flex-col min-w-0 mb-4 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-4 bg-gradient-to-tl from-purple-700 to-pink-500 rounded-t-2xl">
                    <h6 class="mb-0 font-bold text-white">Data Pasien</h6>
                </div>
                <div class="flex-auto p-4">
                    <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <li class="relative block px-0 py-2 pt-0 bg-white border-0 rounded-t-lg text-inherit">
                            <strong class="text-slate-700">Nama Hewan:</strong> <br>
                            {{ $data->nama_pet }} ({{ $data->jenis_kelamin }})
                        </li>
                        <li class="relative block px-0 py-2 bg-white border-0 text-inherit">
                            <strong class="text-slate-700">Pemilik:</strong> <br>
                            {{ $data->nama_pemilik }}
                        </li>
                        <li class="relative block px-0 py-2 pb-0 bg-white border-0 rounded-b-lg text-inherit">
                            <strong class="text-slate-700">Ciri/Tanda:</strong> <br>
                            {{ $data->warna_tanda ?? '-' }}
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Kartu Tanda-Tanda Vital (Dari Perawat) --}}
            <div class="relative flex flex-col min-w-0 mb-4 break-words border-0 bg-orange-50 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-4 border-b border-orange-100">
                    <h6 class="mb-0 font-bold text-orange-700"><i class="mr-1 fas fa-notes-medical"></i> Catatan Perawat</h6>
                </div>
                <div class="flex-auto p-4">
                    <div class="mb-3">
                        <label class="text-xs font-bold uppercase text-slate-500">Anamnesa (Riwayat):</label>
                        <p class="p-2 mt-1 text-sm font-semibold bg-white border border-orange-200 rounded text-slate-800">
                            {{ $data->anamnesa ?? '(Belum diisi perawat)' }}
                        </p>
                    </div>
                    <div>
                        <label class="text-xs font-bold uppercase text-slate-500">Temuan Klinis (Fisik):</label>
                        <p class="p-2 mt-1 text-sm font-semibold bg-white border border-orange-200 rounded text-slate-800">
                            {{ $data->temuan_klinis ?? '(Belum diisi perawat)' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM DIAGNOSA DOKTER --}}
        <div class="w-full max-w-full px-3 mb-6 md:w-2/3 md:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="text-lg font-bold"><i class="mr-2 fas fa-user-md"></i> Pemeriksaan Dokter</h6>
                    <p class="text-xs text-slate-400">Silakan isi diagnosa dan pilih tindakan yang dilakukan.</p>
                </div>
                
                <div class="flex-auto p-6">
                    
                    {{-- Input Diagnosa --}}
                    <div class="mb-6">
                        <label for="diagnosa" class="inline-block mb-2 ml-1 text-sm font-bold text-slate-700">Diagnosa <span class="text-red-500">*</span></label>
                        <textarea name="diagnosa" rows="4" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Tuliskan hasil diagnosa medis...">{{ old('diagnosa', $data->diagnosa) }}</textarea>
                    </div>

                    {{-- Pilihan Tindakan / Terapi (Checkbox List dengan Scroll) --}}
                    <div class="mb-6">
                        <label class="inline-block mb-2 ml-1 text-sm font-bold text-slate-700">Tindakan & Terapi</label>
                        <div class="h-64 p-4 overflow-y-auto border border-gray-300 rounded-lg bg-gray-50">
                            
                            @php $currentCategory = null; @endphp
                            
                            @foreach($tindakanList as $tindakan)
                                {{-- Grouping Header --}}
                                @if($tindakan->nama_kategori_klinis != $currentCategory)
                                    <div class="mt-2 mb-2">
                                        <span class="px-2 py-1 text-xs font-bold text-purple-600 uppercase bg-purple-100 rounded">
                                            {{ $tindakan->nama_kategori_klinis }}
                                        </span>
                                    </div>
                                    @php $currentCategory = $tindakan->nama_kategori_klinis; @endphp
                                @endif

                                <div class="flex items-center pl-2 mb-2">
                                    <input type="checkbox" name="tindakan[]" value="{{ $tindakan->idkode_tindakan_terapi }}" id="tindakan_{{ $tindakan->idkode_tindakan_terapi }}"
                                           class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500"
                                           {{ in_array($tindakan->idkode_tindakan_terapi, $existingTindakan) ? 'checked' : '' }}>
                                    <label for="tindakan_{{ $tindakan->idkode_tindakan_terapi }}" class="ml-2 text-sm font-medium text-gray-900 cursor-pointer">
                                        <span class="font-bold">{{ $tindakan->kode }}</span> - {{ $tindakan->deskripsi_tindakan_terapi }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <p class="mt-1 text-xs text-slate-400">Centang tindakan atau obat yang diberikan kepada pasien.</p>
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t">
                        <a href="{{ route('dokter.detail-rekam-medis.index') }}" class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border rounded-lg cursor-pointer text-slate-700 border-slate-700 hover:bg-slate-700 hover:text-white">
                            Kembali
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-102 shadow-soft-md">
                            <i class="mr-1 fas fa-save"></i> Simpan Hasil Pemeriksaan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
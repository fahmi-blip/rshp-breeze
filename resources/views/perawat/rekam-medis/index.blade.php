@extends('layouts.partial.main')

@section('title', 'Pemeriksaan Awal Perawat')
@section('page-title', 'Pemeriksaan Awal')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-white bg-green-500 rounded-lg shadow-md">
                <i class="mr-2 fas fa-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Antrian Pasien Hari Ini ({{ date('d M Y') }})</h6>
                <p class="text-xs text-slate-400">Silakan input Anamnesa & Temuan Klinis sebelum pasien bertemu dokter.</p>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No. Urut</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pasien</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pemilik</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dokter Tujuan</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status Data</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($antrian as $item)
                            <tr>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-bold">{{ $item->no_urut ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <h6 class="mb-0 text-sm font-bold leading-normal text-slate-700">{{ $item->nama_pet }}</h6>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight">{{ $item->nama_pemilik }}</p>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold text-slate-700">{{ $item->nama_dokter }}</span>
                                </td>
                                <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->idrekam_medis)
                                        <span class="px-2.5 py-1.5 rounded-lg text-xxs font-bold uppercase bg-green-100 text-green-800">Sudah Diisi</span>
                                    @else
                                        <span class="px-2.5 py-1.5 rounded-lg text-xxs font-bold uppercase bg-red-100 text-red-800">Belum Diisi</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    
                                    <a href="{{ route('perawat.rekam-medis.create', $item->idreservasi_dokter) }}" class="inline-block px-4 py-2 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-102 shadow-soft-md">
                                            <i class="mr-1 fas fa-stethoscope"></i> {{ $item->idrekam_medis ? 'Edit' : 'Input' }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-2 text-3xl fas fa-clipboard-check text-slate-300"></i>
                                        <span class="text-sm">Tidak ada antrian pasien saat ini.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
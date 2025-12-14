@extends('layouts.partial.main')

@section('title', 'Daftar Pasien Dokter')
@section('page-title', 'Daftar Periksa Pasien')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-white bg-green-500 rounded-lg shadow-md"><i class="mr-2 fas fa-check"></i>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="p-4 mb-4 text-sm text-white bg-red-500 rounded-lg shadow-md"><i class="mr-2 fas fa-exclamation"></i>{{ session('error') }}</div>
        @endif

        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Antrian Pasien Anda Hari Ini</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                                <th class="px-6 py-3 font-bold text-left uppercase bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Waktu Daftar</th>
                                <th class="px-6 py-3 font-bold text-left uppercase bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pasien & Pemilik</th>
                                <th class="px-6 py-3 font-bold text-left uppercase bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status Diagnosa</th>
                                <th class="px-6 py-3 font-bold text-center uppercase bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($antrian as $item)
                            <tr>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-500">{{ $item->no_urut ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight">
                                         {{ \Carbon\Carbon::parse($item->waktu_daftar)->timezone('Asia/Jakarta')->format('d M Y') }}<br>
                                        {{ \Carbon\Carbon::parse($item->waktu_daftar)->timezone('Asia/Jakarta')->format('H:i:s') }}
                                    </p>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <h6 class="mb-0 text-sm font-bold leading-normal">{{ $item->nama_pet }}</h6>
                                    <p class="mb-0 text-xs text-slate-400">{{ $item->nama_pemilik }}</p>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->diagnosa)
                                        <span class="px-2.5 py-1.5 rounded-lg text-xxs font-bold uppercase bg-green-100 text-green-800">Terisi</span>
                                    @else
                                        <span class="px-2.5 py-1.5 rounded-lg text-xxs font-bold uppercase bg-gray-100 text-gray-800">Belum Diisi</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->status == '3')
                                        <a href="{{ route('dokter.detail-rekam-medis.edit', $item->idreservasi_dokter) }}" class="inline-block px-4 py-2 mb-0 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border rounded-lg shadow-none cursor-pointer text-slate-500 border-slate-300 hover:scale-102">
                                            <i class="mr-1 fas fa-eye"></i> Detail
                                        </a>
                                    @else
                                        <a href="{{ route('dokter.detail-rekam-medis.edit', $item->idreservasi_dokter) }}" class="inline-block px-4 py-2 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-102 shadow-soft-md">
                                            <i class="mr-1 fas fa-stethoscope"></i> Periksa
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-slate-400">Belum ada pasien antri hari ini.</td>
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
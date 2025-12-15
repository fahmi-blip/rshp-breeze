@extends('layouts.partial.main')

@section('title', 'Riwayat Medis')
@section('page-title', 'Riwayat Kesehatan Hewan')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Daftar Riwayat Pemeriksaan</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Tanggal Periksa</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Hewan</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Dokter</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Diagnosa</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $item)
                            <tr>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                                    <p class="mb-0 text-xs font-semibold leading-tight">{{ date('d M Y', strtotime($item->tanggal)) }}</p>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                                    <h6 class="mb-0 text-sm font-bold leading-normal">{{ $item->nama_pet }}</h6>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                                    <p class="mb-0 text-xs leading-tight">{{ $item->nama_dokter }}</p>
                                </td>
                                <td class="px-6 py-3 align-middle bg-transparent border-b whitespace-nowrap">
                                    <p class="mb-0 text-xs italic leading-tight">{{ Str::limit($item->diagnosa, 40) }}</p>
                                </td>
                                <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                    <a href="{{ route('pemilik.riwayat.detail', $item->idrekam_medis) }}" class="inline-block px-4 py-2 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-102 shadow-soft-md">
                                        <i class="mr-1 fas fa-file-medical"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-slate-400">Belum ada riwayat medis.</td>
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
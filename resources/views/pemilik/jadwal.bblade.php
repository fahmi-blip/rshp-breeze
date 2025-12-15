@extends('layouts.partial.main')

@section('title', 'Jadwal Temu Dokter')
@section('page-title', 'Jadwal Saya')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Jadwal Temu Dokter Hewan Anda</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Tanggal</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Hewan</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Dokter</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Keluhan</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 text-xxs opacity-70">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwal as $item)
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
                                    <p class="mb-0 text-xs leading-tight text-slate-400">{{ Str::limit($item->keluhan, 30) }}</p>
                                </td>
                                <td class="px-6 py-3 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                    @php
                                        $statusColor = match($item->status) {
                                            'Menunggu' => 'bg-yellow-100 text-yellow-800',
                                            'Diperiksa' => 'bg-blue-100 text-blue-800',
                                            'Selesai' => 'bg-green-100 text-green-800',
                                            'Batal' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1.5 rounded-lg text-xxs font-bold uppercase {{ $statusColor }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-slate-400">Belum ada jadwal temu dokter.</td>
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